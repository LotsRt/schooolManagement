<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ge extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper("url");
		$this->load->helper("form");
		$this->load->helper("security");
		$this->load->model("/ge/Ge_model", "gemodel");
		$this->load->model('utils/Utils_model', 'utilsmodel');
		$this->load->library("pagination");
	}

	function get_Data_ge(){
		if ($this->session->has_userdata('login')) {
			$page = (int) $this->input->get('page');
			$limit = (int) $this->input->get('limit');
			$search = $this->input->get('search');
			$offset = ($page - 1) * $limit;

			$data = $this->gemodel->get_paginated_data($limit, $offset, $search);
			$total = $this->gemodel->get_total_rows($search);

			echo json_encode([
				'data' => $data,
				'total' => $total
			]);
		} else {
			redirect('login');
		}
	}

	public function search_geometre()
	{
		if ($this->session->has_userdata('login')) {
			$param = $this->input->get('data');
			$result = $this->gemodel->find_ge(strtolower(trim($param)));
			if ($result) {
				echo json_encode($result);
			}
		} else {
			redirect('login');
		}
	}

	public function search_liste_ge($param = null)
	{
		if ($this->session->has_userdata('login')) {
			$totalUsers = $this->gemodel->get_count();
			$gePerPage = 5;
			$limit = ($param * 5) - 5;
			$result = $this->gemodel->get_ge($gePerPage, $limit);
			if ($result) {
				echo json_encode($result);
			}
		} else {
			redirect('login');
		}
	}

	public function add_ge(){
		if ($this->session->has_userdata('login')) {
			$message = NULL;
			try {
				$params['num_ordre'] = $this->input->post('num_ordre');
				$params['nom_prenom'] = $this->input->post('nom_prenom');
				$params['adresse_cabinet'] = $this->input->post('adresse_cabinet');
				$params['tel'] = $this->input->post('tel');
				$params['e_mail'] = $this->input->post('e_mail');
				$num_ordre = str_replace('.', '_', $params['num_ordre']);
				$file_name = 'photo_' . str_replace(' ', '_', $params['num_ordre']) . '_';

				$config['upload_path'] = './upload_photo_geometre/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = 5120;
				$config['max_width'] = 1920;
				$config['max_height'] = 1080;
				$config['file_name'] = $file_name;
				//$config['overwrite']           = true;

				$params['file_path'] = null;

				$this->load->library('upload', $config);

				if (!$this->upload->do_upload('file')) {
					$error = array('error' => $this->upload->display_errors());

					//var_dump($error); die();
				} else {
					$data = array('upload_data' => $this->upload->data());
					//var_dump($data); die();
					$params['file_path'] = base_url() . 'upload_photo_geometre/' . $data['upload_data']['file_name'];
					//$this->load->view('upload_success', $data);
				}
				$message = $this->gemodel->add_ge($params);
				redirect('list_ge/1?success=' . $message, 'refresh');
			} catch (Exception $e) {
				$message = $e->getMessage();
				redirect('list_ge/1?error=' . $message, 'refresh');
			}
		} else {
			redirect('login');
		}
	}

	public function list_ge($param = null){
		if ($this->session->has_userdata('login')) {
			$totalUsers = $this->gemodel->get_count();
			$gePerPage = 5;
			$limit = ($param * 5) - 5;
			$totalPages = ceil($totalUsers / $gePerPage);
			$currentPage = $param;
			$data['linksBeforeAndAfter'] = 2;
			$data['startPage'] = max(1, $currentPage - $data['linksBeforeAndAfter']);
			$data['endPage'] = min($totalPages, $currentPage + $data['linksBeforeAndAfter']);
			$data['totalPages'] = $totalPages;
			$data['currentPage'] = $param;
			$data['list_ge'] = $this->gemodel->get_ge($gePerPage, $limit);
			$data['message'] = $this->utilsmodel->message($this->input->get('success'), $this->input->get('error'));
			//$data['list_type_user'] = $this->usermodel->list_type();
			$data['ge'] = "";
			$data['fildariane'] = "Géomètre Expert";
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar');
			$this->load->view('ge/list_ge', $data);
			$this->load->view('templates/scripts');
		} else {
			redirect('login');
		}
	}

	public function list_ge_json($param = null){
		if ($this->session->has_userdata('login')) {
			$totalUsers = $this->gemodel->get_count();
			$gePerPage = 5;
			$limit = ($param * 5) - 5;
			$totalPages = ceil($totalUsers / $gePerPage);
			$currentPage = $param;
			$data['linksBeforeAndAfter'] = 2;
			$data['startPage'] = max(1, $currentPage - $data['linksBeforeAndAfter']);
			$data['endPage'] = min($totalPages, $currentPage + $data['linksBeforeAndAfter']);
			$data['totalPages'] = $totalPages;
			$data['currentPage'] = $param;
			$data['list_ge'] = $this->gemodel->get_ge($gePerPage, $limit);
			echo json_encode($data['list_ge']);
		} else {
			redirect('login');
		}
	}

	public function edit_ge($id){
		if ($this->session->has_userdata('login')) {
			$message = NULL;
			try {
				$params['num_ordre'] = $this->input->post('num_ordre');
				$params['nom_prenom'] = $this->input->post('nom_prenom');
				$params['adresse_cabinet'] = $this->input->post('adresse_cabinet');
				$params['tel'] = $this->input->post('tel');
				$params['e_mail'] = $this->input->post('e_mail');

				$num_ordre = str_replace('.', '_', $params['num_ordre']);
				$file_name = 'photo_' . str_replace(' ', '_', $num_ordre) . '_';

				$config['upload_path'] = './upload_photo_geometre/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = 5120;
				$config['max_width'] = 1920;
				$config['max_height'] = 1080;
				$config['file_name'] = $file_name;
				//$config['overwrite']           = true;

				$params['file_path'] = null;

				$this->load->library('upload', $config);

				if (!$this->upload->do_upload('file')) {
					$error = array('error' => $this->upload->display_errors());

					//var_dump($error); die();
				} else {
					$data = array('upload_data' => $this->upload->data());
					//var_dump($data); die();
					$params['file_path'] = base_url() . 'upload_photo_geometre/' . $data['upload_data']['file_name'];
					//$this->load->view('upload_success', $data);
				}
				$message = $this->gemodel->edit_ge($params, $id);
				redirect('list_ge/1?success=' . $message, 'refresh');
			} catch (Exception $e) {
				$message = $e->getMessage();
				redirect('list_ge/1?error=' . $message, 'refresh');
			}
		} else {
			redirect('login');
		}
	}

	public function search_ge($mots_cle){
		if ($this->session->has_userdata('login')) {
			$result = $this->gemodel->find_ge(strtolower(trim($mots_cle)));
			if ($result) {
				echo json_encode($result);
			}
		} else {
			redirect('login');
		}
	}

	public function check_ge(){
		if ($this->session->has_userdata('login')) {
			$num_ordre = $this->input->post('num_ordre');
			$result = $this->gemodel->check_ge(strtolower(trim($num_ordre)));
			if ($result) {
				echo json_encode($result);
			}
		} else {
			redirect('login');
		}
	}

	public function get_ge($id_geometre){
		$data = $this->gemodel->get_ge_by_id($id_geometre);
		echo json_encode($data);
	}

	public function index(){
		$this->list_ge();
	}

}