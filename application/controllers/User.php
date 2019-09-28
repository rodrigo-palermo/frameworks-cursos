<?php


class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->helper('url_helper');
    }

    public function register()
    {
    	#Inclui verificacao reCaptcha

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('profile_model');

        $data['profiles'] = $this->profile_model->get_profile();

        $data['title'] = 'Criar conta';

        $this->form_validation->set_rules('id_perfil', 'Perfil', 'required');
        $this->form_validation->set_rules('nome', 'Nome', 'required');
        $this->form_validation->set_rules('email', 'E-mail', 'required');
        $this->form_validation->set_rules('senha', 'Senha', 'required', 'placeholder="Senha"');

		$recaptchaResponse = $this->input->post('g-recaptcha-response');
		$secret = 'CHANGE KEY';
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

        if ($this->form_validation->run() === FALSE or !$status['success'])
        {
            $this->load->view('user/register');
        }
        else
        {
            $this->user_model->set_user();
            # todo: feature: verificar se usuario ja existe antes de gravar (ou tratar erro se no banco houver conflito)
			# todo: ver libraries config e email
			#$this->load->library('email');

			$this->email->from('eng.rodrigo.palermo@gmail.com', 'Administrador');
			$this->email->to('avilapalermo@gmail.com');

			$this->email->subject('Email Test');
			$this->email->message('Testing the email class.');

			$this->email->send();

			$this->load->view('user/register_email_sent');
        }
        $this->load->view('templates/footer');
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
		$this->form_validation->set_rules('senha', 'Senha', 'required', 'placeholder="Senha"');

		$this->load->view('templates/header', $data);
		if ($this->form_validation->run() === FALSE)
		{
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

    public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url().'');
	}

}
