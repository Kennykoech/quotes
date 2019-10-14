<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
		{
			//load database in autoload libraries 
			parent::__construct(); 
			$this->load->model('admin/home_model');         
	}

	public function index($offset=0)
	{
		$this->load->library('pagination');

		$config['base_url'] = base_url(). 'admin/';
		$config['total_rows'] = $this->home_model->count_all();
		$config['uri_segment'] = 2;
		$config['per_page'] = 4;
		$config['reuse_query_string'] = TRUE;

		$this->pagination->initialize($config);

		$data['quotes'] =	$this->home_model->get_quotes($config['per_page'], $offset);
		$data['category'] =	$this->home_model->get_categories();


		$this->load->view('admin/header/header');
		$this->load->view('admin/header/css');
		$this->load->view('admin/header/navtop');
		$this->load->view('admin/header/navleft');


		$this->load->view('admin/home/index', $data);
		$this->load->view('admin/header/footer');
		$this->load->view('admin/header/htmlclose');
        }
		#aAdmin Account
		
	public function admin_sign_up_form()
	{
		$this->load->view('admin/account/sign_up');
	}	

    public function admin_sign_up()
	{
		$this->load->view('admin/account/sign_up');

		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('password2', 'Confirm Password', 'matches[password]');
		
		if($this->form_validation->run() === FALSE){

            $this->load->view('admin/account/sign_up');
                        
		}else{ 
		  
		  $enc_password = md5( $this->input->post('password'));

		  $this->home_model->sign_up_admin($enc_password);
		//	//set message
		  $this->session->set_flashdata('admin_registered', 'You are now registered as an admin and can log in');

		  redirect('admin/login');
		 
	 	 }   
	 }
	 
	public function admin_login_form()
	{
		$this->load->view('admin/account/loffgin');
	} 

	public function admin_login()
	{
            
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		if($this->form_validation->run() === FALSE){
	
			$this->load->view('admin/account/login');
			
		}else{ 
			
			$username = $this->input->post('username');
			//get and encrypt the password
			$password = md5($this->input->post('password'));
			//Login user
			$user_id = $this->home_model->login_admin($username, $password);
			
			if($user_id){ 
				//create session
				$user_data = array(
					'admin_id' => $user_id,
					'admin_username' => $username,
					'logged_in' => true
				);

				$this->session->set_userdata($user_data);
				//set message
				$this->session->set_flashdata('admin_loggedin', 'You are now logged in');

				redirect('admin');

			}else{
				
				//set message
				$this->session->set_flashdata('admin login_failed', 'login is invalid');

				redirect('admin/login');
			}     
		}    
    }

        // public function checkAdmin()
        // {

		// }
	
	public function admin_logout()
	{
		$this->session->unset_userdata('logged_in');
		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('username');
		//set message
		$this->session->set_flashdata('admin_loggedout', 'You are now logged out');

	redirect('admin/login');
	}
        
	
     
}
