<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Archive extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('archive/Archive_model', 'archivemodel');
		$this->load->model('territoire/territoire_model', 'territoiremodel');
		$this->load->model('dossier/Dossier_model', 'dossiermodel');
	}
//------------------------------------Valider ----------------------------
	public function view_archive($param = null)
	{
		if ($this->session->has_userdata('login')) {
			$data['linksBeforeAndAfter'] = 1;
			$data['archive'] = '';
			$data['communes'] = $this->territoiremodel->get_list_commune();
			$data['titres'] = $this->archivemodel->list_archive(null);
			$data['fildariane'] = "Archive Numérique";

			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar');
			$this->load->view('archive/archive', $data);
			$this->load->view('templates/scripts');
		} else {
			redirect('login');
		}
	}

	public function archive_detail($num_dossier)
	{
		if ($this->session->has_userdata('login')) {
			$numero = urldecode($num_dossier);

			$dossier = $this->dossiermodel->find_dossier_info_rtx($numero);

			if (!empty($dossier)) {
				$data['pieces'] = $this->archivemodel->info_titre($dossier);
			}

			$name_table = $this->dossiermodel->detecter_type_numero($numero);

			if ($name_table != null) {
				$data['cartouche'] = $this->dossiermodel->info_num_att($name_table, $numero);
			}

			$data['numero'] = $numero;
			$data['fildariane'] = "Détails du Dossier : ".$numero ;

			$this->load->view('templates/header_map', $data);
			$this->load->view('templates/sidebar');
			$this->load->view('archive/archive_detail', $data);
			$this->load->view('templates/scripts');
		} else {
			redirect('login');
		}
	}

	public function piece_joint()
	{
		if ($this->session->has_userdata('login')) {
			try {
				$numero = $this->input->post('numero');
				$dossier = $this->dossiermodel->find_dossier_info_rtx($numero);
				$result = $this->archivemodel->info_titre($dossier);
				echo json_encode(['status' => 'success', 'message' => 'Document trouver', 'object' => $result]);
			} catch (Exception $e) {
				echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
			}
		}
	}

	public function search()
	{
		if ($this->session->has_userdata('login')) {
			$numero = $this->input->post('mots_cle');
			$commune = $this->input->post('commune');

			$result = $this->archivemodel->search_titre($numero, $commune);

			echo json_encode($result);
		} else {
			redirect('login');
		}
	}

	//fonction manambotra ny view de plan azo imprimena
	public function info_numero()
	{
		if ($this->session->has_userdata('login')) {
			try {
				$numero = urldecode($this->input->get('numero'));
				$information = $this->dossiermodel->detecter_type_numero_geoserver($numero);
				$dossier = $this->dossiermodel->info_num_att_view_t_d($information['table'], $numero);
				$information['dossier'] = $dossier;

				echo json_encode($information);
			} catch (Exception $e) {
				echo json_encode($e->getMessage());
			}
		} else {
			redirect('login');
		}
	}
}