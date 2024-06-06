<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_md extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function authentifier_admin($nom, $mot_de_passe) {
        $this->db->where('nom', $nom);
        $this->db->where('motdepasse', $mot_de_passe);
        $query = $this->db->get('utilisateur');
    
        if ($query->num_rows() == 1) {
            $utilisateur = $query->row();
            return $utilisateur;
        } else {
            return false;
        }
    }
    
    public function authentifier_client($contact, $mot_de_passe) {
        $this->db->where('contact', $contact);
        $this->db->where('motdepasse', $mot_de_passe);
        $query = $this->db->get('utilisateur');
    
        if ($query->num_rows() == 1) {
            $admin = $query->row();
            return $admin;
        } else {
            return false;
        }
    }
    


}
