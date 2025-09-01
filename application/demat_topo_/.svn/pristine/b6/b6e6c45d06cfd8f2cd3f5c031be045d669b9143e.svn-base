<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->helper('security');
        $this->load->model('dossier/Dossier_model', 'dossier_model');
        $this->load->model('authentification/Groupe_model', 'groupe_model');
        $this->load->model('authentification/Utilisateur_model', 'utilisateur_model');
        $this->load->model('dashboard/Dashboard_model', 'dashboard_model');
        $this->load->model('dossier/Demandeur_model', 'demandeur_model');
        $this->load->model('traitement/Traitement_model', 'traitement_model');
    }

    // ------------------------valider-------------------------------
    public function view_dashboard()
    {
        if ($this->session->has_userdata('login')) {
            $data['etat'] = $this->dossier_model->get_etat_dossier($this->session->userdata('idutilisateur'));
            $data['etat_rapport'] = $this->dossier_model->get_etat_dossier_rapport_activite(1,1,date("Y"));
            $data['traitements'] = $this->traitement_model->get_all();

            $data['type_utilisateur'] = $this->groupe_model->list_group_inscri();

            $dossier = $this->dossier_model->get_list_dossier_delais_all_utilisateur();
            $data['stat_chart'] = $this->dashboard_model->trilliage($dossier);

            // pardefaut stat personne service
            $data['stat_user'] = $this->utilisateur_model->liste_statistique_utilisateur(date("Y"), 1, 1);

            $data['dashboard'] = '';
            $data['fildariane'] = "Tableau de bord";
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('dashboard/dashboard');
            $this->load->view('templates/scripts');
        } else {
            redirect('login');
        }
    }

    public function view_dashboard_dossier(){
        if ($this->session->has_userdata('login')) {
            $data['list_dossier'] = $this->dossier_model->get_list_dossier_delais_all_utilisateur();
            $data['suivi'] = '';
            $data['procedures'] = $this->dossier_model->get_proc_dossier(null);
            $data['traitements'] = $this->traitement_model->get_all();
            $data['fildariane'] = "Suivie dossier";
            $data['alldems'] = $this->demandeur_model->list_all_demandeur();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('dashboard/suivie_dossier');
            $this->load->view('templates/scripts');
        } else {
            redirect('login');
        }
    }

    public function dashboard_filtre_service()
    {
        $type = $this->input->post('type_utilisauter');
        $mois = $this->input->post('mois');
        $anne = $this->input->post('anne');

        $resultat = $this->utilisateur_model->liste_statistique_utilisateur($anne, $mois, $type);

        echo json_encode($resultat);
    }

    public function dashboard_filtre_rapport_activites()
    {
        $type = $this->input->post('idtraitement');
        $mois = $this->input->post('mois');
        $anne = $this->input->post('anne');

        $resultat = $this->dossier_model->get_etat_dossier_rapport_activite($type, $mois, $anne);

        echo json_encode($resultat);
    }
}