<?php


class Profile_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function set_profile()
    {
        $this->load->helper('url');

        $data = array(
            'nome' => $this->input->post('nome'),
        );

        return $this->db->insert('profile', $data);
    }

    public function get_profiles()
    {
        $query = $this->db->get('profile');
        return $query->result_array();
    }

}
