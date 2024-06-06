<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Travaux_md extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function compter_projets_en_cours() {
        $this->db->where('etat', 'en cours');  // Remplacez 'etat' par le nom de votre colonne d'état
        $this->db->from('projet');
        return $this->db->count_all_results();
    }

}