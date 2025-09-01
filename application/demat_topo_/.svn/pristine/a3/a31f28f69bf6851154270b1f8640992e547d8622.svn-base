<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Groupe extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->helper('security');
        $this->load->model('authentification/Groupe_model', 'groupemodel');
        $this->load->model('utils/Utils_model', 'utilsmodel');
    }

    function get_Data_type_user(){
        if ($this->session->has_userdata('login')) {
            $page = (int) $this->input->get('page');
            $limit = (int) $this->input->get('limit');
            $search = $this->input->get('search');
            $offset = ($page - 1) * $limit;

            $data = $this->groupemodel->get_paginated_data($limit, $offset, $search);
            $total = $this->groupemodel->get_total_rows($search);

            echo json_encode([
                'data' => $data,
                'total' => $total
            ]);
        } else {
            redirect('login');
        }
    }

    // public function search_liste_type_user($param)
    // {
    //     if ($this->session->has_userdata('login')) {
    //         $totalgroupemodel = $this->groupemodel->get_count();
    //         $usersPerPage = 5;
    //         $limit = ($param * 5) - 5;
    //         $result = $this->groupemodel->list_group($usersPerPage, $limit);
    //         if ($result) {
    //             echo json_encode($result);
    //         }
    //     } else {
    //         redirect('login');
    //     }
    // }

    // public function search_type_user($mots_cle)
    // {
    //     if ($this->session->has_userdata('login')) {
    //         $result = $this->groupemodel->find_type_user($mots_cle);
    //         if ($result) {
    //             echo json_encode($result);
    //         }
    //     } else {
    //         redirect('login');
    //     }
    // }

    public function update_group($idtypeuser = null){
        if ($this->session->has_userdata('login')) {
            $message = NULL;
            try {
                $message = $this->groupemodel->update_group($idtypeuser);
                redirect('list_group/1?success=' . $message, 'refresh');
            } catch (Exception $e) {
                $message = $e->getMessage();
                redirect('list_group/1?error=' . $message, 'refresh');
            }

        } else {
            redirect('login');
        }
    }

    public function edit_group($id = null){
        if ($this->session->has_userdata('login')) {
            $result = $this->groupemodel->get_group_by_id($id);
            if ($result) {
                echo json_encode($result);
            }
        } else {
            redirect('login');
        }
    }

    public function new_group(){
        if ($this->session->has_userdata('login')) {
            $message = NULL;
            try {
                $message = $this->groupemodel->insert_group();
                redirect('list_group/1?success=' . $message, 'refresh');
            } catch (Exception $e) {
                $message = $e->getMessage();
                redirect('list_group/1?error=' . $message, 'refresh');
            }
        } else {
            redirect('login');
        }
    }

    public function list_group($param){
        if ($this->session->has_userdata('login')) {
            $totalgroupemodel = $this->groupemodel->get_count();
            $usersPerPage = 5;
            $limit = ($param * 5) - 5;
            $totalPages = ceil($totalgroupemodel / $usersPerPage);
            $currentPage = $param;
            $data['linksBeforeAndAfter'] = 2;
            $data['startPage'] = max(1, $currentPage - $data['linksBeforeAndAfter']);
            $data['endPage'] = min($totalPages, $currentPage + $data['linksBeforeAndAfter']);
            $data['totalPages'] = $totalPages;
            $data['currentPage'] = $param;
            $data['list_type_utilisateur'] = $this->groupemodel->list_group($usersPerPage, $limit);
            $data['message'] = $this->utilsmodel->message($this->input->get('success'), $this->input->get('error'));
            $data['group'] = '';
            $data['fildariane'] = 'Type Utilisateur';

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('authentification/list_groupes', $data);
            $this->load->view('templates/scripts');
        } else {
            redirect('login');
        }
    }
}