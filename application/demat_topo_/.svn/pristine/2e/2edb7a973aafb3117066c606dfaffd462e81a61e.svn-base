<?php
defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );

class Dessin extends CI_Controller
 {
    public function __construct()
 	{
        parent::__construct();
    }

    public function view_dessin()
	{
		if ($this->session->has_userdata('login')) {
			$data['dessin'] = '';
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar');
			$this->load->view('dessin/dessin', $data);
			$this->load->view('templates/scripts');
		} else {
			redirect('login');
		}
	}
}