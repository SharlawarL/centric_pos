<?php  defined('BASEPATH') OR exit('No direct script access allowed');

class User_fragment extends CI_Model{
    
    function __construct()
	{
		parent::__construct();		
	}

    function get_records()
    {
        return $this->db->select('uf.*')
                         ->from('user_fragment uf')
                         ->get()
                         ->result();
    }

    function get_record_by_user_id($user_id)
    {
        return  $this->db->select('uf.*')
                         ->from('user_fragment uf')
                         ->where('uf.user_id',$user_id)
                         ->get()
                         ->row();
    }

    
    function get_single_record($id)
    {
        return $this->db->select('uf.*')
                        ->from('user_fragment uf')
                        ->where('uf.id',$id)
                        ->get()
                        ->row();
    }   

    

    function add_record($data)
    {
        if($this->db->insert('user_fragment',$data))
        {
            return $this->db->insert_id();
        }
        else
        {
            return FALSE;
        }
    }

    function edit_record($data,$id)
    {    
        $this->db->where('id',$id);     
        if($this->db->update('user_fragment',$data))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    function delete_record($id)
    {   
            $this->db->where('id', $id);
            if($this->db->delete('user_fragment'))
            {
                return true;
            }
            else
            {
                return false;
            }
    }
}
?>