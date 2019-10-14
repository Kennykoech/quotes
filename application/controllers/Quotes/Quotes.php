<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quotes extends CI_Controller {

	public function __construct()
    {
        //load database in autoload libraries 
         parent::__construct(); 
        $this->load->model('quotes/quotes_model');         
    }

    public function create_quote()
    {
        $data['category'] = $this->quotes_model->get_categories();

        $this->load->view('admin/header/header');
        $this->load->view('admin/header/css');
        $this->load->view('admin/header/navtop');
        $this->load->view('admin/header/navleft');


        $this->load->view('admin/home/quote', $data);
        $this->load->view('admin/header/footer');
        $this->load->view('admin/header/htmlclose');
        
    }

    public function save_quote()
    {
        $config['upload_path'] = './assets/images/quotes';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = '1000';
		$config['max_width'] = '1000';
		$config['max_height'] = '1000';

		$this->load->library('upload', $config);
		$quote_cover = $_FILES['userfile']['name'];

		if(!$this->upload->do_upload('userfile')){
			$errors = array('error'=> $this->upload->display_errors());
			//var_dump('here is about song file');
			//var_dump($errors);
		}else{
			//var_dump('no error');
            $data = array('upload_data' => $this->upload->data());
        }
			
        $data = $this->input->post();
        $data['quote_cover'] = $quote_cover;

        if($this->quotes_model->add_quote($data))
            {
                $this->session->set_flashdata('msg', 'quote added successfully');
            }else
            {
                $this->session->set_flashdata('msg', 'quote not added successfully');
            }
            return redirect('quotes/create_quote');
    }

    public function delete_quote($quote_id)
    {
        if($this->quotes_model->delete_quote($quote_id))
		{
			$this->session->set_flashdata('msg', 'quote deleted successfully');
		}
		else
		{
			$this->session->set_flashdata('msg', 'quote not deleted successfully');
		}

		redirect('admin');
    }

     //search
	 public function execute_search()
	 {
		 // Retrieve the posted search term.
		 $search_term = $this->input->post('search');
 
		 // Use a model to retrieve the results.
		 $quotes = $this->quotes_model->get_results($search_term);
 
		 // Pass the results to the view.
		 //$this->load->view('search_results',$data);

         $this->load->view('admin/header/header');
         $this->load->view('admin/header/css');
         $this->load->view('admin/header/navtop');
         $this->load->view('admin/header/navleft');
	
         $this->load->view('admin/home/search_quote', ['quotes' => $quotes]);
         $this->load->view('admin/header/footer');
         $this->load->view('admin/header/htmlclose');

	 }

     public function get_quotes_by_category()
     {
        
         $data = $this->input->post();
         
         $data['quotes'] = $this->quotes_model->filter_quotes_by_category();

        //  $data['quotes'] = $this->quotes_model->get_quotes_by_category($category_id);
         
         $this->load->view('admin/header/header');
         $this->load->view('admin/header/css');
         $this->load->view('admin/header/navtop');
         $this->load->view('admin/header/navleft');
	
         $this->load->view('admin/home/filter_quotes_by_category', $data);
         $this->load->view('admin/header/footer');
         $this->load->view('admin/header/htmlclose');

     }


}
