<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dossier extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('dossier/Dossier_model', 'dossier_model');
        $this->load->model('dossier/Demandeur_model', 'demandeur_model');
        $this->load->model('parametre/Parametre_model', 'parametre_model');
        $this->load->model('traitement/Traitement_model', 'traitement_model');
        $this->load->model('utils/Utils_model', 'utilsmodel');
        $this->load->model('authentification/Utilisateur_model', 'user_model');
        $this->load->model('pdf/Htmltopdf_model', 'Htmltopdf_model');
        $this->load->model('archive/Archive_model', 'archive_model');
        $this->load->model('utils/Polygone_model', 'polygone_model');
        $this->load->model('utils/Email_model', 'emailmodel');
        $this->load->model('authentification/Utilisateur_model', 'utilisateurmodel');
    }

    // ------------Valider -------------
    public function update_req_dossier()
    {
        if ($this->session->has_userdata('login')) {
            $data['iddossier'] = $this->input->post('iddossier');
            $data['iddemandeur'] = $this->input->post('iddemandeur');
            $this->dossier_model->update_req_dossier($data);
            echo json_encode(['status' => 'success']);
        } else {
            redirect('login');
        }
    }
    public function update_details_dossier()
    {
        if ($this->session->has_userdata('login')) {
            $data['iddossier'] = $this->input->post('iddossier');
            $data['nom_propriete'] = $this->input->post('nom_propriete');
            $data['num_requisition'] = $this->input->post('num_requisition');
            $data['origine'] = $this->input->post('origine');
            $data['en_cause'] = $this->input->post('en_cause');
            $data['id_commune'] = $this->input->post('id_commune');
            $data['id_fkt'] = $this->input->post('id_fkt');
            $data['lieu_dit_dossier'] = $this->input->post('lieu_dit_dossier');
            $this->dossier_model->update_details_dossier($data);
            echo json_encode(['status' => 'success']);
        } else {
            redirect('login');
        }
    }
    public function get_commune_details_dossier()
    {
        if ($this->session->has_userdata('login')) {
            $commune = $this->parametre_model->list_commune();
            echo json_encode(['all_commune' => $commune]);
        } else {
            redirect('login');
        }
    }
    public function get_details_dossier()
    {
        if ($this->session->has_userdata('login')) {
            $id = $this->input->post("iddossier");
            $dossier = $this->dossier_model->get_details_dossier_by_id($id);
            $demandeur = $this->dossier_model->get_demandeur_dossier_by_id($id);
            echo json_encode(['dossier' => $dossier, 'demandeur_dossier' => $demandeur]);
        } else {
            redirect('login');
        }
    }

    public function send_dossier()
    {
        if ($this->session->has_userdata('login')) {
            $query = $this->dossier_model->send_dossier();
            $id_receiver = xss_clean($this->input->post('id_user'));
            $receiver = $this->dossier_model->get_Util_receiver($id_receiver);

            // $iddossier = xss_clean($this->input->post('iddossier'));
            // $dossier = $this->dossier_model->info_dossier($iddossier);

            // //envoie de mail debut
            // $dossier = $this->dossier_model->info_dossier($iddossier);
            // if (isset($dossier->email)) {
            //     $this->emailmodel->send_Email($dossier->nom, $dossier->email, $dossier->labeltraitement, $dossier->labelproc, $dossier->rtx, $dossier->dateentree);
            // }
            // //envoie de mail fin

            $message = urlencode('Dossier Transférer à ' . $receiver);
            redirect('list_dossier/1?success=' . $message, 'refresh');
            if ($query) {
                redirect('list_dossier/1', 'refresh');
            }
        } else {
            redirect('login');
        }
    }

    public function add_dossier($param = null)
    {
        if ($this->session->has_userdata('login')) {
            $data['id_typetraitement'] = $this->input->post('id_typetraitement');
            $data['dateentree'] = $this->input->post('dateentree');
            $data['id_demandeur'] = $this->input->post('id_demandeur');
            $data['id_current_user'] = $this->session->userdata('idutilisateur');
            $data['idtypeuser_current_user'] = $this->session->userdata('idtypeuser');
            $data['lieudit'] = $this->input->post('lieudit');
            $data['fkt'] = $this->input->post('fkt');
            $data['num_req'] = $this->input->post('num_req');
            $data['is_transfert_active'] = $this->input->post('etat_transfert');
            $data['commune'] = $this->input->post('commune');
            $data['numero_origine'] = strtoupper($this->input->post('num_origine')); // ← pas de str_replace
            $data['id_type_origine'] = $this->input->post('id_origine');

            // en_cause_id : NULL si vide
            $en_cause_id = $this->input->post('en_cause_id');
            $data['en_cause_id'] = (!empty($en_cause_id)) ? $en_cause_id : null;

            // num_en_cause : tu veux garder tel quel, donc pas de traitement
            $data['num_en_cause'] = strtoupper($this->input->post('num_en_cause'));

            // nom : mettre NULL si vide
            $nom_en_cause = $this->input->post('nom');
            $data['nom'] = (!empty($nom_en_cause)) ? $nom_en_cause : null;

            try {
                // TRAITEMENT STANDARD d'insertion de dossier
                $iddossier = $this->dossier_model->new_dossier($data);
                $this->demandeur_model->insert_usage_for_dossier($iddossier, $this->input->post('id_demandeur'));

                if ($data['is_transfert_active'] == null) {
                    echo " active transfert null";

                } else {
                    $query = $this->dossier_model->send_dossier($iddossier);
                    $id_receiver = xss_clean($this->input->post('id_user'));
                    $receiver = $this->dossier_model->get_Util_receiver($id_receiver);
                    $message = urlencode('Dossier Transférer à ' . $receiver);
                    redirect('list_dossier/1?success=' . $message, 'refresh');
                }
                redirect('list_dossier/1?success=INSERTION AVEC SUCCESS', 'refresh');
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        } else {
            redirect('login');
        }
    }


    // public function list_dossier($param)
    // {
        
    //     if ($this->session->has_userdata('login')) {
    //         $id_current_user = $this->session->userdata('idutilisateur');
    //         $totaldossier = $this->dossier_model->get_count($id_current_user);
    //         $usersPerPage = 5;
    //         $limit = ($param * 5) - 5;
    //         $totalPages = ceil($totaldossier / $usersPerPage);
    //         $currentPage = $param;

    //         $data['linksBeforeAndAfter'] = 2;
    //         $data['startPage'] = max(1, $currentPage - $data['linksBeforeAndAfter']);
    //         $data['endPage'] = min($totalPages, $currentPage + $data['linksBeforeAndAfter']);
    //         $data['totalPages'] = $totalPages;
    //         $data['currentPage'] = $param;
    //         $data['dossiers'] = $this->dossier_model->list_dossier_current_user($id_current_user, $usersPerPage, $limit);
    //         $data['types_traitement'] = $this->traitement_model->get_all();
    //         $data['demandeurs'] = $this->demandeur_model->list_demandeur(9, 0);
    //         $data['total_demandeur'] = $this->demandeur_model->get_count();
    //         $data['alldems'] = $this->demandeur_model->list_all_demandeur();
    //         $data['commune'] = $this->parametre_model->list_commune();
    //         $data['message'] = $this->utilsmodel->message($this->input->get('success'), $this->input->get('error'));
    //         $data['list_origin'] = $this->dossier_model->get_all_origine();
    //         $data['list_procedure'] = $this->dossier_model->get_proc_dossier(null);
    //         $data['list_type_utilisateur'] = $this->utilisateurmodel->list_type();
    //         $data['procedures'] = $this->dossier_model->get_proc_dossier(null);
            
    //         $data['dossier'] = '';
    //         $data['fildariane'] = "Mes Dossier";

    //         $this->load->view('templates/header', $data);
    //         $this->load->view('templates/sidebar');
    //         $this->load->view('dossier/list_dossier');
    //         $this->load->view('templates/scripts');
    //     } else {
    //         redirect('login');
    //     }
    // }


    public function rediriger_dossier($page)
{
    $this->session->set_userdata('page_dossier', $page);
    redirect('list_dossier'); // route propre
}

    public function list_dossier()
{
    if ($this->session->has_userdata('login')) {
        $id_current_user = $this->session->userdata('idutilisateur');

        $page = $this->session->userdata('page_dossier') ?? 1; // par défaut page 1
        $this->session->unset_userdata('page_dossier'); // optionnel pour nettoyage

        $totaldossier = $this->dossier_model->get_count($id_current_user);
        $usersPerPage = 5;
        $limit = ($page * 5) - 5;
        $totalPages = ceil($totaldossier / $usersPerPage);
        $currentPage = $page;

        $data['linksBeforeAndAfter'] = 2;
        $data['startPage'] = max(1, $currentPage - $data['linksBeforeAndAfter']);
        $data['endPage'] = min($totalPages, $currentPage + $data['linksBeforeAndAfter']);
        $data['totalPages'] = $totalPages;
        $data['currentPage'] = $page;
        $data['dossiers'] = $this->dossier_model->list_dossier_current_user($id_current_user, $usersPerPage, $limit);
        $data['types_traitement'] = $this->traitement_model->get_all();
        $data['demandeurs'] = $this->demandeur_model->list_demandeur(9, 0);
        $data['total_demandeur'] = $this->demandeur_model->get_count();
        $data['alldems'] = $this->demandeur_model->list_all_demandeur();
        $data['commune'] = $this->parametre_model->list_commune();
        $data['message'] = $this->utilsmodel->message($this->input->get('success'), $this->input->get('error'));
        $data['list_origin'] = $this->dossier_model->get_all_origine();
        $data['list_procedure'] = $this->dossier_model->get_proc_dossier(null);
        $data['list_type_utilisateur'] = $this->utilisateurmodel->list_type();
        $data['procedures'] = $this->dossier_model->get_proc_dossier(null);

        $data['dossier'] = '';
        $data['fildariane'] = "Mes Dossier";

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('dossier/list_dossier');
        $this->load->view('templates/scripts');
    } else {
        redirect('login');
    }
}


    public function detail_dossier($iddossier = null)
    {
        if ($this->session->has_userdata('login')) {
            $data['infos_dossier'] = $this->dossier_model->get_RTX_by_id($iddossier);
            $data['suivi_dossier'] = $this->dossier_model->get_dossier_by_id($iddossier);
            $data['liste_procedure'] = $this->dossier_model->get_proc_dossier($iddossier);
            $data['type_users'] = $this->user_model->list_type($iddossier);
            $data['iddossier'] = $iddossier;
            $data['details_dossier'] = '';

            $data['pieces_dossier'] = $this->archive_model->get_piece_dossier($iddossier);
            $data['all_recevabilite'] = $this->dossier_model->get_all_recevabilite($iddossier);
            $data['all_reperage'] = $this->dossier_model->select_type_reperage();
            //gere notification debut
            $idtraitement = $this->input->get('idtraitement');
            $etat_notif = $this->input->get('notif');
            if (isset($idtraitement) && isset($etat_notif)) {
                if ($etat_notif == 0) {
                    $result = $this->dossier_model->notification_update($idtraitement);
                }
            }
            //gere notification fin

            //gere page active fin
            $valActive = $this->dossier_model->parametre_Active_view($this->session->userdata('idtypeuser'));
            $data['repAct'] = $valActive['repAct'];
            $data['detAct'] = $valActive['detAct'];
            //gere page active fin
            $data['fildariane'] = "📝Détails dossier";
            $this->load->view('templates/header_map', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('dossier/details_dossier');
            $this->load->view('templates/scripts_map');
        } else {
            redirect('login');
        }
    }

    public function getFktBy_commune($param = null)
    {
        if ($this->session->has_userdata('login')) {
            if (!empty($param)) {
                $res = $this->parametre_model->list_fkt($param);
                echo json_encode($res);
            }
        }
    }

    // informer Usage en cas de probleme avec email debut
    public function informe_usage()
    {
        if ($this->session->has_userdata('login')) {
            try {
                $iddossier = $this->input->post('iddossier');
                $subject = $this->input->post('subject-email');
                $object = $this->input->post('object-email');

                $dossier = $this->dossier_model->info_detaille_dossier($iddossier);
                $demanders = $this->dossier_model->list_demandeur_detail($iddossier);
                $demanders = json_decode($demanders[0]->demandeurs, true);

                foreach ($demanders as $demander) {
                    if ($demander['email'] != 'N/A') {
                        $this->emailmodel->send_Email_Usager($demander['nom'] . ' ' . $demander['prenoms'], $demander['email'], $object, $subject, $dossier->labeltraitement, $dossier->rtx, $dossier->dateentree);
                    }
                }

                echo json_encode(['status' => 'success', 'message' => 'Traitement effectuer avec succes verifier votre email pour etre sur']);
            } catch (Exception $e) {
                echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
            }


        } else {
            redirect('login');
        }
    }

    public function notification()
    {
        if ($this->session->has_userdata('login')) {
            $result = $this->dossier_model->notification_list($this->session->userdata('idutilisateur'));
            $this->dossier_model->traduireDureeEnFrancais($result);
            echo json_encode($result);
        } else {
            redirect('login');
        }
    }

    public function list_origine()
    {
        if ($this->session->has_userdata('login')) {
            echo json_encode($this->dossier_model->get_all_origine());
        } else {
            redirect('login');
        }
    }

    public function notification_count()
    {
        if ($this->session->has_userdata('login')) {
            $result = $this->dossier_model->notification_count($this->session->userdata('idutilisateur'));
            echo json_encode($result);
        } else {
            redirect('login');
        }
    }

    public function rtx()
    {
        if ($this->session->has_userdata('login')) {
            $iddossier = $this->input->post('iddossier');
            $rtx = $this->input->post('rtx');

            $update = $this->dossier_model->update_rtx($iddossier, $rtx);

            if ($update) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'RTX mis à jour avec succès.',
                    'rtx' => $rtx // ← ici on renvoie le RTX formaté
                ]);
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Le RTX existe déjà ou mise à jour impossible.'
                ]);
            }
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Session expirée.'
            ]);
        }
    }


    public function historique_dossier($iddossier)
    {
        if ($this->session->has_userdata('login')) {

            $info_Partielle = $this->dossier_model->get_dossier_all_label($iddossier);

            $info_num_date_verification = $this->dossier_model->get_premiere_verification($iddossier);

            $info_dossier_rtx = $this->dossier_model->select_v_dossier_where_iddossier($iddossier);

            $info_geometre = $this->dossier_model->select_geometre_where_iddossier($iddossier);

            $info_verification = $this->dossier_model->select_verification_where_iddossier($iddossier);

            $info_visa = $this->dossier_model->select_visa_where_iddossier($iddossier);

            $info_satisfaction = $this->dossier_model->select_satisfaction_where_iddossier($iddossier);

            $list_visa = $this->dossier_model->select_visa_selectionne_where__iddossier($iddossier);

            $list_condition = $this->dossier_model->get_all_recevabilite($iddossier);


            echo json_encode([
                "info_partielle" => $info_Partielle,
                "info_num_date_verification" => $info_num_date_verification,
                "info_dossier_rtx" => $info_dossier_rtx,
                "info_geometre" => $info_geometre,
                "info_verification" => $info_verification,
                "info_visa" => $info_visa,
                "info_satisfaction" => $info_satisfaction,
                "list_visa" => $list_visa,
                "list_condition" => $list_condition,
            ]);
        } else {
            redirect('login');
        }
    }

    //get observation poser par l'usager
    public function getObservation()
    {
        if ($this->session->has_userdata('login')) {
            $iddossier = $this->input->get('iddossier');
            $obs = $this->dossier_model->getObservation($iddossier, $this->session->userdata('idutilisateur'));
            if ($obs->observation == NULL || $obs->observation == "") {
                $obs->observation = "";
            }
            echo json_encode($obs->observation);
        } else {
            redirect('login');
        }
    }

    // info sur le detail_dossier debut
    public function info_dossier()
    {
        if ($this->session->has_userdata('login')) {
            $iddossier = $this->input->post('iddossier');
            $dossier = $this->dossier_model->list_demandeur_detail($iddossier);
            echo json_encode($dossier[0]);
        } else {
            redirect('login');
        }
    }

    // Reperage debut
    public function validate_reperage()
    {
        if ($this->session->has_userdata('login')) {
            try {
                $iddossier = $this->input->post('iddossier');
                $type_reperage = $this->input->post('type_reperage');
                $date_entrer = $this->input->post('date_reperage');
                $obs = $this->input->post('obs');
                $num_reperage = $this->input->post('num_reperage');
                $idutilisateur = $this->session->userdata('idutilisateur');
                $type_empietement = $this->input->post('empt');
                $partiel = $this->input->post('partiel');
                $coord = json_decode($this->input->post('coord'));

                //$coord = $this->polygone_model->__prepare_insert_reperage($path_dxf,$iddossier);

                $data = $this->dossier_model->prepare_data_reperage(
                    $coord,
                    $iddossier,
                    $type_reperage,
                    $date_entrer,
                    $obs,
                    $num_reperage,
                    $idutilisateur,
                    $type_empietement,
                    $partiel
                );

                $this->dossier_model->insert_reperage($data);

                echo json_encode(['status' => 'success', 'message' => 'Insertion avec succes']);
            } catch (Exception $e) {
                echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
            }
        } else {
            redirect('login');
        }
    }
    // Reperage Fin

    //Import Pieces Archivage
    public function rattacher_pj()
    {
        if ($this->session->has_userdata('login')) {
            try {
                $dossier = $this->dossier_model->find_dossier_info($_POST['iddossier']);

                $this->archive_model->add_file_joint($dossier, $_POST['iddossier'], $_FILES['files']);

                echo json_encode(['status' => 'success', 'message' => 'Piece joint ajouter avec success']);
            } catch (Exception $e) {
                echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
            }
        } else {
            redirect('login');
        }
    }

    //Retour Dossier CIRDOMA
    public function renvoie_dossier($param)
    {
        echo "renvoie_dossier";
    }

    //Remise Dossier
    public function remise_dossier()
    {
        if ($this->session->has_userdata('login')) {
            $data['idutilisateur'] = $this->session->userdata('idutilisateur');
            $data['iddossier'] = $this->input->post('iddossier');
            $data['date_remise'] = $this->input->post('date_remise');
            $data['observation'] = $this->input->post('observ');

            try {
                $query = $this->dossier_model->remise_dossier($data);
                redirect('list_dossier/1?success=' . $query, 'refresh');
            } catch (Exception $e) {
                $message = $e->getMessage();
                redirect('list_dossier/1?error=' . $message, 'refresh');
            }

        } else {
            redirect('login');
        }
    }

    // liste de visa
    public function list_visa()
    {
        if ($this->session->has_userdata('login')) {
            echo json_encode($this->dossier_model->listVisa());
        } else {
            redirect('login');
        }
    }

    //validation de visa
    public function validate_visa()
    {
        if ($this->session->has_userdata('login')) {
            try {
                $data = json_decode(file_get_contents('php://input'), true);

                $data_ = [
                    'iddossier' => $data['iddossier'],
                    'date' => $data['date_visa'],
                    'visa' => $data['visa'],
                    'obs' => $data['observ'],
                    'id_utilisateur' => $this->session->userdata('idutilisateur')
                ];

                $this->dossier_model->update_visa($data_);
                echo json_encode(['status' => 'success', 'message' => 'Visa effectuer avec succes']);
            } catch (Exception $e) {
                echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
            }
        } else {
            redirect('login');
        }
    }

    //choix du geometre sur le dossier debut
    public function validate_geometre()
    {
        if ($this->session->has_userdata('login')) {
            try {
                $data = json_decode(file_get_contents('php://input'), true);

                $data = [
                    'iddossier' => xss_clean(trim($data[0]['value'])),
                    'date_envoie' => xss_clean(trim($data[1]['value'])),
                    'date_reception_Ge' => xss_clean(trim($data[2]['value'])),
                    'nom_geom' => xss_clean(trim($data[3]['value'])),
                    'id_geometre' => xss_clean(trim($data[4]['value'])),
                    'id_utilisateur' => $this->session->userdata('idutilisateur'),
                    'obs_geometre' => xss_clean(trim($data[5]['value']))
                ];

                $res = $this->dossier_model->choix_geometre($data);
                echo json_encode(['status' => 'success', 'message' => 'Choix du geometre effectuer avec success']);
            } catch (Exception $e) {
                echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
            }
        } else {
            redirect('login');
        }
    }

    //verification modal debut
    public function validate_verification()
    {
        if ($this->session->has_userdata('login')) {
            try {
                $data = json_decode(file_get_contents('php://input'), true);

                $data = [
                    'iddossier' => xss_clean(trim($data[0]['value'])),
                    'num_verification' => xss_clean(trim($data[1]['value'])),
                    'date' => xss_clean(trim($data[2]['value'])),
                    'obs' => xss_clean(trim($data[3]['value'])),
                    'id_utilisateur' => $this->session->userdata('idutilisateur')
                ];

                $res = $this->dossier_model->update_verification($data);
                echo json_encode(['status' => 'success', 'message' => 'Verification effectuer avec success']);
            } catch (Exception $e) {
                echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
            }
        } else {
            redirect('login');
        }
    }

    //print recue debut
    public function print_recu()
    {
        if ($this->session->has_userdata('login')) {
            try {
                $data = json_decode(file_get_contents('php://input'), true);
                date_default_timezone_set('Africa/Nairobi');
                $pdf_name = date('dmyhis') . '.pdf';
                $html_content = $this->Htmltopdf_model->get_recue($data[0]['value']);
                echo json_encode(['status' => 'success', 'message' => 'Visualisation de l\'impression', 'data' => $html_content]);
            } catch (Exception $e) {
                echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
            }
        } else {
            redirect('login');
        }
    }

    //payement dossier
    public function payer_dossier()
    {
        if ($this->session->has_userdata('login')) {
            $data = json_decode(file_get_contents('php://input'), true);

            $data = [
                'iddossier' => xss_clean(trim($data['iddossier'])),
                'montant_total' => $this->dossier_model->removeSpacesFromNumber($data['montant_total']),
                'date_payement' => xss_clean(trim($data['date_payement'])),
                'id_utilisateur' => $this->session->userdata('idtypeuser')
            ];

            try {
                $this->dossier_model->payer_dossier($data);
                echo json_encode(['status' => 'success', 'message' => 'Payement effectuer avec success']);
            } catch (Exception $e) {
                echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
            }
        } else {
            redirect('login');
        }
    }

    public function find_dossier()
    {
        if ($this->session->has_userdata('login')) {

            $idutilisateur = $_SESSION['idutilisateur'];
            $rtx = $this->input->post('mot_cle');
            $demandeur = $this->input->post('demandeur');
            $traitement = $this->input->post('traitement');
            $procedure = $this->input->post('procedure');
            $debut = $this->input->post('debut');
            $fin = $this->input->post('fin');

            $result = $this->dossier_model->get_list_dossier_utilisateur($rtx, $debut, $fin, $demandeur, $idutilisateur, $traitement, $procedure);

            echo json_encode($result);
        } else {
            redirect('login');
        }
    }

    public function get_list_pieces()
    {
        if ($this->session->has_userdata('login')) {
            $result = $this->dossier_model->liste_pieces();
            echo json_encode($result);
        } else {
            redirect('login');
        }
    }

    public function remise_geo()
    {
        if ($this->session->has_userdata('login')) {
            try {
                $id = $this->input->post('iddossier');
                $id_geometre_historique = $this->dossier_model->select_max_id_historique_geo($id);

                // Vérification si id_geometre_historique est vide
                if (empty($id_geometre_historique)) {
                    // Envoie un message d'erreur sans effectuer l'insertion
                    echo json_encode(['status' => 'error', 'message' => 'Le dossier n\'est pas encore assigné à un géomètre']);
                    return; // Arrête l'exécution de la fonction ici
                }

                $data = [
                    "iddossier" => $id,
                    "id_geometre_historique" => $id_geometre_historique,
                    "date_recu" => $this->input->post('date'),
                    "obs" => $this->input->post('obs'),
                    'id_utilisateur' => $this->session->userdata('idutilisateur')
                ];

                $this->dossier_model->insert_historique_geometre($data);

                echo json_encode(['status' => 'success', 'message' => 'Retour du dossier confirmer']);
            } catch (Exception $e) {
                echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
            }
        } else {
            redirect('login');
        }
    }
    public function integration()
    {
        if ($this->session->has_userdata('login')) {
            try {
                $data = json_decode(file_get_contents('php://input'), true);

                $data = [
                    'iddossier' => xss_clean(trim($data[0]['value'])),
                    'date' => xss_clean(trim($data[1]['value'])),
                    'obs' => xss_clean(trim($data[2]['value'])),
                    'id_utilisateur' => $this->session->userdata('idutilisateur')
                ];

                $this->dossier_model->insert_integration($data);
                echo json_encode(['status' => 'success', 'message' => 'Verification effectuer avec success']);
            } catch (Exception $e) {
                echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
            }
        } else {
            redirect('login');
        }
    }
    public function verification_num()
    {
        echo json_encode($this->dossier_model->num_verification($this->input->get('iddossier')));
    }

    public function validate_verif_avt_remise()
    {
        if ($this->session->has_userdata('login')) {
            $data = json_decode(file_get_contents('php://input'), true);
            $data_ = [
                'iddossier' => xss_clean(trim($data['iddossier'])),
                'date' => xss_clean(trim($data['date'])),
                'obs' => xss_clean(trim($data['observ'])),
                'num_verification' => xss_clean(trim($data['num_verification'])),
                'pieces_fournie' => $data['pieces_fournie[]']
            ];
            try {
                $this->dossier_model->update_verif_avt_remise($data_);
                echo json_encode(['status' => 'success', 'message' => 'Insertion avec success']);
            } catch (Exception $e) {
                echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
            }
        } else {
            redirect('login');
        }
    }

    public function get_user_type($id_typeuser)
    {
        if ($this->session->has_userdata('login')) {
            $result = $this->user_model->get_id_typeuser($id_typeuser);
            if ($result) {
                echo json_encode($result);
            }
        } else {
            redirect('login');
        }
    }
    // Recherche des dossier Dans view 'suivie dossier'
    public function find_dossier_rtx_all_utilisateur()
    {
        if ($this->session->has_userdata('login')) {

            $rtx = $this->input->post('mot_cle');
            $demandeur = $this->input->post('demandeur');
            $date_debut = $this->input->post('date_debut');
            $date_fin = $this->input->post('date_fin');
            $type_traitement = $this->input->post('type_traitement');
            $procedure = $this->input->post('procedure');

            $result = $this->dossier_model->get_list_dossier_All_utilisateur($rtx, $demandeur, $type_traitement, $date_debut, $date_fin, $procedure);

            echo json_encode($result);
        } else {
            redirect('login');
        }
    }
    //validation satisfaction note
    public function validate_satisfaction()
    {
        if ($this->session->has_userdata('login')) {
            try {
                $data = json_decode(file_get_contents('php://input'), true);

                $data = [
                    'iddossier' => xss_clean(trim($data[0]['value'])),
                    'date' => xss_clean(trim($data[1]['value'])),
                    'obs' => xss_clean(trim($data[2]['value'])),
                    'id_utilisateur' => $this->session->userdata('idutilisateur')
                ];

                $res = $this->dossier_model->update_satisfaction($data);
                echo json_encode(['status' => 'success', 'message' => 'Satisfaction effectuer avec succes']);
            } catch (Exception $e) {
                echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
            }
        } else {
            redirect('login');
        }
    }

    // Fonction pour extraire les coordonnées depuis GeoJSON
    public function extractCoordsFromGeoJSON($geojsonString)
    {
        $geojson = json_decode($geojsonString, true); // Décoder JSON
        if (isset($geojson['coordinates']) && is_array($geojson['coordinates'])) {
            return $geojson['coordinates'][0]; // Extraire le tableau de coordonnées
        }
        return [];
    }

    public function get_polygone_reperage_partielle($partielle, $reperage)
    {
        $coords = [];

        // Extraire les coordonnées de $partielle (s'il y en a plusieurs)
        foreach ($partielle as $p) {
            if (!empty($p->st_asgeojson)) {
                $coords[] = $this->extractCoordsFromGeoJSON($p->st_asgeojson);
            }
        }

        // Extraire les coordonnées de $reperage (corrigé pour récupérer **tous** les objets)
        foreach ($reperage as $r) {
            if (!empty($r->st_asgeojson)) {
                $coords[] = $this->extractCoordsFromGeoJSON($r->st_asgeojson);
            }
        }

        return $coords; // Retourne un tableau contenant **toutes** les coordonnées
    }

    public function polygone()
    {
        if ($this->session->has_userdata('login')) {
            try {
                $iddossier = $this->input->get('iddossier');
                $dossier = $this->dossier_model->find_dossier_info($iddossier);
                $partielle = $this->dossier_model->select_partielle($dossier);
                $reperage = $this->dossier_model->select_reperage($iddossier);
                $coord = $this->get_polygone_reperage_partielle($partielle, $reperage);
                echo json_encode($coord);
            } catch (Exception $e) {
                echo json_encode(NULL);
            }
        } else {
            redirect('login');
        }
    }

    public function get_Data_dossier()
    {
        $id_current_user = $this->session->userdata('idutilisateur');
        $page = (int) $this->input->get('page');
        $limit = (int) $this->input->get('limit');
        $offset = ($page - 1) * $limit;

        $data = $this->dossier_model->get_paginated_data($id_current_user, $limit, $offset);
        $total = $this->dossier_model->get_total_rows($id_current_user);

        echo json_encode([
            'data' => $data,
            'total' => $total
        ]);
    }

    public function detail_suivie_dossier($iddossier)
    {
        if ($this->session->has_userdata('login')) {
            $data['suivi_dossier'] = $this->dossier_model->get_dossier_by_id($iddossier);
            $data['infos_dossier'] = $this->dossier_model->get_RTX_by_id($iddossier);
            $data['iddossier'] = $iddossier;

            $data['suivi'] = '';
            $data['fildariane'] = 'Détails dossier';


            $this->load->view('templates/header_map', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('dossier/details_suivie_dossier', $data);
            $this->load->view('templates/scripts');
        }
    }
}