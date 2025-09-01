<?php
defined('BASEPATH') or exit('No direct script access allowed');

class filiere_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }


    //recupertaion de filier
    public function geting()
    {
        $this->db->select('filier.nom_filier,filier.code_filier,filier.id_filier');
        $this->db->from('filier');
        $query = $this->db->get();
        return $query->result_array();
    }

    // -------------------------------------------------------------------//

    //recupertaion d  un eleve par matiere
    public function eleve_par_filiere($code_filier)
    {
        $this->db->select('filier.nom_filier,eleve.matricule,eleve.nom,eleve.prenom');//on recupere les information de l eleve 
        $this->db->from('eleve');
        $this->db->join('filier', 'eleve.code_filier = filier.code_filier');
        $this->db->where('filier.code_filier', $code_filier);//on selectionne les eleve qui a le code filier lier au id_filier;
        $query = $this->db->get();
        return $query->result_array();//on le stock sous forme de tableau;
    }

    // -------------------------------------------------------------------//

    //fontion de recuperation de matiere par filier
    public function recup_matiere($code_filier)
    {
        $this->db->select('filier.code_filier,matiere.id_matiere,matiere.nom_matiere,
        matiere.code_matiere,matiere.volume_horaire');//on recupere les information de l eleve 

        $this->db->from('matiere');
        //jointure du matiere au matiere_filier pour puvoir recuperer le matiere
        $this->db->join('filiere_matiere', 'matiere.code_matiere = filiere_matiere.code_matiere');//
        //jointure au filier pour avoir le code_filiere
        $this->db->join('filier', 'filier.code_filier = filiere_matiere.code_filier');
        //on recupere les matiere la ou le code_filier correspond au code_filier 
        $this->db->where('filiere_matiere.code_filier', $code_filier);//on selectionne tout les matiere lier au code_filier dans filiere_matiere
        $query = $this->db->get();
        return $query->result_array();//on le stock sous forme de tableau;
    }


    // -------------------------------------------------------------------//
    //recuperatipn des notes par matiere dans un filier donne
    public function recup_note($code_matiere, $code_filier)
    {
        $this->db->select('eleve.matricule,eleve.nom,eleve.prenom,SUM(note.note * matiere.coefficient) AS total_note
        ,AVG(note.note) AS moyenne');//on recupere les information de l eleve 

        $this->db->from('eleve');
        $this->db->join('note', 'eleve.matricule=note.matricule');
        $this->db->join('matiere', 'note.code_matiere=matiere.code_matiere');
        $this->db->join('filier', 'note.code_filiere=filier.code_filier');
        $this->db->where('matiere.code_matiere', $code_matiere); //on recupere le notes ou le code_matiere coreespond au code_matiere poster
        $this->db->where('filier.code_filier', $code_filier);//on recupere le matiere liee au  code_filier correspond au code_filier poster
        $this->db->group_by('eleve.matricule,eleve.nom,eleve.prenom');
        $this->db->order_by('total_note', 'DESC');
        $query = $this->db->get();
        return $query->result_array();//on le stock sous forme de tableau;
    }

//---------------------function filiere-------------------------
    public function control($code_filier)
    {
        $query = $this->db->get_where('filier', ['code_filier' => $code_filier]);
        return $query->result_array();
    }
    public function ajout($data){
       $this->db->insert('filier',$data);
       return true;
    }

//---------------------function matiere-----------------------
    public function check($code_matiere){
        $query=$this->db->get_where('matiere',['code_matiere'=>$code_matiere]);
        return $query->result_array();
    }
    public function ajout_matiere($data){
        $query=$this->db->insert('matiere',$data);
        return true;
    }


    //---------------------------------fonction matiere_filiere--------------
    public function controller($code_filiere,$code_matiere){
        $query=$this->db->get_where('filiere_matiere',['code_filier'=>$code_filiere,'code_matiere'=>$code_matiere]);
        return $query->result_array();
    }
    public function ajout_MatFi($data){
        $query=$this->db->insert('filiere_matiere',$data);
        return true;
    }
}