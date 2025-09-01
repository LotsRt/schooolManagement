<?php
// defined('BASEPATH') or exit('No direct script access allowed');

class Enseignant_controller extends My_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('traitement/Enseignant_model');
    }

    public function load_enseignant()
    {
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('template/navbar');
        $this->load->view('traitement/view_enseignant');
        $this->load->view('template/footer');
    }

    // -------------------------------------------------------------------//

    public function ajout_enseignant()
    {
        $Matricule = $this->input->post('Matricule');
        $Nom = $this->input->post('Nom');
        $Prénom = $this->input->post('Prénom');
        $code_matiere = $this->input->post('code_matiere');
        $code_enseignant = $this->input->post('code_enseignant');
        $code_filiere = $this->input->post('code_filiere');
        $Sexe = $this->input->post('Sexe');
        $recrutement = $this->input->post('recrutement');
        $telephone = $this->input->post('telephone');
        $adresse = $this->input->post('adresse');
        $email = $this->input->post('email');
        $status = $this->input->post('status');
        $grade = $this->input->post('grade');
        $date_naissance = $this->input->post('date_naissance');

        $data = [
            'matricule' => $Matricule,
            'nom' => $Nom,
            'prenom' => $Prénom,
            'code_matiere' => $code_matiere,
            'code_enseignant' => $code_enseignant,
            'code_filiere' => $code_filiere,
            'sexe' => $Sexe,
            'date_recrutement' => $recrutement,
            'telephone' => $telephone,
            'adresse' => $adresse,
            'email' => $email,
            'statut' => $status,
            'grade' => $grade,
            'date_naissance' => $date_naissance
        ];
        $check_enseignant = $this->Enseignant_model->check_base($Matricule, $code_enseignant);
        if (!empty($check_enseignant)) {
            echo json_encode([
                'status' => 'error',
                'message' => ('votre saisie éxiste déjà!')
            ]);
        } else {
            $donne_recus = $this->Enseignant_model->enseignant_insert($data);
            if ($donne_recus) {
                echo json_encode(
                    [
                        'status' => 'success',
                        'message' => (" $Matricule  $Nom  $Prénom ajouté(e) avec succues ")
                    ]
                );
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => ('erreur lors de l insertion')
                ]);
            }
        }
    }

    // -------------------------------------------------------------------//
    public function recuperer()
    {
        $data = $this->Enseignant_model->recupere_donne();
        echo json_encode(
            [
                'data' => $data
            ]
        );
    }

    public function getById()
    {
        $id = $this->input->post('id');
        $data = $this->Enseignant_model->recuperParId($id);
        echo json_encode($data);
    }



    // -------------------------------------------------------------------//

    public function update_enseignant()
    {
        $id_enseignant = $this->input->post('id_enseignant');
        $Matricule = $this->input->post('Matricule');
        $Nom = $this->input->post('Nom');
        $Prénom = $this->input->post('Prénom');
        $code_matiere = $this->input->post('code_matiere');
        $code_enseignant = $this->input->post('code_enseignant');
        $code_filiere = $this->input->post('code_filiere');
        $Sexe = $this->input->post('Sexe');
        $recrutement = $this->input->post('recrutement');
        $telephone = $this->input->post('telephone');
        $adresse = $this->input->post('adresse');
        $email = $this->input->post('email');
        $status = $this->input->post('status');
        $grade = $this->input->post('grade');
        $date_naissance = $this->input->post('date_naissance');

        $data = [
            'matricule' => $Matricule,
            'nom' => $Nom,
            'prenom' => $Prénom,
            'code_matiere' => $code_matiere,
            'code_enseignant' => $code_enseignant,
            'code_filiere' => $code_filiere,
            'sexe' => $Sexe,
            'date_recrutement' => $recrutement,
            'telephone' => $telephone,
            'adresse' => $adresse,
            'email' => $email,
            'statut' => $status,
            'grade' => $grade,
            'date_naissance' => $date_naissance
        ];
        $data['id_enseignant'] = $id_enseignant;
        $donne_modif = $this->Enseignant_model->enseignant_modif($data);
        if ($donne_modif) {
            echo json_encode(
                [
                    'status' => 'success',
                    'message' => (" $Matricule  $Nom  $Prénom  modifié(e) avec succues ")
                ]
            );
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => ('erreur lors du modification ')
            ]);
        }
    }
    // -------------------------------------------------------------------//

    //pour cacher le id
    public function rediriger_detail_enseignant($id)
    {
        // $this->session->set_userdata('id_enseignant_detail', $id);
        // redirect('detail'); // pas de /id ici
        $token = generate_token($id);
        $url = site_url("detail?id={$id}&token={$token}");
        redirect($url);
    }
    public function enseignant_detail()
    {
        $id = $this->input->get('id');
        $token = $this->input->get('token');
        if (!$id || !$token || !verify_token($id, $token)) {
            show_404();
            return;
        }
        $donne_detail = $this->Enseignant_model->recupere_detail($id);
        if ($donne_detail) {
            $data['enseignant'] = $donne_detail;
            $this->load->view('template/header');
            $this->load->view('template/sidebar');
            $this->load->view('template/navbar');
            $this->load->view('traitement/view_detail', $data);
            $this->load->view('template/footer');
        } else {
            show_404();
        }
    }
}