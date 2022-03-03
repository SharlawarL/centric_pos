<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class License_issuance extends MY_Controller
{
	function __construct() {
		parent::__construct();
		$this->load->model('log_model');
		$this->load->library('zend');
	    $this->zend->load('Zend/Barcode');
	    $this->load->model('sales_model');
	    $this->load->model('ion_auth_model');
	    $this->load->model('biller_model');
		$this->load->model('stock_model');

		$this->load->model('branch_model');
		$this->load->model('warehouse_model');
		$this->load->model('user_model');
		$this->load->model('category_model');
		$this->load->model('subcategory_model');
		$this->load->model('brand_model');
		$this->load->model('product_model');
		$this->load->model('payment_method_model');
		$this->load->model('expense_category_model');
		$this->load->model('uqc_model');
		$this->load->model('discount_model');
		$this->load->model('company_setting_model');
		$this->load->model('subscription_model');
		$this->load->model('license_issuance_model');
		

		$this->load->model('email_setup_model');
        $this->load->model('sms_setting_model');
	    
	}

	public function index()
	{
		if(!$this->user_model->has_permission("list_license"))
		{
			$this->load->view('layout/restricted');	
		}
		else
		{

			$data['plan'] = $this->license_issuance_model->getPlan();
			$data['data'] = $this->license_issuance_model->getLicenses();

			$this->load->view('license_issuance/list',$data);		
		}
	}
	/* 
		generate new license key
	*/
	public function generate_key(){
		if(!$this->user_model->has_permission("add_license"))
		{
			$this->load->view('layout/restricted');	
		}
		else
		{
			$license = rand(1000,9999) . '-' . rand(1000,9999) . '-' . rand(1000,9999) . '-' . rand(1000,9999) . '-' . rand(1000,9999);

			$data = array(
				"license_key" => $license,
				"license_key_status" => 0,
				"date_created" => date('Y-m-d'),					
			);
			if($id = $this->license_issuance_model->generateKey($data)){ 
				$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'License Key Inserted'
					);
				$this->log_model->insert_log($log_data);
	
				$this->session->set_flashdata('success', 'Key: ' . $data['license_key'] . ' is successfully saved.');
				redirect('license_issuance','refresh');
			}
			else{
				$this->session->set_flashdata('fail', 'License Key can not be inserted.');
				redirect("license_issuance",'refresh');
			}
		}
	}

	/* 
		This function is used to delete license record in databse 
	*/

	public function delete($id){

		if($this->user_model->has_permission("delete_license"))
		{
			if($this->license_issuance_model->deleteModel($id)){
				$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'License Key Deleted'
					);
					$this->log_model->insert_log($log_data);
				redirect('license_issuance','refresh');
			}
			else{
				$this->session->set_flashdata('fail', 'License Key can not be Deleted.');
				redirect("license_issuance",'refresh');
			}
		}
		else
		{
			$this->load->view('layout/restricted');	
		}
	}
	/* 
		This function is used to add SUBSCRIPTION PLAN record in database 
	*/
	public function assign_license(){
		$this->load->helper('security');
		$this->form_validation->set_rules('license_id', 'License ID', 'trim|required|numeric|xss_clean');
		$this->form_validation->set_rules('plan_id', 'Plan ID', 'trim|required|numeric|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');
	
		if ($this->form_validation->run() == FALSE)
		{
			$this->index();
		}
		else
		{

			$duration = $this->license_issuance_model->getDurationPlan($this->input->post('plan_id'));
			$duration = $duration[0]->duration;

			if (!$this->license_issuance_model->checkEmailExist($this->input->post('email'))) {

				$this->session->set_flashdata('fail', 'Subscription can not be inserted due to email address is already exist.');
				return redirect("license_issuance",'refresh');

			}
		
			$data = array(
					"plan_id" => $this->input->post('plan_id'),
					"license_id" => $this->input->post('license_id'),
					"email" => $this->input->post('email'),
					"start_date" => date('Y-m-d'),
					"end_date" => date("Y-m-d", strtotime("+" . $duration . " months"))			
				);
	
			if($id = $this->license_issuance_model->addSubscription($data)){ 
				$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Subscription Inserted'
					);
				$this->log_model->insert_log($log_data);

				$email_status = 0;

				$email = $this->email_license($id, $email_status);
	
				$this->session->set_flashdata('success', 'Subscription of ' . $data['email'] . ' is successfully saved.');
				redirect('license_issuance','refresh');
			}
			else{
				$this->session->set_flashdata('fail', 'Subscription can not be inserted.');
				redirect("license_issuance",'refresh');
			}
		}
	}
	/*
		call edit view to edit subscription record 
	*/
	public function edit($id){
		if(!$this->user_model->has_permission("edit_license"))
		{
			$this->load->view('layout/restricted');	
		}
		else
		{
			$data['data'] = $this->license_issuance_model->getLicenseRecord($id);
			$data['plan'] = $this->license_issuance_model->getPlan();

			$this->load->view('license_issuance/edit',$data);	
		}
	}
	/* 
		This function used to get plan's data when the plan is changed
	*/
	public function getPlanData($id){
		$data = $this->license_issuance_model->selectPlanData($id);
		echo json_encode($data);
	}
	/* 
		This function is used to edit subscription in database 
	*/
	public function editLicenseIssuance(){
		$id = $this->input->post('subscription_id');
		$this->form_validation->set_rules('plan_id', 'Plan ID', 'trim|required');
		$this->form_validation->set_rules('license_id', 'License ID', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('license_key', 'License Key', 'trim|required');
		$this->form_validation->set_rules('start_date', 'Start Date', 'trim|required');
		$this->form_validation->set_rules('end_date', 'End Date', 'trim|required');
		$this->form_validation->set_rules('duration', 'Duration', 'trim|required|numeric');
		$this->form_validation->set_rules('price', 'Price', 'trim|required|numeric');

		if ($this->form_validation->run() == FALSE)
        {
            $this->edit($id);
        }
        else
        {
			$original_data = $this->license_issuance_model->getLicenseRecord($id);

			if ($this->input->post('plan_id') == $original_data[0]->plan_id && $this->input->post('email') == $original_data[0]->email && $this->input->post('start_date') == $original_data[0]->start_date) {
				
				$this->index();

			}
			elseif ($this->input->post('start_date') != $original_data[0]->start_date && $this->input->post('plan_id') == $original_data[0]->plan_id && $this->input->post('email') == $original_data[0]->email) {

				$data = array(
					"subscription_id" => $this->input->post('subscription_id'),
					"start_date" => date('Y-m-d', strtotime($this->input->post('start_date'))),
					"end_date" => date('Y-m-d', strtotime($this->input->post('end_date'))),
				);

				if($this->license_issuance_model->updateSubscriptionDate($data,$id)){ 

					$log_data = array(
							'user_id'  => $this->session->userdata('user_id'),
							'table_id' => $id,
							'message'  => 'Subscription Date Updated'
						);

					$this->log_model->insert_log($log_data);

					$this->session->set_flashdata('success', 'Subscription date for ID ' . $data['subscription_id'] . ' updated successfully.');
					redirect("license_issuance",'refresh');
				}
				else{

					$this->session->set_flashdata('fail', 'Subscription date for ID ' . $data['subscription_id'].' is failed to update.');
					redirect("license_issuance",'refresh');

				}
			}
			else {

				if ($this->input->post('email') != $original_data[0]->email) {

					if (!$this->license_issuance_model->checkEmailExist($this->input->post('email'))) {
	
						$this->session->set_flashdata('fail', 'Subscription can not be updated due to email address is already exist with another license key.');
						return redirect("license_issuance",'refresh');
		
					}
				}

				$license = rand(1000,9999) . '-' . rand(1000,9999) . '-' . rand(1000,9999) . '-' . rand(1000,9999) . '-' . rand(1000,9999);

				$license = array(
					"license_key" => $license,
					"license_key_status" => 1,
					"date_created" => date('Y-m-d'),					
				);

				if($new_license_id = $this->license_issuance_model->generateKey($license)){

					$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $new_license_id,
						'message'  => 'License Key Inserted'
					);

					$this->log_model->insert_log($log_data);

					$data = array(
							"subscription_id" => $this->input->post('subscription_id'),
							"plan_id" => $this->input->post('plan_id'),
							"license_id" => $new_license_id,
							"email" => $this->input->post('email'),
							"start_date" => date('Y-m-d', strtotime($this->input->post('start_date'))),
							"end_date" => date('Y-m-d', strtotime($this->input->post('end_date'))),
						);

					if($this->license_issuance_model->updateSubscription($data, $id, $this->input->post('license_id'))){ 

						$log_data = array(
								'user_id'  => $this->session->userdata('user_id'),
								'table_id' => $id,
								'message'  => 'Subscription Details Updated'
							);

						$this->log_model->insert_log($log_data);

						$email_status = 1;

						$email = $this->email_license($data['subscription_id'], $email_status);

						$this->session->set_flashdata('success', 'Subscription details for ID ' . $data['subscription_id'] . ' updated successfully.');
						redirect("license_issuance",'refresh');
					}
					else{

						$this->session->set_flashdata('fail', 'Subscription details for ID ' . $data['subscription_id'].' is failed to update.');
						redirect("license_issuance",'refresh');

					}
				}
				else {

					$this->session->set_flashdata('fail', 'License key is failed to be generated.');
						redirect("license_issuance",'refresh');

				}
			}
		}
	}
	/*
		This function is to generate an email to the user after edit and assign license key
	*/
	public function email_license($id, $email_status)
	{

		$data = $this->license_issuance_model->getLicenseRecord($id);

		$this->load->library('email');

		$config = array(
			"protocol" => "smtp",
			"smtp_host" => "ssl://smtp.gmail.com",
			"smtp_timeout" => 30,
			"smtp_port" => 465,
			"smtp_user" => "", // email address sender
			"smtp_pass" => "", // password email address sender
			"charset" => "utf-8",
			"mailtype" => "html",
			"newline" => "\r\n",

		);

		$this->email->initialize($config);

		$message = "Hi " . $data[0]->email . ",<br>";
		$message .= "<br>";
		
		if ($email_status == 1) {
			$message .= "You have successfully modified your subscription<br>";
		}
		else {
			$message .= "You have successfully subscribed to a new plan.<br>";
		}

		$message .= "Thank you for subscribing to " . $data[0]->name . " Subscription Plan.<br>";
		$message .= "<br>";
		$message .= "Please find your details below:<br>";
		$message .= "Email: " . $data[0]->email . "<br>";
		$message .= "Subscription Plan: " . $data[0]->name . "<br>";
		$message .= "License Key: " . $data[0]->license_key . "<br>";
		$message .= "Start Date: " . $data[0]->start_date . "<br>";
		$message .= "End Date: " . $data[0]->end_date . "<br>";
		$message .= "Price: RM " . $data[0]->price . "<br>";
		$message .= "<br>";
		$message .= "If there is any inquiries. Please feel free to contact us at 010-0000000.<br>";
		$message .= "<br>";
		$message .= "Best regards,<br>";
		$message .= "Kedai Online";

		$this->email->from('syazanihafiy.dev@gmail.com', 'Syazani Hafiy');
		$this->email->to($data[0]->email);

		switch($email_status) {
			case 1:
				$this->email->subject('(MODIFIED SUBSCRIPTION) Kedai Online [SUBSCRIPTION ID: ' . $data[0]->subscription_id . '] - Subscription to ' . $data[0]->name . ' Plan');
				break;
			default:
				$this->email->subject('Kedai Online [SUBSCRIPTION ID: ' . $data[0]->subscription_id . '] - New Subscription to ' . $data[0]->name . ' Plan');
				break;
		}

		$this->email->message($message);

		if ($this->email->send()) {

			$log_data = array(
				'user_id'  => $this->session->userdata('user_id'),
				'table_id' => $data[0]->subscription_id,
				'message'  => 'Subscription email has been sent successfully'
			);
			$this->log_model->insert_log($log_data);

			return TRUE;
		}
		else {
			return FALSE;
		}
	}
} 
?>