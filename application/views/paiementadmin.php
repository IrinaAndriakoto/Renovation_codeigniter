<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <tr>
            <th>id paiement</th>
            <th>id devis</th>
            <th>Date paiement</th>
            <th>idclient</th>
            <th>nom</th>
            <th>id batiment</th>
            <th>Batiment</th>
            <th>Finition</th>
            <th>Cout total</th>
            <th>Reste a payer</th>
            <th>Etat devis</th>
            <th>Progression Paiement (%)</th>
        </tr>
        <?php foreach ($histo as $h): ?>
        <tr>
            <td><?php echo $h->idpaiement; ?></td>
            <td><?php echo $h->iddevis; ?></td>
            <td><?php echo $h->datepaiement; ?></td>
            <td><?php echo $h->idclient; ?></td>
            <td><?php echo $h->nom; ?></td>
            <td><?php echo $h->idbatiment; ?></td>
            <td><?php echo $h->batiment; ?></td>
            <td><?php echo $h->finition; ?></td>
            <td><?php echo $h->couttotal; ?></td>
            <td><?php echo $h->resteapayer; ?></td>
            <td><?php echo $h->etat; ?></td>
            <td><?php echo $h->progressionpaiement ?></td>

        </tr>
        <?php endforeach; ?>
    </table>
    <p><a href="<?php echo site_url('Welcome/admin_dashboard') ?>">Retour</a></p>

</body>
</html>