<?php
defined('BASEPATH') or exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class inventaire extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('inventaire/Inventaire_model');

    }

    public function get_Data_calque()
    {
        if ($this->session->has_userdata('login')) {
            $page = (int) $this->input->get('page');
            $limit = (int) $this->input->get('limit');
            $search = $this->input->get('search');
            $offset = ($page - 1) * $limit;

            $data = $this->Inventaire_model->get_paginated_data($limit, $offset, $search);
            $total = $this->Inventaire_model->get_total_rows($search);

            echo json_encode([
                'data' => $data,
                'total' => $total
            ]);
        } else {
            redirect('login');
        }
    }
    public function view_inventaire()
    {
        if ($this->session->has_userdata('login')) {
            $data['inventaire'] = '';
            $data['fildariane'] = "Inventaire Calque";

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('inventaire/liste_inventaire');
            $this->load->view('templates/scripts');
        } else {
            redirect('login');
        }
    }

    public function add_calque()
    {
        if ($this->session->has_userdata('login')) {
            $nom_calque = $this->input->post('nom_calque');
            $section = $this->input->post('section');
            $canton = $this->input->post('canton');
            $lieu_dit = $this->input->post('lieu_dit');
            $num_parcelle = $this->input->post('num_parcelle');
            $data = $this->Inventaire_model->check($nom_calque, $section, $canton, $lieu_dit, $num_parcelle);
            if (!empty($data)) {
                echo json_encode(['status' => 'error']);
            } else {
                $data1 = $this->Inventaire_model->insert($nom_calque, $section, $canton, $lieu_dit, $num_parcelle);
                echo json_encode(['status' => 'success']);
            }
        } else {
            redirect('login');
        }

    }


    public function get_calque_by_id()
    {
        $id = $this->input->post('id');
        $data = $this->Inventaire_model->get_by_id($id);
        echo json_encode($data);
    }

    public function update_calque()
    {
        $data = array(
            'nom_calque' => $this->input->post('nom_calque'),
            'section' => $this->input->post('section'),
            'canton' => $this->input->post('canton'),
            'lieu_dit' => $this->input->post('lieu_dit'),
            'num_parcelle' => $this->input->post('num_parcelle'),
        );

        $id = $this->input->post('id_calque');
        $result = $this->Inventaire_model->update($id, $data);
        echo json_encode(['success' => $result]);
    }



    public function import_input_calque()
    {
        if (isset($_FILES['fileimplod']['name']) && $_FILES['fileimplod']['name'] != "") {
            $filePath = $_FILES['fileimplod']['tmp_name'];

            $spreadsheet = IOFactory::load($filePath);
            $sheet = $spreadsheet->getActiveSheet();
            $rows = $sheet->toArray();

            $successCount = 0;
            $failCount = 0;

            for ($i = 1; $i < count($rows); $i++) {
                $row = $rows[$i];
                $inserted = false;
                if (count($row) >= 5) {

                    $nom_calque = $row[0];
                    $section = $row[1];
                    $lieu_dit = $row[2];
                    $num_parcelle = $row[3];
                    $canton = $row[4];


                    $valer1 = $this->Inventaire_model->check($nom_calque, $section, $canton, $lieu_dit, $num_parcelle);
                    $valer = $this->Inventaire_model->inspect($nom_calque, $section, $canton, );
                    if (empty($valer1)) {
                        if (empty($valer)) {
                            $data =
                                [
                                    'nom_calque' => $nom_calque,
                                    'section' => $section,
                                    'lieu_dit' => $lieu_dit,
                                    'num_parcelle' => $num_parcelle,
                                    'canton' => $canton
                                ];
                            if (
                                !empty($nom_calque) && !empty($section) && !empty($lieu_dit)
                            ) {
                                $inserted = $this->Inventaire_model->insert_input($data);
                            }
                        }
                    }
                }
                if ($inserted) {
                    $successCount++;
                } else {
                    $failCount++;
                }
            }
            header('Content-Type: application/json');
            echo json_encode([
                'status' => 'success',
                'message' => "$successCount lignes importées, $failCount erreurs."
            ]);

        } else {
            echo json_encode(['status' => 'error', 'message' => 'Aucun fichier reçu']);
        }
    }
}