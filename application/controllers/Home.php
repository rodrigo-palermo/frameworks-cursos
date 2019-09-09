<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Home extends CI_Controller {

    public function view($page = 'home')
    {
        if(!file_exists(APPPATH.'views/home/'.$page.'.php')) {
            //This page does not exists
            show_404();
        }

        $data['title'] = ucfirst($page);

        $this->load->view('templates/header', $data);
        $this->load->view('home/'.$page, $data);
        $this->load->view('templates/footer', $data);
        $this->output->enable_profiler(TRUE);

    }
}
