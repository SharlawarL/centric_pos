<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Group_model extends CI_Model
{
	/*

	*/
	public function get_records(){
		return $this->db->select('g.*')
		              ->from('groups g')
					  ->get()
					  ->results();
	}
}
?>