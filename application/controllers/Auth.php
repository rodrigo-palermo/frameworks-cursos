<?php


class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->load->helper('url_helper');
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

	public function register()
	{
		$this->load->view('templates/header', $data);
		$this->load->view('auth/register');
		$this->load->view('templates/footer');

	}
}
