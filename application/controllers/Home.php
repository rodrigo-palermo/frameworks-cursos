<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Home extends CI_Controller {

    public function view($page = 'home')
    {
        $page_admin = 'admin';

    	if(!file_exists(APPPATH.'views/home/'.$page.'.php')) {
            //This page does not exists
            show_404();
        }

        $data['title'] = ucfirst($page);

        $this->load->view('templates/header', $data);
        if(!$this->session->autenticado || $this->session->usuario_perfil != 'Administrador' ){
			$this->load->view('home/' . $page, $data);
		} else {
			$this->load->view('home/' . $page_admin, $data);
		}
        $this->load->view('templates/footer', $data);
        //client side debug
//        $this->output->enable_profiler(FALSE);

    }
}
