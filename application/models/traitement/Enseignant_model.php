<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Enseignant_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function check_base($Matricule, $code_enseignant)
    {
        $query = $this->db->get_where(
            'enseignant',
            [
                'matricule' => $Matricule,
                'code_enseignant' => $code_enseignant
            ]
        );
        return $query->result_array();
    }

    // -------------------------------------------------------------------//
    public function enseignant_insert($data)
    {
        return $this->db->insert('enseignant', $data);

    }

    // -------------------------------------------------------------------//
    public function recupere_donne()
    {
        $this->db->select('enseignant.id_enseignant,enseignant.matricule,enseignant.nom,enseignant.prenom,enseignant.code_enseignant,enseignant.telephone,
       enseignant.email,enseignant.statut,matiere.nom_matiere,filier.nom_filier');
        $this->db->from('enseignant');
        $this->db->join('filier', 'enseignant.code_filiere=filier.code_filier');
        $this->db->join('matiere', 'enseignant.code_matiere=matiere.code_matiere');
        $this->db->order_by('enseignant.matricule', 'ASC');
        $query = $this->db->get();
        return $query->result_array();

    }
    // -------------------------------------------------------------------//
    public function recuperParId($id)
    {
        $this->db->select('id_enseignant,matricule,nom,prenom,code_enseignant,telephone,
       email,sexe,adresse,statut,grade,date_recrutement,date_naissance,code_matiere,code_filiere');
        $this->db->from('enseignant');
        $this->db->where('id_enseignant', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    // -------------------------------------------------------------------//
    public function enseignant_modif($data)
    {
        $this->db->where('id_enseignant', $data['id_enseignant']);
        unset($data['id_enseignant']);
        return $this->db->update('enseignant', $data);
    }

    // -------------------------------------------------------------------//
    public function recupere_detail($id)
    {
        $this->db->select('enseignant.id_enseignant,enseignant.matricule,enseignant.nom,enseignant.sexe,enseignant.adresse,enseignant.prenom,enseignant.code_enseignant,enseignant.telephone,
       enseignant.email,enseignant.grade,enseignant.date_naissance,enseignant.date_recrutement,enseignant.statut,matiere.nom_matiere,filier.nom_filier');
        $this->db->from('enseignant');
        $this->db->join('filier', 'enseignant.code_filiere=filier.code_filier');
        $this->db->join('matiere', 'enseignant.code_matiere=matiere.code_matiere');
        $this->db->where('id_enseignant', $id);
        $query = $this->db->get();
        return $query->row_array();
    }



    public function find($donne){
        $this->db->like('CAST(matricule AS TEXT)', $donne, 'both', false);
        $this->db->or_like('nom',$donne);
        $this->db->or_like('prenom',$donne);
        $this->db->or_like('email',$donne);
        $query=$this->db->get('enseignant');
        return $query->result_array();
        
    }
}
