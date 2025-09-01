<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    public function construct(){
        $this->load->helper("url");
    }

	public function index()
	{
		$this->load->view('authentification/accueil');
	}
}
