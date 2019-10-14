<?php
class Home_model extends CI_Model{

    public function __construct()
	{

		$this->load->database();
	}
	
	public function get_quotes($limit, $offset)
	{	
		#search
		$keyword = $this->input->get('keyword');
		$this->db->like(array('quote_name' => $keyword));
		#pagination
		$this->db->limit($limit);
		$this->db->offset($offset);

		$this->db->order_by('quotes.quote_id', 'DESC');
		$query = $this->db->get('quotes');
		
		if($query->num_rows() > 0){
			return $query->result();
			
        }else{
            return array();
		}
	}

	public function count_all()
	{
		$keyword = $this->input->get('keyword');
		$this->db->like(array('quote_name' => $keyword));
		return $this->db->get('quotes')->num_rows();
	}

	public function get_categories(){

        $this->db->order_by('category_name');
        $query = $this->db->get('category');
        return $query->result_array();

    }
    
    //register admin
	public function sign_up_admin($enc_password){
		//user data array
		$data = array(
			'admin_username' => $this->input->post('username'),
			'admin_password' => $enc_password,
		);
		//insert admin as a user
		return $this->db->insert('admin', $data);
	}
	
	//login admin
	public function login_admin($username, $password){
		//validate
		$this->db->where('admin_username', $username);
		$this->db->where('admin_password', $password);

		$result = $this->db->get('admin');

		if($result->num_rows() == 1){
			return $result->row(0)->id;
		}else{
			return false;
		}   
	}

	 //Logout 
	 public function admin_logout(){
		//unset user data
	   $this->session->unset_userdata('logged_in');
	   $this->session->unset_userdata('user_id');
	   $this->session->unset_userdata('username');
	   //set message
	   $this->session->set_flashdata('admin_loggedout', 'You are now logged out');

	   redirect('admin/login');

   }
}
?>