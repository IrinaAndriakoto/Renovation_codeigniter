<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MaisonController extends CI_Controller {

public function __construct() {
    parent::__construct();
    $this->load->database();
    $this->load->helper('url');
    $this->load->library('csvimport');
    $this->load->helper('file');
    $this->load->library('upload');
}
    public function index(){
        $this->load->view('importations');
    }

    // public function import() {
    //     global $num_maison;
    //     $num_maison = 4; // Commencez à 1 pour "BAT01"

    //     global $num_tv;
    //     $num_tv=8;

    //     if ($this->input->post()) {
    //         $config['upload_path'] =  './uploads/';
    //         $config['allowed_types'] = 'csv';
    //         $config['max_size'] = 1024;

    //         $this->load->library('upload', $config);
    //         $this->upload->initialize($config);
    //         if (!$this->upload->do_upload('fichier')) {
    //             $error = array('error' => $this->upload->display_errors());
    //             $this->session->set_flashdata('error', $this->upload->display_errors());
    //             print_r($error); // Affiche les erreurs de téléchargement
    //             exit(); // Arrête l'exécution du script
    //         } else {
    //             $file = $this->upload->data();
    //             // Continuez avec la lecture du fichier CSV
    //             $csvFilePath = $file['full_path'];
    //             $csvFileName = $file['file_name'];
    //             $destination = '.uploads/' . $csvFileName;
    //             copy($csvFilePath,$destination);
    //             $data = $this->upload->data();
    //             $csvFF = $data['full_path'];
    //             $csvFileOp = fopen($file['full_path'], 'r');

    //             $header = fgetcsv($csvFileOp);
    //             while ($row = fgetcsv($csvFileOp)) {
    //                 // global $num_maison;
    //                 $num_maison++; // Augmente le numéro de maison
    //                 $num_tv++;
    //                 // Préfixez le numéro avec "BAT" et convertissez en chaîne pour obtenir l'ID complet
    //                 $id_maison = "BAT".$num_maison;
    //                 // $id_tv="T".$num_tv;
    //                 $data_maison = array(
    //                     'id' => $id_maison,
    //                     'designation' => $row['designation'],
    //                     'duree' => $row['duree'],
    //                     'description'=>$row['description'] ,
    //                     'surface'=>$row['surface']
    //                 );
                    
    //                 // $data_travail = array(
    //                 //     'id' =>$id_tv,
    //                 //     'typetravaux' => $row['typetravaux'],
    //                 //     'codetravaux' => $row['codetravaux'],
    //                 //     'designation'=>$row['designation'],
    //                 //     'unite' =>$row['unite'],
    //                 //     'duree'=>$row['duree']
    //                 //     // Assurez-vous que cela correspond à l'ID de la maison liée
    //                 //     // Ajoutez d'autres attributs spécifiques aux travaux ici
    //                 // );

    //                 // $data_devis = array(
    //                 //     'id' => $row['id'],
    //                 //     'idClient' => $row['idClient'],
    //                 //     'date_debut' => $row['date_debut'],
    //                 //     'etat' => $row['etat'],
    //                 //     'date_fin' => $row['date_fin'],
    //                 //     'couttotal' => $row['couttotal'],
    //                 //     'idfinition' => $row['idfinition'],
    //                 //     'idbatiment' => $row['idbatiment'],
    //                 //     'resteapayer' => $row['resteapayer']
    //                 // );
    //                 try {
    //                     $this->import_md->import_data('typebatiment', $data_maison);
    //                 } catch (Exception $e) {
    //                     echo "Erreur lors de l'insertion des données : ". $e->getMessage();
    //                 }
    //                 // $this->import_md->import_data($data_travail);
    //                 // $this->import_md->import_data($data_devis);


    //             }
    //             fclose($csvFile);
    //         }
    //     }

        
    // }

    public function importcsv(){
        $csv_file = $_FILES['csv_file'];
        $csv_file2 = $_FILES['csv_file2'];
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'csv';
        $config['max_size'] = 1024;
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('csv_file')) {
            $error = $this->upload->display_errors();
            echo $error;
        } else {
            $upload_data = $this->upload->data();
            $csv_file_temp_path = $upload_data['full_path'];
            $csv_file_name = $upload_data['file_name'];
            $destination_path = './uploads/csv/' . $csv_file_name;
            copy($csv_file_temp_path, $destination_path);
            $data = $this->upload->data();
            $csv_file = $data['full_path'];  
            $this->projet->importcsv($csv_file);
        }
        if (!$this->upload->do_upload('csv_file2')) {
            $error = $this->upload->display_errors();
            echo $error;
        } else {
            $upload_data = $this->upload->data();
            $csv_file_temp_path = $upload_data['full_path'];
            $csv_file_name = $upload_data['file_name'];
            $destination_path = './uploads/csv/' . $csv_file_name;
            copy($csv_file_temp_path, $destination_path);
            $data = $this->upload->data();
            $csv_file2 = $data['full_path'];
            $this->projet->importcsv2($csv_file2);
        }
        redirect('index');
    }
    
}