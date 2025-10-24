<?php
// defined('BASEPATH') or exit('No direct script access allowed');

class traitement_controller extends My_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('traitement/Traitement_model');
    }

    // function d affichage
    public function view_ajout_eleve()
    {
        $data['filiere'] = $this->Traitement_model->recupere_filier();
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('template/navbar');
        $this->load->view('traitement/view_eleve', $data);
        $this->load->view('template/footer');
    }


    public function view_inscription()
    {
        $data['inscrit'] = $this->Traitement_model->recupere_eleve_inscrit();
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('template/navbar');
        $this->load->view('traitement/inscription', $data);
        $this->load->view('template/footer');
    }

    //utilisation de api dans traitement
    public function ajout_eleve()
    {
        $data = json_decode($this->input->raw_input_stream, true);

        if (empty($data['Matricule']) || !is_numeric($data['Matricule'])) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Matricule invalide ou vide'
            ]);
            return;
        }
        if (empty($data['Nom']) || empty($data['Prénom'])) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Nom et prenom obligatoire'
            ]);
            return;
        }

        $dataEleve = [
            'matricule' => $data['Matricule'],
            'nom' => $data['Nom'],
            'prenom' => $data['Prénom'] ?? '',
            'age' => $data['Age'] ?? null,
            'sexe' => $data['Sexe'] ?? '',
            'date_naissance' => $data['naissance'] ?? null,
            'pere' => $data['père'] ?? '',
            'mere' => $data['mère'] ?? '',
            'adresse' => $data['adresse'] ?? '',
            'code_filier' => $data['classe'] ?? '1'
        ];

        $check = $this->Traitement_model->check_base($data['Matricule']);
        if (!empty($check)) {
            echo json_encode([
                'status' => 'error',
                'message' => (" Etudiant déjà inscrit ")
            ]);
            return;
        }

        $add = $this->Traitement_model->ajout_eleve($dataEleve);
        if ($add) {
            echo json_encode([
                'status' => 'success',
                'message' => ("ajouté(e) avec succues "),
                'data' => $dataEleve
            ], JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => ('erreur lors de l insertion')
            ]);
        }
    }
    // -------------------------------------------------------------------//

    // fonction d ajout eleve
    // public function ajout_eleve()
    // {
    //     $Matricule = $this->input->post('Matricule');
    //     $Nom = $this->input->post('Nom');
    //     $Prénom = $this->input->post('Prénom');
    //     $Age = $this->input->post('Age');
    //     $Sexe = $this->input->post('Sexe');
    //     $naissance = $this->input->post('naissance');
    //     $père = $this->input->post('père');
    //     $mère = $this->input->post('mère');
    //     $adresse = $this->input->post('adresse');
    //     $classe = $this->input->post('classe');
    //     $date_inscription = $this->input->post('date_inscription');
    //     $anne = $this->input->post('anne');

    //     if (empty($Matricule) || !is_numeric($Matricule)) {
    //         echo json_encode([
    //             'status' => 'error',
    //             'message' => 'Matricule invalide ou vide'
    //         ]);
    //         return;
    //     }
    //     $data = [
    //         'matricule' => $Matricule,
    //         'nom' => $Nom,
    //         'prenom' => $Prénom,
    //         'age' => $Age,
    //         'sexe' => $Sexe,
    //         'date_naissance' => $naissance,
    //         'pere' => $père,
    //         'mere' => $mère,
    //         'adresse' => $adresse,
    //         'code_filier' => $classe
    //     ];

    //     $check = $this->Traitement_model->check_base($Matricule);
    //     if (!empty($check)) {
    //         echo json_encode([
    //             'status' => 'error',
    //             'message' => (" Etudiant déjà inscrit ")
    //         ]);
    //     } else {
    //         $add = $this->Traitement_model->ajout_eleve($data);
    //         if ($add) {
    //             echo json_encode([
    //                 'status' => 'success',
    //                 'message' => (" $Matricule  $Nom  $Prénom ajouté(e) avec succues ")
    //             ]);
    //         } else {
    //             echo json_encode([
    //                 'status' => 'error',
    //                 'message' => ('erreur lors de l insertion')
    //             ]);
    //         }
    //     }
    // }

    // -------------------------------------------------------------------//
    // fonction de recuperation d eleve avec nom de filiere
    public function get_eleve()
    {
        $data = $this->Traitement_model->get_eleve();
        echo json_encode(
            [
                'data' => $data
            ]
        );
    }


    public function getById_eleve()
    {
        $id = $this->input->post('id');
        $data = $this->Traitement_model->recuperParId($id);
        echo json_encode($data);
    }


    // -------------------------------------------------------------------//
    public function update_eleve($id)
    {
        $data = json_decode($this->input->raw_input_stream, true);

        $dataEleve = [
            'nom' => $data['Nom'],
            'prenom' => $data['Prénom'] ?? '',
            'age' => $data['Age'] ?? null,
            'sexe' => $data['Sexe'] ?? '',
            'date_naissance' => $data['naissance'] ?? null,
            'pere' => $data['père'] ?? '',
            'mere' => $data['mère'] ?? '',
            'adresse' => $data['adresse'] ?? '',
            'code_filier' => $data['classe'] ?? '1'
        ];

        $dataEleve['id_eleve'] = $id;
        $donne_modif = $this->Traitement_model->eleve_modif($dataEleve);
        if ($donne_modif) {
            echo json_encode(
                [
                    'status' => 'success',
                    'message' => ("modifié(e) avec succues "),
                    'data' => ['matricule' => $data['Matricule'], 'nom' => $data['Nom'], 'prenom' => $data['Prénom']]
                ],
                JSON_UNESCAPED_UNICODE
            );
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => ('erreur lors du modification ')
            ]);
        }
    }
    // -------------------------------------------------------------------//

    //     public function rediriger_detail_eleve($id)
// {
//     $this->load->helper('security');

    //     $token = generate_token($id); // helper qu’on a fait avant
//     $url = site_url("eleve/detail?id={$id}&token={$token}");
//     redirect($url);
// }

    // public function eleve_detail()
// {
//    $th is->load->helper('security');

    //     $id = $this->input->get('id');
//     $token = $this->input->get('token');

    //     if (!$id || !$token || !verify_token($id, $token)) {
//         show_error("Lien invalide ou falsifié", 403);
//         return;
//     }

    //     $donne_detail = $this->Traitement_model->recupere_detail($id);

    //     if ($donne_detail) {
//         $data['eleve'] = $donne_detail;
//         $this->load->view('template/header');
//         $this->load->view('template/sidebar');
//         $this->load->view('template/navbar');
//         $this->load->view('traitement/view_detail_eleve', $data);
//         $this->load->view('template/footer');
//     } else {
//         show_404();
//     }
// }

    //pour cacher le id
    public function rediriger_detail_eleve($id)
    {
        // $this->session->set_userdata('id_eleve_detail', $id);
        // redirect('eleveD'); // pas de /id ici
        $token = generate_token($id);
        $url = site_url("eleveD?id={$id}&token={$token}");
        redirect($url);
    }
    public function eleve_detail()
    {
        $id = $this->input->get('id');
        $token = $this->input->get('token');

        if (!$id || !$token || !verify_token($id, $token)) {
            show_error("Accès Interdite", 403);
            return;
        }
        $donne_detail = $this->Traitement_model->recupere_detail($id);
        if ($donne_detail) {
            $data['eleve'] = $donne_detail;
            $this->load->view('template/header');
            $this->load->view('template/sidebar');
            $this->load->view('template/navbar');
            $this->load->view('traitement/view_detail_eleve', $data);
            $this->load->view('template/footer');
        } else {
            show_404();
        }
    }

    // -------------------------------------------------------------------//
    public function Ajout_note()
    {
        $matricule = $this->input->post('Matricule');
        $code_filier = $this->input->post('code_filier');
        $code_matiere = $this->input->post('code_matiere');
        function convertir_note($valeur)
        {
            $valeur = str_replace(',', '.', $valeur);
            return ($valeur === '') ? null : $valeur;
        }
        $note = convertir_note($this->input->post('note'));

        // $somme_note=0;
        // foreach([$note1, $note2, $note3, $note4] as $note){
        //     $somme_note += ($note !== null) ? $note : 0; // ajouter 0 si vide
        // }


        // if(is_null($note1)&& is_null($note2) && is_null($note3) && is_null($note4)){
        //     $moyenne=0;
        //      $total=0;
        // }else{
        //     $moyenne=$somme_note/4;
        //     $total=$somme_note*$coefficient;
        // }

        $data = [
            'matricule' => $matricule,
            'code_filiere' => $code_filier,
            'code_matiere' => $code_matiere,
            'note' => $note
            // 'total'=>$total,
            // 'moyenne'=>$moyenne
        ];
        $donne_recu = $this->Traitement_model->ajout_note($data);
        if ($donne_recu) {
            echo json_encode([
                'status' => 'success',
                'message' => (" $matricule $note ajouté")
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => ('erreur lors de l insertion')
            ]);
        }
    }

    public function inscription_eleve()
    {
        $Matricule = $this->input->post('Matricule');
        $Nom = $this->input->post('Nom');
        $Prénom = $this->input->post('Prénom');
        $Age = $this->input->post('Age');
        $Sexe = $this->input->post('Sexe');
        $naissance = $this->input->post('naissance');
        $père = $this->input->post('père');
        $mère = $this->input->post('mère');
        $adresse = $this->input->post('adresse');
        $classe = $this->input->post('classe');
        $date_inscription = $this->input->post('date_inscription');
        $anne = $this->input->post('anne');
        $data = [
            'matricule' => $Matricule,
            'nom' => $Nom,
            'prenom' => $Prénom,
            'age' => $Age,
            'sexe' => $Sexe,
            'date_naissance' => $naissance,
            'pere' => $père,
            'mere' => $mère,
            'adresse' => $adresse,
            'code_filier' => $classe,
            'date_inscription' => $date_inscription,
            'anne' => $anne
        ];

        $ajout = $this->Traitement_model->inscrire($data);
        if ($ajout) {
            echo json_encode([
                'status' => 'success',
                'message' => (" $Matricule  $Nom  $Prénom  ajouté(e) avec succues ")
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => ('erreur lors de l insertion')
            ]);
        }
    }


    // -------------------------------------------------------------------//
    public function get_inscription()
    {
        $data = $this->Traitement_model->recupere_eleve_inscrit();
        echo json_encode(
            [
                'data' => $data
            ]
        );
    }

    // -------------------------------------------------------------------//
    public function getById_inscription()
    {
        $id = $this->input->post('id');
        $data = $this->Traitement_model->recuperParId_inscrit($id);
        echo json_encode($data);
    }



    public function getApi_eleve()
    {
        $eleve = $this->Traitement_model->recupere();
        if ($eleve) {
            echo json_encode([
                'status' => 'success',
                'data' => $eleve
            ], JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode([
                'status' => 'error'
            ]);
        }
    }
    public function getEleve()
    {
        $donne = json_decode($this->input->raw_input_stream, true);
        $result = $donne['query'];
        $solution = $this->Traitement_model->rechercheEleve($result);
        echo json_encode($solution);
    }
}
//test
