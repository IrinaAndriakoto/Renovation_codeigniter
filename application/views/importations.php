<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Importation de données</title>
   
</head>
<body>
    <h4>Importation de données.</h4>
    <form action="<?php echo site_url('CSV_Controller/process_csv');?>" method="post" enctype="multipart/form-data">
        <h6>Maison et Travaux.</h6>
        <input type="file" name="csv_file_maison" accept=".csv">
        
        <h6>Devis</h6>
        <input type="file" name="csv_file_devis " accept=".csv">
        <button type="submit">Importer</button>
    </form>
<hr>

</html>