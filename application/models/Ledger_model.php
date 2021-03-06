<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ledger_model extends CI_Model
{
    function __construct() {
        parent::__construct();
        
    }
    public function index(){
        
    } 
    /* 
        return all discount details to display list  
    */
    public function get_records(){

        return $this->db->select('l.*,a.group_title')  
                        ->from('ledger l')
                        ->join('account_group a','a.id = l.accountgroup_id')
                        ->get()
                        ->result(); 
    }
	public function getPurchase(){
		$this->db->select('purchases.*,suppliers.*')
				 ->from('purchases')
				 ->join('suppliers','purchases.supplier_id = suppliers.supplier_id');
		$data = $this->db->get();
		log_message('debug', print_r($data, true));
		return $data->result();
	}

    public function get_records_by_accountgroup_category($category)
    {
        return $this->db->select('l.*,a.group_title')  
                        ->from('ledger l')
                        ->join('account_group a','a.id = l.accountgroup_id')
                        ->where_in('category',$category)
                        ->get()
                        ->result();
        
    }

    function get_single_record($id)
    {
        return $this->db->get_where("ledger",array('id'=>$id))->row();
    }

    function get_branch_from_ledger_id($id)
    {
        return $this->db->select('l.*,a.branch_id')  
                        ->from('ledger l')
                        ->join('account_group a','a.id = l.accountgroup_id')
                        ->where('l.id',$id)
                        ->get()
                        ->row()
                        ->branch_id;
    }

    public function get_records_by_branch($branch_id)
    {
        return $this->db->select('l.*,b.branch_name as branch_name,ag.category as category')
                        ->from('ledger l')  
                        ->join('account_group ag','l.accountgroup_id = ag.id')
                        ->where('ag.category','Expense')
                        ->get()
                        ->result();
    }   

    function add_record($data)
    {
        if($this->db->insert('ledger',$data))
        {
            return  $this->db->insert_id();
        }else
        {
            return FALSE;
        }
    }



    function edit_record($data,$id)
    {    
        $this->db->where('id',$id);     
        if($this->db->update('ledger',$data)){
          //  echo $this->db->last_query();
            return true;
        }else{
            return false;
        }
    }

    function delete_record($id)
    {   
        // $ledger = $this->db->get_where('ledger',array('accountgroup_id'=>$id))->result();
        // $no_ledger    = sizeof($ledger);

        // echo $no_users;
        // exit;

        // if($no_ledger > 0)
        // {    
        //     return $no_ledger;
        // }
        // else
        // {
            $this->db->where('id', $id);
            if($this->db->delete('ledger'))
            {
                return true;
            }
            else
            {
                return false;
            }
        // }
    }

    public function getBranch()
    {
        $this->db->select('branch_id,branch_name');
        $branch = $this->db->get('branch');
        return $array = $branch->result_array();
    }
    
    public function getAccountGroup()
    {
        $this->db->select('id,group_title');
        $acc_group = $this->db->get('account_group');
        return $array = $acc_group->result_array();
    }
    
    public function addModel($data){
        $sql = "insert into discount (discount_name,discount_value,user_id) values(?,?,?)";
        if($this->db->query($sql,$data)){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }
    
    public function getRecord($id){
        $sql = "select * from discount where discount_id = ?";
        if($query = $this->db->query($sql,array($id))){
            return $query->result();
        }
        else{
            return FALSE;
        }
    }
    
    public function editModel($data,$id){
        $sql = "update discount set discount_name = ?,discount_value = ? where discount_id = ?";
        if($this->db->query($sql,array($data['discount_name'],$data['discount_value'],$id))){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }
    
    public function deleteModel($id){
        $sql = "delete from discount where discount_id = ?";
        if($this->db->query($sql,array($id))){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }

    public function addLedger($data)
    {
        $this->db->insert('ledger', $data);
        return $this->db->insert_id();
    }
    
    public function getledgerWithJoin($id)
    {
        $this->db->select('L.*,B.branch_name,A.group_title');
        $this->db->from('ledger AS L');// I use aliasing make joins easier
        $this->db->join('branch AS B', 'B.id = L.branch_id', 'INNER');
        $this->db->join('account_group AS A', 'A.id = L.accountgroup_id', 'INNER');
        $this->db->where('L.id',$id);
        $q = $this->db->get();
        if( $q->num_rows() > 0 )
        {
            return $q->row();
        } 
    
        return FALSE;
    }
    
    public function getledgerById($id)
    {
        $q = $this->db->get_where('ledger', array('id' => $id), 1); 
        if( $q->num_rows() > 0 )
        {
            return $q->row();
        } 
    
        return FALSE;
    }
    
    public function updateLedger($ledgerDetail,$id)
    {
        $ledgerData = array(
            'branch_id'         =>  $ledgerDetail['branch_id'],
            'type'              =>  $ledgerDetail['type'],
            'title'             =>  $ledgerDetail['title'],
            'accountgroup_id'   =>  $ledgerDetail['accountgroup_id'],
            'opening_balance'   =>  $ledgerDetail['opening_balance'],
            'closing_balance'   =>  $ledgerDetail['closing_balance'],
            'opening_date'      =>  $ledgerDetail['opening_date'],
            'end_date'          =>  $ledgerDetail['end_date'],
        );
        
        $this->db->where('id', $id);
        if($this->db->update('ledger', $ledgerData)) {
                return true;
        }
        return false;
    }

    public function getBillerLedgerDetail($ledger_id){
        $user = $this->db->get_where('biller', array('ledger_id' => $ledger_id))->row(); 
        if(is_null($user)){
            return false;
        }else{
            return $user->biller_id;
        }
    }

    public function getCustomerLedgerDetails($ledger_id){
        $user = $this->db->get_where('customer', array('ledger_id' => $ledger_id))->row();
        if(is_null($user)){
            return false;
        }else{
            return $user->customer_id;
        }
    }

    public function getBankLedgerDetails($ledger_id){
        $user = $this->db->get_where('bank_account', array('ledger_id' => $ledger_id))->row();
        if(is_null($user)){
            return false;
        }else{
            return true;
        }
    }

    public function getSuppliersLedgerDetails($ledger_id){
        $user = $this->db->get_where('suppliers', array('ledger_id' => $ledger_id))->row();
        if(is_null($user)){
            return false;
        }else{
            return true;
        }
    }

    public function getPurchaserLedgerDetails($ledger_id){
        $user = $this->db->get_where('users', array('ledger_id' => $ledger_id))->row();
        if(is_null($user)){
            return false;
        }else{
            return $user->id;
        }
    }



    public function deleteLedger($id)
    {
        if($this->db->delete('ledger', array('id' => $id))) {
            return true;
        }
            
        return FALSE;
    }
    public function getReport($id){
        return $this->db->select('i.sales_amount as invoice_amount,i.paid_amount as paid_amount,
        i.invoice_no as invoice_no,i.invoice_date,c.first_name as cname')
        ->from('invoice i')
        ->join('sales s','s.sales_id=i.sales_id')
        ->join('users c','c.id=s.customer_id')
        ->get()
        ->result();
    }
	public function getStatementData($year,$id){
		return $this->db->select('i.sales_amount as invoice_amount,i.paid_amount as paid_amount,
        i.invoice_no as invoice_no,i.invoice_date,c.first_name as cname')
						->from('invoice i')
						->join('sales s','s.sales_id=i.sales_id')
						->join('users c','c.id=s.customer_id')
						->where('YEAR(s.date)',$year)
                        ->where('s.delete_status',0)
                        ->get()
                        ->result();
                    }
	public function getInvoiceData($year,$id){
		$query = $this->db->select('i.sales_id,i.invoice_no,i.invoice_date,i.sales_amount,s.delete_status,s.delete_date')
						->from('invoice i')
						->join('sales s','s.sales_id=i.sales_id')
						->join('users c','c.id=s.customer_id')
						->where('YEAR(s.date)',$id);

			if ($id) {
				$query = $query->where('c.id',$id);
			}

		return $query->get()->result();
	}
	public function getInvoiceDeleteData($year,$id){
		$query = $this->db->select('i.sales_id,i.invoice_no,i.invoice_date,i.sales_amount,s.delete_status,s.delete_date')
						->from('invoice i')
						->join('sales s','s.sales_id=i.sales_id')
						->join('users c','c.id=s.customer_id')
						->where('YEAR(s.date)',$year)
						->where('s.delete_status',1);

			if ($id) {
				$query = $query->where('c.id',$id);
			}

		return $query->get()->result();
	}
	public function getPaymentData($year,$id){
		$query = $this->db->select('i.sales_id,i.invoice_no,th.voucher_no,th.amount,th.voucher_date')
						->from('invoice i')
						->join('sales s','s.sales_id=i.sales_id')
						->join('users c','c.id=s.customer_id')
						->join('transaction_header th','th.invoice_id = i.id')
						->where('YEAR(s.date)',$year);

			if ($id) {
				$query = $query->where('c.id',$id);
			}

		return $query->get()->result();
	}
	public function getCreditNoteData($year,$id){
		$query = $this->db->select('i.sales_id,i.invoice_no,th.voucher_no,th.amount,th.voucher_date')
						->from('credit_debit_note cdn')
						->join('transaction_header th','cdn.id = th.credit_debit_note_id')
						->join('invoice i','cdn.invoice_id = i.id')
						->join('sales s','s.sales_id=i.sales_id')
						->join('users c','c.id=s.customer_id')
						->where('YEAR(s.date)',$year);

			if ($id) {
				$query = $query->where('c.id',$id);
			}

		return $query->get()->result();
	}

}
?>