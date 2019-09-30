<?php

class Content extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('content_model');
        $this->load->helper('url_helper');
    }

    public function create($id = false)
    {
        if(isset($_POST['hdnId']))
        	$id = $_POST['hdnId'];

    	$this->load->helper('form');
        $this->load->library('form_validation');
		$this->load->model('course_model');

		$data['course'] = $this->course_model->get_course();

        $data['tableName'] = 'Conteudo';

        if($id){
			$data['title'] = 'Atualização de conteúdo';
			$arrContentTemp = $this->content_model->get_content($id);
			$data['content'] = $arrContentTemp[0];
		} else {
			$data['title'] = 'Cadastro de conteúdo';
		}
		$this->form_validation->set_rules('id_curso', 'Curso', 'required');
        $this->form_validation->set_rules('nome', 'Nome', 'required');
        $this->form_validation->set_rules('descricao', 'Descrição', 'required');

		$this->load->view('templates/header', $data);
        if ($this->form_validation->run() === FALSE)
        {
        	$this->load->view('content/create', $data);
        }
        else
        {
            $this->content_model->set_content($id);
            //$this->load->view('templates/success');
			redirect(base_url().'content/view');
        }
		$this->load->view('templates/footer');
    }

    public function view()
    {
        $data['title'] = 'Lista de conteúdo';
        $data['content'] = $this->content_model->get_content();

        $this->load->view('templates/header', $data);        
        $this->load->view('content/view');
        $this->load->view('templates/footer');
    }

    public function delete($id)
	{
		$this->content_model->delete_content($id);
		redirect(base_url().'content/view');
	}

}
