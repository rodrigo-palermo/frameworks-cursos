<?php


class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->helper('url_helper');
    }

    public function create()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('profile_model');

        $data['profiles'] = $this->profile_model->get_profiles();

        $data['title'] = 'Cadastro de usuário';

        $this->form_validation->set_rules('id_perfil', 'Perfil', 'required');
        $this->form_validation->set_rules('nome', 'Nome', 'required');
        $this->form_validation->set_rules('email', 'E-mail', 'required');
        $this->form_validation->set_rules('senha', 'Senha', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('user/create');
            $this->load->view('templates/footer');

        }
        else
        {
            $this->user_model->set_user();
            $this->load->view('user/success');
        }
    }

}