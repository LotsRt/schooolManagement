<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashbord_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function compter()
    {
        return $this->db->from('eleve')->count_all_results();
    }
    public function compter_enseignant()
    {
        return $this->db->from('enseignant')->count_all_results();
    }

    public function nombre_classe()
    {
        $this->db->from('filier');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function moyenne_eleve($result)
    {
        $this->db->select('AVG(note) As moyenne');
       $this->db->from('note');
       $this->db->join('filier','note.code_filiere=filier.code_filier');
       $this->db->where('nom_filier',$result);
       $query=$this->db->get();
       return $query->row();
    }

    

}