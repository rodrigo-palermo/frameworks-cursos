<?php

class Course extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('course_model');
        $this->load->helper('url_helper');
    }

    public function create($id = false)
    {
        if(isset($_POST['hdnId']))
        	$id = $_POST['hdnId'];

    	$this->load->helper('form');
        $this->load->library('form_validation');
		$this->load->model('category_model');

		$data['category'] = $this->category_model->get_category();

        $data['tableName'] = 'Curso';

        if($id){
			$data['title'] = 'Atualização de curso';
			$data['course'] = $this->course_model->get_course($id);
		} else {
			$data['title'] = 'Cadastro de curso';
		}
		$this->form_validation->set_rules('id_categoria', 'Categoria', 'required');
        $this->form_validation->set_rules('nome', 'Nome', 'required');
        $this->form_validation->set_rules('descricao', 'Descrição', 'required');

		$this->load->view('templates/header', $data);
        if ($this->form_validation->run() === FALSE)
        {
        	$this->load->view('course/create', $data);
        }
        else
        {
            $this->course_model->set_course($id);
            //$this->load->view('templates/success');
			redirect(base_url().'user/account');
        }
		$this->load->view('templates/footer');
    }

    public function view($id = null)
    {
        $data['title'] = 'Lista de curso';

        if($id)
			$data['course'] = $this->course_model->get_course($id);
        else
        	$data['course'] = $this->course_model->get_course();

        $this->load->view('templates/header', $data);
        $this->load->view('course/view');
        $this->load->view('templates/footer');
    }

    public function delete($id)
	{
		$this->course_model->delete_course($id);
		redirect(base_url().'user/account');
	}

}
