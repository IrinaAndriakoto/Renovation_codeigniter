<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'helpers/tcpdf/tcpdf.php'); // Inclure la bibliothèque TCPDF

class PdfController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Charger le modèle ou toute autre source de données nécessaire
        $this->load->model('devis_md');
        // $this->load->library('MYPDF')
        $this->load->library('tcpdf');
        date_default_timezone_set('UTC');

    }
 
    public function generate_pdf() {
        $id=$this->input->get('IdDevisesss');
        // Récupérer les données à afficher dans le PDF depuis le modèle
        $data['devis'] = $this->devis_md->getAllDetailsDevis($id); // Supposons que votre modèle récupère les données de devis

        // Créer une nouvelle instance de TCPDF
        $pdf = new TCPDF('L',PDF_UNIT,PDF_PAGE_FORMAT,true,'UTF-8',false);

        // Définir le format de la page et l'orientation (ici, A4 en mode portrait)
        // $pdf->setPaper('A4', 'portrait');
        // Définir le titre du document
        $pdf->SetTitle('Devis BTP');

        // Ajouter une page au document
        $pdf->AddPage();

        // Convertir le tableau HTML en PDF
        $html = '<table border="1">
                    <tr>
                        <th>Nom du Client</th>
                        <th>Id Batiment</th>
                        <th>Batiment</th>
                        <th>Finition</th>
                        <th>Type du Travail</th>
                        <th>Code Travaux</th>
                        <th>Designation</th>
                        <th>Unite</th>
                        <th>Quantité</th>
                        <th>Durée</th>
                        <th>Date Début</th>
                        <th>Date Fin</th>
                        <th>Cout Total</th>
                    </tr>';
        foreach ($data['devis'] as $d) {
            $html .= '<tr>
                        <td>'.$d->nom.'</td>
                        <td>'.$d->idbatiment.'</td>
                        <td>'.$d->batiment.'</td>
                        <td>'.$d->finition.'</td>
                        <td>'.$d->typetravaux.'</td>
                        <td>'.$d->codetravaux.'</td>
                        <td>'.$d->designation.'</td>
                        <td>'.$d->unite.'</td>
                        <td>'.$d->quantite.'</td>
                        <td>'.$d->duree.'</td>
                        <td>'.$d->date_debut.'</td>
                        <td>'.$d->date_fin.'</td>
                        <td>'.$d->couttotal.'</td>
                    </tr>';
        }
        $html .= '</table>';

        // Ajouter le contenu HTML au PDF
        $pdf->writeHTML($html, true, false, true, false, '');

        // Enregistrer le PDF dans un fichier et le télécharger
        $pdf->Output('devis_btp.pdf', 'D');
    }
}
?>
