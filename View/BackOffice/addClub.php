<?php

require_once ($_SERVER['DOCUMENT_ROOT'] . '/PROJETWEB/Controller/clubC.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Créer une instance du contrôleur
    $clubC = new ClubC();

    // Créer une instance de votre classe Club (modifiez selon votre modèle)
    $club = new Club(
        null, // L'ID du club est souvent généré automatiquement par la base de données
        $_POST['nom_club'] ?? '', // Récupérer le nom du club
        $_POST['description'] ?? '', // Description
        $_POST['date_creation'] ?? 'now', // Date de création, 'now' par défaut
        $_POST['categorie'] ?? '', // Catégorie
        $_POST['lieu'] ?? '', // Lieu
        $_FILES['logo']['name'] ?? '', // Nom du fichier logo, récupéré via $_FILES
        $_POST['lien'] ?? '' // Lien du club
    );

    // Charger et enregistrer le fichier logo si fourni
    if (!empty($_FILES['logo']['tmp_name'])) {
        $targetDirectory = '../../uploads/'; // Dossier où enregistrer les logos
        $targetFile = $targetDirectory . basename($_FILES['logo']['name']);
        move_uploaded_file($_FILES['logo']['tmp_name'], $targetFile);
    }

    
   
		// Appeler la méthode pour ajouter un club
        if ($clubC->addClub($club)) {
			 // Redirection vers listClubs.php après succès
			header("Location: listClubs.php");
			exit();
		} else {
			echo "Erreur lors de l'ajout du club";
		}
        
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Basic -->
	<meta charset="UTF-8">
        <title>Ajouter un Club</title>
        
        <!-- Copier exactement les mêmes liens que dans index.php -->
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
						<?php include('includes/sidebar.php'); ?>
						<!-- end: sidebar -->
                        <div class="col-lg-12">
							<section role="main" class="content-body">
								<header class="page-header">
									<h2>Ajouter un Club</h2>
								</header>

								<!-- start: page -->
								<div class="row">
									<div class="col-lg-12">
									<section class="panel">
										<header class="panel-heading">
											<h2 class="panel-title">Formulaire d'ajout d'un club</h2>
										</header>
                                <div class="panel-body">
									<form class="form-horizontal form-bordered" method="POST" action="" enctype="multipart/form-data">
										<!-- Nom du Club -->
										<div class="form-group row">
											<label class="col-lg-3 control-label text-lg-right pt-2">Nom du Club</label>
											<div class="col-lg-9">
												<input type="text" class="form-control" name="nom_club">
												<span class="error-message" id="nomError" style="color:red;"></span>
											</div>
										</div>

										<!-- Description -->
										<div class="form-group row">
											<label class="col-lg-3 control-label text-lg-right pt-2">Description</label>
											<div class="col-lg-9">
												<textarea class="form-control" rows="3" name="description"></textarea>
												<span class="error-message" id="descriptionError" style="color:red;"></span>
											</div>
										</div>

										<!-- Date de Création -->
										<div class="form-group row">
											<label class="col-lg-3 control-label text-lg-right pt-2">Date de Création</label>
											<div class="col-lg-9">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-calendar"></i>
													</span>
													<input type="date" class="form-control" name="date_creation">
													<span class="error-message" id="dateError" style="color:red;"></span>
												</div>
											</div>
										</div>

										<!-- Catégorie -->
										<div class="form-group row">
											<label class="col-lg-3 control-label text-lg-right pt-2">Catégorie</label>
											<div class="col-lg-9">
												<select class="form-control" name="categorie" required>
													<option value="Culture">Culture</option>
													<option value="Sport">Sport</option>
													<option value="Technologie">Technologie</option>
													<option value="Art">Art</option>
													<option value="Social">Social</option>
													<option value="Scientifique">Scientifique</option>
													<option value="Environnement">Environnement</option>
												</select>
											</div>
										</div>

										<!-- Lieu -->
										<div class="form-group row">
											<label class="col-lg-3 control-label text-lg-right pt-2">Lieu</label>
											<div class="col-lg-9">
												<input type="text" class="form-control" name="lieu">
												<span class="error-message" id="lieuError" style="color:red;"></span>
											</div>
										</div>

										<!-- Logo -->
										<div class="form-group row">
											<label class="col-lg-3 control-label text-lg-right pt-2">Logo</label>
											<div class="col-lg-9">
												<div class="fileupload fileupload-new" data-provides="fileupload">
													<div class="input-append">
														<div class="uneditable-input">
															<i class="fa fa-file fileupload-exists"></i>
															<span class="fileupload-preview"></span>
														</div>
														<span class="btn btn-default btn-file">
															<span class="fileupload-exists">Changer</span>
															<span class="fileupload-new">Sélectionner</span>
															<input type="file" name="logo" accept="image/*">
														</span>
														<span class="error-message" id="logoError" style="color:red;"></span>
													</div>
												</div>
												<div id="logoPreview"></div>
											</div>
										</div>

										<!-- Lien -->
										<div class="form-group row">
											<label class="col-lg-3 control-label text-lg-right pt-2">Lien</label>
											<div class="col-lg-9">
											<input type="text" name="lien">
											<span id="lienError" class="error-message"></span>Y
											</div>
										</div>

										<!-- Boutons -->
										<div class="form-group row">
											<div class="col-lg-9 offset-lg-3">
												<button type="submit" class="btn btn-primary">Ajouter Club</button>
												<button type="reset" class="btn btn-default">Réinitialiser</button>
											</div>
										</div>
									</form>
						
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
        <!-- Specific Page Vendor -->
        <script src="assets/vendor/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
        <script src="assets/vendor/jquery-ui-touch-punch/jquery.ui.touch-punch.js"></script>
        <script src="assets/vendor/jquery-appear/jquery.appear.js"></script>
        <script src="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
        <script src="assets/vendor/jquery-easypiechart/jquery.easypiechart.js"></script>
        <script src="assets/vendor/flot/jquery.flot.js"></script>
        <script src="assets/vendor/flot-tooltip/jquery.flot.tooltip.js"></script>
        <script src="assets/vendor/flot/jquery.flot.pie.js"></script>
        <script src="assets/vendor/flot/jquery.flot.categories.js"></script>
        <script src="assets/vendor/flot/jquery.flot.resize.js"></script>
        <script src="assets/vendor/jquery-sparkline/jquery.sparkline.js"></script>
        <script src="assets/vendor/raphael/raphael.js"></script>
        <script src="assets/vendor/morris/morris.js"></script>
        <script src="assets/vendor/gauge/gauge.js"></script>
        <script src="assets/vendor/snap-svg/snap.svg.js"></script>
        <script src="assets/vendor/liquid-meter/liquid.meter.js"></script>
        <script src="assets/javascripts/theme.js"></script>
        
        <!-- Theme Custom -->
        <script src="assets/javascripts/theme.custom.js"></script>
        
        <!-- Theme Initialization Files -->
        <script src="assets/javascripts/theme.init.js"></script>

		<script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            
            // Prévisualisation du logo
            const logoInput = document.querySelector('[name="logo"]');
            logoInput.addEventListener('change', function(e) {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('logoPreview').innerHTML = 
                            `<img src="${e.target.result}">`;
                    }
                    reader.readAsDataURL(file);
                }
            });

            // Validation du formulaire
            form.addEventListener('submit', function(e) {
                let isValid = true;
                
                // Validation du nom
                const nom = document.querySelector('[name="nom_club"]').value;
                if (!nom || nom.length < 3) {
                    document.getElementById('nomError').textContent = 'Le nom doit contenir au moins 3 caractères';
                    isValid = false;
                } else {
                    document.getElementById('nomError').textContent = '';
                }

                // Validation de la description
                const description = document.querySelector('[name="description"]').value;
                if (!description || description.length < 10) {
                    document.getElementById('descriptionError').textContent = 'La description doit contenir au moins 10 caractères';
                    isValid = false;
                } else {
                    document.getElementById('descriptionError').textContent = '';
                }

                // Validation de la date
                const date = document.querySelector('[name="date_creation"]').value;
                if (!date) {
                    document.getElementById('dateError').textContent = 'Veuillez choisir une date';
                    isValid = false;
                } else {
                    document.getElementById('dateError').textContent = '';
                }

                // Validation du lieu
                const lieu = document.querySelector('[name="lieu"]').value;
                if (!lieu || lieu.length < 2 || lieu.length > 15) {
                    document.getElementById('lieuError').textContent = 'Le lieu doit contenir entre 2 et 15 caractères';
                    isValid = false;
                } else {
                    document.getElementById('lieuError').textContent = '';
                }

                // Validation du logo
                const logo = document.querySelector('[name="logo"]').files[0];
                if (!logo) {
                    document.getElementById('logoError').textContent = 'Veuillez choisir un logo';
                    isValid = false;
                } else if (!logo.type.startsWith('image/')) {
                    document.getElementById('logoError').textContent = 'Le fichier doit être une image';
                    isValid = false;
                } else {
                    document.getElementById('logoError').textContent = '';
                }

                // Validation du lien
                const lien = document.querySelector('[name="lien"]').value;
                const urlRegex = /^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/;
                if (!lien || !urlRegex.test(lien)) {
                    document.getElementById('lienError').textContent = 'Veuillez entrer une URL valide';
                    isValid = false;
                } else {
                    document.getElementById('lienError').textContent = '';
                }

                if (!isValid) {
                    e.preventDefault();
                }
            });
        });
    </script>	

</body>
</html>