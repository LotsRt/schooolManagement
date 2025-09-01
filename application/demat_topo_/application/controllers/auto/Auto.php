<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auto extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper("url");
        $this->load->model( 'auto/Auto_model', 'auto_model' );
	}

    public function view(){
        if ($this->session->has_userdata('login')) {
			$data['linksBeforeAndAfter'] = 1;
			$data['fildariane'] = "Georeferencement";
			$data[ 'geom' ] = '';
			$this->load->view('templates/header_auto', $data);
			$this->load->view('templates/sidebar');
			$this->load->view('auto/auto');
			$this->load->view( 'templates/scripts_auto');
		} else {
			redirect('login');
		}
    }	
}
