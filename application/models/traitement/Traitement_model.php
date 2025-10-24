<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Traitement_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();

    }
    // -------------------------------------------------------------------//
    // fonction d ajout
    public function ajout_eleve($dataEleve)
    {
        $query1 = $this->db->insert('eleve', $dataEleve);
        // $query2 = $this->db->insert('inscription', $data1);
        // return $query1 && $query2;
        return $query1;

    }

    // -------------------------------------------------------------------//
    // controlle dans la base des donne identique avant insertion
    public function check_base($Matricule)
    {
        $query = $this->db->get_where('eleve', ['matricule' => $Matricule]);
        return $query->result_array();
    }

    // -------------------------------------------------------------------//

    // fonction de recuperation d eleve avec jointure 
    public function get_eleve()
    {
        $this->db->select('eleve.matricule,eleve.id_eleve, eleve.nom, eleve.prenom, filier.nom_filier');
        $this->db->from('eleve');
        $this->db->join('filier', 'eleve.code_filier = filier.code_filier');
        $this->db->order_by('eleve.matricule', 'ASC');
        $query = $this->db->get();
        return $query->result_array(); // ou result() si tu préfères des objets
    }


    // -------------------------------------------------------------------//
    public function recuperParId($id)
    {
        $this->db->select('id_eleve,matricule,nom,prenom,code_filier,adresse,age,sexe,date_naissance,pere,mere');
        $this->db->from('eleve');
        $this->db->where('id_eleve', $id);
        $query = $this->db->get();
        return $query->row_array();

    }

    // -------------------------------------------------------------------//
    public function eleve_modif($dataEleve)
    {
        $this->db->where('id_eleve', $dataEleve['id_eleve']);
        unset($dataEleve['id_eleve']);
        return $this->db->update('eleve', $dataEleve);
    }

    // -------------------------------------------------------------------//
    public function recupere_detail($id)
    {
        $this->db->select('eleve.matricule,eleve.nom,eleve.prenom,eleve.age,eleve.sexe,eleve.date_naissance,
        eleve.pere,eleve.mere,eleve.adresse,filier.nom_filier');
        $this->db->from('eleve');
        $this->db->join('filier', 'eleve.code_filier = filier.code_filier');
        $this->db->where('id_eleve', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    // -------------------------------------------------------------------//
    public function ajout_note($data)
    {
        return $this->db->insert('note', $data);
    }

    // -------------------------------------------------------------------//
    public function recupere_filier()
    {
        $query = $this->db->get('filier');
        return $query->result_array();
    }


    // -------------------------------------------------------------------//

    public function inscrire($data)
    {
        return $this->db->insert('inscription', $data);
    }
    // ----------------------------------------------------------------------//
    public function recupere_eleve_inscrit()
    {
        $query = $this->db->get('inscription');
        return $query->result_array();
    }


    public function recuperParId_inscrit($id)
    {
        $this->db->select('id_inscription,matricule,nom,prenom,date_naissance,date_inscription,anne');
        $this->db->from('inscription');
        $this->db->where('id_inscription', $id);
        $query = $this->db->get();
        return $query->row_array();
    }


    public function recupere()
    {
        $query = $this->db->get('eleve');
        return $query->result_array();
    }


    public function rechercheEleve($result)
    {
        $this->db->group_start(); // ouvre un groupe pour OR combiné
        $this->db->like('matricule::text', $result, 'after', false); // commence par le texte
        $this->db->or_like('nom', $result, 'after');               // commence par le texte
        $this->db->or_like('prenom', $result, 'after');            // commence par le texte
        $this->db->group_end(); // ferme le groupe

        $query = $this->db->get('eleve');
        return $query->result_array();
    }
}
// CREER UN FONCTION DANS LA BASE OU IL CALCULE AUTOMATIQUEMENT LES DONNE ENTRER

// CREATE OR REPLACE FUNCTION update_total_moyenne()
// RETURNS trigger AS $$
// BEGIN
//     NEW.moyenne := (COALESCE(NEW.note1, 0) + COALESCE(NEW.note2, 0) + COALESCE(NEW.note3, 0) + COALESCE(NEW.note4, 0)) / 4;
//     NEW.total := NEW.moyenne * COALESCE(NEW.coefficient, 1); COALESCE MTOVY AMLE $coefficient= (coefficient!==null) ? $coefficient :1;
//     RETURN NEW;
// END;
// $$ LANGUAGE plpgsql;

// CREATE TRIGGER trg_update_total_moyenne
// BEFORE INSERT OR UPDATE ON note
// FOR EACH ROW
// EXECUTE FUNCTION update_total_moyenne();
