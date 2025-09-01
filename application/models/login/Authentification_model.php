<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Authentification_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

public function ajouter($data)
    {
       return $this->db->insert('utilisateur',$data);
    }

    public function get_util()
    {
        $query= $this->db->get('utilisateur');
         return $query->result_array();
    }

    public function authentifier($nom, $mot){
        $this->db->where('nomUtilisateur',$nom);
        $query=$this->db->get('utilisateur');
        if($query->num_rows()==1){
            $utilisateur=$query->row();
            if(password_verify($mot,$utilisateur->password)){
                return $utilisateur;
            }
        }
        return false;
    }
}