<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Balance_model extends CI_Model
{
	/*

	*/
	public function get_records(){
		return $this->db->select('
									opening_date, 
                                    end_date,
                                    rm,

								')
						 ->from('balance')
						 ->get();
	}
	public function add_balance($data)
	{
		if($this->db->insert('balance',$data))
		{
			return  $this->db->insert_id();
		}
		else
		{
			return FALSE;
		}
	}
}
?>