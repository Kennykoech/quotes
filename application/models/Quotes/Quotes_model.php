<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quotes_model extends CI_Model{

    public function __construct()
	{

		$this->load->database();
	}
	
	public function get_categories(){

        $this->db->order_by('category_name');
        $query = $this->db->get('category');
        return $query->result_array();

	}
	
	public function get_quotes_by_category($category_id){

		$this->db->order_by('quotes.quote_id', 'DESC');

		//$this->db->join('category', 'category.category_id = quotes.category_id');
		$query = $this->db->get_where('quotes', array('category_id' => $category_id));
		return $query->result_array();
	}

	// public function add_quote($data){
	// 	return $this->db->insert('quotes', $data);
	// }
		
	public function add_quote($data){
		
		// 'quote_cover' => $quote_cover,
		
		// $data = array(
		// 	'category_id' => $this->input->post('category_id'),
		
		// 	'quote_name' => $this->input->post(),
		// );

		return $this->db->insert('quotes', $data);

	} 

	public function delete_quote($quote_id)
	{
		return $this->db->delete('quotes',['quote_id' => $quote_id]);
		
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

	public function filter_quotes_by_category()
	{
		$category_id = $this->input->post('category_id');


		$this->db->select("*");
		$this->db->from("quotes");
		$this->db->where("category_id",$category_id);
		

		// Execute the query.
		$query = $this->db->get();

		// Return the results.
		$results = $query->result();

		return($results);

	}
}
?>