<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Procedure extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('traitement/Procedure_model', 'procedure_model');
        $this->load->model('utils/Utils_model', 'utilsmodel');
    }

    public function get_data_procedure(){
        if ($this->session->has_userdata('login')) {
            $page = (int) $this->input->get('page');
            $limit = (int) $this->input->get('limit');
            $search = $this->input->get('search');
            $offset = ($page - 1) * $limit;

            $data = $this->procedure_model->get_paginated_data($limit, $offset, $search);
            $total = $this->procedure_model->get_total_rows($search);

            echo json_encode([
                'data' => $data,
                'total' => $total
            ]);
        } else {
            redirect('login');
        }
    }

    // public function list_procedure($param = null)
    public function list_procedure(){
        if ($this->session->has_userdata('login')) {
            $data['message'] = $this->utilsmodel->message($this->input->get('success'), $this->input->get('error'));
            $data['procedure'] = '';
            $data['fildariane'] = 'Procédure';

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('traitement/list_procedure');
            $this->load->view('templates/scripts');
        } else {
            redirect('login');
        }
    }

    public function new_procedure(){
        if ($this->session->has_userdata('login')) {
            $data['labelproc'] = xss_clean(trim($this->input->post('labelproc')));
            $data['delai'] = xss_clean(trim($this->input->post('delai')));

            try {
                $message = $this->procedure_model->insert_procedure($data);
                redirect('list_procedure/1?success=' . $message, 'refresh');
            } catch (Exception $e) {
                $message = $e->getMessage();
                redirect('list_procedure/1?error=' . $message, 'refresh');
            }
        } else {
            redirect('login');
        }
    }

    public function edit_procedure($id = null){
        if ($this->session->has_userdata('login')) {
            $result = $this->procedure_model->get_procedure_by_id($id);
            if ($result) {
                echo json_encode($result);
            }
        } else {
            redirect('login');
        }
    }

    public function update_procedure($idproc = null){
        if ($this->session->has_userdata('login')) {
            $message = NULL;
            try {
                $message = $this->procedure_model->update_procedure($idproc);
                redirect('list_procedure/1?success=' . $message, 'refresh');
            } catch (Exception $e) {
                $message = $e->getMessage();
                redirect('list_procedure/1?error=' . $message, 'refresh');
            }
        } else {
            redirect('login');
        }
    }

    public function all_procedure(){
        if ($this->session->has_userdata('login')) {
            $result = $this->procedure_model->findALL();
            if ($result) {
                echo json_encode($result);
            }
        } else {
            redirect('login');
        }
    }

    // public function search_procedure($mots_cle)
    // {
    //     if ($this->session->has_userdata('login')) {
    //         $result = $this->procedure_model->find_procedure($mots_cle);
    //         if ($result) {
    //             echo json_encode($result);
    //         }
    //     } else {
    //         redirect('login');
    //     }
    // }

    // public function search_list_procedure($param = null)
    // {
    //     if ($this->session->has_userdata('login')) {
    //         $listPerPage = 5;
    //         $limit = ($param * 5) - 5;
    //         $result = $this->procedure_model->list_procedure($listPerPage, $limit);
    //         if ($result) {
    //             echo json_encode($result);
    //         }
    //     } else {
    //         redirect('login');
    //     }
    // }
}