<?php

class Profile extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('profile_model');
        $this->load->helper('url_helper');
    }

    public function create($id = false)
    {
        if(isset($_POST['hdnId']))
        	$id = $_POST['hdnId'];

    	$this->load->helper('form');
        $this->load->library('form_validation');

        $data['tableName'] = 'Perfil de usuário';

        if($id){
			$data['title'] = 'Atualização de perfil de usuário';
			$arrProfileTemp = $this->profile_model->get_profile($id);
			$data['profile'] = $arrProfileTemp[0];
		} else {
			$data['title'] = 'Cadastro de perfil de usuário';
		}

        $this->form_validation->set_rules('nome', 'Nome', 'required');

		$this->load->view('templates/header', $data);
        if ($this->form_validation->run() === FALSE)
        {
        	$this->load->view('profile/create', $data);
        }
        else
        {
            $this->profile_model->set_profile($id);
            //$this->load->view('templates/success');
			redirect(base_url().'profile/view');
        }
		$this->load->view('templates/footer');
    }

    public function view()
    {
        $data['title'] = 'Lista de perfil de usuário';
        $data['profiles'] = $this->profile_model->get_profile();

        $this->load->view('templates/header', $data);        
        $this->load->view('profile/view');
        $this->load->view('templates/footer');
    }

    public function delete($id)
	{
		$this->profile_model->delete_profile($id);
		redirect(base_url().'profile/view');
	}

}
