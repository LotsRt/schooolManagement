<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cartographie extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper("url");
        $this->load->model( 'dossier/Dossier_model', 'dossier_model' );
        $this->load->model( 'utils/Polygone_model', 'polygone_model' );
        $this->load->model( 'cartographie/Cartographie_model', 'cartographie_model' );
	}
	
//-----------------Valider ------------------------------
	public function view_rep_plof()
	{
		if ($this->session->has_userdata('login')) {
			$data['reper_plof'] = "";
            $data['fildariane'] = "Repérage Numérique";
			$this->load->view('templates/header_map', $data);
			$this->load->view('templates/sidebar');
			$this->load->view('cartographie/reperage_plof');
			$this->load->view('templates/scripts_map');
		} else {
			redirect('login');
		}
	}

    public function import_dxf() {
        if ( $this->session->has_userdata('login' )){
            try {
                // titre ou FN ou cadastre
                $data = $this->dossier_model->import_dxf_file_process();

                //titre origine 'virgule ny separation'
                //mila origine ra toka bornage et morcellement na fusion
                //ito mila amborina mjery oe efa naazo titre ou pas ve ilay dossier si oiu tokn le numero de ttre mitondray ny archive
                $dossier = $this->dossier_model->process_import_dxf($_POST['iddossier']);
                
                $name_table =  $this->dossier_model->get_where_origine($dossier->id_type_origine);

                $origine = $this->dossier_model->split_Origine($dossier->numero_origine);

                if($dossier->idtraitement == 24){ // id 24 bornage et morcellement
                    //extract X et Y du fichier DXF
                    $partielle = $this->polygone_model->traitement($_FILES['fileUpload']['tmp_name']);

                    $titre_fille_data = $this->polygone_model->__prepare_insert($partielle, $_FILES['fileUpload']['tmp_name'], $_POST['iddossier']);

                    for ($i=0; $i < count($origine); $i++) { 
                        $mere_info = $this->dossier_model->select_table_where_numero($name_table->labeltypeorigine, $dossier->id_type_origine , $origine[$i]);
                        
                        //verification avent le traitement 
                        $this->dossier_model->check_intersection($titre_fille_data[0]['geom'] ,$mere_info->numero, $name_table->labeltypeorigine, $dossier->id_type_origine);

                        //soustraction de la titre mere
                        $new_mere_polygone =  $this->dossier_model->select_partielle_where_id_dossier_mere($titre_fille_data[0]['geom'] ,$mere_info->numero, $name_table->labeltypeorigine, $dossier->id_type_origine);

                        //transferer vers le table historique avant update
                        $this->dossier_model->insert_partielle_into_historique($mere_info->numero, $name_table->labeltypeorigine, $dossier->id_type_origine);

                        //Modifier le titre origine ou mere
                        $this->dossier_model->update_partielle_where_id_dossier($new_mere_polygone,  $origine[$i], $name_table->labeltypeorigine, $dossier->id_type_origine);
                    }
                }else if($dossier->idtraitement == 26){ // id 26 bornage et fusion
                    $this->dossier_model->transfer_to_historique($origine, $dossier->id_type_origine);
                }

                $data_dxf = $this->cartographie_model->import_dxf($_FILES['fileUpload'], $dossier, $data);
            
                echo json_encode(['status' => 'success', 'message' => 'Import du fichier DXF avec success', 'object' => $data_dxf]);
            } catch (Exception $e) {
                echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
            }
        }else {
            redirect( 'login' );
        }
    }

    public function reperage() {
        if ( $this->session->has_userdata( 'login' ) ) {
            try {
                $RTX = $this->dossier_model->find_dossier_rtx_by_iddossier($_POST['iddossier']);

				$reperage = $this->cartographie_model->reperage( $RTX, $_FILES['fileUpload']);
                
				echo json_encode($reperage);
            } catch (Exception $e) {
                echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
            }
        }else {
            redirect( 'login' );
        }
    }

    public function import_dxf_rep(){
        if ( $this->session->has_userdata('login' )){
            try {
                $data_dxf = $this->cartographie_model->import_dxf_rep($_FILES['fileUpload']);

                echo json_encode(['status' => 'success', 'message' => 'Visualisation du dxf', 'object' => $data_dxf]);

            } catch (Exception $e) {
                echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
            }

        }else{
            redirect( 'login' );
        }
    }

}
