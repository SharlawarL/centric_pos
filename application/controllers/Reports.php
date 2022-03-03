<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Reports extends MY_Controller
{
	function __construct() {
		parent::__construct();
		$this->load->model('reports_model');
		$this->load->model('transfer_model');
		$this->load->model('purchase_model');
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
        
		$this->load->model('log_model');
	}
	public function index(){
		$this->daily();
	} 
	public function purchase(){
		$data['data'] = $this->reports_model->getPurchase();
		$data['purchase_items'] = $this->reports_model->getPurchaseItems();
		$data['products'] = $this->reports_model->getProduct();
		$data['user'] = $this->reports_model->getUsers();
		$data['supplier'] = $this->reports_model->getSuppliers();
		$data['warehouse'] = $this->warehouse_model->getWarehouse();
		$this->load->view('reports/purchase',$data);
	}

	
	
	public function purchase_report(){
		$reference_no = $this->input->post('reference_no');
		$user_id = $this->input->post('user');
		$supplier_id = $this->input->post('supplier');
		$warehouse_id = $this->input->post('warehouse');
	 	$start_date =  $this->input->post('start_date');
		$end_date =  $this->input->post('end_date');
		if($this->input->post('submit') == "Search"){
			$data['data'] = $this->reports_model->getPurchaseDetails($reference_no,$user_id,$supplier_id,$warehouse_id,$start_date,$end_date);
			$data['purchase_items'] = $this->reports_model->getPurchaseItems();
			$data['products'] = $this->reports_model->getProduct();
			$data['user'] = $this->reports_model->getUsers();
			$data['supplier'] = $this->reports_model->getSuppliers();
			$data['warehouse'] = $this->warehouse_model->getWarehouse();
			$this->load->view('reports/purchase',$data);
		}
		else if($this->input->post('submit') == "PDF"){
			$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => 0,
					'message'  => 'Purchase PDF Generated'
				);
			$this->log_model->insert_log($log_data);
			ob_start();
			$html = ob_get_clean();
			$html = utf8_encode($html);

			$data['purchase'] = $this->reports_model->getPurchaseDetails($reference_no,$user_id,$supplier_id,$warehouse_id,$start_date,$end_date);

			$data['purchase_items'] = $this->reports_model->getPurchaseItems();
			$data['products'] = $this->reports_model->getProduct();
			$html = $this->load->view('reports/purchase_pdf',$data,true);

	        $mpdf = new \Mpdf\Mpdf();
	        $mpdf->allow_charset_conversion = true;
	        $mpdf->charset_in = 'UTF-8';
	        $mpdf->WriteHTML($html);
	        $mpdf->Output('Purchase.pdf','I');
		}
		else if($this->input->post('submit') == "CSV"){
			$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => 0,
					'message'  => 'Purchase CSV Generated'
				);
			$this->log_model->insert_log($log_data);
			ob_start();
			$this->load->dbutil();
			$delimiter = ",";
	        $newline = "\r\n";
	        $filename = "products_report.csv";
			$data  = $this->reports_model->getPurchaseDetailsForCSV($reference_no,$user_id,$supplier_id,$warehouse_id,$start_date,$end_date);
			/*$products = $this->reports_model->getPurchaseProduct();
			foreach ($data as  $key => $row) {
				foreach ($products as $value) {
					if($row->purchase_id == $value->purchase_id){
						if(!isset($data[$key]->product)){
							$data[$key]->product = $value->name.'('.$value->quantity.")";
						}
						else{
							$data[$key]->product .= ','.$value->name.'('.$value->quantity.")";
						}
					}
				}
			}*/
			$data = $this->dbutil->csv_from_result($data, $delimiter, $newline);
        	force_download($filename, $data);
		}
		else if($this->input->post('submit') == "Print"){
			$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => 0,
					'message'  => 'Purchase Print Generated'
				);
			$this->log_model->insert_log($log_data);
			$data['purchase'] = $this->reports_model->getPurchaseDetails($reference_no,$user_id,$supplier_id,$warehouse_id,$start_date,$end_date);
			$data['purchase_items'] = $this->reports_model->getPurchaseItems();
			$data['products'] = $this->reports_model->getProduct();
			$html = $this->load->view('reports/purchase_pdf',$data);

			
		}
		else{
			redirect('reports/purchase','refresh');
		}
	}
	public function purchase_pdf(){
		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		$data['purchase'] = $this->reports_model->getPurchase();
		$data['purchase_items'] = $this->reports_model->getPurchaseItems();
		$data['products'] = $this->reports_model->getProduct();
		$html = $this->load->view('reports/purchase_pdf',$data,true);

        $mpdf = new Mpdf\Mpdf();
        $mpdf->allow_charset_conversion = true;
        $mpdf->charset_in = 'UTF-8';
        $mpdf->WriteHTML($html);
        $mpdf->Output('purchase.pdf','I');
	}
	public function purchase_return(){
		$data['purchase_return'] = $this->reports_model->getPurchaseReturn();
		$data['purchase_return_items'] = $this->reports_model->getPurchaseReturnItems();
		$data['products'] = $this->reports_model->getProduct();
		$data['user'] = $this->reports_model->getUsers();
		$data['supplier'] = $this->reports_model->getSuppliers();
		$data['warehouse'] = $this->warehouse_model->getWarehouse();
		$this->load->view('reports/purchase_return',$data);
	}
	public function purchase_return_report(){
		$reference_no = $this->input->post('reference_no');
		$user_id = $this->input->post('user');
		$supplier_id = $this->input->post('supplier');
		$warehouse_id = $this->input->post('warehouse');
	 	$start_date =  $this->input->post('start_date');
		$end_date =  $this->input->post('end_date');
		if($this->input->post('submit') == "Search"){
			$data['purchase_return'] = $this->reports_model->getPurchaseReturnDetails($reference_no,$user_id,$supplier_id,$warehouse_id,$start_date,$end_date);
			$data['purchase_return_items'] = $this->reports_model->getPurchaseReturnItems();
			$data['products'] = $this->reports_model->getProduct();
			$data['user'] = $this->reports_model->getUsers();
			$data['supplier'] = $this->reports_model->getSuppliers();
			$data['warehouse'] = $this->warehouse_model->getWarehouse();
			$this->load->view('reports/purchase_return',$data);
		}
		else if($this->input->post('submit') == "PDF"){
			$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => 0,
					'message'  => 'Purchase Return PDF Generated'
				);
			$this->log_model->insert_log($log_data);
			ob_start();
			$html = ob_get_clean();
			$html = utf8_encode($html);

			$data['purchase_return'] = $this->reports_model->getPurchaseReturnDetails($reference_no,$user_id,$supplier_id,$warehouse_id,$start_date,$end_date);

			$data['purchase_return_items'] = $this->reports_model->getPurchaseReturnItems();
			$data['products'] = $this->reports_model->getProduct();
			$html = $this->load->view('reports/purchase_return_pdf',$data,true);

	        $mpdf = new \Mpdf\Mpdf();
	        $mpdf->allow_charset_conversion = true;
	        $mpdf->charset_in = 'UTF-8';
	        $mpdf->WriteHTML($html);
	        $mpdf->Output('purchase_return.pdf','I');
		}
		else if($this->input->post('submit') == "CSV"){
			$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => 0,
					'message'  => 'Purchase Return CSV Generated'
				);
			$this->log_model->insert_log($log_data);
			ob_start();
			$this->load->dbutil();
			$delimiter = ",";
	        $newline = "\r\n";
	        $filename = "products_report.csv";
			$data  = $this->reports_model->getPurchaseReturnDetailsForCSV($reference_no,$user_id,$supplier_id,$warehouse_id,$start_date,$end_date);
			/*$products = $this->reports_model->getPurchaseReturnProduct();
			foreach ($data as  $key => $row) {
				foreach ($products as $value) {
					if($row->id == $value->purchase_return_id){
						if(!isset($data[$key]->product)){
							$data[$key]->product = $value->name.'('.$value->quantity.")";
						}
						else{
							$data[$key]->product .= ','.$value->name.'('.$value->quantity.")";
						}
					}
				}
			}*/
			$data = $this->dbutil->csv_from_result($data, $delimiter, $newline);
        	force_download($filename, $data);
		}

		else if($this->input->post('submit') == "Print"){
			$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => 0,
					'message'  => 'Purchase Return Print Generated'
				);
			$this->log_model->insert_log($log_data);

			$data['purchase_return'] = $this->reports_model->getPurchaseReturnDetails($reference_no,$user_id,$supplier_id,$warehouse_id,$start_date,$end_date);

			$data['purchase_return_items'] = $this->reports_model->getPurchaseReturnItems();
			$data['products'] = $this->reports_model->getProduct();
			$html = $this->load->view('reports/purchase_return_pdf',$data);

			
		}
		else{
			redirect('reports/purchase_return','refresh');
		}
	}
	public function purchase_return_pdf(){
		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		$data['purchase_return'] = $this->reports_model->getPurchaseReturn();
		$data['purchase_return_items'] = $this->reports_model->getPurchaseReturnItems();
		$data['products'] = $this->reports_model->getProduct();
		$html = $this->load->view('reports/purchase_return_pdf',$data,true);

        $mpdf = new Mpdf\Mpdf();
        $mpdf->allow_charset_conversion = true;
        $mpdf->charset_in = 'UTF-8';
        $mpdf->WriteHTML($html);
        $mpdf->Output('purchase_return.pdf','I');
	}
	public function sales(){
		$data['sales'] = $this->reports_model->getSales();
		$data['sales_items'] = $this->reports_model->getSalesItems();
		$data['products'] = $this->reports_model->getProduct();
		$data['biller'] = $this->reports_model->getBillers();
		$data['user'] = $this->reports_model->getUsers();
		$data['warehouse'] = $this->warehouse_model->getWarehouse();
		$data['customer'] = $this->reports_model->getCustomers();
		$data['discount'] = $this->reports_model->getDiscounts();
		$this->load->view('reports/sales',$data);
	}
	public function sales_report(){
		$reference_no = $this->input->post('reference_no');
		$user_id = $this->input->post('user');
		$biller_id = $this->input->post('biller');
		$warehouse_id = $this->input->post('warehouse');
		$customer_id = $this->input->post('customer');
		$discount_id = $this->input->post('discount');
	 	$start_date =  $this->input->post('start_date');
		$end_date =  $this->input->post('end_date');
		if($this->input->post('submit') == "Search"){
			$data['sales'] = $this->reports_model->getSalesDetails($reference_no,$user_id,$biller_id,$warehouse_id,$customer_id,$discount_id,$start_date,$end_date);

			$data['sales_items'] = $this->reports_model->getSalesItems();
			$data['products'] = $this->reports_model->getProduct();
			$data['biller'] = $this->reports_model->getBillers();
			$data['user'] = $this->reports_model->getUsers();
			$data['warehouse'] = $this->warehouse_model->getWarehouse();
			$data['customer'] = $this->reports_model->getCustomers();
			$data['discount'] = $this->reports_model->getDiscounts();
			// echo '<pre>';
			// print_r($data);
			// exit;
			$this->load->view('reports/sales',$data);
		}
		else if($this->input->post('submit') == "PDF"){
			$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => 0,
					'message'  => 'Sales PDF Generated'
				);
			$this->log_model->insert_log($log_data);
			ob_start();
			$html = ob_get_clean();
			$html = utf8_encode($html);

			$data['sales'] = $this->reports_model->getSalesDetails($reference_no,$user_id,$biller_id,$warehouse_id,$customer_id,$discount_id,$start_date,$end_date);

			$data['sales_items'] = $this->reports_model->getSalesItems();
			$data['products'] = $this->reports_model->getProduct();
			$html = $this->load->view('reports/sales_pdf',$data,true);

	        $mpdf = new \Mpdf\Mpdf();
	        $mpdf->allow_charset_conversion = true;
	        $mpdf->charset_in = 'UTF-8';
	        $mpdf->WriteHTML($html);
	        $mpdf->Output('sales.pdf','I');
		}
		else if($this->input->post('submit') == "CSV"){
			$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => 0,
					'message'  => 'Sales CSV Generated'
				);
			$this->log_model->insert_log($log_data);
			ob_start();
			$this->load->helper('download');
			$this->load->dbutil();
			$this->load->helper('file');
			$delimiter = ",";
	        $newline = "\r\n";
	        $filename = "products_report.csv";
			$data  = $this->reports_model->getSalesDetailsForCSV($reference_no,$user_id,$biller_id,$warehouse_id,$customer_id,$discount_id,$start_date,$end_date);
			/*$products = $this->reports_model->getSalesProduct();
			foreach ($data as  $key => $row) {
				foreach ($products as $value) {
					if($row->sales_id == $value->sales_id){
						if(!isset($data[$key]->product)){
							$data[$key]->product = $value->name.'('.$value->quantity.")";
						}
						else{
							$data[$key]->product .= ','.$value->name.'('.$value->quantity.")";
						}
					}
				}
			}*/
			$data = $this->dbutil->csv_from_result($data, $delimiter, $newline);
        	force_download($filename, $data);
		}
		else if($this->input->post('submit') == "Print"){
			$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => 0,
					'message'  => 'Sales Print Generated'
				);
			$this->log_model->insert_log($log_data);

			$data['sales'] = $this->reports_model->getSalesDetails($reference_no,$user_id,$biller_id,$warehouse_id,$customer_id,$discount_id,$start_date,$end_date);

			$data['sales_items'] = $this->reports_model->getSalesItems();
			$data['products'] = $this->reports_model->getProduct();
			$html = $this->load->view('reports/sales_pdf',$data);

			
		}
		else{
			redirect('reports/sales','refresh');
		}
	}
	public function sales_pdf(){
		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		$data['sales'] = $this->reports_model->getSales();
		$data['sales_items'] = $this->reports_model->getSalesItems();
		$data['products'] = $this->reports_model->getProduct();
		$html = $this->load->view('reports/sales_pdf',$data,true);

        $mpdf = new Mpdf\Mpdf();
        $mpdf->allow_charset_conversion = true;
        $mpdf->charset_in = 'UTF-8';
        $mpdf->WriteHTML($html);
        $mpdf->Output('sales.pdf','I');
	}
	public function sales_return(){
		$data['sales_return'] = $this->reports_model->getSalesReturn();
		$data['sales_return_items'] = $this->reports_model->getSalesReturnItems();
		$data['products'] = $this->reports_model->getProduct();
		$data['biller'] = $this->reports_model->getBillers();
		$data['user'] = $this->reports_model->getUsers();
		$data['warehouse'] = $this->warehouse_model->getWarehouse();
		$data['customer'] = $this->reports_model->getCustomers();
		// $data['discount'] = $this->reports_model->getDiscounts();
		$this->load->view('reports/sales_return',$data);
	}
	public function sales_return_report(){
		$reference_no = $this->input->post('reference_no');
		$user_id =$this->input->post('user');
		$biller_id = $this->input->post('biller');
		$warehouse_id = $this->input->post('warehouse');
		$customer_id = $this->input->post('customer');
		// $discount_id = $this->input->post('discount');
	 	$start_date =  $this->input->post('start_date');
		$end_date =  $this->input->post('end_date');
		if($this->input->post('submit') == "Search"){
			$data['sales_return'] = $this->reports_model->getSalesReturnDetails($reference_no,$user_id,$biller_id,$warehouse_id,$customer_id,$start_date,$end_date);

			$data['sales_return_items'] = $this->reports_model->getSalesReturnItems();
			$data['products'] = $this->reports_model->getProduct();
			$data['biller'] = $this->reports_model->getBillers();
			$data['user'] = $this->reports_model->getUsers();
			$data['warehouse'] = $this->warehouse_model->getWarehouse();
			$data['customer'] = $this->reports_model->getCustomers();
			// $data['discount'] = $this->reports_model->getDiscounts();
			$this->load->view('reports/sales_return',$data);
		}
		else if($this->input->post('submit') == "PDF"){
			$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => 0,
					'message'  => 'Sales Return PDF Generated'
				);
			$this->log_model->insert_log($log_data);
			ob_start();
			$html = ob_get_clean();
			$html = utf8_encode($html);

			$data['sales_return'] = $this->reports_model->getSalesReturnDetails($reference_no,$user_id,$biller_id,$warehouse_id,$customer_id,$start_date,$end_date);

			$data['sales_return_items'] = $this->reports_model->getSalesReturnItems();
			$data['products'] = $this->reports_model->getProduct();
			$html = $this->load->view('reports/sales_return_pdf',$data,true);

	        $mpdf = new \Mpdf\Mpdf();
	        $mpdf->allow_charset_conversion = true;
	        $mpdf->charset_in = 'UTF-8';
	        $mpdf->WriteHTML($html);
	        $mpdf->Output('sales_return.pdf','I');
		}
		else if($this->input->post('submit') == "CSV"){
			$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => 0,
					'message'  => 'Sales CSV Generated'
				);
			$this->log_model->insert_log($log_data);
			ob_start();
			$this->load->helper('download');
			$this->load->dbutil();
			$this->load->helper('file');
			$delimiter = ",";
	        $newline = "\r\n";
	        $filename = "products_report.csv";
			$data  = $this->reports_model->getSalesDetailsForCSV($reference_no,$user_id,$biller_id,$warehouse_id,$customer_id,$discount_id,$start_date,$end_date);
			/*$products = $this->reports_model->getSalesProduct();
			foreach ($data as  $key => $row) {
				foreach ($products as $value) {
					if($row->sales_id == $value->sales_id){
						if(!isset($data[$key]->product)){
							$data[$key]->product = $value->name.'('.$value->quantity.")";
						}
						else{
							$data[$key]->product .= ','.$value->name.'('.$value->quantity.")";
						}
					}
				}
			}*/
			$data = $this->dbutil->csv_from_result($data, $delimiter, $newline);
        	force_download($filename, $data);
		}

		else if($this->input->post('submit') == "Print"){
			$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => 0,
					'message'  => 'Sales Return Print Generated'
				);
			$this->log_model->insert_log($log_data);
			$data['sales_return'] = $this->reports_model->getSalesReturnDetails($reference_no,$user_id,$biller_id,$warehouse_id,$customer_id,$start_date,$end_date);

			$data['sales_return_items'] = $this->reports_model->getSalesReturnItems();
			$data['products'] = $this->reports_model->getProduct();
			$html = $this->load->view('reports/sales_return_pdf',$data);

			
		}
		else{
			redirect('reports/sales_return','refresh');
		}
	}
	public function sales_return_pdf(){
		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		$data['sales_return'] = $this->reports_model->getSalesReturn();
		$data['sales_return_items'] = $this->reports_model->getSalesReturnItems();
		$data['products'] = $this->reports_model->getProduct();
		$html = $this->load->view('reports/sales_return_pdf',$data,true);

        $mpdf = new Mpdf\Mpdf();
        $mpdf->allow_charset_conversion = true;
        $mpdf->charset_in = 'UTF-8';
        $mpdf->WriteHTML($html);
        $mpdf->Output('sales_return.pdf','I');
	}
	public function products(){
		$data['data'] = $this->reports_model->getPurchaseSales();
		$data['warehouse'] = $this->warehouse_model->getWarehouse();
		$data['products'] = $this->reports_model->getProduct();
		$this->load->view('reports/products',$data);
	}
	public function products_report(){
		$product_id = $this->input->post('product');
		$warehouse_id = $this->input->post('warehouse');
	 	$start_date =  $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		if($this->input->post('submit') == "Search"){
			$data['data'] = $this->reports_model->getProductsDetails($product_id,$warehouse_id,$start_date,$end_date);
			$data['products'] = $this->reports_model->getProduct();
			$data['warehouse'] = $this->warehouse_model->getWarehouse();
			$this->load->view('reports/products',$data);
		}
		else if($this->input->post('submit') == "PDF"){
			$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => 0,
					'message'  => 'Product PDF Generated'
				);
			$this->log_model->insert_log($log_data);
			ob_start();
			$html = ob_get_clean();
			$html = utf8_encode($html);

			$data['data'] = $this->reports_model->getProductsDetails($product_id,$warehouse_id,$start_date,$end_date);
			$html = $this->load->view('reports/products_pdf',$data,true);

	        $mpdf = new \Mpdf\Mpdf();
	        $mpdf->allow_charset_conversion = true;
	        $mpdf->charset_in = 'UTF-8';
	        $mpdf->WriteHTML($html);
	        $mpdf->Output('products.pdf','I');
		}
		else if($this->input->post('submit') == "CSV"){
			$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => 0,
					'message'  => 'Product CSV Generated'
				);
			$this->log_model->insert_log($log_data);
            $this->load->dbutil();
	        $delimiter = ",";
	        $newline = "\r\n";
	        $filename = "products.csv";
	        $result = $this->reports_model->getProductsDetailsForCSV($product_id,$warehouse_id,$start_date,$end_date);
	        $data = $this->dbutil->csv_from_result($result, $delimiter, $newline);
	        force_download($filename, $data);
		}
		else{
			redirect('reports/products','refresh');
		}
	}

	public function daily(){
		$this->load->model('ion_auth_model');
		$data['current_month_sales'] = $this->reports_model->currentMonthSales();
		$data['profit'] = $this->reports_model->profit();
		$data['day_profit'] = $this->reports_model->dayProfit();
		$data['sales'] =  $this->reports_model->daySales();
		$data['sales_return'] =  $this->reports_model->daySalesReturn();
		$this->load->view('reports/daily',$data);
	}

	public function receivable(){
		$data['data'] = $this->reports_model->receivable();
		$data['user'] = $this->reports_model->getUsers();
		$data['customers'] = $this->reports_model->getCustomers();
		$this->load->view('reports/receivable',$data);
	}
	public function receivable_report(){
		$start_date =  $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
	//	$user_id =$this->input->post('user');
		$customer_id = $this->input->post('customer');
		if($this->input->post('submit') == "Search"){
			$data['data'] = $this->reports_model->getReceivableAmountDetails($start_date,$end_date,$customer_id);
			$data['user'] = $this->reports_model->getUsers();
			$data['customers'] = $this->reports_model->getCustomers();
			$data['customer'] = $this->input->post('customer');
			$this->load->view('reports/receivable',$data);
		}
	}
	public function payable(){
		$data['data'] = $this->reports_model->payable();
		$data['supplier'] = $this->reports_model->getSuppliers();
		$this->load->view('reports/payable',$data);
	}
	public function payable_report(){
		
		$start_date =  $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$supplier_id = $this->input->post('supplier');
		if($this->input->post('submit') == "Search"){
			$data['data'] = $this->reports_model->getPayableAmountDetails($start_date,$end_date,$supplier_id);
			$data['supplier'] = $this->reports_model->getSuppliers();
			$this->load->view('reports/payable',$data);
		}
	}
	public function warehouse_report($warehouse_id = NULL){
		
		if($warehouse_id == NULL && $warehouse_id == 0)
		{
			$data['data'] = $this->reports_model->getWarehouseWiseProducts(0);
			$data['warehouse'] = $this->transfer_model->getWarehouse();	
			$data['selected_warehouse'] = 0;
		}
		else
		{
			$data['data'] = $this->reports_model->getWarehouseWiseProducts($warehouse_id);
			$data['warehouse'] = $this->transfer_model->getWarehouse();
			$data['selected_warehouse'] = $warehouse_id;
		}
		
		$this->load->view('reports/warehouse_report',$data);
	}

	public function balance_sheet(){


	}

	public function pl_report(){

		// $data['company'] 				= $this->purchase_model->getCompany();
		// $data['sales'] 					= $this->reports_model->getFilterSales($from_date, $to_date);
		// $data['sales_cost'] 			= $this->reports_model->getTotalSalesCost();
		// $data['sales_profit']			= $data['sales'] - $data['sales_cost'];
		// $data['sales_tax']				= $this->reports_model->getTotalSalesTax();
		// $data['sales_after_tax']		= $data['sales'] - $data['sales_tax'];
		// $data['sales_profit_after_tax'] = $data['sales_profit'] - $data['sales_tax'];
		// $data['sales_profit_before_tax']= $data['sales_profit'];
		// $data['expense']				= $this->reports_model->getTotalExpense();			


		// echo '<pre>';
		// print_r($data);		
		// exit;
		if($_POST)
		{	
			$branch 	= $this->input->post('branch');
			$start_date	= $this->input->post('start_date');
			$end_date	= $this->input->post('end_date');

			$data['sales'] 			= $this->reports_model->getFilterSales("2018-10-01",$end_date);
			$data['sales_return'] 	= $this->reports_model->getFilterSalesReturns("2018-10-01",$end_date);
			$data['purchases'] 		= $this->reports_model->getFilterPurchases("2018-10-01",$end_date);
			$data['purchase_return']= $this->reports_model->getFilterPurchasesReturns("2018-10-01",$end_date);

			$data['total_sales']			= $this->reports_model->getTotalSales("2018-10-01", $end_date);
			$data['total_sales_return']		= $this->reports_model->getTotalSalesReturn("2018-10-01", $end_date);
			$data['total_purchase']			= $this->reports_model->getTotalPurchases("2018-10-01", $end_date);
			$data['total_purchase_return']	= $this->reports_model->getTotalPurchasesReturn("2018-10-01", $end_date);
			$data['closing_stock'] 			= $this->reports_model->getClosingStock();
			$data['opening_stock'] 			= $this->reports_model->getOpeningStock();

			$data['start_date'] 	= $start_date;
			$data['end_date'] 		= $end_date;

			$data['expenses']		= $this->reports_model->getExpense();
			$data['taxes']			= $this->reports_model->getTaxes();
			$data['discount']		= $this->reports_model->getSalesDiscount();

			// echo '<pre>';
			// print_r($data);
			// exit;

			$this->load->view('reports/pl_report_print',$data);
		}
		else
		{
			$data['branch']		= $this->branch_model->getBranch();
			$this->load->view('reports/pl_report',$data);
		}
		
		
	}

	public function pl_report_print(){

		// $data['company'] 				= $this->purchase_model->getCompany();
		// $data['sales'] 					= $this->reports_model->getFilterSales($from_date, $to_date);
		// $data['sales_cost'] 			= $this->reports_model->getTotalSalesCost();
		// $data['sales_profit']			= $data['sales'] - $data['sales_cost'];
		// $data['sales_tax']				= $this->reports_model->getTotalSalesTax();
		// $data['sales_after_tax']		= $data['sales'] - $data['sales_tax'];
		// $data['sales_profit_after_tax'] = $data['sales_profit'] - $data['sales_tax'];
		// $data['sales_profit_before_tax']= $data['sales_profit'];
		// $data['expense']				= $this->reports_model->getTotalExpense();			


		// echo '<pre>';
		// print_r($data);
		// exit;

		$data['branch']		= $this->branch_model->getBranch();


		$this->load->view('reports/pl_report_print',$data);
		
	}

	public function sst()
	{
		if(!$this->user_model->has_permission("list_sst"))
		{
			$this->load->view('layout/restricted');	
		}
		else {
			$data['data'] = $this->reports_model->getSST();
			$this->load->view('reports/sst', $data);
		}	
			
	}

	public function create_sst()
	{
		$this->load->helper('security');
		$this->form_validation->set_rules('sst_name', 'SST Name', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('start_date', 'Start Date', 'trim|required|xss_clean');
		$this->form_validation->set_rules('end_date', 'End Date', 'trim|required|xss_clean');
	
		if ($this->form_validation->run() == FALSE)
		{
			$this->sst();
		}
		else
		{
		
			$data = array(
					"sst_name" => $this->input->post('sst_name'),
					"start_date" => date('Y-m-d', strtotime($this->input->post('start_date'))),
					"end_date" => date('Y-m-d', strtotime($this->input->post('end_date')))	
			);
	
			if($id = $this->reports_model->createSST($data)){ 
				$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'SST Record Inserted'
					);
				$this->log_model->insert_log($log_data);
	
				$this->session->set_flashdata('success', 'SST record: ' . $data['sst_name'] . ' is successfully saved.');
				redirect('reports/sst','refresh');
			}
			else{
				$this->session->set_flashdata('fail', 'SST record cannot be inserted.');
				redirect("reports/sst",'refresh');
			}
		}
	}
	
	public function sst_edit($id){

		if(!$this->user_model->has_permission("edit_sst"))
		{
			$this->load->view('layout/restricted');	
		}
		else
		{
			$data['data'] = $this->reports_model->getSSTDetail($id);

			if($data['data'] == null){
				$this->session->set_flashdata('fail', 'SST record is not available. It might be deleted or removed.');
				redirect("subscription/index",'refresh');
			}

			$this->load->view('reports/sst_edit', $data);
		}	
	}

	public function update_sst()
	{
		$id = $this->input->post('sst_id');
		$this->form_validation->set_rules('sst_name', 'SST Name', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('start_date', 'Start Date', 'trim|required');
		$this->form_validation->set_rules('end_date', 'End Date', 'trim|required');
	
		if ($this->form_validation->run() == FALSE)
		{
			$this->sst();
		}
		else
		{
		
			$data = array(
					"sst_name" => $this->input->post('sst_name'),
					"start_date" => date('Y-m-d', strtotime($this->input->post('start_date'))),
					"end_date" => date('Y-m-d', strtotime($this->input->post('end_date')))	
			);
	
			if($id = $this->reports_model->updateSST($id, $data)){ 
				$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'SST Record Updated'
					);
				$this->log_model->insert_log($log_data);
	
				$this->session->set_flashdata('success', 'SST record: ' . $data['sst_name'] . ' is successfully updated.');
				redirect('reports/sst','refresh');
			}
			else{
				$this->session->set_flashdata('fail', 'SST record cannot be updated.');
				redirect("reports/sst",'refresh');
			}
		}
	}

	public function delete_sst($id)
	{
		if($this->user_model->has_permission("delete_sst"))
		{
			if($this->reports_model->deleteSST($id)){
				$log_data = array(
						'user_id'  => $this->session->userdata('user_id'),
						'table_id' => $id,
						'message'  => 'SST Record Deleted'
					);
				$this->log_model->insert_log($log_data);
				$this->session->set_flashdata('success', 'SST Record has been deleted.');
				redirect('reports/sst','refresh');
			}
			else{
				$this->session->set_flashdata('fail', 'SST Record can not be Deleted.');
				redirect("repors/sst",'refresh');
			}
		}
		else
		{
			$this->load->view('layout/restricted');	
		}
	}

	public function sst_form($id)
	{
		if(!$this->user_model->has_permission("form_sst"))
		{
			$this->load->view('layout/restricted');	
		}
		else {
			$data['id'] = $id;
			$this->load->helper('url'); 
			$this->load->view('reports/sst_form', $data);
		}

	}

	public function submit_sst()
	{

		$data = array(

			"sst_id" => $this->input->post('sst_id'),
			"return_type" => $this->input->post('return_type'),
			"no_sst" => $this->input->post('no_sst'),
			"registered_name" => $this->input->post('registered_name'),
			"tax_start" => date('Y-m-d', strtotime($this->input->post('tax_start'))),
			"tax_end" => date('Y-m-d', strtotime($this->input->post('tax_end'))),
			"return_date" => date('Y-m-d', strtotime($this->input->post('return_date'))),
			"tax_goods1" => $this->input->post('tax_goods1'),
			"tax_goods2" => $this->input->post('tax_goods2'),
			"tax_goods3" => $this->input->post('tax_goods3'),
			"tax_goods4" => $this->input->post('tax_goods4'),
			"tax_goods5" => $this->input->post('tax_goods5'),
			"tariff_code1" => $this->input->post('tariff_code1'),
			"tariff_code2" => $this->input->post('tariff_code2'),
			"tariff_code3" => $this->input->post('tariff_code3'),
			"tariff_code4" => $this->input->post('tariff_code4'),
			"tariff_code5" => $this->input->post('tariff_code5'),
			"goods_sold1" => $this->input->post('goods_sold1'),
			"goods_sold2" => $this->input->post('goods_sold2'),
			"goods_sold3" => $this->input->post('goods_sold3'),
			"goods_sold4" => $this->input->post('goods_sold4'),
			"goods_sold5" => $this->input->post('goods_sold5'),
			"own_used1" => $this->input->post('own_used1'),
			"own_used2" => $this->input->post('own_used2'),
			"own_used3" => $this->input->post('own_used3'),
			"own_used4" => $this->input->post('own_used4'),
			"own_used5" => $this->input->post('own_used5'),
			"tax_service1" => $this->input->post('tax_service1'),
			"tax_service2" => $this->input->post('tax_service2'),
			"tax_service3" => $this->input->post('tax_service3'),
			"tax_service4" => $this->input->post('tax_service4'),
			"tax_service5" => $this->input->post('tax_service5'),
			"total_sold" => $this->input->post('total_sold'),
			"total_own" => $this->input->post('total_own'),
			"total_service" => $this->input->post('total_service'),
			"net_total" => $this->input->post('net_total'),
			"rate_5" => $this->input->post('rate_5'),
			"payable_5" => $this->input->post('payable_5'),
			"rate_10" => $this->input->post('rate_10'),
			"payable_10" => $this->input->post('payable_10'),
			"rate_6" => $this->input->post('rate_6'),
			"payable_6" => $this->input->post('payable_6'),
			"rate_25" => $this->input->post('rate_25'),
			"payable_25" => $this->input->post('payable_25'),
			"payable_tax" => $this->input->post('payable_tax'),
			"credit_deduction" => $this->input->post('credit_deduction'),
			"sales_deduction" => $this->input->post('sales_deduction'),
			"service_deduction" => $this->input->post('service_deduction'),
			"adjustment_deduction" => $this->input->post('adjustment_deduction'),
			"tax_before_penalty" => $this->input->post('tax_before_penalty'),
			"penalty_rate" => $this->input->post('penalty_rate'),
			"tax_include_penalty" => $this->input->post('tax_include_penalty'),
			"sold_per_litre" => $this->input->post('sold_per_litre'),
			"value_sales_litre" => $this->input->post('value_sales_litre'),
			"value_tax_litre" => $this->input->post('value_tax_litre'),
			"value_pay_litre" => $this->input->post('value_pay_litre'),
			"sold_per_kg" => $this->input->post('sold_per_kg'),
			"value_sales_kg" => $this->input->post('value_sales_kg'),
			"value_tax_kg" => $this->input->post('value_tax_kg'),
			"value_pay_kg" => $this->input->post('value_pay_kg'),
			"sold_per_advolerum" => $this->input->post('sold_per_advolerum'),
			"value_tax_advolerum" => $this->input->post('value_tax_advolerum'),
			"value_pay_advolerum" => $this->input->post('value_pay_advolerum'),
			"area" => $this->input->post('area'),
			"schedule_a" => $this->input->post('schedule_a'),
			"schedule_b" => $this->input->post('schedule_b'),
			"schedule_c" => $this->input->post('schedule_c'),
			"item_12" => $this->input->post('item_12'),
			"item_34" => $this->input->post('item_34'),
			"item_5" => $this->input->post('item_5'),
			"exempted_tax" => $this->input->post('exempted_tax'),
			"item_12_exempted" => $this->input->post('item_12_exempted'),
			"item_34_exempted" => $this->input->post('item_34_exempted'),
			"item_5_exempted" => $this->input->post('item_5_exempted'),
			"date_declaration" => date('Y-m-d', strtotime($this->input->post('date_declaration'))),
			"name_declaration" => $this->input->post('name_declaration'),
			"id_declaration" => $this->input->post('id_declaration'),
			"designation_declaration" => $this->input->post('designation_declaration'),
			"phone_declaration" => $this->input->post('phone_declaration')

		);

		if($this->reports_model->submitSST($data)){ 
			$log_data = array(
					'user_id'  => $this->session->userdata('user_id'),
					'table_id' => $this->input->post('sst_id'),
					'message'  => 'Form is Submitted'
				);
			$this->log_model->insert_log($log_data);
			$this->session->set_flashdata('success', 'SST Form for ' . $this->input->post('sst_id') . ' is submitted successfully.');
			redirect("reports/sst",'refresh');
		}
		else{
			$this->session->set_flashdata('fail', 'SST Form for ' . $this->input->post('sst_id') .' is failed to submit.');
			redirect("reports/sst",'refresh');
		}
	}

	public function sst_return_pdf($id){
		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		$data['data'] = $this->reports_model->getSSTFormDetails($id);

		$html = $this->load->view('reports/sst_return_pdf',$data,true);

		$no_sst = json_decode(json_encode($data['data']), true);
		$no_sst = $no_sst[0]['no_sst'];

		include(APPPATH.'third_party/mpdf/mpdf.php');
        $mpdf = new mPDF(); 
        $mpdf->allow_charset_conversion = true;
        $mpdf->charset_in = 'UTF-8';
        $mpdf->WriteHTML($html);
        $mpdf->Output($no_sst . '.pdf','I');
	}
						
	public function sst_report(){
		$report_name = $this->input->post('report_name');
	 	$start_date =  $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		if($this->input->post('submit') == "Submit"){

			$data['data'] = $this->reports_model->getsstDetails($report_name,$start_date,$end_date);
			$data['sst'] = $this->reports_model->getsst();

			$this->load->view('reports/sst',$data);
			
		}
		
	}
	
}
?>