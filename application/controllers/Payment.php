<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Payment extends MY_Controller
{
	function __construct() {
		parent::__construct();
		$this->load->model('payment_model');
		$this->load->model('log_model');
		$this->load->model('receipt_model');
		$this->load->model('branch_model');
		$this->load->model('warehouse_model');
		$this->load->model('user_model');
		$this->load->model('category_model');
		$this->load->model('subcategory_model');
		$this->load->model('brand_model');
		$this->load->model('product_model');
		$this->load->model('payment_method_model');
		$this->load->model('expense_category_model');
		$this->load->model('discount_model');
		$this->load->model('email_setup_model');
        $this->load->model('sms_setting_model');
		
		

		
	}
	public function index()
	{
		if(!$this->user_model->has_permission("list_payment"))
		{
			$this->load->view('layout/restricted');	
		}
		else
		{
			$data['data'] = $this->payment_model->getPayment();	
			$this->load->view('payment/list',$data);
		}
	} 
	public function add()
	{
		if(!$this->user_model->has_permission("add_payment"))
		{
			$this->load->view('layout/restricted');	
		}
		else
		{
			$data['invoice'] 		= $this->payment_model->getReceipt();
			$data['branch'] 		= $this->branch_model->get_records();
			$data['p_reference_no'] = $this->receipt_model->generateReferenceNo();
			$data['from_ac'] 		= $this->payment_model->getFromAccount();
			$data['to_ac'] 			= $this->payment_model->getToAccount();
			$data['payment_method'] = $this->payment_method_model->payUserData();
			
			$this->load->view('payment/add',$data);
		}
	}
	/*

	*/
	public function getAmount($id){
		$data = $this->payment_model->getAmount($id);
		echo json_encode($data);
	}

	public function getAccount($branch_id){
		$data['from_ac'] 	= $this->payment_model->getFromAccount($branch_id);
		$data['to_ac'] 		= $this->payment_model->getToAccount($branch_id);
		// $data = $this->payment_model->getAccount($branch_id);
		// echo '<pre>';
		// print_r($data);
		// exit;
		echo json_encode($data);
	}

	public function getAccountGroupID($id){
		echo $this->payment_model->getAccountGroupID($id);
	}
}