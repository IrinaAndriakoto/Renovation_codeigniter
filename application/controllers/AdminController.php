<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('admin_md'); // Charger le modèle de connexion
        $this->load->helper('url');
        // date_default_timezone_set('UTC');
    }

    public function listePaiement(){
		$this->load->model('admin_md');
        $data['histo'] = $this->admin_md->getHistoriquePaiement();
        $this->load->view('paiementadmin',$data); // Charger le modèle utilisateur

    }

    public function detailDevis(){
        $this->load->model('devis_md');
        $data['dev'] = $this->devis_md->getDevisByIdDetails();
        $this->load->view('detailDevis',$data);
    }

    public function afficher_details($IdDevise) {
        // Charger le modèle
        $this->load->model('devis_md');
    
        // Récupérer les détails du devis
        $data['devi'] = $this->devis_md->getAllDetailsDevis($IdDevise);
    
        // Afficher la vue avec les détails du devis
        $this->load->view('afficher_details', $data);
    }

    public function histogramme() {
        $this->load->model('admin_md');
        // $year=2024;
        $data['m'] = $this->admin_md->get_montant(2024);  // Remplacez par l'année de votre choix
        $this->load->view('histogramme', $data);
    }
    
}