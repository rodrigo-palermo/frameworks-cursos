<?php


class Profile_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_profiles()
    {
        $query = $this->db->get('profile');
        return $query->result_array();
    }

}