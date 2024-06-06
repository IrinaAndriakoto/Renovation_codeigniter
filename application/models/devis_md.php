<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class devis_md extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getAllDevis(){
        $query=$this->db->get('v_devisfinale');
        return $query->result();
    }

    // public function getDevisById($id){
    //     $this->db->where('id',$id);
    //     $query=$this->db->get('v_devis');

    //     if ($query->num_rows() == 1) {
    //         $devis = $query->row();
    //         return $devis;
    //     } else {
    //         return false;
    //     }
    // }

    public function get_devis_by_client($client_name) {
        $this->db->select('*');
        $this->db->from('v_devisfinale');
        $this->db->where('nom', $client_name);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_finitions() {
        $query = $this->db->get('finition');
        return $query->result();
    }

    public function getClients(){
        $this->db->select('*');
         $this->db->from('utilisateur');
         $this->db->where('role','client');
         $query = $this->db->get();
        return $query->result();

    }

    public function getBatiment(){
        $query = $this->db->get('typebatiment');
        return $query->result();
    }
    public function getCoutTotal(){
        $query = $this->db->get('v_batimentcout');
        return $query->result();
    }
    
    public function get_duree($idbatiment) {
        $query = $this->db->get_where('v_batimentcout', array('idbatiment' => $idbatiment));
        $result = $query->row();
        return $result->duree;
    }
    public function get_couttotal($idbatiment){
        $query = $this->db->get_where('v_batimentcout', array('idbatiment' => $idbatiment));
        $result = $query->row();
        return $result->couttotal;
    }
    public function getCoutTotalDevis($iddevise){
        $query=$this->db->get_where('v_devisfinale',array('iddevise'=>$iddevise));
        $result = $query->row();
        return $result->resteapayer;
    }

    public function get_gaintemps($idfinition) {
        $query = $this->db->get_where('finition', array('id' => $idfinition));
        $result = $query->row();
        return $result->gaintemps;
    }
    public function get_augmentation_prix($idfinition){
        $query = $this->db->get_where('finition',array('id' =>$idfinition));
        $result = $query->row();
        return $result->augmentationprix;
    }
    public function insert_demande($idclient, $idfinition, $idbatiment, $date_debut, $date_fin,$couttotal_ajuste) {
        $data = array(
            'idclient' => $idclient,
            'idfinition' => $idfinition,
            'idbatiment' => $idbatiment,
            'date_debut' => $date_debut,
            'date_fin' => $date_fin,
            'couttotal' => $couttotal_ajuste,
            'etat' => 'en cours',
            'resteapayer'=>$couttotal_ajuste
        );
        $this->db->insert('devis', $data);
    }

    public function getDevisGroupByClient($client){
        $this->db->select('*');
        $this->db->from('v_devisfinale');
        $this->db->group_by('IdDevise');
        $this->db->having('nom',$client);

        $query = $this->db->get();
        return $query->result();
    }
    public function getDevisById($id){
        $this->db->select('*');
        $this->db->from('v_devisfinale');
        $this->db->group_by('IdDevise');
        $this->db->having('IdDevise',$id);

        $query = $this->db->get();
        return $query->result();
    }
    public function getDevisByIdDetails(){
        $this->db->select('*');
        $this->db->from('v_devisfinale');
        $this->db->group_by('IdDevise');

        $query = $this->db->get();
        return $query->result();
    }
    public function getAllDetailsDevis($id){
        $this->db->select('*');
        $this->db->from('v_devisfinale');
        $this->db->where('iddevise', $id);
        $query = $this->db->get();
        return $query->result();
    }


    public function insert_paiement($IdDevise, $paye, $dateP) {
        // Vérifier si la table 'paiement' est vide
        $query = $this->db->get('paiement');
        if ($query->num_rows() == 0) {
            // Si la table est vide, définir le nouvel ID paiement sur 1
            $new_idpaiement = 1;
        } else {
            // Sinon, récupérer la valeur maximale actuelle de la colonne 'idpaiement' dans la table 'paiement'
            $query = $this->db->select_max('idpaiement')->get('historiquepaiement');
            $row = $query->row();
            $max_idpaiement = $row->idpaiement;
            
            // Ajouter 1 pour obtenir le nouvel ID du paiement
            $new_idpaiement = $max_idpaiement + 1;
        }
    
        // Insérer les données dans la table 'paiement'
        $data = array(
            'iddevis' => $IdDevise,
            'paye' => $paye,
            'datepaiement' => $dateP
        );
        $this->db->insert('paiement', $data);
    
        // Insérer également les données dans la table 'historiquepaiement'
        $data1 = array(
            'idpaiement' => $new_idpaiement,
            'datepaiement' => $dateP
        );
        $this->db->insert('historiquepaiement', $data1);
    }
    public function updateResteAPayer($id, $montant) {
        $data = array('resteapayer' => $montant);
        $this->db->where('id', $id);
        $this->db->update('devis', $data);
    }
}