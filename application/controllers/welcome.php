<?php
defined('BASEPATH') or exit('No direct script access allowed');

class welcome extends CI_Controller
{
    function index()
    {
        $this->load->view('accueil/accueil');
    }

    public function vers_externe() {
        redirect('https://infinityfree.net');
    }

}