<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Controlle extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('login/Authentification_model');
        $this->load->model('traitement/Dashbord_model');

    }
    
    public function Add_utilisateur()
    {
        $nomUtilisateur = $this->input->post('nomUtilisateur');
        $prenom = $this->input->post('prenom');
        $role = $this->input->post('role');
        $pass = $this->input->post('pass');
        $hashed_password = password_hash($pass, PASSWORD_DEFAULT);
        $data =
            [
                'nomUtilisateur' => $nomUtilisateur,
                'prenom' => $prenom,
                'role' => $role,
                'password' => $hashed_password
            ];

        $result = $this->Authentification_model->ajouter($data);
        if ($result) {
            echo json_encode([
                'status' => 'success',
                'message' => ("$nomUtilisateur  $prenom $role inserer avec succues "),
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => ('erreur lors de envoye')
            ]);
        }
    }

    public function affiche_login()
    {
        $this->load->view('authentification/login');
    }

    public function view_utilisateur()
    {
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('template/navbar');
        $this->load->view('authentification/view_utilisateur');
        $this->load->view('template/footer');

    }

    public function recuperer()
    {
        $data = $this->Authentification_model->get_util();
        echo json_encode([
            'data' => $data
        ]);
    }


    public function check_mdp()
{
    if ($this->input->post()) {
        $nom = trim($this->input->post('username', true));
        $mot = trim($this->input->post('password', true));

        if (!empty($nom) && !empty($mot)) {
            $utilisateur = $this->Authentification_model->authentifier($nom, $mot);
            if ($utilisateur) {
                $this->session->set_userdata([
                    'id_utilisateur' => $utilisateur->id_utilisateur,
                    'nomUtilisateur' => $utilisateur->nomUtilisateur,
                    'role' => $utilisateur->role
                ]);
                $this->session->set_flashdata('succes', "✅ Bonjour <strong>$nom</strong> !");
                redirect('Bord');
            } else {
                $this->session->set_flashdata('error', "❌ Identifiant ou mot de passe incorrect.");
                redirect('Login');
            }
        } else {
            $this->session->set_flashdata('error', "❌ Veuillez remplir tous les champs.");
            redirect('Login');
        }
    } else {
        $this->session->set_flashdata('error', "❌ Veuillez réessayer.");
        redirect('Login');
    }
}

    //-----------------------------------------------------------------------------
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('Login');
    }
}

