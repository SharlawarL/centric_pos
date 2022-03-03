<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Statement extends MY_Controller
{
	function __construct() {
		parent::__construct();
		$this->load->model('statement_model');
		$this->load->model('customer_model');
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
		$this->load->model('purchase_model');
		$this->load->model('email_setup_model');
        $this->load->model('sms_setting_model');
        
		$this->load->model('log_model');
	}
	public function index()
	{
		if(!$this->user_model->has_permission("statement"))
		{
			$this->load->view('layout/restricted');	
		}
		else
		{
			//$data['data'] = $this->statement_model->getStatement();
			$data['warehouses'] = $this->purchase_model->getPurchaserWarehouse();
			$data['customers'] = $this->user_model->get_user_records_by_role('customer');
			$data['company'] = $this->purchase_model->getCompany();
			$this->load->view('statement/list',$data);
		}
	}
	public function getStatements()
	{
		$this->form_validation->set_rules('year','Year','trim|required|numeric');
//		$this->form_validation->set_rules('customer','Customer','trim|required|numeric');
//		$this->form_validation->set_rules('warehouse','Warehouse','trim|required|numeric');
		if($this->form_validation->run()==FALSE){
			$this->index();
		}
		else{
			$year = $this->input->post('year');
			$customer = (int) $this->input->post('customer');
			$warehouse = (int) $this->input->post('warehouse');
			$data['year'] = $year;
			$data['data'] = $this->statement_model->getStatementData($year,$customer,$warehouse);
			$data['invoice_data'] = $this->statement_model->getInvoiceData($year,$customer,$warehouse);
			$data['invoice_delete_data'] = $this->statement_model->getInvoiceDeleteData($year,$customer,$warehouse);
			/*echo "<pre>";
			print_r($data['data']);
			exit;*/
			$data['payment_data'] = $this->statement_model->getPaymentData($year,$customer,$warehouse);
			$data['credit_note'] = $this->statement_model->getCreditNoteData($year,$customer,$warehouse);
			$data['customers'] = $this->user_model->get_user_records_by_role('customer');
			$data['warehouses'] = $this->purchase_model->getPurchaserWarehouse();
			$data['customer_data'] = $this->customer_model->getCustomerData($customer,$warehouse);
			$data['company'] = $this->purchase_model->getCompany();
			$data['customer'] = $customer;
			$data['warehouse'] = $warehouse;
			/*echo "<pre>";
			print_r($data['credit_note']);
			exit;*/
			$this->load->view('statement/list',$data);
		}
	} 
}