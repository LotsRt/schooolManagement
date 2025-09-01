<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Traitement extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('traitement/Traitement_model', 'traitement_model');
        $this->load->model('dossier/Dossier_model', 'dossier_model');
        $this->load->model('traitement/Procedure_model', 'procedure_model');
        $this->load->model('utils/Utils_model', 'utilsmodel');
    }

    // public function list_traitement($param = null)
   public function list_traitement() {
        if ($this->session->has_userdata('login')) {
            $data['message'] = $this->utilsmodel->message($this->input->get('success'), $this->input->get('error'));
            $data['list_procedures'] = $this->procedure_model->findALL();
            $data['traitement'] = '';
            $data['fildariane'] = 'Traitement';

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('traitement/list_traitement');
            $this->load->view('templates/scripts');
        } else {
            redirect('login');
        }
    }

    public function new_type_traitement(){
        if ($this->session->has_userdata('login')) {
            $result = $this->traitement_model->insert_traitement();
            if ($result) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Erreur lors de l\'insertion des données.']);
            }
        } else {
            redirect('login');
        }
    }

    public function get_data_traitement(){
        if ($this->session->has_userdata('login')) {
            $page = (int) $this->input->get('page');
            $limit = (int) $this->input->get('limit');
            $search = $this->input->get('search');
            $offset = ($page - 1) * $limit;

            $data = $this->traitement_model->get_paginated_data($limit, $offset, $search);
            $total = $this->traitement_model->get_total_rows($search);

            echo json_encode([
                'data' => $data,
                'total' => $total
            ]);
        } else {
            redirect('login');
        }
    }
 
    public function edit_type_traitement($idtraitement = null){
        if ($this->session->has_userdata('login')) {
            $result = $this->traitement_model->get_type_traitement_by_id($idtraitement);
            echo json_encode($result);
        } else {
            redirect('login');
        }
    }
    
    public function get_info_traitement(){
        if ($this->session->has_userdata('login')) {
            $iddossier = $this->input->get('iddossier');
            $dossier = $this->dossier_model->get_RTX_by_id($iddossier);
            $idtraitement = $dossier[0]->id_typetraitement;
            $result = $this->traitement_model->get_type_traitement_by_idtraitement($idtraitement);
            echo json_encode($result);
        } else {
            redirect('login');
        }
    }
    
    public function update_type_traitement($idtraitement = null){
        if ($this->session->has_userdata('login')) {
            $result = $this->traitement_model->update_traitement($idtraitement);
            if ($result) {
                echo json_encode(['success' => true, 'message' => 'Modification reussi avec success']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Erreur lors de l\'insertion des données.']);
            }
        } else {
            redirect('login');
        }
    }

    // ----------------Fonction Tsy miasa--------------------------------

    /*public function search_type_traitement($mots_cle)
    {
        if ($this->session->has_userdata('login')) {
            $result = $this->traitement_model->find_type_traitement($mots_cle);
            if ($result) {
                echo json_encode($result);
            }
        } else {
            redirect('login');
        }
    }
    
    public function search_list_traitement($param = null)
    {
            if ($this->session->has_userdata('login')) {
            $total_traitement = $this->traitement_model->get_count();
            $listPerPage = 5;
            $limit = ($param * 5) - 5;
            $totalPages = ceil($total_traitement / $listPerPage);
            $currentPage = $param;
            $result = $this->traitement_model->list_traitement($listPerPage, $limit);
            if ($result) {
                echo json_encode($result);
            }
        } else {
            redirect('login');
        }
    }*/

}