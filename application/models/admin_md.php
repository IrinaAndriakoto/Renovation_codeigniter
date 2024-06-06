<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_md extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getHistoriquePaiement(){
        $this->db->select('*');
        $this->db->from('v_paiementdevis');

        $query = $this->db->get();
        return $query->result();
    }

    public function get_montant_par_mois($year) {
//         $year = 2024; // Année spécifiée
//         $months = range(1, 12);


//         $query = $this->db->query("
//         SELECT MONTH(date_debut) AS month, SUM(couttotal) AS total
// FROM Months
// LEFT JOIN v_devisfinale ON MONTH(v_devisfinale.date_debut) = Months.month AND YEAR(v_devisfinale.date_debut) = 2024
// GROUP BY month
// HAVING total > 0
// ORDER BY month ASC;
//         ", [$year]);
// $results = $query->result_array();

$this->db->select('MONTH(date_debut) as month, SUM(couttotal) as total');
$this->db->from('v_devisfinale');
$this->db->where('YEAR(date_debut)', $year);
$this->db->group_by('month');
$query = $this->db->get();
return $query->result_array();
    }
    
    
    public function get_montant($year) {
        $this->db->select('MONTH(date_debut) as month, SUM(couttotal) as total');
        $this->db->from('v_devisfinale');
        $this->db->where('YEAR(date_debut)', $year);
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
}