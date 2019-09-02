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

        $data['title'] = 'Cadastro de usuário';

        $this->form_validation->set_rules('perfil', 'Perfil', 'required');
        $this->form_validation->set_rules('nome', 'Nome', 'required');
        $this->form_validation->set_rules('email', 'E-mail', 'required');
        $this->form_validation->set_rules('password', 'Senha', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('user/create');
            $this->load->view('templates/footer');

        }
        else
        {
            $this->user_model->set();
            //$this->load->view('user/success');
        }
    }
}