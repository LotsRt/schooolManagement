<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Parametres extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('parametre/Parametre_model', 'parametre_model');
        $this->load->model('parametre/Service_model', 'service_model');
        $this->load->model('utils/Utils_model', 'utilsmodel');
    }
    public function import_()
    {
        header('Content-Type: application/json'); // ← ajoute cette ligne absolument
    
        if (!empty($_FILES['excel_file']['name'])) {
            $filePath = $_FILES['excel_file']['tmp_name'];
    
            try {    
                $this->parametre_model->import_from_excel($filePath);
                echo json_encode(['status' => 'success', 'message' => 'Import avec succès']);
            } catch (Exception $e) {
                echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
            }
    
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Veuillez choisir votre fichier']);
        }
    }
    
    

    function get_Data_cir(){
        if ($this->session->has_userdata('login')) {
            $page = (int) $this->input->get('page');
            $limit = (int) $this->input->get('limit');
            $search = $this->input->get('search');
            $offset = ($page - 1) * $limit;

            $data = $this->parametre_model->get_paginated_data($limit, $offset, $search);
            $total = $this->parametre_model->get_total_rows($search);

            echo json_encode([
                'data' => $data,
                'total' => $total
            ]);
        } else {
            redirect('login');
        }
    }

    public function update_circonscription($id_cir = null){
        if ($this->session->has_userdata('login')) {
            $message = null;
            $data_cir = [
                'id' => xss_clean(trim($id_cir)),
                'code' => xss_clean(trim($this->input->post('code'))),
                'label' => xss_clean(trim($this->input->post('label'))),
                'id_service' => xss_clean(trim($this->input->post('id_service'))),
            ];

            $message = null;
            try {
                $message = $this->parametre_model->update_cir($data_cir);
                redirect('liste_circonscription/1?success=' . $message, 'refresh');
            } catch (Exception $e) {
                $message = $e->getMessage();
                redirect('liste_circonscription/1?error=' . $message, 'refresh');
            }
        } else {
            redirect('login');
        }
    }

    public function new_cir(){
        if ($this->session->has_userdata('login')) {
            $message = null;
            try {
                $message = $this->parametre_model->insert_cir();
                redirect('liste_circonscription/1?success=' . $message, 'refresh');
            } catch (Exception $e) {
                $message = $e->getMessage();
                redirect('liste_circonscription/1?error=' . $message, 'refresh');
            }
        } else {
            redirect('login');
        }
    }

    public function edit_circonscription($id = null){
        if ($this->session->has_userdata('login')) {
            $result = $this->parametre_model->get_cir_by_id($id);
            echo json_encode($result);
        } else {
            redirect('login');
        }
    }

    public function liste_circonscription($param = null)
    {
        if ($this->session->has_userdata('login')) {
            $total_traitement = $this->parametre_model->get_count();
            $listPerPage = 5;
            $limit = ($param * 5) - 5;
            $totalPages = ceil($total_traitement / $listPerPage);
            $currentPage = $param;
            $data['linksBeforeAndAfter'] = 2;
            $data['startPage'] = max(1, $currentPage - $data['linksBeforeAndAfter']);
            $data['endPage'] = min($totalPages, $currentPage + $data['linksBeforeAndAfter']);
            $data['totalPages'] = $totalPages;
            $data['currentPage'] = $param;
            $data['liste_cir'] = $this->parametre_model->liste_cir($listPerPage, $limit);
            $data['liste_service'] = $this->service_model->get_all();
            $data['message'] = $this->utilsmodel->message($this->input->get('success'), $this->input->get('error'));
            $data['parametre'] = '';
            $data['fildariane'] = 'Circonscription';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('parametre/parametre');
            $this->load->view('templates/scripts');
        } else {
            redirect('login');
        }
    }

    // public function search_list_cir($param = null)
    // {
    //     if ($this->session->has_userdata('login')) {
    //         $total_traitement = $this->parametre_model->get_count();
    //         $listPerPage = 5;
    //         $limit = ($param * 5) - 5;
    //         $result = $this->parametre_model->liste_cir($listPerPage, $limit);
    //         if ($result) {
    //             echo json_encode($result);
    //         }
    //     } else {
    //         redirect('login');
    //     }
    // }

    // public function search_cir($mots_cle)
    // {
    //     if ($this->session->has_userdata('login')) {
    //         $result = $this->parametre_model->find_cir($mots_cle);
    //         if ($result) {
    //             echo json_encode($result);
    //         }
    //     } else {
    //         redirect('login');
    //     }
    // }
}
