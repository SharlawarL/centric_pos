<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class License_issuance_model extends CI_Model
{
	function __construct() {
		parent::__construct();
		
	}
	public function index(){
		
	}
	/* 
	add new license record in database 
	*/
	public function generateKey($data){
		log_message('debug', print_r($data, true));
		if($this->db->insert('licenses', $data)){
			return  $this->db->insert_id();
		}
		else{
			return FALSE;
		}
	}
	/* 
	return all license details to display list 
	*/
	public function getLicenses(){
		
		$sql = "SELECT * FROM subscriptions LEFT JOIN plans USING(plan_id) LEFT JOIN licenses USING(license_id) UNION SELECT licenses.license_id, NULL AS plan_id, NULL AS subscription_id, NULL AS email, NULL AS start_date, NULL AS end_date, NULL AS sub_delete_status, NULL AS name, NULL AS description, NULL AS price, NULL AS duration, NULL AS plan_date_created, NULL AS delete_status, licenses.license_key, licenses.license_key_status, licenses.date_created, licenses.license_delete_status FROM licenses WHERE licenses.license_id NOT IN (SELECT subscriptions.license_id FROM subscriptions) AND licenses.license_delete_status != 1";
		$data = $this->db->query($sql);
		return $data->result();
		
	}
	/* 
		delete license record from database 
	*/
	public function deleteModel($id){
		
		$this->db->where('license_id',$id);
		if($this->db->update('licenses',array('license_delete_status'=>1, 'license_key_status'=>0))){
			$this->db->where('license_id', $id);
			if($this->db->update('subscriptions',array('sub_delete_status'=>1))){
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
		update license record from database 
	*/
	public function updateSubscription($data, $id, $old_license_id){
		
		$this->db->where('license_id',$old_license_id);
		if($this->db->update('licenses',array('license_delete_status'=>1, 'license_key_status'=>0))){
			$this->db->where('subscription_id', $id);
			if($this->db->update('subscriptions', $data)){
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
	return plan
	*/
	public function getPlan(){
		$this->db->select('*');
		$data =	$this->db->get_where('plans',array('plan_delete_status'=>0));
		return $data->result();
	}
	/* 
	return duration plan
	*/
	public function getDurationPlan($id){
		$this->db->select('duration');
		$data =	$this->db->get_where('plans',array('plan_id'=>$id));
		return $data->result();
	}
	/* 
	add new subscription record in database 
	*/
	public function addSubscription($data){
		log_message('debug', print_r($data, true));
		if($this->db->insert('subscriptions', $data)){
			$insert_id = $this->db->insert_id();

			if($this->db->where('license_id',$data['license_id'])){
				$this->db->update('licenses',array('license_key_status'=>1));
				return $insert_id;
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
		return all license details 
	*/
	public function getLicenseRecord($data){

		$sql = "SELECT * FROM subscriptions LEFT JOIN plans USING(plan_id) LEFT JOIN licenses USING(license_id) WHERE subscription_id = 1 UNION SELECT licenses.license_id, NULL AS plan_id, NULL AS subscription_id, NULL AS email, NULL AS start_date, NULL AS end_date, NULL AS sub_delete_status, NULL AS name, NULL AS description, NULL AS price, NULL AS duration, NULL AS plan_date_created, NULL AS delete_status, licenses.license_key, licenses.license_key_status, licenses.date_created, licenses.license_delete_status FROM licenses WHERE licenses.license_id NOT IN (SELECT subscriptions.license_id FROM subscriptions) AND licenses.license_delete_status != 1 AND licenses.license_key_status != 0";
		$data = $this->db->query($sql);

		if($data){
			return $data->result();
		}
		else{
			return FALSE;
		}
	}
	/* 
		return plan data 
	*/
	public function selectPlanData($id){
		
		$data = $this->db->get_where('plans',array('plan_id'=>$id,'plan_delete_status'=>0));
		return $data->result();
	}
	/* 
		save edited subscription record in database  
	*/
	public function updateSubscriptionDate($data,$id){
		$this->db->where('subscription_id', $id);
		if($this->db->update('subscriptions',$data)){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	public function checkEmailExist($email)
	{

		$sql = "SELECT 1 FROM `subscriptions` WHERE email = '$email' AND sub_delete_status = 0";
		$data = $this->db->query($sql);
		$data = $data->result();

		if (empty($data)) {
			return TRUE;
		}
		else {
			return FALSE;
		}

	}
}
?>