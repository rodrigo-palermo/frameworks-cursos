<?php


class Profile_model extends CI_Model
{
	private $table = 'perfil';

    public function __construct()
    {
        $this->load->database();
    }

    public function set_profile($id = false)
    {
        $this->load->helper('url');

        $data = array(
            'nome' => $this->input->post('nome'),
        );

        if($id) {
			$this->db->where('id', $id);
			return $this->db->update($this->table, $data);
		}
        return $this->db->insert($this->table, $data);
    }

    public function get_profile($id = false)
    {
        if($id){
        	$this->db->where('id',$id);
		}
    	$query = $this->db->get($this->table);
        return $query->result_array();
    }

    public function delete_profile($id)
	{
		$this->db->where('id',$id);
		return $this->db->delete($this->table);
	}

}
