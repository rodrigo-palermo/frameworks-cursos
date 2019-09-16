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
}
