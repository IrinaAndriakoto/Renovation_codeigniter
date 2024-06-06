<!DOCTYPE HTML>
<html>
	<head>
		<title>Homepage</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="../../assets/main.css" />

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
                                    <p>Connecté en tant que client.</p>
								</header>

							<!-- Section -->
								<section>
									<div class="content">
                        
                        </div>
								
								</section>
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
                                    <li><a href="#" class="load-content" data-url="<?php echo site_url('DevisController/devisClient') ?>">Consulter vos devis</a></li>
                                    <li><a href="#" class="load-content" data-url="<?php echo site_url('DevisController/newDevis') ?>">Creer un nouveau devis</a></li>
                                    <li><a href="#" class="load-content" data-url="<?php echo site_url('AdminController/listePaiement') ?>">Historique paiement </a></li>
										<li><a href="<?php echo site_url('Welcome/logout') ?>">Déconnexion</a></li>
									</ul>
								</nav>
						</div>
					</div>

			</div>
                            
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Sélectionner tous les liens avec la classe load-content
        const loadContentLinks = document.querySelectorAll('.load-content');

        // Boucler sur chaque lien et ajouter un écouteur d'événement de clic
        loadContentLinks.forEach(link => {
            link.addEventListener('click', function(event) {
                // Empêcher le comportement de lien par défaut
                event.preventDefault();

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
	</body>
</html>