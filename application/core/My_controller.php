<?php
class MY_controller extends CI_Controller     
{
    //constructeur
   public function __construct()//no different pour chaque constructeur
    {
        parent::__construct();
        if(!$this->session->userdata('id_utilisateur')){
            redirect('Welcome/index');
        }
    }
}