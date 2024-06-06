<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DevisController extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('devis_md'); // Charger le modèle de connexion
        $this->load->library('session');
        $this->load->helper('url');
        date_default_timezone_set('UTC');
    }

    public function index(){
        $data['devis'] = $this->devis_md->getAllDevis();
        $this->load->view('devis',$data);
    }

    public function devisClient(){
        $this->load->model('devis_md');
        $cust=$this->session->userdata('nom');
        $data['devis'] = $this->devis_md->getDevisGroupByClient($cust);
        $this->load->view('devis',$data);
    }
    
    public function newDevis(){
        $data['finitions'] = $this->devis_md->get_finitions();
        $data['batiments'] = $this->devis_md->getBatiment();
        $data['couts'] = $this->devis_md->getCoutTotal();
        $data['clients'] = $this->devis_md->getClients();
        $this->load->view('newDevis',$data);
    }
    public function submit_demande() {
        // Récupérer les données du formulaire
        $idclient = $this->input->post('client');
        $idfinition = $this->input->post('finition');
        $idbatiment = $this->input->post('batiment');
        $date_debut = $this->input->post('datetrav');

        // Calculer la date de fin
        $duree_batiment = $this->devis_md->get_duree($idbatiment);
        $gaintemps_finition = $this->devis_md->get_gaintemps($idfinition);
        $date_fin = date('Y-m-d', strtotime($date_debut . ' + ' . ($duree_batiment - $gaintemps_finition) . ' days'));

        // Calculer le coût total ajusté en fonction de l'augmentation de prix de la finition
        $couttotal = $this->devis_md->get_couttotal($idbatiment);
        $augmentation_prix = $this->devis_md->get_augmentation_prix($idfinition);
        $couttotal_ajuste = $couttotal * ($augmentation_prix / 100 + 1);

        // Insérer les données dans la base de données
        $this->devis_md->insert_demande($idclient, $idfinition, $idbatiment, $date_debut, $date_fin,$couttotal_ajuste);

        // Rediriger vers la page d'accueil ou afficher un message de succès
        redirect('Welcome/user_dashboard');
    }
    public function paiement() {
        $this->load->model('devis_md');
        $cust = $this->session->userdata('nom');
        $data['devis'] = $this->devis_md->getDevisGroupByClient($cust);
        
        // Pass the retrieved data to the view
        $this->load->view('paiement', $data);
    }
    

    public function payer() {
        // Récupérer les données du formulaire
        $montant = $this->input->post('montanttt');
        $dateP = $this->input->post('datePa');
        $IdDevise = $this->input->post('IdDevises');
    
        $this->load->model('devis_md');
        $couttotal = $this->devis_md->getCoutTotalDevis($IdDevise);

        if ($montant > $couttotal) {
            echo "Le montant du paiement ne peut pas être supérieur au coût total.";
            return;
        } else{

        // Soustraire le montant payé du coût total
        $nouveauCouttotal = $couttotal - $montant;
    
    
        $this->devis_md->insert_paiement($IdDevise, $montant, $dateP);
        $this->devis_md->updateResteAPayer($IdDevise, $nouveauCouttotal);
        }
        redirect('Welcome/user_dashboard');
    }
    
}