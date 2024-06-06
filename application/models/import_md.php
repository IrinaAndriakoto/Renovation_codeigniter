<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class import_md extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // public function import_data($table, $data) {
    //     // Vérifiez si la table existe et est valide
    //     if (!in_array($table, ['typebatiment'])) {
    //         throw new Exception("Table invalide");
    //     }

    //     // Construisez la requête SQL d'insertion
    //     $this->db->set($data);
    //     $this->db->insert($table);

    //     // Retournez le dernier ID inséré (si applicable)
    //     return $this->db->insert_id();
    // }

    // public function insert_maison($data) {
    //     // Construit la requête SQL d'insertion
    //     // $this->db->set($data);
    //     $this->db->insert_batch('typebatiment',$data);

    //     // Retourne le dernier ID inséré (si applicable)
    //     return $this->db->insert_id();
    // }

    public function importcsv($csvfile) {
        $filehandle = fopen($csvfile, 'r');
        $i = 0;
    global $num_maison;
                     $num_maison++; // Augmente le numéro de maison
                     $num_tv++;
                 // Préfixez le numéro avec "BAT" et convertissez en chaîne pour obtenir l'ID complet
                 $id_maison = "BAT".$num_maison;
                 // $id_tv="T".$num_tv;
                 $this->db->insert('devis', array(

                     'id' => $id_maison,
                     'designation' => $row['designation'],
                     'duree' => $row['duree'],
                     'description'=>$row['description'] ,
                     'surface'=>$row['surface']
                 ));
        fclose($filehandle);
        $sql = "insert into finition (nom,pourcentage) 
                select distinct client , client from devis;";
        $this->db->query($sql);
        $sql = "insert into finition(nom,pourcentage)
                select distinct finition, taux_finition from devis";
        $this->db->query($sql);
        $sql = "insert into projeclient(idprojet,idclient,idfinition,prix,pourcentage,duree,datedebut,references,datedevis,lieu)
                select idprojet,idclient,idfinition,0,taux_finition,duree,date_debut,ref_devis,date_devis,lieu from devis";
        $this->db->query($sql);
        $sql = "insert into projetclienttravaux (idprojetclient,idprojet,idtravaux,numero,nom,prix,idunite,quantite)
                select * from v_projetclienttravaux";
        $this->db->query($sql);
    }
}