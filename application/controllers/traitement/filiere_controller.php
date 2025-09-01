<?php
// defined('BASEPATH') or exit('No direct script access allowed');

class filiere_controller extends My_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('traitement/filiere_model');
    }

    public function show_filiere()
    {
        $donne_get = $this->filiere_model->geting();
        $data['filiere'] = $donne_get;
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('template/navbar');
        $this->load->view('traitement/filiere', $data);
        $this->load->view('template/footer');
    }
    // -------------------------------------------------------------------//
//pour cacher le id
    public function rediriger_eleve_par_filier($id)
    {
        $this->session->set_userdata('code_filier', $id);
        redirect('EleveF'); // pas de /id ici
        // $token=generate_token('id');
        // $url=site_url("EleveF?id={$id}&token={$token}");
        // redirect($url);
    }
    public function eleve_par_filiere()
    {
        $code_filier = $this->session->userdata('code_filier');
        if ($code_filier) {
            $donne_get = $this->filiere_model->eleve_par_filiere($code_filier);
            $data['eleve_filiere'] = $donne_get;
            $this->load->view('template/header');
            $this->load->view('template/sidebar');
            $this->load->view('template/navbar');
            $this->load->view('traitement/eleve_par_filiere', $data);
            $this->load->view('template/footer');
        }
    }

    // -------------------------------------------------------------------//
//pour cacher le id
    public function rediriger_matiere_eleve($id)
    {
        $this->session->set_userdata('code_filier', $id);
        redirect('EleveM'); // pas de /id ici
    }
    public function matiere_eleve()
    {
        $code_filier = $this->session->userdata('code_filier');
        if ($code_filier) {
            $donne_get = $this->filiere_model->recup_matiere($code_filier);
            $data['matiere'] = $donne_get;
            $this->load->view('template/header');
            $this->load->view('template/sidebar');
            $this->load->view('template/navbar');
            $this->load->view('traitement/matiere_eleve', $data);
            $this->load->view('template/footer');
        }
    }

    // -------------------------------------------------------------------//
    //pour cacher le id
    public function rediriger_note_eleve($id, $id1)
    {
        $this->session->set_userdata('code_matiere', $id);
        $this->session->set_userdata('code_filier', $id1);
        redirect('Note'); // pas de /id ici
    }
    public function note_eleve()
    {
        $code_matiere = $this->session->userdata('code_matiere');
        $code_filier = $this->session->userdata('code_filier');

        if ($code_matiere && $code_filier) {
            $donne_get = $this->filiere_model->recup_note($code_matiere, $code_filier);
            $data['note_eleve'] = $donne_get;
            $this->load->view('template/header');
            $this->load->view('template/sidebar');
            $this->load->view('template/navbar');
            $this->load->view('traitement/eleve_note', $data);
            $this->load->view('template/footer');
        }
    }
    public function ajout_filier()
    {
        $code_filier = $this->input->post('code_filier');
        $nom_filier = $this->input->post('nom_filier');
        $data = [
            'code_filier' => $code_filier,
            'nom_filier' => $nom_filier
        ];
        $check = $this->filiere_model->control($code_filier);
        if (!empty($check)) {
            echo json_encode([
                'status' => 'error',
                'message' => (" Filière déjà éxistant ")
            ]);
        } else {
            $result = $this->filiere_model->ajout($data);
            if ($result) {
                echo json_encode(
                    [
                        'status' => 'success',
                        'message' => (" $nom_filier  ajout avec succues ")
                    ]
                );
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => ("erreur lors de l' insertion ")
                ]);
            }
        }
    }
    public function ajout_Matiere()
    {
        $code_matiere = $this->input->post('code_matiere');
        $nom_matiere = $this->input->post('nom_matiere');
        $volume = $this->input->post('volume');
        $coefficient = $this->input->post('coefficient');
        $data = [
            'code_matiere' => $code_matiere,
            'nom_matiere' => $nom_matiere,
            'volume_horaire' => $volume,
            'coefficient' => $coefficient
        ];
        $verification = $this->filiere_model->check($code_matiere);
        if (!empty($verification)) {
            echo json_encode([
                'status' => 'error',
                'message' => (" matière déjà éxistant ")
            ]);
        } else {
            $data = $this->filiere_model->ajout_matiere($data);
            if ($data) {
                echo json_encode(
                    [
                        'status' => 'success',
                        'message' => (" $nom_matiere  ajout avec succues ")
                    ]
                );
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => ("erreur lors de l' insertion ")
                ]);
            }
        }
    }

    public function ajout_MatiereFiliere()
    {
        $code_filiere = $this->input->post('code_filier');
        $code_matiere = $this->input->post('code_matiere');
        $data = [
            'code_filier' => $code_filiere,
            'code_matiere' => $code_matiere
        ];
        $check = $this->filiere_model->controller($code_filiere, $code_matiere);
        if (!empty($check)) {
            echo json_encode(
                [
                    'status' => 'succes',
                    'message' => (" la relation existe déjà ")
                ]
            );
        } else {
            $result = $this->filiere_model->ajout_MatFi($data);
            if ($result) {
                echo json_encode(
                    [
                        'status' => 'success',
                        'message' => ("Ajout avec succues ")
                    ]
                );
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => ("erreur lors de l' insertion ")
                ]);
            }
        }

    }
}