<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.css') ?>">
    <!-- <link rel="stylesheet" href="../../assets/main.css"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/js/jquery-3.5.1.js') ?>">

</head>
<body> <br> <br>
    <h4 style="text-align: center;color:#1065ab;">Paiement des devis.</h4> <br> 
    <form id="paymentForm" action="<?php echo site_url('DevisController/payer') ?>" method="post">
    <?php foreach ($devis as $d): ?>
        <div class="devisApayer" >
            <input type="hidden" name="IdDevises" value="<?php echo $d->IdDevise; ?>">
            <input type="hidden" name="restepp" value="<?php echo $d->resteapayer; ?>">
            <table class="table table-striped">
    <tr>
        <th>Id Devis</th>
        <th>Id Client</th>
        <th>Nom du Client</th>
        <th>Id Batiment</th>
        <th>Batiment</th>
        <th>Finition</th>
        <th>Durée</th>
        <th>Date Début</th>
        <th>Date Fin</th>
        <th>Cout Total</th>
        <th>Reste A Payer</th>
        <th>Date de paiement</th>
        <th>Montant</th>
        <th></th>
    </tr>
    <tr class="table-light">
        <td><?php echo $d->IdDevise; ?></td>
        <td><?php echo $d->idclient; ?></td>
        <td><?php echo $d->nom; ?></td>
        <td><?php echo $d->idbatiment; ?></td>
        <td><?php echo $d->batiment; ?></td>
        <td><?php echo $d->finition; ?></td>
        <td><?php echo $d->duree; ?></td>
        <td><?php echo $d->date_debut; ?></td>
        <td><?php echo $d->date_fin; ?></td>
        <td><?php echo $d->couttotal; ?></td>
        <td><?php echo $d->resteapayer; ?></td>
        <td><input type="date" name="datePa"></td>
        <td><input type="text" name="montanttt"></td>
        <td><input type="submit" value="Payer"></td>
    </tr>
</table>
        </div>
        <?php endforeach; ?>
    <p><a href="<?php echo site_url('Welcome/user_dashboard') ?>">Retour</a></p>
</form>

<script>
$(document).ready(function() {
    $('#paymentForm').on('submit', function(e) {
        e.preventDefault();

        var montant = parseFloat($('input[name="montanttt"]').val());
        var resteapayer = parseFloat($('input[name="restepp"]').val());

        if (montant > resteapayer) {
            alert('Le montant à payer ne peut pas être supérieur au montant restant à payer.');
        } else {
            $.ajax({
                url: '<?php echo site_url('DevisController/payer') ?>',
                type: 'post',
                data: $(this).serialize(),
                success: function() {
                    alert('Paiement effectué avec succès.');
                    location.reload();
                }
            });
        }
    });
});
</script>

</body>
</html>