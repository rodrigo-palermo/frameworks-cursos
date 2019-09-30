<?php


class Course_model extends CI_Model
{
	private $table = 'curso';

    public function __construct()
    {
        $this->load->database();
    }

    public function set_course($id = false)
    {
        $this->load->helper('url');

        $data = array(
			'id_categoria' => $this->input->post('id_categoria'),
            'nome' => $this->input->post('nome'),
            'descricao' => $this->input->post('descricao')
        );

        if($id) {
			$this->db->where('id', $id);
			return $this->db->update($this->table, $data);
		}
        return $this->db->insert($this->table, $data);
    }

    public function get_course($id = false)
    {
		if($id){
			$this->db->where('curso.id',$id);
		}
		$this->db->select('curso.*, categoria.nome categoria_nome');
		$this->db->from('curso');
		$this->db->join('categoria','curso.id_categoria = categoria.id');
		$query = $this->db->get();
		return $query->result_array();
    }

    public function delete_course($id)
	{
		$this->db->where('id',$id);
		return $this->db->delete($this->table);
	}

}
