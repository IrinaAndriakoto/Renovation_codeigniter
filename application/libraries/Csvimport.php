<?php
defined('BASEPATH') or exit('No direct script access allowed');

class csvimport
{
    protected $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->load->database();
    }

    public function import_data_maison($file_path_maison)
    {
        if (!file_exists($file_path_maison)) {
            return false;
        }
    
        $file_content = file_get_contents($file_path_maison);
    
        if (empty($file_content)) {
            return false;
        }

        $csv_lines = explode(PHP_EOL, $file_content);

        global $num_tv;
        $num_tv=8;
        global $num_maison;
        $num_maison=0;
        for ($i = 1; $i < count($csv_lines); $i++) {
            $line = $csv_lines[$i];

            // Ignorer les lignes vides
            if (!empty($line)) {
                // Exploder chaque ligne en un tableau de valeurs CSV
                $csv_values = str_getcsv($line);

                $num_maison++; // Augmente le numéro de maison
            // Préfixez le numéro avec "BAT" et convertissez en chaîne pour obtenir l'ID complet
            $id_maison = "BAT".$num_maison;
                // Insérer les valeurs dans la table maisons
                $maisons_data = array(
                    'id' => $id_maison,
                    'designation' => $csv_values[0], // Colonne 'type'
                    'description' => $csv_values[1], // Colonne 'description'
                    'surface' => $csv_values[2], // Colonne 'surface'
                    'duree' => $csv_values[8], // Colonne 'cout_construction'
                    // 'duree' => $csv_values[4] // Colonne 'duree_construction'
                );

                $this->CI->db->insert('typebatiment', $maisons_data);

                $num_tv++; // Augmente le numéro de maison
            // Préfixez le numéro avec "BAT" et convertissez en chaîne pour obtenir l'ID complet
            $id_tv = "T0".$num_tv;
                // Insérer les valeurs dunans la table travaux
                $travaux_data = array(
                    'id' => $id_tv,
                    'designation' => $csv_values[4], // Colonne 'type_travaux'
                    'code_travaux' => $csv_values[3], // Colonne 'code_travaux'
                    'unite' => $csv_values[5],
                    'duree' => $csv_values[8]
                );

                $this->CI->db->insert('test_import_travaux', $travaux_data);

                // $maison_travaux_data = array(
                //     'id_maison' => $this->CI->db->insert_id(),
                //     'id_travaux' => $this->CI->db->insert_id() 
                // );

                // $this->CI->db->insert('maison_travaux', $maison_travaux_data);
            }
        }

        return true;
    }

    public function import_data_devis($file_path_devis)
    {
        if (!file_exists($file_path_devis)) {
            return false;
        }
    
        $file_content = file_get_contents($file_path_devis);
    
        if (empty($file_content)) {
            return false;
        }

        $csv_lines = explode(PHP_EOL, $file_content);

        for ($i = 1; $i < count($csv_lines); $i++) {
            $line = $csv_lines[$i];

            if (!empty($line)) {
                $csv_values = str_getcsv($line);

                $devis_data = array(
                    'type_maison' => $csv_values[0],
                    'type_finition' => $csv_values[1],
                    'date_debut' => $csv_values[2],
                    'client_id' => $csv_values[3],
                    'id_travaux' => $csv_values[4],
                    'total' => $csv_values[5],
                    'date_fin' => $csv_values[6]
                );

                $this->CI->db->insert('devis', $devis_data);
            }
        }
        return true;
    }

    public function import_data_detail_travaux($file_path_detail_travaux)
    {
        if (!file_exists($file_path_detail_travaux)) {
            return false;
        }
    
        $file_content = file_get_contents($file_path_detail_travaux);
    
        if (empty($file_content)) {
            return false;
        }

        $csv_lines = explode(PHP_EOL, $file_content);

        for ($i = 1; $i < count($csv_lines); $i++) {
            $line = $csv_lines[$i];

            if (!empty($line)) {
                $csv_values = str_getcsv($line);

                $detail_travaux_data = array(
                    'id_travaux' => $csv_values[0],
                    'designation' => $csv_values[1],
                    'PU' => $csv_values[2],
                    'Unite' => $csv_values[3],
                    'quantite' => $csv_values[4],
                    'Total' => $csv_values[5]
                );

                $this->CI->db->insert('detail_travaux', $detail_travaux_data);
            }
        }
        return true;
    }

    public function import_data_paiements($file_path_paiements)
    {
        if (!file_exists($file_path_paiements)) {
            return false;
        }
    
        $file_content = file_get_contents($file_path_paiements);
    
        if (empty($file_content)) {
            return false;
        }

        $csv_lines = explode(PHP_EOL, $file_content);

        for ($i = 1; $i < count($csv_lines); $i++) {
            $line = $csv_lines[$i];

            if (!empty($line)) {
                $csv_values = str_getcsv($line);

                $paiements_data = array(
                    'date_paiement' => $csv_values[0],
                    'montant' => $csv_values[1],
                    'client_id' => $csv_values[2],
                    'devis_id' => $csv_values[3]
                );

                $this->CI->db->insert('Paiements', $paiements_data);
            }
        }
        return true;
    }
}
