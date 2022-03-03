<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Subscription extends MY_Controller
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
		$this->load->model('payment_method_model');
		$this->load->model('expense_category_model');
		$this->load->model('uqc_model');
		$this->load->model('discount_model');
		$this->load->model('company_setting_model');
		$this->load->model('subscription_model');
		
		
		$this->load->model('email_setup_model');
        $this->load->model('sms_setting_model');
	    
	}
	public function index()
	{
		if(!$this->user_model->has_permission("list_plan"))
		{
			$this->load->view('layout/restricted');	
		}
		else
		{	
			$data['data'] = $this->subscription_model->getPlans();
			
			$this->load->view('subscription/list',$data);		
		}
		
	}
	/* 
		call add view to add new plan
	*/
	public function add(){
		if(!$this->user_model->has_permission("add_plan"))
		{
			$this->load->view('layout/restricted');	
		}
		else
		{
			$this->load->view('subscription/addplan');
		}
			
	}
	/* 
		This function is used to add SUBSCRIPTION PLAN record in database 
	*/
	public function addPlan(){
		$this->load->helper('security');
		$this->form_validation->set_rules('plan_name', 'Name', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('plan_desc', 'Description', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('plan_price', 'Price', 'trim|required|numeric|xss_clean');
		$this->form_validation->set_rules('plan_duration', 'Duration', 'trim|required|numeric|xss_clean');
	
		if ($this->form_validation->run() == FALSE)
		{
			$this->add();
		}
		else
		{
		
			$data = array(
					"name" => $this->input->post('plan_name'),
					"description" => $this->input->post('plan_desc'),
					"price" => $this->input->post('plan_price'),
					"duration" => $this->input->post('plan_duration'),
					"date_created" => date('Y-m-d'),					
				);
	
			if($id = $this->subscription_model->addModel($data)){ 
				$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Subscription Plan Inserted'
					);
				$this->log_model->insert_log($log_data);
	
				$this->session->set_flashdata('success', 'Plan ' . $data['name'] . ' is successfully saved.');
				redirect('subscription','refresh');
			}
			else{
				$this->session->set_flashdata('fail', 'Subscription plan can not be inserted.');
				redirect("subscription",'refresh');
			}
		}
	}
	/* 
		This function is used to delete plan record in databse 
	*/
	public function delete($id){

		if($this->user_model->has_permission("delete_plan"))
		{
			if($this->subscription_model->deleteModel($id)){
				$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Subscription Plan Deleted'
					);
					$this->log_model->insert_log($log_data);
				redirect('subscription','refresh');
			}
			else{
				$this->session->set_flashdata('fail', 'Subscription Plan can not be Deleted.');
				redirect("subscription",'refresh');
			}
		}
		else
		{
			$this->load->view('layout/restricted');	
		}
		
	}
	/*
		call edit view to edit plan record 
	*/
	public function edit($id){
		if(!$this->user_model->has_permission("edit_plan"))
		{
			$this->load->view('layout/restricted');	
		}
		else
		{
			$data['data'] = $this->subscription_model->getPlanId($id);

			if($data['data'] == null){
				$this->session->set_flashdata('fail', 'Plan is not available. It might be deleted or removed.');
				redirect("subscription/index",'refresh');
			}

			$this->load->view('subscription/edit',$data);	
		}	
	}
	/* 
		This function is used to edit plan in database 
	*/
	public function editPlan(){
		$id = $this->input->post('id');
		$this->form_validation->set_rules('plan_name', 'Name', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('plan_desc', 'Description', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('plan_price', 'Price', 'trim|required|numeric');
		$this->form_validation->set_rules('plan_duration', 'Duration', 'trim|required|numeric');


		if ($this->form_validation->run() == FALSE)
		{
			$this->add();
		}
		else
		{
			$data = array(
					"name" => $this->input->post('plan_name'),
					"description" => $this->input->post('plan_desc'),
					"price" => $this->input->post('plan_price'),
					"duration" => $this->input->post('plan_duration'),
					"date_created" => date('Y-m-d'),					
				);

			if($this->subscription_model->editModel($data,$id)){ 
				$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'Plan Updated'
					);
				$this->log_model->insert_log($log_data);
				$this->session->set_flashdata('success', 'Plan ' . $data['name'] . ' updated successfully.');
				redirect("subscription",'refresh');
			}
			else{
				$this->session->set_flashdata('fail', 'Plan ' . $data['name'] .' is failed to update.');
				redirect("subscription",'refresh');
			}
		}
	}
} 
?>