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

        $data['profiles'] = $this->profile_model->get_profile();

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
            $this->load->view('templates/success');
        }
    }

    public function view()
    {
        $data['title'] = 'Lista de usuários';

        $data['users'] = $this->user_model->get_users();
        
        $this->load->view('templates/header', $data);
        $this->load->view('user/view');
        $this->load->view('templates/footer');
    }

	public function login()
	{

		$this->load->helper('form');
		$this->load->library('form_validation');

		$data['tableName'] = 'user';
		$data['title'] = 'Login';

		$this->form_validation->set_rules('username', 'Nome de usuário', 'required');
		$this->form_validation->set_rules('password', 'Senha', 'required');

		$this->load->view('templates/header', $data);
		if($this->form_validation->run() === FALSE) {
			$this->load->view('auth/login');
		}else {
			$this->user_model->set_user()
		}
		$this->load->view('templates/footer');

		if (isset($_POST['submitEntrar'])) {

			$login = $_POST['login'];
			$senha_digitada = $_POST['senha'];

			$usuario = Usuario::findByLogin($login);

			if(empty($usuario)) {
				http_response_code(500);
			}
			else {
				if ($senha_digitada == $usuario->getSenha()) {
					$_SESSION['autenticado'] = true;
					$_SESSION['id_usuario'] = $usuario->getId();
					$_SESSION['perfil'] =  $usuario->getIdPerfil();
					http_response_code(200);
				}
				else {
					http_response_code(500);
				}
			}
		}
	}

}
