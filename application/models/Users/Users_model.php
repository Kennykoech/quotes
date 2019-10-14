<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model{

    public function __construct()
	{

		$this->load->database();
    }

    public function get_quotes($limit,$offset)
    {
		$this->db->limit($limit);
		$this->db->offset($offset);

        $this->db->order_by('quote_id');
        $query = $this->db->get('quotes');
        return $query->result();
	}
	
	public function count_all()
	{
		return $this->db->get('quotes')->num_rows();
	}

     //search
	 public function get_results($search_term='default')
	 {
		 // Use the Active Record class for safer queries.
		 $this->db->select("*");
		 $this->db->from("quotes");
		 $this->db->like("quote_name",$search_term);
		 
 
		 // Execute the query.
		 $query = $this->db->get();
 
		 // Return the results.
		 return $query->result();
	 }

	  //register user
	public function sign_up_user($enc_password){
		//user data array
		$data = array(
			'user_name' => $this->input->post('username'),
			'user_password' => $enc_password,
		);
		//insert admin as a user
		return $this->db->insert('users', $data);
	}
	
	//login user
	public function login_user($username, $password){
		//validate
		$this->db->where('user_name', $username);
		$this->db->where('user_password', $password);

		$result = $this->db->get('users');

		if($result->num_rows() == 1){
			return $result->row(0)->id;
		}else{
			return false;
		}   
	}
}