<?php


class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->helper('url_helper');
    }

	public function view()
	{
		$data['title'] = 'Lista de usuários';

		$data['users'] = $this->user_model->get_users();

		$this->load->view('templates/header', $data);
		$this->load->view('user/view');
		$this->load->view('templates/footer');
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url().'');
	}

	public function delete($id)
	{
		$this->user_model->delete_user($id);
		redirect(base_url().'user/view');
	}

	public function login()
	{

		$this->load->helper('form');
		$this->load->library('form_validation');

		$data['title'] = 'Login';
		$data['errorMessage'] = 'Login e/ou senha incorretos. Tente novamente';

		$this->session->set_userdata('loginError', False);

		$this->form_validation->set_rules('nome', 'Nome de usuário', 'required');
		$this->form_validation->set_rules('senha', 'Senha', 'required');

		$this->load->view('templates/header', $data);
		if($this->form_validation->run() === False) {
			$this->load->view('user/login');
		}else {
			if($this->user_model->auth_user()){
				$this->session->set_userdata('autenticado', True);
				redirect(base_url().'');
			} else {
				$this->session->set_userdata('loginError', True);
				$this->load->view('user/login', $data);
			}
		}
		$this->load->view('templates/footer');

	}
    public function register()
    {
    	#Inclui verificacao reCaptcha

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('profile_model');

        $data['profiles'] = $this->profile_model->get_profile();

		$data['duplicateUserMessage'] = 'Nome de usuário indisponível. Tente outro.';
		$data['passwordMismatchMessage'] = 'Senhas não conferem. Tente novamente';
		$data['robotMessage'] = 'Confirme que você é uma pessoa.';
		$this->session->set_userdata('duplicateUserError', False);
		$this->session->set_userdata('passwordMismatchError', False);
		$this->session->set_userdata('robotError', False);

        $data['title'] = 'Criar conta';

        $this->form_validation->set_rules('id_perfil', 'Perfil', 'required');
        $this->form_validation->set_rules('nome', 'Nome', 'required');
        $this->form_validation->set_rules('email', 'E-mail', 'required');
        $this->form_validation->set_rules('senha', 'Senha', 'required', 'placeholder="Senha"');
		$this->form_validation->set_rules('senha_repetida', 'Senha novamente', 'required', 'placeholder="Senha novamente"');

		$recaptchaResponse = $this->input->post('g-recaptcha-response');
		$secret = $this->config->item('g-recaptha-backend-key');
		$url = 'https://www.google.com/recaptcha/api/siteverify';
		$data1 = array('secret' => $secret, 'response' => $recaptchaResponse);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		$response = curl_exec($ch);
		curl_close($ch);
		$status = json_decode($response, true);


        $this->load->view('templates/header', $data);

		$allow_register = $this->user_model->allow_register();
		$repeated_pass_match = $this->user_model->repeated_pass_match();

        if ($this->form_validation->run() === FALSE || !$status['success'] || !$allow_register || !$repeated_pass_match)
		{

			if(!$status['success']){
				$this->session->set_userdata('robotError', True);
			}
			else if(!$allow_register){
				$this->session->set_userdata('duplicateUserError', True);
			}
			else if(!$repeated_pass_match){
				$this->session->set_userdata('passwordMismatchError', True);
			}
			$this->load->view('user/register');
		}
        else
        {
            $this->user_model->set_user();

			$this->email->from('eng.rodrigo.palermo@gmail.com', 'Cursos Online Team');
			$this->email->to('avilapalermo@gmail.com');

			$this->email->subject('Sua nova conta no Cursos Online');
			$this->email->message('Sua nova conta no Cursos Online está ponta.\n\n Acesse o site faça o login.');

			$this->email->send();

			$this->load->view('user/register_email_sent');
        }
        $this->load->view('templates/footer');
    }

    public function create()
    {
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('profile_model');

		$data['profiles'] = $this->profile_model->get_profile();
		$data['duplicateUserMessage'] = 'Nome de usuário indisponível. Tente outro.';
		$data['passwordMismatchMessage'] = 'Senhas não conferem. Tente novamente';

		$this->session->set_userdata('duplicateUserError', False);
		$this->session->set_userdata('passwordMismatchError', False);

		$data['title'] = 'Cadastro de usuário';

		$this->form_validation->set_rules('id_perfil', 'Perfil', 'required');
		$this->form_validation->set_rules('nome', 'Nome', 'required');
		$this->form_validation->set_rules('email', 'E-mail', 'required');
		$this->form_validation->set_rules('senha', 'Senha', 'required', 'placeholder="Senha"');
		$this->form_validation->set_rules('senha_repetida', 'Senha novamente', 'required', 'placeholder="Senha novamente"');

		$this->load->view('templates/header', $data);

		$allow_register = $this->user_model->allow_register();
		$repeated_pass_match = $this->user_model->repeated_pass_match();

		if ($this->form_validation->run() === FALSE || !$allow_register || !$repeated_pass_match)
		{
			if(!$allow_register){
				$this->session->set_userdata('duplicateUserError', True);
			}
			else if(!$repeated_pass_match){
				$this->session->set_userdata('passwordMismatchError', True);
			}
			$this->load->view('user/create');
		}
		else
		{
			$this->user_model->set_user();
			//$this->load->view('templates/success');
			redirect(base_url().'user/view');
		}
		$this->load->view('templates/footer');
	}

}
