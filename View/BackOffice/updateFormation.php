<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/PROJETWEB/config.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/PROJETWEB/Model/formations.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/PROJETWEB/Controller/formationC.php');

$error = "";
$formationC = new Formationc();

// Récupérer la formation à modifier
if (isset($_GET['id_formation'])) {
    $formation = $formationC->getFormationById($_GET['id_formation']);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Gestion de l'image
        $image = $formation['image']; // Changé de 'logo' à 'image'
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $image = uniqid() . '_' . $_FILES['image']['name'];
            $upload_dir = "../../uploads/";
            
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            
            move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . $image);
        }

        // Traitement du prix
        $prix = $_POST['prix'] ?? '';
        $prixValue = ($prix === 'free') ? 0 : (is_numeric($prix) ? (int)$prix : null);

        // Création de l'objet Formation avec les nouvelles données
        $updatedFormation = new Formation(
            intval($_GET['id_formation']),
            $_POST['nom_formation'],
            $_POST['description'],
            $_POST['organisme'],
            $prixValue,
            $image,
            $_POST['lien'],
            !empty($_POST['id_club']) ? (int)$_POST['id_club'] : null,
            $_POST['date_formation'] // Ajout de la date
        );

        // Tentative de mise à jour
        if ($formationC->updateFormation($updatedFormation)) {
            header('Location: listFormations.php');
            exit();
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>

<!doctype html>
<html class="fixed">
<head>
    <!-- Basic -->
    <meta charset="UTF-8">
    <title>Modifier une Formation</title>
    
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

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
                    <h2>Modifier une Formation</h2>
                </header>

                <!-- start: page -->
                <div class="row">
                    <div class="col-lg-12">
                        <section class="panel">
                            <header class="panel-heading">
                                <h2 class="panel-title">Formulaire de modification</h2>
                            </header>
                            <div class="panel-body">
                                <?php if ($error): ?>
                                    <div class="alert alert-danger">
                                        <strong>Erreur!</strong> <?php echo $error; ?>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if ($formation): ?>
                                    <form id="formationForm" class="form-horizontal form-bordered" method="POST" action="updateFormation.php?id_formation=<?php echo $formation['id_formation']; ?>" enctype="multipart/form-data">
                                        
                                        <!-- Nom de la Formation -->
                                        <div class="form-group row">
                                            <label class="col-lg-3 control-label text-lg-right pt-2">Nom de la Formation</label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control" name="nom_formation" value="<?php echo htmlspecialchars($formation['nom_formation']); ?>">
                                                <span class="error-message" id="nomError"></span>
                                            </div>
                                        </div>

                                        <!-- Description -->
                                        <div class="form-group row">
                                            <label class="col-lg-3 control-label text-lg-right pt-2">Description</label>
                                            <div class="col-lg-9">
                                                <textarea class="form-control" rows="3" name="description"><?php echo htmlspecialchars($formation['description']); ?></textarea>
                                                <span class="error-message" id="descriptionError"></span>
                                            </div>
                                        </div>

                                        <!-- Organisme -->
                                        <div class="form-group row">
                                            <label class="col-lg-3 control-label text-lg-right pt-2">Organisme</label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control" name="organisme" value="<?php echo htmlspecialchars($formation['organisme']); ?>">
                                                <span class="error-message" id="organismeError"></span>
                                            </div>
                                        </div>

                                        <!-- Prix -->
                                        <div class="form-group row">
                                            <label class="col-lg-3 control-label text-lg-right pt-2">Prix</label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control" name="prix" value="<?php echo $formation['prix'] == 0 ? 'free' : $formation['prix']; ?>">
                                                <span class="error-message" id="prixError"></span>
                                            </div>
                                        </div>

                                        <!-- Image -->
                                        <div class="form-group row">
                                            <label class="col-lg-3 control-label text-lg-right pt-2">Image</label>
                                            <div class="col-lg-9">
                                                <input type="file" class="form-control" name="image">
                                                <span class="error-message" id="imageError"></span>
                                                <?php if (!empty($formation['image'])): ?>
                                                    <div id="currentImage">
                                                        <img src="../../uploads/<?php echo htmlspecialchars($formation['image']); ?>" 
                                                             style="max-width: 200px; margin-top: 10px;">
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <!-- Lien -->
                                        <div class="form-group row">
                                            <label class="col-lg-3 control-label text-lg-right pt-2">Lien</label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control" name="lien" value="<?php echo htmlspecialchars($formation['lien']); ?>">
                                                <span class="error-message" id="lienError"></span>
                                            </div>
                                        </div>

                                        <!-- ID Club -->
                                        <div class="form-group row">
                                            <label class="col-lg-3 control-label text-lg-right pt-2">ID Club</label>
                                            <div class="col-lg-9">
                                                <input type="number" class="form-control" name="id_club" value="<?php echo htmlspecialchars($formation['id_club']); ?>">
                                                <span class="error-message" id="idClubError"></span>
                                            </div>
                                        </div>

                                        <!-- Date de la formation -->
                                        <div class="form-group row">
                                            <label class="col-lg-3 control-label text-lg-right pt-2">Date de la formation</label>
                                            <div class="col-lg-9">
                                                <input type="date" class="form-control" name="date_formation" 
                                                       value="<?php echo !empty($formation['date']) ? htmlspecialchars($formation['date']) : ''; ?>" 
                                                       required>
                                                <span class="error-message" id="dateError"></span>
                                            </div>
                                        </div>

                                        <!-- Bouton de soumission -->
                                        <div class="form-group row">
                                            <div class="col-lg-9 col-lg-offset-3">
                                                <button type="submit" class="btn btn-primary">Modifier</button>
                                            </div>
                                        </div>
                                    </form>
                                <?php else: ?>
                                    <p>Formation non trouvée.</p>
                                <?php endif; ?>
                            </div>
                        </section>
                    </div>
                </div>
            </section>
        </div>
    </section>

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

    <!-- Validation Script -->
    <script>
    document.getElementById('formationForm').addEventListener('submit', function(event) {
        event.preventDefault();
        if (validateForm()) {
            this.submit();
        }
    });

    function validateForm() {
        // Réinitialiser les erreurs
        document.querySelectorAll('.error-message').forEach(error => {
            error.textContent = '';
        });
        
        let isValid = true;

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
        }

        return isValid;
    }

    // Prévisualisation de l'image
    document.querySelector('[name="image"]').addEventListener('change', function(e) {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').innerHTML = 
                    `<img src="${e.target.result}" style="max-width: 200px; margin-top: 10px;">`;
            }
            reader.readAsDataURL(file);
        }
    });
    </script>
</body>
</html>
