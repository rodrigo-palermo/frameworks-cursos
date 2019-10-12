<?php


class Content_model extends CI_Model
{
	private $table = 'conteudo';

    public function __construct()
    {
        $this->load->database();
    }

    public function set_content($id = false)
    {
        $this->load->helper('url');

        $data = array(
			'id_curso' => $this->input->post('id_curso'),
            'nome' => $this->input->post('nome'),
            'descricao' => $this->input->post('descricao')
        );

        if($id) {
			$this->db->where('id', $id);
			return $this->db->update($this->table, $data);
		}
        return $this->db->insert($this->table, $data);
    }

    public function get_content($id = false)
    {
		if($id){
			$this->db->where('conteudo.id',$id);
		}
		$this->db->select('conteudo.*, curso.nome curso_nome');
		$this->db->from('conteudo');
		$this->db->join('curso','conteudo.id_curso = curso.id');
		$query = $this->db->get();
		return $query->result_array();
    }

	public function get_content_by_id_course($id_course)
	{
		$this->db->select('conteudo.*');
		$this->db->from('conteudo');
		$this->db->where('conteudo.id_curso',$id_course);
		$query = $this->db->get();
		return $query->result_array();
	}

    public function delete_content($id)
	{
		$this->db->where('id',$id);
		return $this->db->delete($this->table);
	}

}
