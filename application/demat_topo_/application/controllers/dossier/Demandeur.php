<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Demandeur extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('dossier/Demandeur_model', 'demandeur_model');
        $this->load->model('utils/Utils_model', 'utilsmodel');
    }

    public function get_Data() //LISTE ET RECHERCHE DEMANDEUR AVEC PAGINATION
    {
        if ($this->session->has_userdata('login')) {
            $page = (int) $this->input->get('page');
            $limit = (int) $this->input->get('limit');
            $search = $this->input->get('search');
            $offset = ($page - 1) * $limit;

            $data = $this->demandeur_model->get_paginated_data($limit, $offset, $search);
            $total = $this->demandeur_model->get_total_rows($search);

            echo json_encode([
                'data' => $data,
                'total' => $total
            ]);
        } else {
            redirect('login');
        }
    }

    // public function list_demandeur($param = null)
    public function list_demandeur() //FONCTION POUR AFFICHER DEMANDEUR
    {
        if ($this->session->has_userdata('login')) {
            $data['message'] = $this->utilsmodel->message($this->input->get('success'), $this->input->get('error'));
            $data['usager'] = '';
            $data['fildariane'] = 'Demandeurs';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('dossier/liste_demandeur', $data);
            $this->load->view('templates/scripts');
        } else {
            redirect('login');
        }
    }

    public function new_demandeur()
    {
        if ($this->session->has_userdata('login')) {
            $message = NULL;

            try {
                $data_demandeur = array(
                    'nom' => xss_clean(trim($this->input->post('nom'))),
                    'prenoms' => xss_clean(trim($this->input->post('prenoms'))),
                    'adresse' => xss_clean(trim($this->input->post('adresse'))),
                    'cin' => xss_clean(trim($this->input->post('cin'))),
                    'datecin' => xss_clean(trim($this->input->post('date_cin'))),
                    'lieucin' => xss_clean(trim($this->input->post('lieu_cin'))),
                    'tel' => xss_clean(trim($this->input->post('tel'))),
                    'email' => xss_clean(trim($this->input->post('email')))
                );

                $data_demandeur = $this->demandeur_model->controller_check($data_demandeur);
                $message = $this->demandeur_model->insert_demandeur($data_demandeur);

                redirect('list_demandeur/1?success=' . $message, 'refresh');
            } catch (Exception $e) {
                $message = $e->getMessage();
                redirect('list_demandeur/1?error=' . $message, 'refresh');
            }
        } else {
            redirect('login');
        }
    }

    public function edit_demandeur($id = null)
    {
        if ($this->session->has_userdata('login')) {
            $result = $this->demandeur_model->get_demandeur_by_id($id);
            echo json_encode($result);
        } else {
            redirect('login');
        }
    }

    public function update_demandeur($id_demandeur = null)
    {
        if ($this->session->has_userdata('login')) {
            $message = NULL;

            try {
                $data_demandeur = array(
                    'id_demandeur' => xss_clean(trim($id_demandeur)),
                    'nom' => xss_clean(trim($this->input->post('nom'))),
                    'prenoms' => xss_clean(trim($this->input->post('prenoms'))),
                    'adresse' => xss_clean(trim($this->input->post('adresse'))),
                    'cin' => xss_clean(trim($this->input->post('cin'))),
                    'datecin' => xss_clean(trim($this->input->post('date_cin'))),
                    'lieucin' => xss_clean(trim($this->input->post('lieu_cin'))),
                    'tel' => xss_clean(trim($this->input->post('tel'))),
                    'email' => xss_clean(trim($this->input->post('email')))
                );

                $this->demandeur_model->controller_check($data_demandeur);
                $message = $this->demandeur_model->update_demandeur($data_demandeur);

                redirect('list_demandeur/1?success=' . $message, 'refresh');
            } catch (Exception $e) {
                $message = $e->getMessage();
                redirect('list_demandeur/1?error=' . $message, 'refresh');
            }
        } else {
            redirect('login');
        }
    }

    public function add_demandeur_json()
    {
        if ($this->session->has_userdata('login')) {
            $demandeur['nom'] = $this->input->post('nom');
            $demandeur['prenom'] = $this->input->post('prenom');
            $demandeur['adresse'] = $this->input->post('adresse');
            $demandeur['cin'] = $this->input->post('cin');
            $demandeur['date'] = $this->input->post('date');
            $demandeur['lieu_cin'] = $this->input->post('lieu_cin');
            $demandeur['tel'] = $this->input->post('tel');
            $demandeur['email'] = $this->input->post('email');

            $id = $this->demandeur_model->insert_demandeur($demandeur);
            echo json_encode(['id' => $id]);
        } else {
            redirect('login');
        }
    }

    public function update_demandeur_json()
    {
        if ($this->session->has_userdata('login')) {
            $data = json_decode(file_get_contents('php://input'), true);

            $data_demandeur = array(
                'id_demandeur' => xss_clean(trim($data[0])),
                'nom' => xss_clean(trim($data[1])),
                'prenoms' => xss_clean(trim($data[2])),
                'adresse' => xss_clean(trim($data[3])),
                'cin' => xss_clean(trim($data[4])),
                'datecin' => xss_clean(trim($data[5])),
                'lieucin' => xss_clean(trim($data[6])),
                'tel' => xss_clean(trim($data[7])),
                'email' => xss_clean(trim($data[8]))
            );
            $query = $this->demandeur_model->update_demandeur($data_demandeur);
        } else {
            redirect('login');
        }
    }

}