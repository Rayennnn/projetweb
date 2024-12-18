<?php
include ('../../Controller/formationC.php');

require_once($_SERVER['DOCUMENT_ROOT'] . '/PROJETWEB/Controller/clubC.php');
$formationC = new Formationc();
$list = $formationC->getAllFormations();
$clubC = new ClubC();
?>

<!doctype html>
<html class="fixed">
    <head>
        <!-- Basic -->
        <meta charset="UTF-8">
        <title>Liste des Formations</title>
        
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
        <link rel="stylesheet" href="assets/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css" />
        <link rel="stylesheet" href="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />
        <link rel="stylesheet" href="assets/vendor/morris/morris.css" />

        <!-- Theme CSS -->
        <link rel="stylesheet" href="assets/stylesheets/theme.css" />

        <!-- Skin CSS -->
        <link rel="stylesheet" href="assets/stylesheets/skins/default.css" />

        <!-- Theme Custom CSS -->
        <link rel="stylesheet" href="assets/stylesheets/theme-custom.css">

        <!-- Head Libs -->
        <script src="assets/vendor/modernizr/modernizr.js"></script>
    </head>
    <body>
        <section class="body">
            <!-- start: header -->
            <?php include('includes/header.php'); ?>
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
								<li class="nav-parent ">
                        <a>
                            <i class="fa fa-users" aria-hidden="true"></i>
                            <span>Clubs</span>
                        </a>
                        <ul class="nav nav-children">
                            <li>
                                <a href="\PROJETWEB\View\BackOffice\addClub.php">
                                    Ajouter un club
                                </a>
                            </li>
                            <li>
                                <a href="\PROJETWEB\View\BackOffice\listClubs.php">
                                    Liste des clubs
                                </a>
                            </li>
                        </ul>
                    </li>
                    
                    <!-- Ajout du menu Formations -->
                    <li class="nav-parent nav-expanded nav-active">
                        <a>
                            <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                            <span>Formations</span>
                        </a>
                        <ul class="nav nav-children">
                            <li>
                                <a href="\PROJETWEB\View\BackOffice\addFormation.php">
                                    Ajouter une formation
                                </a>
                            </li>
                            <li>
                                <a href="\PROJETWEB\View\BackOffice\listFormations.php">
                                    Liste des formations
                                </a>
                            </li>
                        </ul>
                    </li>
					<li class="nav-parent">
										<a>
											<i class="fa fa-list-alt" aria-hidden="true"></i>
											<span>Quiz</span>
										</a>
										<ul class="nav nav-children">
											<li>
												<a href="http://localhost/PROJETWEB/View/BackOffice/afficherquestion.php">
													 questions
												</a>
											</li>
											<li>
												<a href="http://localhost/PROJETWEB/View/BackOffice/affichereponse.php">
													 reponses
												</a>
											</li>
											
										</ul>
									</li>
									<li class="nav-parent">
										<a>
											<i class="fa fa-table" aria-hidden="true"></i>
											<span>interantional</span>
										</a>
										<ul class="nav nav-children">
											
											<li>
												<a href="octopus/addBourse.php">
													 Bourses
												</a>
											</li>
											<li>
												<a href="octopus/addprogramme.php">
													 programmes d'échanges
												</a>
											</li>
											
										</ul>
									</li>
									
									<li class="nav-parent">
										<a href ="admin-comments.php">
											<i class="fa fa-columns" aria-hidden="true"></i>
											<span>témoignage</span>
										</a>
										
									</li>
							<!-- Ajout du menu suggestions -->		
											
									<li class="nav-parent">
										<a>
											<i class="fa fa-list-alt" aria-hidden="true"></i>
											<span>suggestion</span>
										</a>
										<ul class="nav nav-children">
										<li >
											
												<a href="octopus-master/octopus-master/octopus/addreponse.php">
													 ajouter reponse
												</a>
											</li>
											<li>
												<a href="octopus-master/octopus-master/octopus/addsuggestion.php">
													 liste reponse
												</a>
											</li>
											<li>
												<a href="octopus-master/octopus-master/octopus/listesuggestion.php">
												liste suggestion et reclamation
												</a>
											</li>
											<li>
												<a href="octopus-master/octopus-master/octopus/statistiques.php">
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
                        <h2>Liste des Formations</h2>
                    </header>

                    <!-- start: page -->
                    <div class="row">
                        <div class="col-lg-12">
                            <section class="panel">
                                <header class="panel-heading">
                                    <h2 class="panel-title">Formations enregistrées</h2>
                                </header>
                                <div class="panel-body">
                                    <table class="table table-bordered table-striped mb-none" id="datatable-default">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nom de la Formation</th>
                                                <th>Description</th>
                                                <th>Organisme</th>
                                                <th>Prix</th>
                                                <th>Image</th>
                                                <th>Lien</th>
                                                <th>ID Club</th>
                                                <th>Date</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($list as $formation): ?>
                                            <tr>
                                                <td><?php echo $formation['id_formation']; ?></td>
                                                <td><?php echo $formation['nom_formation']; ?></td>
                                                <td><?php echo substr($formation['description'], 0, 50) . '...'; ?></td>
                                                <td><?php echo $formation['organisme']; ?></td>
                                                <td>
                                                    <?php echo $formation['prix'] == 0 ? 'Free' : $formation['prix'] . ' DT'; ?>
                                                </td>
                                                <td>
                                                    <img src="../../uploads/<?php echo $formation['image']; ?>" alt="Image" class="img-thumbnail" style="max-width: 50px;">
                                                </td>
                                                <td>
                                                    <a href="<?php echo $formation['lien']; ?>" target="_blank" class="btn btn-info btn-sm">
                                                        <i class="fa fa-link"></i> Visiter
                                                    </a>
                                                </td>
                                                <!-- Récupérer le nom du club à partir de l'ID du club -->
                                                <?php $nom_club = $clubC->getNomClubById($formation['id_club']);?> 
                                                <td><?php echo htmlspecialchars($nom_club); ?></td>
                                                <td><?php 
                                                    if (!empty($formation['date'])) {
                                                        $date = new DateTime($formation['date']);
                                                        echo $date->format('d/m/Y');
                                                    } else {
                                                        echo "Date non définie";
                                                    }
                                                ?></td>
                                                <td>
                                                    <a href="updateFormation.php?id_formation=<?php echo $formation['id_formation']; ?>" class="btn btn-warning btn-sm">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                    <a href="deleteFormation.php?id_formation=<?php echo $formation['id_formation']; ?>" 
                                                       class="btn btn-danger btn-sm"
                                                       onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette formation ?');">
                                                        <i class="fa fa-trash-o"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </section>
                        </div>
                    </div>
                </section>
            </div>
        </section>

        <!-- Vendor -->
        <script src="assets/vendor/jquery/jquery.js"></script>
        <script src="assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
        <script src="assets/vendor/bootstrap/js/bootstrap.js"></script>
        <script src="assets/vendor/nanoscroller/nanoscroller.js"></script>
        <script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
        <script src="assets/vendor/magnific-popup/magnific-popup.js"></script>
        <script src="assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
        
        <!-- Theme Base, Components and Settings -->
        <script src="assets/javascripts/theme.js"></script>
        
        <!-- Theme Custom -->
        <script src="assets/javascripts/theme.custom.js"></script>
        
        <!-- Theme Initialization Files -->
        <script src="assets/javascripts/theme.init.js"></script>
    </body>
</html>