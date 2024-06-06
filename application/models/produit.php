<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produit extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getAllProd() {
        $query = $this->db->get('produits');  // 'produits' est le nom de votre table
        return $query->result();
    }
}
