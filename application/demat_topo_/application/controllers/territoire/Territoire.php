<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Territoire extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper("url");
        $this->load->helper("form");
        $this->load->model('territoire/Territoire_model', 'territoiremodel');
        $this->load->model('utils/Utils_model', 'utilsmodel');
    }

    public function import_territoire(){
        if ($this->input->method() == 'post' && isset($_FILES['import']['tmp_name'])) {
            $tmp_file = $_FILES['import']['tmp_name'];
            $file_type = $_FILES['import']['type'];
            $file_name = $_FILES['import']['name'];

            if ($file_type !== 'text/csv' && pathinfo($file_name, PATHINFO_EXTENSION) !== 'csv') {
                redirect('list_commune/1?error=Veuillez importer un fichier CSV valide.', 'refresh');
            }

            if ($this->territoiremodel->import_csv($tmp_file)) {
                redirect('list_commune/1?success=Importation avec success', 'refresh');
            } else {
                echo "Échec de l'importation.";
            }
        } else {
            redirect('list_commune/1?error=Aucune fichier trouver', 'refresh');
        }
    }

    // ----------------------COMMUNE-------------------------------
    public function get_data_commune(){
        if ($this->session->has_userdata('login')) {
            $page = (int) $this->input->get('page');
            $limit = (int) $this->input->get('limit');
            $search = $this->input->get('search');
            $offset = ($page - 1) * $limit;

            $data = $this->territoiremodel->get_paginated_data_commune($limit, $offset, $search);
            $total = $this->territoiremodel->get_total_rows_commune($search);

            echo json_encode([
                'data' => $data,
                'total' => $total
            ]);
        } else {
            redirect('login');
        }
    }

    public function list_commune($param = null){
        if ($this->session->has_userdata('login')) {
            $totalUsers = $this->territoiremodel->get_count_commune();
            $usersPerPage = 5;
            $limit = ($param * 5) - 5;
            $totalPages = ceil($totalUsers / $usersPerPage);
            $currentPage = $param;
            $data['linksBeforeAndAfter'] = 1;
            $data['startPage'] = max(1, $currentPage - $data['linksBeforeAndAfter']);
            $data['endPage'] = min($totalPages, $currentPage + $data['linksBeforeAndAfter']);
            $data['totalPages'] = $totalPages;
            $data['currentPage'] = $param;
            $data['list_commune'] = $this->territoiremodel->get_list_commune_pagination($usersPerPage, $limit);
            $data['message'] = $this->utilsmodel->message($this->input->get('success'), $this->input->get('error'));
            $data['commune_territoire'] = '';
            $data['fildariane'] = 'Commune';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('territoire/commune', $data);
            $this->load->view('templates/scripts');
        } else {
            redirect('login');
        }
    }

    public function add_commune(){
        if ($this->session->has_userdata('login')) {
            try {
                $data = array(
                    'codecommune' => $this->input->post('code'),
                    'nomcommune' => $this->input->post('nom_commune'),
                );

                $this->territoiremodel->insert_commune($data);
                redirect('list_commune/1?success=INSERTION AVEC SUCCESS', 'refresh');
            } catch (Exception $e) {
                redirect('list_commune/1?error=PROBLEME INSERTION', 'refresh');
            }
        } else {
            redirect('login');
        }
    }

    public function get_commune_by_id(){
        if ($this->session->has_userdata('login')) {
            try {
                $idcommune = $this->input->post('id');
                $data = $this->territoiremodel->get_commune_by_id($idcommune);

                echo json_encode($data);
            } catch (Exception $e) {
                redirect('list_commune/1?error=PROBLEME DE MODIFICATION', 'refresh');
            }
        } else {
            redirect('login');
        }
    }

    public function edit_commune($idcommune){
        if ($this->session->has_userdata('login')) {
            try {
                $data = array(
                    'idcommune' => $idcommune,
                    'codecommune' => $this->input->post('code'),
                    'nomcommune' => $this->input->post('nom_commune'),
                );

                $this->territoiremodel->update_commune_by_id($data);
                redirect('list_commune/1?success=MODIFICATION AVEC SUCCESS', 'refresh');
            } catch (Exception $e) {
                redirect('list_commune/1?error=PROBLEME INSERTION', 'refresh');
            }
        } else {
            redirect('login');
        }
    }

    // public function search_commune()
    // {
    //     if ($this->session->has_userdata('login')) {
    //         try {
    //             $data = $this->territoiremodel->search_commune($this->input->get('mots_cle'));

    //             echo json_encode($data);
    //         } catch (Exception $e) {
    //             redirect('list_commune/1?error=PROBLEME DE MODIFICATION', 'refresh');
    //         }
    //     } else {
    //         redirect('login');
    //     }
    // }

    //---------------------FOKONTANY-------------------------------

    public function get_data_fokontany(){
        if ($this->session->has_userdata('login')) {
            $page = (int) $this->input->get('page');
            $limit = (int) $this->input->get('limit');
            $search = $this->input->get('search');
            $offset = ($page - 1) * $limit;

            $data = $this->territoiremodel->get_paginated_data_fokontany($limit, $offset, $search);
            $total = $this->territoiremodel->get_total_rows_fokontany($search);

            echo json_encode([
                'data' => $data,
                'total' => $total
            ]);
        } else {
            redirect('login');
        }
    }
    
    public function list_fokontany($param = null){
        if ($this->session->has_userdata('login')) {
            $totalUsers = $this->territoiremodel->get_count_fokontany();
            $usersPerPage = 5;
            $limit = ($param * 5) - 5;
            $totalPages = ceil($totalUsers / $usersPerPage);
            $currentPage = $param;
            $data['linksBeforeAndAfter'] = 2;
            $data['startPage'] = max(1, $currentPage - $data['linksBeforeAndAfter']);
            $data['endPage'] = min($totalPages, $currentPage + $data['linksBeforeAndAfter']);
            $data['totalPages'] = $totalPages;
            $data['currentPage'] = $param;
            $data['list_fokontany'] = $this->territoiremodel->get_list_fokontany($usersPerPage, $limit);
            $data['list_commune'] = $this->territoiremodel->get_list_commune();
            $data['message'] = $this->utilsmodel->message($this->input->get('success'), $this->input->get('error'));
            $data['fokontany'] = '';
            $data['fildariane'] = 'Fokontany';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('territoire/fokontany', $data);
            $this->load->view('templates/scripts');
        } else {
            redirect('login');
        }
    }

    public function add_fokontany(){
        if ($this->session->has_userdata('login')) {
            try {
                $data = array(
                    'idcommune' => $this->input->post('id_commune'),
                    'nomfokontany' => $this->input->post('nom_fokontany'),
                );

                $this->territoiremodel->insert_fokontany($data);
                redirect('list_fokontany/1?success=INSERTION AVEC SUCCESS', 'refresh');
            } catch (Exception $e) {
                redirect('list_fokontany/1?error=PROBLEME INSERTION', 'refresh');
            }
        } else {
            redirect('login');
        }
    }

    public function get_fokontany_by_id(){
        if ($this->session->has_userdata('login')) {
            try {
                $idfokontany = $this->input->post('id');
                $data = $this->territoiremodel->get_fokontany_by_id($idfokontany);

                echo json_encode($data);
            } catch (Exception $e) {
                redirect('list_fokontany/1?error=PROBLEME DE MODIFICATION', 'refresh');
            }
        } else {
            redirect('login');
        }
    }

    public function edit_fokontany($idfokontany){
        if ($this->session->has_userdata('login')) {
            try {
                $data = array(
                    'idfokontany' => $idfokontany,
                    'idcommune' => $this->input->post('id_commune'),
                    'nomfokontany' => $this->input->post('nom_fokontany'),
                );

                $this->territoiremodel->update_fokontany_by_id($data);
                redirect('list_fokontany/1?success=MODIFICATION AVEC SUCCESS', 'refresh');
            } catch (Exception $e) {
                redirect('list_fokontany/1?error=PROBLEME INSERTION', 'refresh');
            }
        } else {
            redirect('login');
        }
    }

    // public function search_fokontany()
    // {
    //     if ($this->session->has_userdata('login')) {
    //         try {
    //             $data = $this->territoiremodel->search_fokontany($this->input->get('mots_cle'));

    //             echo json_encode($data);
    //         } catch (Exception $e) {
    //             redirect('list_commune/1?error=PROBLEME DE MODIFICATION', 'refresh');
    //         }
    //     } else {
    //         redirect('login');
    //     }
    // }

}