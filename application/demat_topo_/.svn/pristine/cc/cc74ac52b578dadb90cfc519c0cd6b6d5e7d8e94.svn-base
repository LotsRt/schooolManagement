<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Utilisateur extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->helper('security');
        $this->load->model('/authentification/Utilisateur_model', 'usermodel');
    }

    public function get_data_user(){
        if ($this->session->has_userdata('login')) {
            $page = (int) $this->input->get('page');
            $limit = (int) $this->input->get('limit');
            $search = $this->input->get('search');
            $offset = ($page - 1) * $limit;

            $data = $this->usermodel->get_paginated_data($limit, $offset, $search);
            $total = $this->usermodel->get_total_rows($search);

            echo json_encode([
                'data' => $data,
                'total' => $total
            ]);
        } else {
            redirect('login');
        }
    }

    public function login(){
        if (!$this->session->has_userdata('login')) {
            $this->load->view('authentification/login');
        } else {
            redirect('dashboard');
        }
    }

    public function list_utilisateur($param = null){
        if ($this->session->has_userdata('login')) {
            $totalUsers = $this->usermodel->get_count();
            $usersPerPage = 5;
            $limit = ($param * 5) - 5;
            $totalPages = ceil($totalUsers / $usersPerPage);
            $currentPage = $param;
            $data['linksBeforeAndAfter'] = 2;
            $data['startPage'] = max(1, $currentPage - $data['linksBeforeAndAfter']);
            $data['endPage'] = min($totalPages, $currentPage + $data['linksBeforeAndAfter']);
            $data['totalPages'] = $totalPages;
            $data['currentPage'] = $param;
            $data['list_utilisateur'] = $this->usermodel->get_user($usersPerPage, $limit);
            $data['list_type_user'] = $this->usermodel->list_type();
            $data['list_circoscription'] = $this->usermodel->list_circ();
            $data['user'] = '';
            $data['fildariane'] = 'Utilisateur';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('authentification/list_utilisateur', $data);
            $this->load->view('templates/scripts');
        } else {
            redirect('login');
        }
    }

    public function search_users($mots_cle){
        if ($this->session->has_userdata('login')) {
            $result = $this->usermodel->find_user($mots_cle);
            if ($result) {
                echo json_encode($result);
            }
        } else {
            redirect('login');
        }
    }

    public function add_user($param = null){
        if ($this->session->has_userdata('login')) {
            $login = $this->input->post('login');
            $nbr = $this->usermodel->get_login($login);

            if ($nbr > 0) {
                $this->session->set_flashdata('login_exists', true);
                redirect('list_user/1');
            } else {
                $data['nom'] = $this->input->post('nom');
                $data['prenoms'] = $this->input->post('prenoms');
                $data['login'] = $this->input->post('login');
                $data['password'] = $this->input->post('password');
                $data['id_circonscription'] = $this->input->post('id_circonscription');
                $data['id_type_user'] = $this->input->post('id_type_user');
                $data['tel'] = $this->input->post('tel');
                $data['mail'] = $this->input->post('mail');
                $data['cin'] = $this->input->post('cin');
                $data['mail'] = $this->input->post('mail');
                $data['photo'] = $_FILES['photo']['name'];
                $id_utilisateur = $this->usermodel->new_user($data);

                if (isset($_FILES['photo'])) {
                    $chemin_specifique = 'C:/wamp64/www/demat_topo_/assets/image/' . $id_utilisateur[0]->idutilisateur;
                    $chemin_specifique = getcwd() . DIRECTORY_SEPARATOR . '/assets/image/' . $id_utilisateur[0]->idutilisateur;

                    if (!is_dir($chemin_specifique)) {
                        if (mkdir($chemin_specifique, 0755, true)) {
                            echo "Le dossier '$chemin_specifique' a été créé avec succès.";
                        } else {
                            echo "Erreur lors de la création du dossier '$chemin_specifique'.";
                        }
                    } else {
                        echo "Le dossier '$chemin_specifique' existe déjà.";
                    }

                    $fichier = $chemin_specifique . DIRECTORY_SEPARATOR . '' . $_FILES['photo']['name'];
                    $uploaded_file = $_FILES['photo']['tmp_name'];

                    if (move_uploaded_file($uploaded_file, $fichier)) {
                        $data['photo'] = $_FILES['photo']['name'];
                    } else {
                        echo "Error moving ---- file.";
                    }
                }

                redirect('list_user/1', 'refresh');
            }
        } else {
            redirect('login');
        }
    }

    public function change_state_signup($state = 0, $id = null){
        if ($this->session->has_userdata('login')) {
            $query = $this->usermodel->validate_sign_up($state, $id);
            redirect('list_user/1', 'refresh');
        } else {
            redirect('login');
        }
    }

    public function check_login(){
        $res = $this->usermodel->get_elt_for_login();
        $data = [];
        if (empty($res)) {
            $data['info'] = 'Le mot de passe ou le login est incorrecte... Veuillez vérifier SVP!';
            $this->load->view('authentification/login', $data);
        } else {
            if ($res->valide == 0) {
                $data['info'] = "Votre compte n'a pas encore été activé ou a été désactivé par l'administrateur.";
                $this->load->view('authentification/login', $data);
            } else {
                $this->session->set_userdata('idutilisateur', $res->idutilisateur);
                $this->session->set_userdata('labeltype', $res->labeltype);
                $this->session->set_userdata('login', $res->login);
                $this->session->set_userdata('groupe', $res->labeltype);
                $this->session->set_userdata('idtypeuser', $res->idtypeuser);
                $this->session->set_userdata('nom', $res->nom);
                $this->session->set_userdata('prenom', $res->prenoms);
                $this->session->set_userdata('id_circonscription', $res->id_circonscription);
                $this->session->set_userdata('labelcirconscription', $res->label);
                redirect('dashboard', 'refresh');
            }
        }
    }

    public function search_list_user($param = null){
        if ($this->session->has_userdata('login')) {
            $totalUsers = $this->usermodel->get_count();
            $usersPerPage = 5;
            $limit = ($param * 5) - 5;
            $totalPages = ceil($totalUsers / $usersPerPage);
            $currentPage = $param;
            $result = $this->usermodel->get_user($usersPerPage, $limit);
            if ($result) {
                echo json_encode($result);
            }
        } else {
            redirect('login');
        }
    }

    public function profil(){
        if ($this->session->has_userdata('login')) {
            $userId = $this->session->userdata('idutilisateur');
            $data['profile_user'] = $this->usermodel->get_elmt_by_id($userId);
            $data['profile'] = '';
            $data['fildariane'] = 'Mon Profile';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('profile/profile');
            $this->load->view('templates/scripts');
        } else {
            redirect('login');
        }
    }

    public function edit_utilisateur(){
        if ($this->session->has_userdata('login')) {
            $data_json = json_decode(file_get_contents('php://input'), true);
            try {
                $data = [
                    'idutilisateur' => xss_clean(trim($data_json['idutilisateur'])),
                    'nom' => xss_clean(trim($data_json['nom'])),
                    'prenom' => xss_clean(trim($data_json['prenoms'])),
                    'cin' => xss_clean(trim($data_json['cin'])),
                    'tel' => xss_clean(trim($data_json['tel'])),
                    'mail' => xss_clean(trim($data_json['mail'])),
                ];

                $this->usermodel->update_utilisateur_by_id($data);
                $message = 'Modification Profile éffectuer avec success!';
                echo json_encode(['status' => 'success', 'message' => $message]);
            } catch (Exception $e) {
                echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
            }
        } else {
            redirect('login');
        }
    }

    public function deconnexion(){
        if ($this->session->has_userdata('login')) {
            $this->session->sess_destroy();
            redirect('login', 'refresh');
        } else {
            redirect('login');
        }
    }
}