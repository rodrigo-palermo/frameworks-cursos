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

		$this->load->model('profile_model');

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
		#$data['robotMessage'] = 'Confirme que você é uma pessoa.';
		$this->session->set_userdata('duplicateUserError', False);
		$this->session->set_userdata('passwordMismatchError', False);
		#$this->session->set_userdata('robotError', False);

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
		$isPerson = $status['success']?True:False;

        if ($this->form_validation->run() === FALSE || !$isPerson || !$allow_register || !$repeated_pass_match)
		{

			if(!$allow_register){
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
            $user_email = $this->input->post('email');

			$this->email->from('eng.rodrigo.palermo@gmail.com', 'Cursos Online Team');
			$this->email->to($user_email);

			$this->email->subject('Cursos Online - Nova conta');
			$this->email->message('Sua nova conta no Cursos Online está pronta. Acesse o site para fazer o login.');

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

		$this->session->set_userdata('duplicateUserError', False);

		$data['title'] = 'Cadastro de usuário';

		$this->form_validation->set_rules('id_perfil', 'Perfil', 'required');
		$this->form_validation->set_rules('nome', 'Nome', 'required');
		$this->form_validation->set_rules('email', 'E-mail', 'required');

		$this->load->view('templates/header', $data);

		$allow_register = $this->user_model->allow_register();

		if ($this->form_validation->run() === FALSE || !$allow_register)
		{
			if(!$allow_register){
				$this->session->set_userdata('duplicateUserError', True);
			}
			$this->load->view('user/create');
		}
		else
		{
			$random_password = $this->random_password(4);
			$this->user_model->set_user_by_admin($random_password);

			$email = $this->input->post('email');

			$id = $this->user_model->get_id_by_email($email);

			$this->email->from('eng.rodrigo.palermo@gmail.com', 'Cursos Online Team');
			$this->email->to($email);

			$this->email->subject('Cursos Online - Nova conta');
			$this->email->message('Esta conta foi criada pelo administrador do site.<br>
 									    Senha provisória: '.$random_password.PHP_EOL.'<br>
				                       Faça login e altere esta senha provisória no menu de configurações da conta.');

			$this->email->send();

			redirect(base_url().'user/view');
		}
		$this->load->view('templates/footer');
	}

	public function edit($id)
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('profile_model');

		$data['profiles'] = $this->profile_model->get_profile();
		$data['duplicateUserMessage'] = 'Nome de usuário indisponível. Tente outro.';
		$data['passwordMismatchMessage'] = 'Senhas não conferem. Tente novamente';

		$this->session->set_userdata('duplicateUserError', False);
		$this->session->set_userdata('passwordMismatchError', False);

		$data['title'] = 'Atualização de cadastro';
		$arrUserTemp = $this->user_model->get_users($id);
		$data['user'] = $arrUserTemp[0];

		$this->form_validation->set_rules('nome', 'Nome', 'required');

		$this->load->view('templates/header', $data);

		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('user/edit', $data);
		}
		else
		{
			$this->user_model->update_user_attribute($id, 'nome', $data['nome']);
			//$this->load->view('templates/success');
			redirect(base_url().'user/view');
		}
		$this->load->view('templates/footer');
	}

	public function reset_pass()
	{

		$this->load->helper('form');
		$this->load->library('form_validation');

		$data['title'] = 'Login - Redefinir senha';
		$data['emailErrorMessage'] = 'E-mail não encontrado. Tente novamente';

		$this->session->set_userdata('emailError', False);

		$this->form_validation->set_rules('email', 'E-mail de recuperação', 'required');

		$this->load->view('templates/header', $data);
		if($this->form_validation->run() === False) {
			$this->load->view('user/reset_pass');
		}else {
			if($this->user_model->auth_user_email()){

				$new_password = $this->random_password(4);
				$email = $this->input->post('email');

				$id = $this->user_model->get_id_by_email($email);
				$this->user_model->reset_user_password($id, $new_password);

				$this->email->from('eng.rodrigo.palermo@gmail.com', 'Cursos Online Team');
				$this->email->to($email);

				$this->email->subject('Cursos Online - Redefinir senha');
				$this->email->message('Sua senha foi redefinida.<br>
 									    Nova senha provisória: '.$new_password.PHP_EOL.'<br>
				                       Faça login e altere esta senha provisória no menu de configurações da conta.');

				$this->email->send();

				$this->load->view('user/reset_pass_email_sent');
			} else {
				$this->session->set_userdata('emailError', True);
				$this->load->view('user/reset_pass', $data);
			}
		}
		$this->load->view('templates/footer');
	}

	private function random_password($length)
	{
		$sample = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz!#*?';
		return substr(str_shuffle($sample), 0, $length);
	}

}
