<?php
defined('BASEPATH') or exit('No direct script access allowed');

class dashbord_controller extends My_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('traitement/Dashbord_model');
    }
    public function nombre_eleve()
    {
         $result = $this->input->post('option');
         $data['result']=$result;
        $data['nom'] = $this->session->userdata('nomUtilisateur');
        $nbr = $this->Dashbord_model->compter();
        $nbr_enseignant = $this->Dashbord_model->compter_enseignant();
        $data['total_nombre'] = $nbr;
        $data['total_enseignant'] = $nbr_enseignant;
        $data['classe'] = $this->Dashbord_model->nombre_classe();
        $data['moyenne'] = $this->Dashbord_model->moyenne_eleve($result);
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('template/navbar_dashbord', $data);
        $this->load->view('traitement/ViewDashbord', $data);
        $this->load->view('template/footer');
    }

    // public function moyenne()
    // {
       
        
    //     if ($data) {
    //         $this->load->view('template/header');
    //         $this->load->view('template/sidebar');
    //         $this->load->view('template/navbar_dashbord', $data);
    //         $this->load->view('traitement/ViewDashbord', $data);
    //         $this->load->view('template/footer');
    //     }

    // }
}