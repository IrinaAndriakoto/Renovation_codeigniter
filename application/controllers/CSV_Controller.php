<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CSV_Controller extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('csvimport'); 
    }

    public function process_csv() {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = '*';
        $this->load->library('upload', $config);
    
        // Define an array of file input names and corresponding import functions
        $files_to_import = array(
            'csv_file_maison' => 'import_data_maison',
            'csv_file_devis' => 'import_data_devis',
            // Add more file input names and functions as needed
        );
    
        foreach ($files_to_import as $file_input_name => $import_function) {
            if (!$this->upload->do_upload($file_input_name)) {
                $error = $this->upload->display_errors();
                echo "Erreur lors du téléchargement du fichier CSV pour $file_input_name : $error";
            } else {
                $data = $this->upload->data(); 
                $file_path = $data['full_path'];
    
                $import_result = $this->csvimport->$import_function($file_path); 
    
                if (!$import_result) {
                    echo "Erreur lors de l'importation des données CSV pour $file_input_name.";
                } else {
                    echo "Importation des données CSV pour $file_input_name réussie.";
                    redirect('Admin/dashboard');
                }
            }
        }
    
    
        // Vérifier et traiter le fichier CSV pour les devis
        if (!$this->upload->do_upload('csv_file_devis')) {
            $error = $this->upload->display_errors();
            echo "Erreur lors du téléchargement du fichier CSV pour les devis : $error";
        } else {
            $data = $this->upload->data();
            $file_path_devis = $data['full_path'];
    
            $import_result_devis = $this->csvimport->import_data_devis($file_path_devis); 
    
            if (!$import_result_devis) {
                echo "Erreur lors de l'importation des données CSV pour les devis.";
            } else {
                echo "Importation des données CSV pour les devis réussie.";
                redirect('Admin/dashboard');
            }
        }}
    
    
    // public function process_csv() {
    //     $config['upload_path'] = './uploads/';
    //     $config['allowed_types'] = 'csv';
    //     $this->load->library('upload', $config);

    //     if (!$this->upload->do_upload('csv_file_maison')) {
    //         $error = $this->upload->display_errors();
    //         echo "Erreur lors du téléchargement du fichier CSV : $error";
    //     } else {
    //         $data = $this->upload->data();
    //         $file_path = $data['full_path'];

    //         $import_result = $this->csvimport->import_data_maison($file_path); 

    //         if (!$import_result) {
    //             echo "Erreur lors de l'importation des données CSV.";
    //         } else {
    //             echo
    //             redirect('Admin/dashboard'); 
    //         }
    //     }
    // }

    // public function devis_csv() {
    //     $config['upload_path'] = './uploads/';
    //     $config['allowed_types'] = 'csv';
    //     $this->load->library('upload', $config);

    //     if (!$this->upload->do_upload('csv_file_devis')) {
    //         $error = $this->upload->display_errors();
    //         echo "Erreur lors du téléchargement du fichier CSV : $error";
    //     } else {
    //         $data = $this->upload->data();
    //         $file_path = $data['full_path'];

    //         $import_result = $this->csvimport->import_data_devis($file_path); 

    //         if (!$import_result) {
    //             echo "Erreur lors de l'importation des données CSV.";
    //         } else {
    //             echo
    //             redirect('Admin/dashboard');
    //         }
    //     }
    // }

    public function paiement_csv() {
    $config['upload_path'] = './uploads/';
    $config['allowed_types'] = 'csv';
    $this->load->library('upload', $config);

    if (!$this->upload->do_upload('csv_file_paiement')) {
        $error = $this->upload->display_errors();
        echo "Erreur lors du téléchargement du fichier CSV : $error";
    } else {
        $data = $this->upload->data();
        $file_path_paiement = $data['full_path'];

        $import_result_paiement = $this->csvimport->import_paiement($file_path_paiement);

        if (!$import_result_paiement) {
            echo "Erreur lors de l'importation des données CSV pour les paiements.";
        } else {
            echo "Importation des données CSV pour les paiements réussie.";
            redirect('Admin/dashboard');
        }
    }
}

}

