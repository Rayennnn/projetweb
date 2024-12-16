<?php
include 'C:\xampp\htdocs\projetweb\controller\suggestionC.php';

$suggestionC = new SuggestionC();
$stats = $suggestionC->getStatistiques();
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$limit = 1000; // Ou toute autre limite souhaitée
$offset = ($page - 1) * $limit;

// Appeler la méthode avec les arguments nécessaires
$suggestions = $suggestionC->getSuggestions($limit, $offset);

?>
<!doctype html>
<html class="fixed">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<title>suggestion</title>
		<meta name="keywords" content="HTML5 Admin Template" />
		<meta name="description" content="Porto Admin - Responsive HTML5 Template">
		<meta name="author" content="okler.net">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="assets/vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

		<!-- Specific Page Vendor CSS -->
		<link rel="stylesheet" href="assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.css" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="assets/stylesheets/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme-custom.css">

		<!-- Head Libs -->
		<script src="assets/vendor/modernizr/modernizr.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

	</head>
	<body>
		<section class="body">

			<!-- start: header -->
			<header class="header">
				<div class="logo-container">
					<a href="../" class="logo">
						<img src="assets/images/logo.png" height="35" alt="Porto Admin" />
					</a>
					<div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
						<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
					</div>
				</div>
			
				<!-- start: search & user box -->
				<div class="header-right">
			
					<form action="pages-search-results.html" class="search nav-form">
						<div class="input-group input-search">
							<input type="text" class="form-control" name="q" id="q" placeholder="Search...">
							<span class="input-group-btn">
								<button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
							</span>
						</div>
					</form>
			
					<span class="separator"></span>
			
					<ul class="notifications">
						<li>
							<a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
								<i class="fa fa-tasks"></i>
								<span class="badge">3</span>
							</a>
			
							<div class="dropdown-menu notification-menu large">
								<div class="notification-title">
									<span class="pull-right label label-default">3</span>
									Tasks
								</div>
			
								<div class="content">
									<ul>
										<li>
											<p class="clearfix mb-xs">
												<span class="message pull-left">Generating Sales Report</span>
												<span class="message pull-right text-dark">60%</span>
											</p>
											<div class="progress progress-xs light">
												<div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
											</div>
										</li>
			
										<li>
											<p class="clearfix mb-xs">
												<span class="message pull-left">Importing Contacts</span>
												<span class="message pull-right text-dark">98%</span>
											</p>
											<div class="progress progress-xs light">
												<div class="progress-bar" role="progressbar" aria-valuenow="98" aria-valuemin="0" aria-valuemax="100" style="width: 98%;"></div>
											</div>
										</li>
			
										<li>
											<p class="clearfix mb-xs">
												<span class="message pull-left">Uploading something big</span>
												<span class="message pull-right text-dark">33%</span>
											</p>
											<div class="progress progress-xs light mb-xs">
												<div class="progress-bar" role="progressbar" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100" style="width: 33%;"></div>
											</div>
										</li>
									</ul>
								</div>
							</div>
						</li>
						<li>
							<a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
								<i class="fa fa-envelope"></i>
								<span class="badge">4</span>
							</a>
			
							<div class="dropdown-menu notification-menu">
								<div class="notification-title">
									<span class="pull-right label label-default">230</span>
									Messages
								</div>
			
								<div class="content">
									<ul>
										<li>
											<a href="#" class="clearfix">
												<figure class="image">
													<img src="assets/images/!sample-user.jpg" alt="Joseph Doe Junior" class="img-circle" />
												</figure>
												<span class="title">Joseph Doe</span>
												<span class="message">Lorem ipsum dolor sit.</span>
											</a>
										</li>
										<li>
											<a href="#" class="clearfix">
												<figure class="image">
													<img src="assets/images/!sample-user.jpg" alt="Joseph Junior" class="img-circle" />
												</figure>
												<span class="title">Joseph Junior</span>
												<span class="message truncate">Truncated message. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sit amet lacinia orci. Proin vestibulum eget risus non luctus. Nunc cursus lacinia lacinia. Nulla molestie malesuada est ac tincidunt. Quisque eget convallis diam, nec venenatis risus. Vestibulum blandit faucibus est et malesuada. Sed interdum cursus dui nec venenatis. Pellentesque non nisi lobortis, rutrum eros ut, convallis nisi. Sed tellus turpis, dignissim sit amet tristique quis, pretium id est. Sed aliquam diam diam, sit amet faucibus tellus ultricies eu. Aliquam lacinia nibh a metus bibendum, eu commodo eros commodo. Sed commodo molestie elit, a molestie lacus porttitor id. Donec facilisis varius sapien, ac fringilla velit porttitor et. Nam tincidunt gravida dui, sed pharetra odio pharetra nec. Duis consectetur venenatis pharetra. Vestibulum egestas nisi quis elementum elementum.</span>
											</a>
										</li>
										<li>
											<a href="#" class="clearfix">
												<figure class="image">
													<img src="assets/images/!sample-user.jpg" alt="Joe Junior" class="img-circle" />
												</figure>
												<span class="title">Joe Junior</span>
												<span class="message">Lorem ipsum dolor sit.</span>
											</a>
										</li>
										<li>
											<a href="#" class="clearfix">
												<figure class="image">
													<img src="assets/images/!sample-user.jpg" alt="Joseph Junior" class="img-circle" />
												</figure>
												<span class="title">Joseph Junior</span>
												<span class="message">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sit amet lacinia orci. Proin vestibulum eget risus non luctus. Nunc cursus lacinia lacinia. Nulla molestie malesuada est ac tincidunt. Quisque eget convallis diam.</span>
											</a>
										</li>
									</ul>
			
									<hr />
			
									<div class="text-right">
										<a href="#" class="view-more">View All</a>
									</div>
								</div>
							</div>
						</li>
						<li>
							<a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
								<i class="fa fa-bell"></i>
								<span class="badge">3</span>
							</a>
			
							<div class="dropdown-menu notification-menu">
								<div class="notification-title">
									<span class="pull-right label label-default">3</span>
									Alerts
								</div>
			
								<div class="content">
									<ul>
										<li>
											<a href="#" class="clearfix">
												<div class="image">
													<i class="fa fa-thumbs-down bg-danger"></i>
												</div>
												<span class="title">Server is Down!</span>
												<span class="message">Just now</span>
											</a>
										</li>
										<li>
											<a href="#" class="clearfix">
												<div class="image">
													<i class="fa fa-lock bg-warning"></i>
												</div>
												<span class="title">User Locked</span>
												<span class="message">15 minutes ago</span>
											</a>
										</li>
										<li>
											<a href="#" class="clearfix">
												<div class="image">
													<i class="fa fa-signal bg-success"></i>
												</div>
												<span class="title">Connection Restaured</span>
												<span class="message">10/10/2014</span>
											</a>
										</li>
									</ul>
			
									<hr />
			
									<div class="text-right">
										<a href="#" class="view-more">View All</a>
									</div>
								</div>
							</div>
						</li>
					</ul>
			
					<span class="separator"></span>
			
					<div id="userbox" class="userbox">
						<a href="#" data-toggle="dropdown">
							<figure class="profile-picture">
								<img src="assets/images/!logged-user.jpg" alt="Joseph Doe" class="img-circle" data-lock-picture="assets/images/!logged-user.jpg" />
							</figure>
							<div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@okler.com">
								<span class="name">John Doe Junior</span>
								<span class="role">administrator</span>
							</div>
			
							<i class="fa custom-caret"></i>
						</a>
			
						<div class="dropdown-menu">
							<ul class="list-unstyled">
								<li class="divider"></li>
								<li>
									<a role="menuitem" tabindex="-1" href="pages-user-profile.html"><i class="fa fa-user"></i> My Profile</a>
								</li>
								<li>
									<a role="menuitem" tabindex="-1" href="#" data-lock-screen="true"><i class="fa fa-lock"></i> Lock Screen</a>
								</li>
								<li>
									<a role="menuitem" tabindex="-1" href="pages-signin.html"><i class="fa fa-power-off"></i> Logout</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- end: search & user box -->
			</header>
			<!-- end: header -->
			
    
			<div class="inner-wrapper">
				<!-- start: sidebar -->
				<aside id="sidebar-left" class="sidebar-left">
				
					<div class="sidebar-header">
						
						<div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
							<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
						</div>
					</div>
				
					<div class="nano">
						<div class="nano-content">
							<nav id="menu" class="nav-main" role="navigation">
								<ul class="nav nav-main">
									
									
											
									<li class="nav-parent nav-expanded nav-active">
										<a>
											<i class="fa fa-list-alt" aria-hidden="true"></i>
											<span>suggestion</span>
										</a>
										<ul class="nav nav-children">
										<li >
											
												<a href="addreponse.php">
													 ajouter reponse
												</a>
											</li>
											<li>
												<a href="listereponsesug.php">
													 liste reponse
												</a>
											</li>
											<li>
												<a href="listesuggestion.php">
												liste suggestion et reclamation
												</a>
											</li>
											<li class="nav-active">
												<a href="statistiques.php">
													 statistiques
												</a>
											</li>
											
										</ul>
									</li>
									
									
							
				
							<hr class="separator" />
				
							
							
				
					</div>
				
				</aside>
				<!-- end: sidebar -->

				<section role="main" class="content-body">
					<header class="page-header">
						<h2>Statistiques des Suggestions</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="index.html">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>suggestion</span></li>
								<li><span>statistiques</span></li>
							</ol>
					
							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>
					<div class="main-content">
       

        <div class="stats-container">
            <!-- Cartes des statistiques -->
            <div class="stats-cards">
                <div class="stat-card total">
                    <i class="fas fa-list-alt"></i>
                    <div class="stat-value"><?php echo $stats['total']; ?></div>
                    <div class="stat-label">Total des suggestions</div>
                </div>
                
                <div class="stat-card traite">
                    <i class="fas fa-check-circle"></i>
                    <div class="stat-value"><?php echo $stats['traitée']['percentage']; ?>%</div>
                    <div class="stat-label">Traitées (<?php echo $stats['traitée']['count']; ?>)</div>
                </div>
                
                <div class="stat-card rejete">
                    <i class="fas fa-times-circle"></i>
                    <div class="stat-value"><?php echo $stats['rejetée']['percentage']; ?>%</div>
                    <div class="stat-label">Rejetées (<?php echo $stats['rejetée']['count']; ?>)</div>
                </div>
                
                <div class="stat-card en-attente">
                    <i class="fas fa-hourglass-half"></i>
                    <div class="stat-value"><?php echo $stats['en_attente']['percentage']; ?>%</div>
                    <div class="stat-label">En attente (<?php echo $stats['en_attente']['count']; ?>)</div>
                </div>
            </div>
            <style>
                .charts-container {
                    display: flex;
                    justify-content: space-between;
                    gap: 25px;
                }

                .chart-wrapper {
                    width: 100%; /* Chaque graphique prend 45% de l'espace */
                    height: 300px; 
					margin-top: 40px;
					margin-bottom: 30px;
                }
                /* Conteneur principal */
                .stats-cards {
                    display: flex;
                    justify-content: space-between;
                    flex-wrap: wrap;
                    gap: 50px;
                    margin-top: 20px;
                }

                /* Style de base pour chaque carte */
                .stat-card {
                    flex: 1 1 calc(25% - 10px);
                    max-width: 200px;
                    padding: 20px;
                    border-radius: 10px;
                    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
                    text-align: center;
                    background: #f9f9f9;
                    transition: transform 0.1s ease, box-shadow 0.2s ease;
                }

                /* Effet au survol */
                .stat-card:hover {
                    transform: translateY(-5px);
                    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.4);
                }

                /* Couleurs spécifiques */
                .stat-card.total {
                    background: #3498db;
                    color: white;
                }

                .stat-card.traite {
                    background: #2ecc71;
                    color: white;
                }

                .stat-card.rejete {
                    background: #e74c3c;
                    color: white;
                }

                .stat-card.en-attente {
                    background: #f1c40f;
                    color: black;
                }

                /* Icônes */
                .stat-card i {
                    font-size: 2.5rem;
                    margin-bottom: 25px;
                    display: block;
                    color: rgba(255, 255, 255, 0.9); /* Couleur légèrement atténuée */
                }

                /* Valeur */
                .stat-card .stat-value {
                    font-size: 2rem;
                    font-weight: bold;
                    margin-bottom: 20px;
                }

                /* Étiquette */
                .stat-card .stat-label {
                    font-size: 1.2rem;
                    font-weight: normal;
                }

            </style>

            <!-- Graphiques -->
            <div class="charts-container">
                <div class="chart-wrapper">
                    <canvas id="statusChart" style="height: 300px;"></canvas>
                </div>
                <div class="chart-wrapper">
                    <canvas id="typeChart" style="height: 300px;"></canvas>
                </div>
            </div>

        </div>
                <div class="statistics-section">
            <h3>Statistiques des Suggestions</h3>
            <table class="table">
                <thead>
                    <tr>
                        
                        <th>Suggestion</th>
                        <th>Date de Soumission</th>
                        <th>Likes</th>
                        <th>Dislikes</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                        // Assurez-vous de vérifier si $suggestions contient des données
                        if (isset($suggestions) && is_array($suggestions)) {
                            foreach ($suggestions as $index => $suggestion) {
                                echo "<tr>
                                    
                                        <td>{$suggestion['contenu']}</td>
                                        <td>{$suggestion['date_soumission']}</td>
                                        <td>{$suggestion['likes']}</td>
                                        <td>{$suggestion['dislikes']}</td>
                                    </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>Aucune suggestion disponible.</td></tr>";
                        }
                        ?>
                </tbody>
            </table>
        </div>
    </div>
                
    <script>
           const chartOptions = {
    responsive: true,
    maintainAspectRatio: false, // Permet de personnaliser la hauteur/largeur
    plugins: {
        title: {
            display: true,
            text: '',
        },
        legend: {
            position: 'bottom', // Place la légende en bas pour économiser de l'espace
        }
    }
};

// Graphique des statuts
// Graphique des statuts
new Chart(document.getElementById('statusChart'), {
    type: 'pie',
    data: {
        labels: ['Traitée', 'Rejetée', 'En attente'],
        datasets: [{
            data: [
                <?php echo $stats['traitée']['count'] ?? 0; ?>,
                <?php echo $stats['rejetée']['count'] ?? 0; ?>,
                <?php echo $stats['en_attente']['count'] ?? 0; ?>
            ],
            backgroundColor: ['#2ecc71', '#e74c3c', '#f1c40f']
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false, // Permet de contrôler la taille dans le CSS
        plugins: {
            title: {
                display: true,
                text: 'Répartition par statut',
                font: {
                    size: 22 // Taille du texte du titre
                }
            },
            legend: {
                labels: {
                    font: {
                        size: 18 // Taille du texte des légendes
                    }
                }
            }
        }
    }
});

new Chart(document.getElementById('typeChart'), {
    type: 'pie',
    data: {
        labels: ['Suggestions', 'Réclamations'],
        datasets: [{
            data: [
                <?php echo $stats['par_type']['suggestion']['count']; ?>,
                <?php echo $stats['par_type']['reclamation']['count']; ?>
            ],
            backgroundColor: ['#3498db', '#e6680e']
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false, // Permet de contrôler la taille dans le CSS
        plugins: {
            title: {
                display: true,
                text: 'Répartition par type',
                font: {
                    size: 22 // Taille du texte du titre
                }
            },
            legend: {
                labels: {
                    font: {
                        size: 18 // Taille du texte des légendes
                    }
                }
            }
        }
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const likeButtons = document.querySelectorAll('.like-btn');
    const dislikeButtons = document.querySelectorAll('.dislike-btn');

    // Fonction pour gérer les votes
    function sendVote(id, action) {
        fetch('/projetweb/view/backoffice/updateVotes.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `id=${id}&action=${action}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                // Rafraîchir la page ou mettre à jour les éléments du DOM pour refléter les nouveaux votes
                location.reload(); // Recharger la page pour voir les votes mis à jour
            } else {
                alert('Une erreur est survenue lors du vote');
            }
        })
        .catch(error => console.error('Erreur lors du vote:', error));
    }

    // Ajouter les écouteurs d'événements sur les boutons "Like"
    likeButtons.forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            sendVote(id, 'like');
        });
    });

    // Ajouter les écouteurs d'événements sur les boutons "Dislike"
    dislikeButtons.forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            sendVote(id, 'dislike');
        });
    });
});


    </script>
					

			<aside id="sidebar-right" class="sidebar-right">
				<div class="nano">
					<div class="nano-content">
						<a href="#" class="mobile-close visible-xs">
							Collapse <i class="fa fa-chevron-right"></i>
						</a>
			
						<div class="sidebar-right-wrapper">
			
							<div class="sidebar-widget widget-calendar">
								<h6>Upcoming Tasks</h6>
								<div data-plugin-datepicker data-plugin-skin="dark" ></div>
			
								<ul>
									<li>
										<time datetime="2014-04-19T00:00+00:00">04/19/2014</time>
										<span>Company Meeting</span>
									</li>
								</ul>
							</div>
			
							<div class="sidebar-widget widget-friends">
								<h6>Friends</h6>
								<ul>
									<li class="status-online">
										<figure class="profile-picture">
											<img src="assets/images/!sample-user.jpg" alt="Joseph Doe" class="img-circle">
										</figure>
										<div class="profile-info">
											<span class="name">Joseph Doe Junior</span>
											<span class="title">Hey, how are you?</span>
										</div>
									</li>
									<li class="status-online">
										<figure class="profile-picture">
											<img src="assets/images/!sample-user.jpg" alt="Joseph Doe" class="img-circle">
										</figure>
										<div class="profile-info">
											<span class="name">Joseph Doe Junior</span>
											<span class="title">Hey, how are you?</span>
										</div>
									</li>
									<li class="status-offline">
										<figure class="profile-picture">
											<img src="assets/images/!sample-user.jpg" alt="Joseph Doe" class="img-circle">
										</figure>
										<div class="profile-info">
											<span class="name">Joseph Doe Junior</span>
											<span class="title">Hey, how are you?</span>
										</div>
									</li>
									<li class="status-offline">
										<figure class="profile-picture">
											<img src="assets/images/!sample-user.jpg" alt="Joseph Doe" class="img-circle">
										</figure>
										<div class="profile-info">
											<span class="name">Joseph Doe Junior</span>
											<span class="title">Hey, how are you?</span>
										</div>
									</li>
								</ul>
							</div>
			
						</div>
					</div>
				</div>
			</aside>
		</section>

		<!-- Vendor -->
		<script src="assets/vendor/jquery/jquery.js"></script>
		<script src="assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="assets/vendor/bootstrap/js/bootstrap.js"></script>
		<script src="assets/vendor/nanoscroller/nanoscroller.js"></script>
		<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="assets/vendor/magnific-popup/magnific-popup.js"></script>
		<script src="assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
		
		<!-- Specific Page Vendor -->
		<script src="assets/vendor/jquery-autosize/jquery.autosize.js"></script>
		<script src="assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="assets/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="assets/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="assets/javascripts/theme.init.js"></script>

	</body>
</html>