<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/bootstrap.css">
    <title>Document</title>
</head>
<body>
<table >
    <tr>
        <th>Id Devis</th>
        <th>Id Client</th>
        <th>Nom du Client</th>
        <th>Id Batiment</th>
        <th>Id travaux</th>
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
        <th>État</th>
        <th>Reste A Payer</th>
    </tr>
    <?php foreach ($devis as $d): ?>
    <tr>
    <input type="hidden" name="IdDevisesss" value="<?php echo $d->IdDevise; ?>">
        <td><?php echo $d->IdDevise; ?></td>
        <td><?php echo $d->idclient; ?></td>
        <td><?php echo $d->nom; ?></td>
        <td><?php echo $d->idbatiment; ?></td>
        <td><?php echo $d->id; ?></td>
        <td><?php echo $d->batiment; ?></td>
        <td><?php echo $d->finition; ?></td>
        <td><?php echo $d->typetravaux; ?></td>
        <td><?php echo $d->codetravaux; ?></td>
        <td><?php echo $d->designation; ?></td>
        <td><?php echo $d->unite; ?></td>
        <td><?php echo $d->quantite; ?></td>
        <td><?php echo $d->duree; ?></td>
        <td><?php echo $d->date_debut; ?></td>
        <td><?php echo $d->date_fin; ?></td>
        <td><?php echo $d->couttotal; ?></td>
        <td><?php echo $d->etat; ?></td>
        <td><?php echo $d->resteapayer; ?></td>
        <td><a href="<?php echo site_url('PdfController/generate_pdf?IdDevisesss=' . $d->IdDevise); ?>">Export PDF</a></td>
    </tr>
    <?php endforeach; ?>
</table>
<a href="<?php echo site_url('DevisController/paiement'); ?>">Effectuer un paiement</a>

<p><a href="<?php echo site_url('Welcome/user_dashboard') ?>">Retour</a></p>

</body>
</html>