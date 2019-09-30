<?php


class Category_model extends CI_Model
{
	private $table = 'categoria';

    public function __construct()
    {
        $this->load->database();
    }

    public function set_category($id = false)
    {
        $this->load->helper('url');

        $data = array(
            'nome' => $this->input->post('nome'),
            'descricao' => $this->input->post('descricao')
        );

        if($id) {
			$this->db->where('id', $id);
			return $this->db->update($this->table, $data);
		}
        return $this->db->insert($this->table, $data);
    }

    public function get_category($id = false)
    {
        if($id){
        	$this->db->where('id',$id);
		}
    	$query = $this->db->get($this->table);
        return $query->result_array();
    }

    public function delete_category($id)
	{
		$this->db->where('id',$id);
		return $this->db->delete($this->table);
	}

}
