<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
require_once($_SERVER['DOCUMENT_ROOT'] . '/PROJETWEB/Controller/formationC.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/PROJETWEB/Model/formations.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    

    var_dump($_POST);
    var_dump($_FILES);
    // Créer une instance du contrôleur
    $formationC = new Formationc();

    // Traitement du prix
    $prix = $_POST['prix'] ?? '';
    $prixValue = ($prix === 'free') ? 0 : (is_numeric($prix) ? (int)$prix : null);

    // Assurez-vous que l'id_club est un entier
    $idClub = !empty($_POST['id_club']) ? (int)$_POST['id_club'] : null;

    // Créer une instance de votre classe Formation
    $formation = new Formation(
        null, // L'ID de la formation est souvent généré automatiquement par la base de données
        $_POST['nom_formation'] ?? '', // Récupérer le nom de la formation
        $_POST['description'] ?? '', // Description
        $_POST['organisme'] ?? '', // Organisme
        $prixValue, // Prix converti en entier ou null
        $_FILES['image']['name'] ?? '', // Nom du fichier image, récupéré via $_FILES
        $_POST['lien'] ?? '', // Lien de la formation
        $idClub // ID du club converti en entier
    );

    // Charger et enregistrer le fichier image si fourni
    if (!empty($_FILES['image']['tmp_name'])) {
        $targetDirectory = '../../uploads/'; // Dossier où enregistrer les images
        $targetFile = $targetDirectory . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $targetFile);
    }

    // Appeler la méthode pour ajouter une formation
    if ($formationC->addFormation($formation)) {
        // Redirection vers listFormations.php après succès
        header("Location: listFormations.php");
        exit();
    } else {
        echo "Erreur lors de l'ajout de la formation";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Formation</title>
    <!-- Web Fonts  -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.css" />
    <link rel="stylesheet" href="assets/vendor/magnific-popup/magnific-popup.css" />
    <link rel="stylesheet" href="assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

    <!-- Theme CSS -->
    <link rel="stylesheet" href="assets/stylesheets/theme.css" />
    <link rel="stylesheet" href="assets/stylesheets/skins/default.css" />
    <link rel="stylesheet" href="assets/stylesheets/theme-custom.css">

    <!-- Head Libs -->
    <script src="assets/vendor/modernizr/modernizr.js"></script>

    <style>
    .error-message {
        color: red;
        font-size: 0.9em;
        margin-top: 5px;
        display: block;
        clear: both;
    }
    .form-group {
        margin-bottom: 20px;
    }
    #imagePreview img {
        max-width: 200px;
        margin-top: 10px;
    }
</style>
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
                <h2>Ajouter une Formation</h2>
            </header>

            <!-- start: page -->
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            <h2 class="panel-title">Formulaire d'ajout</h2>
                        </header>
                        <div class="panel-body">
                            <?php if (isset($error)): ?>
                                <div class="alert alert-danger">
                                    <strong>Erreur!</strong> <?php echo $error; ?>
                                </div>
                            <?php endif; ?>

                            <form id="formationForm" class="form-horizontal form-bordered" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
                                <!-- Nom de la Formation -->
                                <div class="form-group">
                                    <label class="col-lg-3 control-label text-lg-right pt-2">Nom de la Formation</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" name="nom_formation">
                                        <div class="error-message" id="nomError"></div>
                                    </div>
                                </div>

                                <!-- Description -->
                                <div class="form-group">
                                    <label class="col-lg-3 control-label text-lg-right pt-2">Description</label>
                                    <div class="col-lg-9">
                                        <textarea class="form-control" rows="3" name="description"></textarea>
                                        <div class="error-message" id="descriptionError"></div>
                                    </div>
                                </div>

                                <!-- Organisme -->
                                <div class="form-group ">
                                    <label class="col-lg-3 control-label text-lg-right pt-2">Organisme</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" name="organisme">
                                        <div class="error-message" id="organismeError"></div>
                                    </div>
                                </div>

                                <!-- Prix -->
                                <div class="form-group">
                                    <label class="col-lg-3 control-label text-lg-right pt-2">Prix</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" name="prix" placeholder="Entrez un prix ou 'free'">
                                        <div class="error-message" id="prixError"></div>
                                    </div>
                                </div>

                                <!-- Image -->
                                <div class="form-group">
                                    <label class="col-lg-3 control-label text-lg-right pt-2">Image</label>
                                    <div class="col-lg-9">
                                        <input type="file" class="form-control" name="image" accept="image/*">
                                        <div class="error-message" id="imageError"></div>
                                        <div id="imagePreview"></div>
                                    </div>
                                </div>

                                <!-- Lien -->
                                <div class="form-group">
                                    <label class="col-lg-3 control-label text-lg-right pt-2">Lien</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" name="lien">
                                        <div class="error-message" id="lienError"></div>
                                    </div>
                                </div>

                                <!-- ID Club -->
                                <div class="form-group">
                                    <label class="col-lg-3 control-label text-lg-right pt-2">ID Club</label>
                                    <div class="col-lg-9">
                                        <input type="number" class="form-control" name="id_club" min="1">
                                        <div class="error-message" id="idClubError"></div>
                                    </div>
                                </div>

                                <!-- Date de la formation -->
                                <div class="form-group">
                                    <label for="date_formation">Date de la formation :</label>
                                    <input type="date" class="form-control" id="date_formation" 
                                           name="date_formation" required>
                                </div>

                                <!-- Bouton de soumission -->
                                <div class="form-group">
                                    <div class="col-lg-9 col-lg-offset-3">
                                        <button type="submit" class="btn btn-primary">Ajouter</button>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('formationForm');
        
        // Prévisualisation de l'image
        const imageInput = document.querySelector('[name="image"]');
        const imagePreview = document.getElementById('imagePreview');
        
        imageInput.addEventListener('change', function(e) {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.innerHTML = `<img src="${e.target.result}" style="max-width: 200px;">`;
                }
                reader.readAsDataURL(file);
            }
        });

        // Validation du formulaire
        form.addEventListener('submit', function(e) {
            e.preventDefault(); // Empêcher la soumission par défaut
            let isValid = true;
            
            // Réinitialiser tous les messages d'erreur
            document.querySelectorAll('.error-message').forEach(error => {
                error.textContent = '';
            });

            // Validation du nom
            const nom = document.querySelector('[name="nom_formation"]').value.trim();
            if (!nom || nom.length < 3) {
                document.getElementById('nomError').textContent = 'Le nom doit contenir au moins 3 caractères';
                isValid = false;
            }

            // Validation de la description
            const description = document.querySelector('[name="description"]').value.trim();
            if (!description || description.length < 10) {
                document.getElementById('descriptionError').textContent = 'La description doit contenir au moins 10 caractères';
                isValid = false;
            }

            // Validation de l'organisme
            const organisme = document.querySelector('[name="organisme"]').value.trim();
            if (!organisme || organisme.length < 3) {
                document.getElementById('organismeError').textContent = 'L\'organisme doit contenir au moins 3 caractères';
                isValid = false;
            }

            // Validation du prix
            const prix = document.querySelector('[name="prix"]').value.trim();
            if (prix !== 'free' && (isNaN(prix) || parseFloat(prix) < 0)) {
                document.getElementById('prixError').textContent = 'Veuillez entrer un prix valide (nombre positif) ou "free"';
                isValid = false;
            }

            // Validation de l'image
            const image = document.querySelector('[name="image"]').files[0];
            if (!image) {
                document.getElementById('imageError').textContent = 'Veuillez choisir une image';
                isValid = false;
            } else if (!image.type.startsWith('image/')) {
                document.getElementById('imageError').textContent = 'Le fichier doit être une image';
                isValid = false;
            }

            // Validation du lien
            const lien = document.querySelector('[name="lien"]').value.trim();
            const urlRegex = /^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/;
            if (!lien || !urlRegex.test(lien)) {
                document.getElementById('lienError').textContent = 'Veuillez entrer une URL valide';
                isValid = false;
            }

            // Validation de l'ID Club
            const idClub = document.querySelector('[name="id_club"]').value.trim();
            if (idClub !== '' && parseInt(idClub) < 1) {
                document.getElementById('idClubError').textContent = 'Veuillez entrer un ID de club valide ou laisser vide pour NULL';
                isValid = false;
            } else {
                document.getElementById('idClubError').textContent = '';
            }

            // Si tout est valide, soumettre le formulaire
            if (isValid) {
                form.submit();
            }
        });
    });
</script>

<!-- Vendor Scripts -->
<script src="assets/vendor/jquery/jquery.js"></script>
<script src="assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.js"></script>
<script src="assets/vendor/nanoscroller/nanoscroller.js"></script>
<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="assets/vendor/magnific-popup/magnific-popup.js"></script>
<script src="assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>

<!-- Theme Base, Components and Settings -->
<script src="assets/javascripts/theme.js"></script>
<script src="assets/javascripts/theme.custom.js"></script>
<script src="assets/javascripts/theme.init.js"></script>

</body>
</html>