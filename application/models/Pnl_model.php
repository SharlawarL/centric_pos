<?php  defined('BASEPATH') OR exit('No direct script access allowed');

class Pnl_model extends CI_Model{
    // TODO seperate reports (sales,purchase,assets) by warehouse
    function __construct()
	{
		parent::__construct();		
	}

    function get_account_group($type)
    {
        return $this->db->select('ag.*')
                       ->from('account_group ag')
                       ->where('ag.category',$type)
                       ->get()
                       ->result();
    }

    /**
     * @param mixed $group_name
     */

    function get_user_with_ledger($group_name)
    {
        return $this->db->select('lgr.*,ag.*,u.username as username,u.id as user_id')
                 ->from('users u')
                 ->join('users_groups ug','ug.user_id = u.id')
                 ->join('groups g','g.id = ug.group_id')
                 ->join('ledger lgr','u.ledger_id = lgr.id')
                 ->join('account_group ag','ag.id = lgr.accountgroup_id')
                 ->where('g.name',$group_name)
                 ->get()
                 ->result();
    }

    function get_primary_warehouse()
    {
        return $this->db->select("wa.warehouse_id as id")
                         ->from('warehouse wa')
                         ->where('wa.primary_warehouse',true)
                         ->get()
                         ->row();
    }

    /**
     * @param int $customer_id
     * @param int $warehouse_id
     * @param int $year
     */

    function get_sales_records($customer_id,$warehouse_id,$year)
    {
        $sales_records = $this->db->select('sa.*,SUM(sa.tax_value) as total_tax_amount')
                          ->from('sales sa')
                          ->where('customer_id',$customer_id)
                          ->where('warehouse_id',$warehouse_id)
                          ->where('YEAR(sa.date)',$year)
                          ->get()
                          ->result();

        $paid_sales_record = [];

        foreach ($sales_records as $sales_record) {
            $invoice = $this->db->select('SUM(inv.paid_amount) as paid_amount,inv.id')
                               ->from('invoice inv')
                               ->where('sales_id',$sales_record->sales_id)
                               ->get()
                               ->row();

            if ($invoice->paid_amount >= $sales_record->total) {
                $sales_record->total_paid_amount = $invoice->paid_amount;
                array_push($paid_sales_record,$sales_record);
            }
        }

        return $paid_sales_record;
    }

    /**
     * @param int $supplier_id
     * @param int $warehouse_id
     * @param int $year 
     */

    function get_purchase_records($supplier_id,$warehouse_id,$year)
    {
        $purchase_records = $this->db->select('pa.*,pa.tax_value as total_tax_amount')
                          ->from('purchases pa')
                          ->where('supplier_id',$supplier_id)
                          ->where('warehouse_id',$warehouse_id)
                          ->where('YEAR(pa.date)',$year)
                          ->get()
                          ->result();

        $paid_purchase_record = [];

        foreach ($purchase_records as $purchase_record) {
            $purchase_receipt = $this->db->select('SUM(ar.paid_amount) as paid_amount')
                               ->from('account_receipts ar')
                               ->where('purchase_id',$purchase_record->purchase_id)
                               ->get()
                               ->row();

            if ($purchase_receipt->paid_amount >= $purchase_record->total) {
                $purchase_record->total_paid_amount = $purchase_receipt->paid_amount;
                array_push($paid_purchase_record,$purchase_record);
            }
        }

        return $paid_purchase_record;
    }

    /**
     * @param int $purchase_id
     */

    function get_purchase_product_costs($purchase_id,$year)
    {
        // retrieve product costs by purchase id
        return $this->db->select('SUM(pi.cost*pi.quantity) as cost')
                                 ->from('purchase_items pi')
                                 ->join('purchases pa','pa.purchase_id = pi.purchase_id')
                                 ->where('pa.purchase_id',$purchase_id)
                                 ->where('YEAR(pa.date)',$year)
                                 ->get()
                                 ->row();
    }
}
?>