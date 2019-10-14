<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct()
    {
        //load database in autoload libraries 
         parent::__construct(); 
        $this->load->model('users/users_model');         
	}
	
	public function index($offset=0)
	{
		
		$this->load->library('pagination');

		$config['base_url'] = base_url(). 'users/';
		$config['total_rows'] = $this->users_model->count_all();
		$config['uri_segment'] = 4;
		$config['per_page'] = 4;

		$this->pagination->initialize($config);

		$data['quotes'] = $this->users_model->get_quotes($config['per_page'], $offset);

		
		$this->load->view('quotes/includes/header');
		$this->load->view('quotes/home/index',$data);
		$this->load->view('quotes/includes/footer');
		
	}

	 //search
	public function execute_search()
	{
		 // Retrieve the posted search term.
		 $search_term = $this->input->post('search');
 
		 // Use a model to retrieve the results.
		 $data['quotes'] = $this->users_model->get_results($search_term);
 
		 // Pass the results to the view.
		 //$this->load->view('search_results',$data);

		 $this->load->view('quotes/includes/header');
		 $this->load->view('quotes/home/search_quote', $data);
		 $this->load->view('quotes/includes/footer');
		 
	 }
	
	 public function users_sign_up_form()
	 {
		$this->load->view('quotes/account/sign_up');
	 }

	 public function users_login_form()
	 {
		$this->load->view('quotes/account/login');
	 }

	
	public function users_sign_up()
	{
 
		 $this->form_validation->set_rules('username', 'Username', 'required');
		 $this->form_validation->set_rules('password', 'Password', 'required');
		 $this->form_validation->set_rules('password2', 'Confirm Password', 'matches[password]');
		 
		 if($this->form_validation->run() === FALSE){
 
			 $this->load->view('quotes/account/sign_up');
						 
		 }else{ 
		   
		   $enc_password = md5( $this->input->post('password'));
 
		   $this->users_model->sign_up_user($enc_password);
		 //	//set message
		   $this->session->set_flashdata('user_registered', 'You are now registered as an admin and can now log in');
 
		   redirect('users/login');
		  
		   }   
	  }

	public function users_login()
	{
            
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		if($this->form_validation->run() === FALSE){
	
			$this->load->view('quotes/account/login');
			
		}else{ 
			
			$username = $this->input->post('username');
			//get and encrypt the password
			$password = md5($this->input->post('password'));
			//Login user
			$user_id = $this->users_model->login_user($username, $password);
			
			if($user_id){ 
				//create session
				$user_data = array(

					'admin_id' => $user_id,
					'admin_username' => $username,
					'logged_in' => true
					
				);

				$this->session->set_userdata($user_data);
				//set message
				$this->session->set_flashdata('user_loggedin', 'You are now logged in');

				redirect('users');

			}else{
				
				//set message
				$this->session->set_flashdata('user login_failed', 'login is invalid');

				redirect('users/login');
			}     
		}    
    }

}
