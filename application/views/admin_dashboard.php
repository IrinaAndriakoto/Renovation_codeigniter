<!DOCTYPE HTML>
<html>
<head>
    <title>Homepage</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="../../assets/main.css" />
    <script src="<?php echo base_url('assets/js/chart.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


</head>
<style>
    .insert {
        display: none;
    }

    .insert.active {
        display: block;
    }

    .insert a {
        display: block;
        padding: 10px;
        text-decoration: none;
        color: #333;
        margin-bottom: 10px;
        border-radius: 5px;
        background-color: #ddd;
    }

    .insert a.active {
        background-color: #007bff;
        color: #ddd;
    }

    .cnv{
        width:300px;
        height: 100px;
    }

    .ambony{
        display: flex;
        height: 50px;
        padding: 5px;
    }
    .ambony_sp{
        margin-left: 150px;
    }
</style>
<body class="is-preload">
<!-- Wrapper -->
<div id="wrapper">
    <!-- Main -->
    <div id="main">
        <div class="inner">
            <!-- Header -->
            <header id="header">
                <a href="<?php echo site_url('Welcome/admin_dashboard') ?>" class="logo"><strong>Renovation.</strong></a>
                <p>Connecté en tant qu'Admin.</p>
            </header>

            <!-- Section --> <br>
            <h4 style='text-decoration: underline;'>Nos Services : </h4>
            <div class="ambony">
                <span class="ambony_sp"><a href="<?php echo site_url('examples/products_management') ?>">Tous les types de travaux </a> </span>
                <span class="ambony_sp"><a href="<?php echo site_url('AdminController/detailDevis') ?>">Details Devis Travaux </a> </span>
                <span class="ambony_sp"><a href="<?php echo site_url('examples/employees_management') ?>">Toutes les finitions </a> </span>
                <span class="ambony_sp"><a href="<?php echo site_url('examples/offices_management') ?>">Tous les types de batiments </a> </span>
                
            </div> <hr>
            <div class="canvasss">

                <!-- Autres éléments de la page... -->
                <h5>Tableau de bord</h5>
                <p><h6>Montant total des devis 2024 : </h6> <?php foreach ($mt as $montant): ?>
                    <?php echo $montant['total']; ?>
                    <?php endforeach; ?> Ariary</p>
                    <canvas id="myChart"></canvas>
                </div>
                    <div class="content">
        
            </div>
        </div>
    </div>
    <!-- Sidebar -->
    <div id="sidebar">
        <div class="inner">
            <!-- Menu -->
            <nav id="menu">
                <header class="major">
                    <h2>Menu</h2>
                </header>
                <ul>
                    <li><a href="#" class="load-content" data-url="<?php echo site_url('Welcome/profil') ?>">Profil</a></li>
                    <li><a href="#" class="load-content" data-url="<?php echo site_url('examples/customers_management')?>">Utilisateurs</a></li>
                    <li><a href="#" class="load-content" data-url="<?php echo site_url('examples/orders_management') ?>">Tous les devis </a></li>
                    <li><a href="#" class="load-content" data-url="<?php echo site_url('AdminController/listepaiement') ?>">Historique paiement des clients </a></li>
                    <li><a href="#" class="load-content" data-url="<?php echo site_url('MaisonController/index') ?>">Import</a></li>

                    <li><a href="<?php echo site_url('Welcome/admin_dashboard') ?>">Tableau de bord</a></li>


        <br>    <br>
                    <li><a href="#" class="load-content" data-url="<?php echo site_url('DatabaseController/reset_database') ?>">Reinitialiser la base de données</a></li>
                    <li><a href="<?php echo site_url('Welcome/logout') ?>">Déconnexion</a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Sélectionner tous les liens avec la classe load-content
    const loadContentLinks = document.querySelectorAll('.load-content');

    // Sélectionner le div avec la classe canvasss
    const canvasDiv = document.querySelector('.canvasss');

    // Boucler sur chaque lien et ajouter un écouteur d'événement de clic
    loadContentLinks.forEach(link => {
        link.addEventListener('click', function(event) {
            // Empêcher le comportement de lien par défaut
            event.preventDefault();

            // Masquer le div avec la classe canvasss
            canvasDiv.style.display = 'none';

            // Récupérer l'URL de données à charger depuis l'attribut data-url du lien
            const url = link.getAttribute('data-url');

            // Effectuer une requête AJAX pour récupérer le contenu de l'URL
            fetch(url)
                .then(response => response.text())
                .then(html => {
                    // Mettre à jour le contenu du div content avec le contenu récupéré via AJAX
                    document.querySelector('.content').innerHTML = html;
                })
                .catch(error => {
                    console.error('Erreur lors de la récupération du contenu:', error);
                });
        });
    });
});

</script>
<script>
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Jan', 'Fev', 'Mar', 'Avr', 'Mai', 'Jun', 'Jul', 'Aou', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [{
            label: 'Montant des devis',
            data: [
                <?php if (!empty($m)): ?>
                    <?php foreach ($m as $montant): ?>
                        <?php echo $montant['total']; ?>,
                    <?php endforeach; ?>
                <?php endif; ?>
            ],
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
			<!-- <script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script> -->
</body>
</html>
