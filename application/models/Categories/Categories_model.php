<?php
class Categories_model extends CI_Model{

    public function __construct()
	{

		$this->load->database();
    }

    public function add_category()
    {
        $data = array(
            'category_name' => $this->input->post('category_name'),     
        );

        return $this->db->insert('category', $data);
    } 

    public function get_categories($limit, $offset)
    {
        $this->db->limit($limit);
		$this->db->offset($offset);

        $this->db->order_by('category_name');
        $query = $this->db->get('category');
        return $query->result_array();

    }

    public function count_all()
	{
		return $this->db->get('category')->num_rows();
	}


    public function get_single_category($category_id)
	{
		$query = $this->db->get_where('category', array('category_id' => $category_id));

		if($query->num_rows() > 0){
			return $query->row();
		}else{
            return false;
		}
	}

    public function update_category($data, $category_id)
	{
		return $this->db->where('category_id',$category_id)
						->update('category', $data);
	}
      

    public function delete_category($category_id)
	{
		return $this->db->delete('category',['category_id' => $category_id]);
		
    }
    
    public function view_quotes_by_category($category_id)
    {
        $this->db->order_by('quotes.quote_id', 'DESC');

		$this->db->join('category', 'category.category_id = quotes.category_id');
		$query = $this->db->get_where('quotes', array('category_id' => $category_id));
		return $query->result_array();
    }

   
}

?>