<?php

class Profile extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('profile_model');
        $this->load->helper('url_helper');
    }

    public function create()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Cadastro de perfil de usuário';

        $this->form_validation->set_rules('nome', 'Nome', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('profile/create');
            $this->load->view('templates/footer');

        }
        else
        {
            $this->profile_model->set_profile();
            $this->load->view('profile/success');
        }
    }

    public function view()
    {
        $data['title'] = 'Lista de perfil de usuário';
        $data['profiles'] = $this->profile_model->get_profiles();

        $this->load->view('templates/header', $data);        
        $this->load->view('profile/view');
        $this->load->view('templates/footer');
    }

    
}