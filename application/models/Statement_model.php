<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Statement_model extends CI_Model
{
	public function getStatementData($year,$customer_id,$warehouse_id){
		$query = $this->db->select('sum(i.sales_amount) as invoice_amount,sum(i.paid_amount) as paid_amount')
						->from('invoice i')
						->join('sales s','s.sales_id=i.sales_id')
						->join('users c','c.id=s.customer_id')
						->join('warehouse w','w.warehouse_id=s.warehouse_id')
						->where('YEAR(s.date)',$year)
						->where('s.delete_status',0);

			if ($customer_id) {
				$query = $query->where('c.id',$customer_id);
			}

			if ($warehouse_id) {
				$query = $query->where('s.warehouse_id',$warehouse_id);
			}

		return $query->get()->row();
	}
	public function getInvoiceData($year,$customer_id,$warehouse_id){
		$query = $this->db->select('i.sales_id,i.invoice_no,i.invoice_date,i.sales_amount,s.delete_status,s.delete_date')
						->from('invoice i')
						->join('sales s','s.sales_id=i.sales_id')
						->join('users c','c.id=s.customer_id')
						->join('warehouse w','w.warehouse_id=s.warehouse_id')
						->where('YEAR(s.date)',$year);

			if ($customer_id) {
				$query = $query->where('c.id',$customer_id);
			}

			if ($warehouse_id) {
				$query = $query->where('s.warehouse_id',$warehouse_id);
			}

		return $query->get()->result();
	}
	public function getInvoiceDeleteData($year,$customer_id,$warehouse_id){
		$query = $this->db->select('i.sales_id,i.invoice_no,i.invoice_date,i.sales_amount,s.delete_status,s.delete_date')
						->from('invoice i')
						->join('sales s','s.sales_id=i.sales_id')
						->join('users c','c.id=s.customer_id')
						->join('warehouse w','w.warehouse_id=s.warehouse_id')
						->where('YEAR(s.date)',$year)
						->where('s.delete_status',1);

			if ($customer_id) {
				$query = $query->where('c.id',$customer_id);
			}

			if ($warehouse_id) {
				$query = $query->where('s.warehouse_id',$warehouse_id);
			}

		return $query->get()->result();
	}
	public function getPaymentData($year,$customer_id,$warehouse_id){
		$query = $this->db->select('i.sales_id,i.invoice_no,th.voucher_no,th.amount,th.voucher_date')
						->from('invoice i')
						->join('sales s','s.sales_id=i.sales_id')
						->join('users c','c.id=s.customer_id')
						->join('transaction_header th','th.invoice_id = i.id')
						->join('warehouse w','w.warehouse_id=s.warehouse_id')
						->where('YEAR(s.date)',$year);

			if ($customer_id) {
				$query = $query->where('c.id',$customer_id);
			}

			if ($warehouse_id) {
				$query = $query->where('s.warehouse_id',$warehouse_id);
			}

		return $query->get()->result();
	}
	public function getCreditNoteData($year,$customer_id,$warehouse_id){
		$query = $this->db->select('i.sales_id,i.invoice_no,th.voucher_no,th.amount,th.voucher_date')
						->from('credit_debit_note cdn')
						->join('transaction_header th','cdn.id = th.credit_debit_note_id')
						->join('invoice i','cdn.invoice_id = i.id')
						->join('sales s','s.sales_id=i.sales_id')
						->join('users c','c.id=s.customer_id')
						->join('warehouse w','w.warehouse_id=s.warehouse_id')
						->where('YEAR(s.date)',$year);

			if ($customer_id) {
				$query = $query->where('c.id',$customer_id);
			}

			if ($warehouse_id) {
				$query = $query->where('s.warehouse_id',$warehouse_id);
			}

		return $query->get()->result();
	}
}