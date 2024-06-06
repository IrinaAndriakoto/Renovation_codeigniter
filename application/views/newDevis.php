<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/bootstrap.css">

    <title>Document</title>
</head>
<style>
    table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}

th {
  background-color: #4CAF50;
  color: white;
}

.offre{
    text-align: center;
    width: 500px;
    margin-left: 500px;
    margin-top: 50px;
}
</style>
<body>
    <h6 style="text-decoration:underline;text-align:center;">Nos offres : </h6> <br>
<table>
  <thead>
  <tr>
      <th></th>
      <th>Standard</th>
      <th>Gold</th>
      <th>Premium</th>
      <th>VIP</th>
    </tr>
    <tr>
      <td>Type</td>
      <td>Plan de maison simple</td>
      <td>Plan de maison standard</td>
      <td>Plan de maison sur mesure</td>
      <td>Plan de maison par un architecte</td>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Realisation des plans</td>
      <td>Coupe et façade issues d’un catalogue</td>
      <td>Plan complet pour dépôt permis de construire</td>
      <td>Plan sur mesure et aide à la demande de permis de construire</td>
      <td>Plan en détails, accompagnement personnalisé pour constitution dossier de demande de permis de construire</td>
    </tr>
    <tr>
      <td>Prix TVA</td>
      <td>20%</td>
      <td>20%</td>
      <td>20%</td>
      <td>20%</td>
    </tr>
  </tbody>
</table>
<h5>Nos batiments : </h5>
<?php foreach ($batiments as $b): ?>
    <p><?php echo $b->designation ?></p>
    <p>Surface : <?php echo $b->surface ?> m2</p>
    <p><?php echo $b->description ?></p>
    <?php endforeach; ?>
    <h5>Devis standard pour:</h5>
    <?php foreach ($couts as $cout): ?>
        
        <ul>
            <li><Strong><?php echo $cout->designation; ?></Strong> : </li>
            <p> Durée de construction : <?php echo $cout->duree ?> jours</p>
            <p>Total travaux : <?php echo $cout->couttotal ?> Ariary </p>
        </ul>  
        <?php endforeach; ?>
    <div class="offre">
    <fieldset style="text-align:left;">
        <form action="<?php echo site_url('DevisController/submit_demande')?>" method="post">

            <legend>Je souhaite opter pour :</legend>
            <br>
            <?php foreach ($batiments as $batiment): ?>
                <div>
                    <input type="radio" name="batiment" value="<?php echo $batiment->id; ?>" id="<?php echo $batiment->id; ?>" />
                    <label for="<?php echo $batiment->id; ?>"><?php echo $batiment->designation; ?></label>
                </div>
            <?php endforeach; ?>

            <select name="client" >
                <option value="">Le client</option>
                <?php foreach ($clients as $client): ?>
                <option value="<?php echo $client->id ?>"><?php  echo $client->nom?> </option>
            <?php endforeach; ?>
            </select>
            <!-- <p>Nom du client : <input type="text" name="nomclient"></p> -->
            <select name="finition" >
                <option value="">Choisir la finition </option>
                <?php foreach ($finitions as $finition): ?>
                <option value="<?php echo $finition->id ?>"><?php  echo $finition->finition?> </option>
            <?php endforeach; ?>
            </select>
            <p>Commencer les travaux le : <input type="date" name="datetrav" ></p>
            <input type="submit" value="Soumettre">
        </form>
</fieldset>
</div>


</body>
</html>