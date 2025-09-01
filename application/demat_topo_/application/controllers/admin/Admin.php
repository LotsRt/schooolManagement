<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
        $this->load->model('admin/Admin_model', 'adminmodel');
	}

	public function view_sql()
	{
        $data['fichier'] = $this->adminmodel->read();

        $this->load->view('admin/admin', $data);
	}

    public function insert_sql()
    {
        // Récupérer les fichiers sélectionnés
        $selected_files = $this->input->post('selected_files');
        try {
            $result = $this->adminmodel->insert_process($selected_files);
            echo $result;
            echo '<br><a href="' . site_url('image_sql_admin') . '"> <- Retour </a>';

        } catch (Exception $e) {
            echo $e->getMessage();
            echo '<br>';
            echo 'Maty lelike. Za ko mahay otraniny';
        }
    }
    
}
