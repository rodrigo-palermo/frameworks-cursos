<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MY_Controller Extends CI_Controller{
    public function __construct(){
        parent::__construct();
        if (!$this->ion_auth->logged_in()) 
        {
            redirect(site_url('auth/login'));
        }
    }
}