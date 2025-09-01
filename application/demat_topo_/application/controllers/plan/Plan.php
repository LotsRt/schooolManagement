<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Plan extends CI_Controller
{
	public function __construct(){
		parent::__construct();
        //$this->load->model('admin/Admin_model', 'adminmodel');
	}

	public function view_plan(){
        if ($this->session->has_userdata('login')) {
            $data['linksBeforeAndAfter'] = 1;
            $data['plan'] = '';
            $data['fildariane'] = "Visualisation Plan";

            $this->load->view('templates/header_map', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('plan/plan', $data);
            $this->load->view('templates/scripts_map');
        } else {
            redirect('login');
        }
	}
    
}
