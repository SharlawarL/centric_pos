<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Subscription_model extends CI_Model
{
	function __construct() {
		parent::__construct();
		
	}
	public function index(){
		
	}
	/* 
	add new plan record in database 
	*/
	public function addModel($data){
		log_message('debug', print_r($data, true));
		if($this->db->insert('plans', $data)){
			return  $this->db->insert_id();
		}
		else{
			return FALSE;
		}
	}
	/* 
	return all plan details to display list 
	*/
	public function getPlans(){
		
		$sql = "SELECT * FROM `plans`";
		$data = $this->db->query($sql);
		return $data->result();
		
	}
	/* 
	return all plan details where 'id' to display list 
	*/
	public function getPlanId($id){
		$plan_id = null;
		if ($id) {
			$plan_id = $id;
		}
		else {
			return FALSE;
		}
		$sql = "SELECT * FROM `plans` WHERE plan_id = $plan_id";
		$data = $this->db->query($sql);
		return $data->result();
		
	}
	/* 
		delete plan record from database 
	*/
	public function deleteModel($id){
		$this->db->where('plan_id',$id);
		if($this->db->update('plans',array('plan_delete_status'=>1))){
			$this->db->where('plan_id',$id);
			if($this->db->update('subscriptions',array('sub_delete_status'=>1))){
				$this->db->select('license_id');
				$this->db->where('plan_id', $id);
				$q = $this->db->get('subscriptions');
				$data = $q->result_array();
				for ($i=0; $i<count($data); $i++){
					$row = $data[$i]['license_id'];
					$this->db->where('license_id', $row);
					$this->db->update('licenses',array('license_delete_status'=>1, 'license_key_status'=>0));
				}
				return TRUE;
			}
			else{
				return FALSE;
			}
		}
		else{
			return FALSE;
		}
	}
	/* 
		save edited plan record in database  
	*/
	public function editModel($data,$id){
		$this->db->where('plan_id',$id);
		if($this->db->update('plans',$data)){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
}
?>