<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Barcode_model extends CI_Model
{	
	public function __construct(){
    	parent:: __construct();
    }

    public function getProductName($term)
    {
        $this->db->select('name,barcode_id,code,product_id');
        $this->db->from('products');
        $this->db->like('name', $term);
        $this->db->where('delete_status',0);
        $query=$this->db->get();
        return $query->result();
    }

    function getItemById($id)
    {
        $this->db->select('*');
        $this->db->from('products');
        $this->db->where('delete_status',0);
        $this->db->where('product_id',$id);
        $query=$this->db->get();
        return $query->row();   
    }
}