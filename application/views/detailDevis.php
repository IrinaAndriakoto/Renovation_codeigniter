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
        <th>Batiment</th>
        <th>Finition</th>
        <th>Date Début</th>
        <th>Date Fin</th>
        <th>Cout Total</th>
        <th>État</th>
    </tr>
    <?php foreach ($dev as $d): ?>
    <tr>
    <td><a href="<?php echo site_url('AdminController/afficher_details/' . $d->IdDevise); ?>"><?php echo $d->IdDevise; ?></a></td>
        <td><?php echo $d->idclient; ?></td>
        <td><?php echo $d->nom; ?></td>
        <td><?php echo $d->batiment; ?></td>
        <td><?php echo $d->finition; ?></td>
        <td><?php echo $d->date_debut; ?></td>
        <td><?php echo $d->date_fin; ?></td>
        <td><?php echo $d->couttotal; ?></td>
        <td><?php echo $d->etat; ?></td>
        <td><a href="<?php echo site_url('PdfController/generate_pdf'); ?>">Export PDF</a></td>
    </tr>
    <?php endforeach; ?>
</table>
<p><a href="<?php echo site_url('Welcome/admin_dashboard') ?>">Retour</a></p>

</body>
</html>