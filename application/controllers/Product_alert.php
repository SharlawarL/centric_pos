<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Product_alert extends MY_Controller
{
	function __construct() {
		parent::__construct();
		$this->load->model('product_alert_model');
		$this->load->model('log_model');
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
	public function index(){
		// get all product , its quantity is less than alert quantity.
		$data['data'] = $this->product_alert_model->getProductAlert();
		$this->load->view('product_alert/list',$data);
	}
	
	public function create_pdf(){
		$log_data = array(
				'user_id'  => $this->session->userdata('user_id'),
				'table_id' => 0,
				'message'  => 'Product Alert PDF Generated'
			);
		$this->log_model->insert_log($log_data);
		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		$data['data'] = $this->product_alert_model->getProductAlert();
		$this->load->view('product_alert/list',$data);
		$html = $this->load->view('product_alert/pdf',$data,true);

        $mpdf = new Mpdf\Mpdf();
        $mpdf->allow_charset_conversion = true;
        $mpdf->charset_in = 'UTF-8';
        $mpdf->WriteHTML($html);
        $mpdf->Output('alert_quantity.pdf','I');
	}
	public function create_csv(){
		$log_data = array(
				'user_id'  => $this->session->userdata('user_id'),
				'table_id' => 0,
				'message'  => 'Product Alert CSV Generated'
			);
		$this->log_model->insert_log($log_data);
		ob_start();
		$this->load->dbutil();
        $delimiter = ",";
        $newline = "\r\n";
        $filename = "product_alert.csv";
        $result = $this->product_alert_model->getCsvData();
        $data = $this->dbutil->csv_from_result($result, $delimiter, $newline);
        force_download($filename, $data);
	}
}
?>