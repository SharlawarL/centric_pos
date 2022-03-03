<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Balance extends MY_Controller
{
	function __construct() {
		parent::__construct();

		$this->load->model('balance_model');
		$this->load->model('branch_model');
		$this->load->model('brand_model');
		$this->load->model('category_model');
		$this->load->model('product_model');
		$this->load->model('expense_category_model');
		$this->load->model('email_setup_model');
		$this->load->model('sms_setting_model');
		$this->load->model('discount_model');
		$this->load->model('payment_method_model');
		$this->load->model('subcategory_model');
		$this->load->model('warehouse_model');
		$this->load->model('user_model');
		$this->load->model('log_model');
		


	
	}
	public function index(){
		if(!$this->user_model->has_permission("balance"))
        {
            $this->load->view('layout/restricted'); 
        }
        else
        {
        	$data['data'] = $this->balance_model->get_records();
			$this->load->view('balance/add',$data);	
        }
	}
	public function add(){
		if(!$this->user_model->has_permission("add_balance"))
        {
            $this->load->view('layout/restricted'); 
        }
        else
        {
        	$data['data'] = $this->balance_model->get_records();
			$this->load->view('balance/add',$data);
		}
	} 


	/*
		get date and month
	*/
	public function balance(){
		$date   = $this->input->post('date');
		$month  = $this->input->post('month');
		$year   = $this->input->post('year');		
		$submit = $this->input->post('submit');

		// echo $month;
		// exit;
		
		if($submit=="submit")
		{
			$data['data'] 	= $this->balance_model->balance($month,$year,$date)->result();		
			$data['date'] 	= $date;
			$data['month'] 	= $month;
			$data['year'] 	= $year;
			$this->load->view('balance/balance',$data);
		}
		else
		{
			redirect('balance','refresh');
		}
		
	}
	
}
?>