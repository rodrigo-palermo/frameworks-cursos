<?php


class User_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function set_user()
    {
        $this->load->helper('url');

        $data = array(
            'id_perfil' => $this->input->post('id_perfil'),
            'nome' => $this->input->post('nome'),
            'email' => $this->input->post('email'),
            'senha' => $this->input->post('senha'),
        );

        return $this->db->insert('usuario', $data);
    }

    public function get_users()
    {
        $query = $this->db->get('usuario');
        return $query->result_array();
    }

    public function get_user($id)
    {
        $query = $this->db->get_where('usuario', array('id' => $id));
        return $query->row();
    }

    public function get_id_by_username($username)
    {
        $query = $this->db->get_where('usuario', array('nome' => $username), 1);
        $row = $query->row();
        if(isset($row))
        	return $row->id;
        else
        	return False;
    }

    public function auth_user()
    {
        $data = array(
            'nome' => $this->input->post('nome'),
            'senha' => $this->input->post('senha')
        );

        $id = $this->get_id_by_username($data['nome']);

        if($id){
        	if($data['nome'] == $this->get_user($id)->nome){
				return True;
			}
		}
        return False;

    }
}
