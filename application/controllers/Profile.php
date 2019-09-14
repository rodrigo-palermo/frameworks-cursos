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
        $data['tableName'] = 'Perfil de usuário';

        $this->form_validation->set_rules('nome', 'Nome', 'required');

		$this->load->view('templates/header', $data);
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('profile/create');
        }
        else
        {
            $this->profile_model->set_profile();
            $this->load->view('templates/success');
        }
		$this->load->view('templates/footer');
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
