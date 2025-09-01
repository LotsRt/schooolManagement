<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reproduction extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('reproduction/Reproduction_model', 'reproduction_model');
		$this->load->model('dossier/Demandeur_model', 'demandeur_model');
		$this->load->model('parametre/Parametre_model', 'parametre_model');
		$this->load->model('authentification/Utilisateur_model', 'user_model');
		$this->load->model('authentification/Groupe_model', 'groupe_model');
	}

	public function list_reproduction($param = null, $keyword = null)
	{
		if ($this->session->has_userdata('login')) {
			$id_current_user = $this->session->userdata('idutilisateur');
			$totaldossier = $this->reproduction_model->get_count($id_current_user);
			$usersPerPage = 5;
			$limit = ($param * 5) - 5;
			$totalPages = ceil($totaldossier / $usersPerPage);
			$currentPage = $param;

			$data['linksBeforeAndAfter'] = 2;
			$data['startPage'] = max(1, $currentPage - $data['linksBeforeAndAfter']);
			$data['endPage'] = min($totalPages, $currentPage + $data['linksBeforeAndAfter']);
			$data['totalPages'] = $totalPages;
			$data['currentPage'] = $param;
			$data['reproduction'] = $this->reproduction_model->list_reproduction_current_user($id_current_user, $usersPerPage, $limit);
			$data['types_traitement'] = $this->reproduction_model->list_type_traitement();
			//$data['liste_pieces'] = $this->dossier_model->liste_pieces();
			$data['demandeurs'] = $this->demandeur_model->list_demandeur(5, 1);
			$data['commune'] = $this->parametre_model->list_commune();
			//var_dump($data['commune']);
			$data['breadcrumbs_1'] = "Délivrance de documents topographiques";
			$data['breadcrumbs_2'] = "Reproduction de documents";
			$data['link'] = "traite_dossier";
			$data['reprod'] = true;
			$data['fildariane'] = "Reproduction de documents";
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar');
			$this->load->view('reproduction/list_reproduction');
			$this->load->view('templates/scripts');
		} else {
			redirect('login');
		}
	}

	public function find_reproduction($keyword = null, $param = null)
	{
		if ($this->session->has_userdata('login')) {
			//var_dump($this->input->post());
			$id_current_user = $this->session->userdata('idutilisateur');
			$totaldossier = $this->reproduction_model->get_count($id_current_user, strtolower($keyword));
			$usersPerPage = 5;
			$limit = ($param * 5) - 5;
			$totalPages = ceil($totaldossier / $usersPerPage);
			$currentPage = $param;

			$data['linksBeforeAndAfter'] = 2;
			$startPage = max(1, $currentPage - $data['linksBeforeAndAfter']);
			$endPage = min($totalPages, $currentPage + $data['linksBeforeAndAfter']);

			//$totalPages = $totalPages;
			//$data['currentPage'] = $param;
			$res_final = array();
			$data['idutilisateur'] = $this->session->userdata('idutilisateur');
			if ($keyword != null) {
				$res = $this->reproduction_model->find_reproduction_by_keyword(strtolower($keyword), $data['idutilisateur']);
				//$data = $this->reproduction_model->list_type_traitement();
				$line = array();
				foreach ($res as $row) {
					$nom_demandeur = "";
					if ($row->id_demandeur != null) {
						$res_demandeur = $this->demandeur_model->get_demandeur_by_id($row->id_demandeur);
						if ($res_demandeur[0]->nom != null)
							$nom_demandeur = $nom_demandeur . $res_demandeur[0]->nom . ' ';
						if ($res_demandeur[0]->prenoms != null)
							$nom_demandeur = $nom_demandeur . $res_demandeur[0]->prenoms;
					}
					$line = (array) $row;
					$line['currentPage'] = $currentPage;
					$line['startPage'] = $startPage;
					$line['endPage'] = $endPage;
					$line['totalPages'] = $totalPages;
					$line['nom_demandeur'] = $nom_demandeur;
					//array_push($line, $totaldossier);
					array_push($res_final, $line);
				}

				echo json_encode($res_final);
			}

		} else {
			redirect('login');
		}
	}

	public function payer_reproduction()
	{
		if ($this->session->has_userdata('login')) {
			$data['id_reproduction'] = $this->input->post('id_reproduction');
			$data['date_payement'] = $this->input->post('date_field');
			$montant = $this->input->post('cout');
			$data['montant'] = (float) str_replace(",", "", $montant);
			$data['rtx'] = $this->input->post('rtx');
			$data['recette'] = $this->input->post('recette');
			//var_dump($data); die();
			$query = $this->reproduction_model->payer_reproduction($data);
			$data['success'] = $query;
			redirect('detail_reproduction/' . $data['id_reproduction'], 'refresh');
		} else {
			redirect('login');
		}
	}

	public function check_archive_numerique()
	{
		if ($this->session->has_userdata('login')) {
			$data['num_titre'] = $this->input->post('num_titre');
			$res = $this->reproduction_model->check_if_exist_numerique($data);
			echo json_encode($res);
		} else {
			redirect('login');
		}
	}

	public function detail_reproduction($id_reproduction = null)
	{
		if ($this->session->has_userdata('login')) {
			$data['suivi_dossier'] = $this->reproduction_model->get_reproduction_by_id($id_reproduction);
			//$data['pieces_dossier'] = null;
			$idtraitement = 16; // id de la reproduction du plan
			$data['liste_procedure'] = $this->reproduction_model->get_procedure($idtraitement);
			$data['types_traitement'] = $this->reproduction_model->list_type_traitement();
			$data['demandeurs'] = $this->demandeur_model->list_demandeur(5, 1);

			$data['infos_reproduction'] = $this->reproduction_model->get_RTX_by_id($id_reproduction);
			$data['id_reproduction'] = $id_reproduction;
			$data['type_users'] = $this->user_model->list_type();
			//var_dump($data['type_users']);

			$data['breadcrumbs_1'] = "Reproduction Plan";
			$data['breadcrumbs_2'] = "Details reproduction";
			$data['reprod'] = true;
			$data['fildariane'] = "Détails reproduction";
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar');
			$this->load->view('reproduction/details_reproduction');
			$this->load->view('templates/scripts');
		}
	}

	public function add_verif_existance()
	{
		if ($this->session->has_userdata('login')) {

			$data['type_propriete'] = $this->input->post('type_propriete');
			$data['num_titre'] = $this->input->post('num_titre');
			$data['ppte_dite'] = $this->input->post('ppte_dite');
			$data['section'] = $this->input->post('section_cadastre');
			$data['num_parcelle'] = $this->input->post('num_parcelle_cadastre');
			$data['idc_section'] = $this->input->post('idc_section_cadastre');
			$data['canton'] = $this->input->post('canton_cadastre');


			$this->reproduction_model->save_verif_doc_exist($data);
			//test kely

			redirect('list_reproduction/1', 'refresh');
		} else {
			redirect('login');
		}
	}

	public function validate_scan()
	{
		if ($this->session->has_userdata('login')) {
			$params['id_reproduction'] = $this->input->post('id_reproduction');
			$params['date'] = $this->input->post('date_field');
			$params['rtx'] = $this->input->post('rtx');
			$num_rtx = str_replace(' ', '_', $params['rtx']);
			//$file_name = 'photo_'.str_replace('/','_',$num_rtx).'_';
			/*traitement fichier*/
			$config['upload_path'] = './reproduction/scan/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = 10240;
			$config['max_width'] = 10000;
			$config['max_height'] = 10000;
			//$config['file_name']           = $file_name;
			//$config['overwrite']           = true;

			$params['file_path'] = null;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('file_scan')) {
				$error = array('error' => $this->upload->display_errors());

				var_dump($error);
				die();
			} else {
				$data = array('upload_data' => $this->upload->data());
				//var_dump($data);
				$params['file_path'] = base_url() . 'reproduction/scan/' . $data['upload_data']['file_name'];
				//$this->load->view('upload_success', $data);
			}
			$this->reproduction_model->validate_scan($params);
			redirect('detail_reproduction/' . $params['id_reproduction'], 'refresh');
		} else {
			redirect('login');
		}
	}

	public function validate_vectorisation()
	{
		if ($this->session->has_userdata('login')) {
			$params['id_reproduction'] = $this->input->post('id_reproduction');
			$params['date'] = $this->input->post('date_field');

			$params['dwg_path'] = null;
			$params['dxf_path'] = null;

			if (isset($_FILES['dwg_file'])) {
				//var_dump($_FILES['dwg_file']); die();
				$fileName = $_FILES['dwg_file']['name'];
				if ($fileName != "") {
					$fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
					//$iddossier = $this->input->post('iddossier');

					if ($fileExtension != strtolower('dwg')) {
						redirect('detail_reproduction/' . $params['id_reproduction'] . '?error=verifier le format du fichier', 'refresh');
					}

					$fichier = getcwd() . DIRECTORY_SEPARATOR . 'reproduction/plan' . DIRECTORY_SEPARATOR . '' . $_FILES['dwg_file']['name'];
					$path = base_url() . 'reproduction/plan' . DIRECTORY_SEPARATOR . '' . $_FILES['dwg_file']['name'];
					$uploaded_file = $_FILES['dwg_file']['tmp_name'];
					if (move_uploaded_file($uploaded_file, $fichier)) {
						//$this->polygone_model->__insert_dxf_into_partielle($fichier, $iddossier);
						$params['dwg_path'] = str_replace("\\", "/", $path);
						var_dump($params['dwg_path']);

					} else {
						redirect('detail_reproduction/' . $params['id_reproduction'] . '?error=Une erreur est survenue', 'refresh');
					}
				}

			}


			if (isset($_FILES['dxf_file'])) {
				$fileName = $_FILES['dxf_file']['name'];
				if ($fileName != "") {
					$fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
					//$iddossier = $this->input->post('iddossier');

					if ($fileExtension != strtolower('reproduction/plan')) {
						redirect('detail_reproduction/' . $params['id_reproduction'] . '?error=verifier le format du fichier', 'refresh');
					}

					$fichier = getcwd() . DIRECTORY_SEPARATOR . 'reproduction/plan' . DIRECTORY_SEPARATOR . '' . $_FILES['dxf_file']['name'];
					$path = base_url() . 'reproduction/plan' . DIRECTORY_SEPARATOR . '' . $_FILES['dxf_file']['name'];
					$uploaded_file = $_FILES['dxf_file']['tmp_name'];
					if (move_uploaded_file($uploaded_file, $fichier)) {
						//$this->polygone_model->__insert_dxf_into_partielle($fichier, $iddossier);
						$params['dxf_path'] = str_replace("\\", "/", $path);

					} else {
						redirect('detail_reproduction/' . $params['id_reproduction'] . '?error=Une erreur est survenue', 'refresh');
					}
				}

			}

			//var_dump($params['dwg_file']); die('eto');

			$this->reproduction_model->validate_vectorisation($params);
			redirect('detail_reproduction/' . $params['id_reproduction'], 'refresh');
		} else {
			redirect('login');
		}
	}

	public function add_reproduction()
	{
		if ($this->session->has_userdata('login')) {

			$data['id_typetraitement'] = $this->input->post('id_typetraitement');

			if (isset($this->input->post['droit_frais'])) {
				$data['droit_frais'] = $this->input->post('droit_frais');
			}


			if (isset($this->input->post['num_titre_mere'])) {
				$data['num_titre_mere'] = $this->input->post('num_titre_mere');
			}


			if (isset($this->input->post['radio_carac'])) {
				$data['radio_carac'] = $this->input->post('radio_carac');
			}
			$data['type_propriete'] = $this->input->post('type_propriete');
			$data['num_titre'] = $this->input->post('num_titre');
			$data['ppte_dite'] = $this->input->post('ppte_dite');
			$data['section'] = $this->input->post('section_cadastre');
			$data['num_parcelle'] = $this->input->post('num_parcelle_cadastre');
			$data['nombre'] = (int) $this->input->post('nombre_reprod');
			$data['utilite'] = $this->input->post('utilite_reprod');
			$data['droit'] = $this->input->post('droit_frais');
			$data['dateentree'] = $this->input->post('date_field');
			$data['id_demandeur'] = $this->input->post('id_demandeur');
			$data['id_current_user'] = $this->session->userdata('idutilisateur');
			$data['id_reproduction'] = $this->input->post('id_reproduction');

			$config['upload_path'] = './reproduction/scan/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size'] = 10240;
			$config['max_width'] = 10000;
			$config['max_height'] = 10000;
			//$config['file_name']           = $file_name;
			//$config['overwrite']           = true;

			$data['file_path_cin'] = null;
			$data['file_path_csj'] = null;

			$this->load->library('upload', $config);

			if (isset($_FILES['cin_copie'])) {
				if (!$this->upload->do_upload('cin_copie')) {
					$error = array('error' => $this->upload->display_errors());

					//var_dump($error); die();
				} else {
					$res = array('upload_data' => $this->upload->data());
					//var_dump($data);
					$data['file_path_cin'] = base_url() . 'reproduction/scan/' . $res['upload_data']['file_name'];
					//$this->load->view('upload_success', $data);
				}
			}

			if (isset($_FILES['csj_copie'])) {
				if (!$this->upload->do_upload('csj_copie')) {
					$error = array('error' => $this->upload->display_errors());

					//var_dump($error); die();
				} else {
					$res = array('upload_data' => $this->upload->data());
					//var_dump($data);
					$data['file_path_csj'] = base_url() . 'reproduction/scan/' . $res['upload_data']['file_name'];
					//$this->load->view('upload_success', $data);
				}
			}
			//$this->reproduction_model->new_reproduction($data);
			$this->reproduction_model->edit_reproduction($data);
			//test kely

			redirect('list_reproduction/1', 'refresh');
		} else {
			redirect('login');
		}
	}

	public function save_verif_doc_exist()
	{
		if ($this->session->has_userdata('login')) {

			$data['id_typetraitement'] = $this->input->post('id_typetraitement');

			$data['type_propriete'] = $this->input->post('type_propriete');
			$data['num_titre'] = $this->input->post('num_titre');
			$data['ppte_dite'] = $this->input->post('ppte_dite');
			$data['section'] = $this->input->post('section_cadastre');
			$data['num_parcelle'] = $this->input->post('num_parcelle_cadastre');
			$data['id_demandeur'] = $this->input->post('id_demandeur');
			$data['id_current_user'] = $this->session->userdata('idutilisateur');
			$data['idc_section'] = $this->input->post('idc_section_cadastre');
			$data['canton'] = $this->input->post('canton_cadastre');

			$data['path_dwg'] = null;
			$data['path_dxf'] = null;
			$data['path_scan'] = null;

			if (trim($this->input->post('path_dwg')) != "")
				$data['path_dwg'] = $this->input->post('path_dwg');

			if (trim($this->input->post('path_dxf')) != "")
				$data['path_dxf'] = $this->input->post('path_dxf');

			if (trim($this->input->post('path_scan')) != "")
				$data['path_scan'] = $this->input->post('path_scan');

			$data['id_current_user'] = $this->session->userdata('idutilisateur');

			//var_dump($data); die();

			$this->reproduction_model->new_reproduction_exists($data);
			//test kely

			redirect('list_reproduction/1', 'refresh');
		} else {
			redirect('login');
		}
	}

	public function send_reproduction()
	{
		if ($this->session->has_userdata('login')) {
			$query = $this->reproduction_model->send_reproduction();
			$data['success'] = $query;
			if ($query) {
				redirect('list_reproduction/1', 'refresh');
			}
		} else {
			redirect('login');
		}
	}

	public function print_recu_reprod()
	{
		//test kely
		$iddossier = $this->input->post('id_reproduction');
		$this->load->model('pdf/Facture_Reproduction_model', 'Htmltopdf_model');
		date_default_timezone_set('Africa/Nairobi');
		$pdf_name = date('dmyhis') . ".pdf";
		//die('avant printing recue');
		$html_content = $this->Htmltopdf_model->get_recue($iddossier, 1);
		echo $html_content;
		//fin test kely
	}

	public function validate_verif_reprod()
	{
		$info['id_reproduction'] = (int) $this->input->post('id_reproduction');
		$info['date'] = $this->input->post('date_field');
		$info['obs'] = $this->input->post('obs_verification');
		$res = $this->reproduction_model->update_verification($info);

		redirect('detail_reproduction/' . $info['id_reproduction'], 'refresh');
	}

	public function validate_signature_reprod()
	{
		$info['id_reproduction'] = (int) $this->input->post('id_reproduction');
		$info['date'] = $this->input->post('date_field');
		//$info['obs'] = $this->input->post('obs_verification');
		$res = $this->reproduction_model->update_signature($info);

		redirect('detail_reproduction/' . $info['id_reproduction'], 'refresh');
	}

	public function validate_delivrance()
	{
		$info['id_reproduction'] = (int) $this->input->post('id_reproduction');
		$info['date'] = $this->input->post('date_field');
		//$info['obs'] = $this->input->post('obs_verification');
		$res = $this->reproduction_model->update_delivrance($info);

		redirect('detail_reproduction/' . $info['id_reproduction'], 'refresh');
	}

	public function validate_reproduction()
	{
		$info['id_reproduction'] = (int) $this->input->post('id_reproduction');
		$info['date'] = $this->input->post('date_field');
		//$info['obs'] = $this->input->post('obs_verification');
		$res = $this->reproduction_model->update_reproduction($info);

		redirect('detail_reproduction/' . $info['id_reproduction'], 'refresh');
	}

	public function generate_rtx($id)
	{
		$res = $this->reproduction_model->get_last_num_reprod_plan();
		echo json_encode($res);
	}

	public function check_document()
	{
		$data['id'] = (int) $this->input->post('id_reproduction');
		$data['date'] = $this->input->post('date_field');
		if ($this->input->post('radio_existe') == "existe")
			$data['existe'] = true;
		else
			$data['existe'] = false;
		$this->reproduction_model->save_res_verif($data);
		redirect('detail_reproduction/' . $data['id'], 'refresh');
	}

}