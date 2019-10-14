<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class   Categories extends CI_Controller {

    public function __construct()
    {
        //load database in autoload libraries 
         parent::__construct(); 
        $this->load->model('categories/categories_model');         
    }

    public function create_category()
    {
            
        $this->load->view('admin/header/header');
        $this->load->view('admin/header/css');
        $this->load->view('admin/header/navtop');
        $this->load->view('admin/header/navleft');

        $this->load->view('admin/home/category');
        $this->load->view('admin/header/footer');
        $this->load->view('admin/header/htmlclose');
    }

    public function add_category()
    {
        $this->categories_model->add_category();

        $this->session->set_flashdata('category_created', 'Your category has been created');

        redirect('categories/view_category');

    }

    public function view_category($offset=0)
    {
        $this->load->library('pagination');

		$config['base_url'] = base_url(). 'categories/view_category/';
		$config['total_rows'] = $this->home_model->count_all();
		// $config['uri_segment'] = 4;
		$config['per_page'] = 10;

        $this->pagination->initialize($config);
        
        $data['category'] = $this->categories_model->get_categories($config['per_page'], $offset);

        $this->load->view('admin/header/header');
        $this->load->view('admin/header/css');
        $this->load->view('admin/header/navtop');
        $this->load->view('admin/header/navleft');


        $this->load->view('admin/home/view_category', $data);
        $this->load->view('admin/header/footer');
        $this->load->view('admin/header/htmlclose');
    }

    public function edit_category($category_id){

		$this->form_validation->set_rules('category_name', 'Enter category_name', 'required');

		if ($this->form_validation->run())
		{
            $data = $this->input->post();
            unset($data['submit']);
            if($this->categories_model->update_category($data, $category_id))
            {
                $this->session->set_flashdata('msg', 'category updated  successfully');
            }else
            {
                $this->session->set_flashdata('msg', 'category not updated successfully');
            }
            return redirect('categories/view_category');
		}
		else
		{

            echo validation_errors();
                
		}
	 }

    public function update_category($category_id)
	{
		
		$category = $this->categories_model->get_single_category($category_id);

        $this->load->view('admin/header/header');
        $this->load->view('admin/header/css');
        $this->load->view('admin/header/navtop');
        $this->load->view('admin/header/navleft');

        $this->load->view('admin/home/update_category', ['category' => $category]);
		$this->load->view('admin/header/footer');
        $this->load->view('admin/header/htmlclose');
	}

    public function delete_category($category_id)
    {
        if($this->categories_model->delete_category($category_id))
		{

            $this->session->set_flashdata('msg', 'category deleted successfully');
            
		}
		else
		{

            $this->session->set_flashdata('msg', 'category not deleted successfully');
            
		}

		redirect('categories/view_category');
    }

    public function view_quotes_by_category($category_id)
    {
        $quotes_by_category = $this->categories_model->view_quotes_by_category($category_id);

        $this->load->view('admin/header/header');
        $this->load->view('admin/header/css');
        $this->load->view('admin/header/navtop');
        $this->load->view('admin/header/navleft');

        $this->load->view('admin/home/update_category', ['quotes' => $quotes_by_category]);
		$this->load->view('admin/header/footer');
        $this->load->view('admin/header/htmlclose');


    }


}

?>