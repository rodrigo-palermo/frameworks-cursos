<?php

class Category extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('category_model');
        $this->load->helper('url_helper');
    }

    public function create($id = false)
    {
        if(isset($_POST['hdnId']))
        	$id = $_POST['hdnId'];

    	$this->load->helper('form');
        $this->load->library('form_validation');

        $data['tableName'] = 'Categoria de cursos';

        if($id){
			$data['title'] = 'Atualização de categoria de cursos';
			$arrCategoryTemp = $this->category_model->get_category($id);
			$data['category'] = $arrCategoryTemp[0];
		} else {
			$data['title'] = 'Cadastro de categoria de cursos';
		}

        $this->form_validation->set_rules('nome', 'Nome', 'required');
        $this->form_validation->set_rules('descricao', 'Descrição', 'required');

		$this->load->view('templates/header', $data);
        if ($this->form_validation->run() === FALSE)
        {
        	$this->load->view('category/create', $data);
        }
        else
        {
            $this->category_model->set_category($id);
            //$this->load->view('templates/success');
			redirect(base_url().'category/view');
        }
		$this->load->view('templates/footer');
    }

    public function view()
    {
        $data['title'] = 'Lista de categoria de cursos';
        $data['category'] = $this->category_model->get_category();

        $this->load->view('templates/header', $data);        
        $this->load->view('category/view');
        $this->load->view('templates/footer');
    }

    public function delete($id)
	{
		$this->category_model->delete_category($id);
		redirect(base_url().'category/view');
	}

}
