<?php defined('BASEPATH') or exit('No direct script access allowed');
class Pnl extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('user_model');
		$this->load->model('pnl_model');
	}

	public function index()
	{
		if (!$this->user_model->has_permission("list_pnl"))
			return $this->load->view('layout/restricted');

		$years = [
			date('Y', strtotime("-2 year")),
			date('Y', strtotime("-1 year")),
			date('Y')
		];

		$profit_account_groups = $this->pnl_model->get_account_group('income');
		$expenses_account_groups = $this->pnl_model->get_account_group('expense');


		$current_warehouse = $this->pnl_model->get_primary_warehouse();
		$customer_ledgers = $this->pnl_model->get_user_with_ledger('customer');
		$supplier_ledgers = $this->pnl_model->get_user_with_ledger('supplier');

		foreach ($customer_ledgers as $customer_ledger) {
			foreach ($years as $key => $year) {
				$sales_record = $this->pnl_model->get_sales_records($customer_ledger->user_id, $current_warehouse->id, $year);

				$customer_ledger->total_paid_amount[$key] = array_sum(
					array_column($sales_record, "total_paid_amount")
				);

				$customer_ledger->total_tax_amount[$key] = array_sum(
					array_column($sales_record, "total_tax_amount")
				);
			}
		}

		foreach ($supplier_ledgers as $supplier_ledger) {

			$total_sold_product_cost_ledger = null;

			foreach ($years as $year_range => $year) {
				$purchase_records = $this->pnl_model->get_purchase_records($supplier_ledger->user_id, $current_warehouse->id, $year);

				$supplier_ledger->total_paid_amount[$year_range] = array_sum(
					array_column($purchase_records, "total_paid_amount")
				);

				$supplier_ledger->total_tax_amount[$year_range] = array_sum(
					array_column($purchase_records, "total_tax_amount")
				);

				foreach (array_column($purchase_records, "purchase_id") as $purchase) {
					// get list of purchase items by order
					$total_sold_product_cost_ledger[$year_range] += $this->pnl_model->get_purchase_product_costs($purchase, $year)->cost;
				}
			}
		}

		foreach ($expenses_account_groups as $expenses_account_group) {
			$expense_accountgroup_ledger = array_filter($supplier_ledgers,function($supplier_ledger) use ($expenses_account_group) {
				return $supplier_ledger->accountgroup_id == $expenses_account_group->id;
			});

			$year1_amount = 0;
			$year2_amount = 0;
			$year3_amount = 0;

			foreach (array_column($expense_accountgroup_ledger,'total_paid_amount') as $total_paid_amount) {
				$year1_amount += $total_paid_amount[0];
				$year2_amount += $total_paid_amount[1];
				$year3_amount += $total_paid_amount[2];
			}

			$expenses_account_group->ledger_balance = [
				$year1_amount,
				$year2_amount,
				$year3_amount
			];

		}

		foreach ($profit_account_groups as $profit_account_group) {

			$profit_accountgroup_ledger = array_filter($customer_ledgers,function($customer_ledger) use ($profit_account_group) {
				return $customer_ledger->accountgroup_id == $profit_account_group->id;
			});

			$year1_amount = 0;
			$year2_amount = 0;
			$year3_amount = 0;

			$year1_tax_amount = 0;
			$year2_tax_amount = 0;
			$year3_tax_amount = 0;

			foreach (array_column($profit_accountgroup_ledger,'total_paid_amount') as $total_paid_amount) {
				$year1_amount += $total_paid_amount[0];
				$year2_amount += $total_paid_amount[1];
				$year3_amount += $total_paid_amount[2];
			}

			$profit_account_group->ledger_balance = [
				$year1_amount,
				$year2_amount,
				$year3_amount
			];


			foreach (array_column($profit_accountgroup_ledger,'total_tax_amount') as $total_tax_amount) {
				$year1_tax_amount += $total_tax_amount[0];
				$year2_tax_amount += $total_tax_amount[1];
				$year3_tax_amount += $total_tax_amount[2];
			}

			$profit_account_group->ledger_tax_balance = [
				$year1_tax_amount,
				$year2_tax_amount,
				$year3_tax_amount
			];
		}

		 $data['profits'] = $profit_account_groups;
		 $data['expenses'] = $expenses_account_groups;
		 $data['assets'] = $total_sold_product_cost_ledger;
		 $data['company_name'] = $this->session->userdata('company');

		// echo json_encode($data['expenses']);

		ob_start();
		$html = ob_get_clean();
		$html = utf8_encode($html);

		$html = $this->load->view('pnl/pdf', $data, true);


		$mpdf = new Mpdf\Mpdf();
		$mpdf->allow_charset_conversion = true;
		$mpdf->charset_in = 'UTF-8';
		$mpdf->WriteHTML($html);
		$mpdf->Output();
	}
}
