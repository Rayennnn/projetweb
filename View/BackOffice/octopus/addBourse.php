<?php
require_once '../../../Controller/bourseC.php';
require_once '../../../Model/bourses.php';

// Définir le chemin pour les uploads
$uploadDir = '../../../uploads/';

if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo '<pre>';
    print_r($_POST); // Affichez les données soumises
    echo '</pre>';

    // Créer une instance du contrôleur
    $bourseC = new BourseC();

    try {
        // Définir l'ID du programme
        $id_prog = 6; // Gardez la valeur de prog fixe
        $programmeExists = $bourseC->verifierProgramme($id_prog); // Utilisez $id_prog ici

        if (!$programmeExists) {
            throw new Exception("Le programme avec l'ID spécifié n'existe pas.");
        }

        // Traitement de l'image
        $imageName = '';
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $imageName = time() . '_' . basename($_FILES['image']['name']);
            $targetPath = $uploadDir . $imageName;

            if (!move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                throw new Exception("Erreur lors de l'upload de l'image.");
            }
        }

        // Créer une nouvelle instance de Bourse
        $bourse = new Bourse();
        $bourse->setNomBourse($_POST['titre']);
        $bourse->setDescription($_POST['desc']);
        $bourse->setOrganisme($_POST['organisme']);
        $bourse->setDateLimite($_POST['dateLimite']);
        $bourse->setAgeLimite($_POST['age_limite']);
        $bourse->setNiveauEtude($_POST['niveau']);
        $bourse->setPays($_POST['pays']);
        $bourse->setFrais($_POST['frais']);
        $bourse->setLien($_POST['lien']);
        $bourse->setImage($imageName);
        $bourse->setProg($id_prog); // Assurez-vous que prog est défini
        

        if ($bourseC->ajouterBourse($bourse)) {
            header('Location: listebourse.php?success=add');
            exit;
        } else {
            throw new Exception("Erreur lors de l'ajout de la bourse.");
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html class="fixed">
<head>
    <meta charset="UTF-8">
    <title>Ajouter une Bourse</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Web Fonts -->
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
</head>
<body>
    <section class="body">
        <!-- start: header -->
        <header class="header">
            <div class="logo-container">
                <a href="index.php" class="logo">
                    <img src="assets/images/logo.png" height="35" alt="Admin" />
                </a>
            </div>
        </header>
        <div class="inner-wrapper">
                <!-- start: sidebar -->
                <aside id="sidebar-left" class="sidebar-left">
    <div class="sidebar-header">
        <div class="sidebar-title">Navigation</div>
    </div>
    <div class="nano">
        <div class="nano-content">
            <nav id="menu" class="nav-main" role="navigation">
                <ul class="nav nav-main">
                <li class="nav-active">
                        <a href="stat.php">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                  
                    <li class="nav-active">
                        <a href="index.php">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            <span>liste des programmes d'echanges</span>
                        </a>
                    </li>
                    <li class="nav-active">
                        <a href="listebourse.php">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            <span>liste des bourses</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</aside>

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
								<li class="nav-parent">
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
                    <li class="nav-parent">
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
												<a href="../../../afficherquestion.php">
													 questions
												</a>
											</li>
											<li>
												<a href="../../../affichereponse.php">
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
												<a href="../../../octopus/addBourse.php">
													 Bourses
												</a>
											</li>
											<li>
												<a href="../../../octopus/addprogramme.php">
													 programmes d'échanges
												</a>
											</li>
											
										</ul>
									</li>
									
									<li class="nav-parent">
										<a href ="../../../admin-comments.php">
											<i class="fa fa-columns" aria-hidden="true"></i>
											<span>témoignage</span>
										</a>
										
									</li>
							<!-- Ajout du menu suggestions -->		
											
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
											<li>
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
                    <h2>Ajouter une Bourse</h2>
                </header>

                <!-- Formulaire d'ajout -->
                <div class="row">
                    <div class="col-lg-12">
                        <section class="panel">
                            <header class="panel-heading">
                                <h2 class="panel-title">Nouvelle Bourse</h2>
                            </header>
                            <div class="panel-body">
                                <?php if (isset($error)): ?>
                                    <div class="alert alert-danger">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <strong>Erreur!</strong> <?php echo $error; ?>
                                    </div>
                                <?php endif; ?>

                                <form method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Image</label>
                                        <div class="col-md-6">
                                            <input type="file" name="image" class="form-control" id="image">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Titre</label>
                                        <div class="col-md-6">
                                            <input type="text" name="titre" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Description</label>
                                        <div class="col-md-6">
                                            <textarea name="desc" class="form-control" rows="3"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Organisme</label>
                                        <div class="col-md-6">
                                            <input type="text" name="organisme" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Date Limite</label>
                                        <div class="col-md-6">
                                            <input type="date" name="dateLimite" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Âge Limite</label>
                                        <div class="col-md-6">
                                            <input type="number" name="age_limite" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Niveau d'études</label>
                                        <div class="col-md-6">
                                            <select name="niveau" class="form-control">
                                                <option value="">Sélectionner un niveau</option>
                                                <option value="licence">Licence</option>
                                                <option value="master">Master</option>
                                                <option value="doctorat">Doctorat</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Pays</label>
                                        <div class="col-md-6">
                                            <select name="pays" class="form-control">
                                                <option value="">Sélectionner un pays</option>
                                                <option value="allemagne">Allemagne</option>
                                                <option value="france">France</option>
                                                <option value="canada">Canada</option>
                                                <option value="usa">États-Unis</option>
                                                <option value="royaume-uni">Royaume-Uni</option>
                                                <option value="espagne">Espagne</option>
                                                <option value="italie">Italie</option>
                                                <option value="japon">Japon</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">frais</label>
                                        <div class="col-md-6">
                                            <input type="number" name="frais" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Lien</label>
                                        <div class="col-md-6">
                                            <input type="url" name="lien" class="form-control" 
                                                   placeholder="https://example.com">
                                        </div>
                                        
                                    </div>

                             
                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-3">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-save"></i> Enregistrer
                                            </button>
                                            <a href="listebourse.php" class="btn btn-default">
                                                <i class="fa fa-arrow-left"></i> Annuler
                                            </a>
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
    <script src="assets/vendor/bootstrap/js/bootstrap.js"></script>
    <script src="assets/vendor/nanoscroller/nanoscroller.js"></script>
    <script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script src="assets/vendor/magnific-popup/magnific-popup.js"></script>
    <script src="assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
    
    <!-- Theme Base, Components and Settings -->
  
    
    <script>
    function validateForm() {
        // Validation de l'image
        const image = document.getElementById('image');
        if (!image.files || image.files.length === 0) {
            alert('Une image est requise');
            image.focus();
            return false;
        }

        // Validation du titre
        const titre = document.querySelector('input[name="titre"]');
        if (!titre.value.trim()) {
            alert('Le titre est obligatoire');
            titre.focus();
            return false;
        }
        if (titre.value.length < 3) {
            alert('Le titre doit contenir au moins 3 caractères');
            titre.focus();
            return false;
        }

        // Validation de la description
        const description = document.querySelector('textarea[name="desc"]');
        if (!description.value.trim()) {
            alert('La description est obligatoire');
            description.focus();
            return false;
        }
        if (description.value.length < 10) {
            alert('La description doit contenir au moins 10 caractères');
            description.focus();
            return false;
        }

        // Validation de l'organisme
        const organisme = document.querySelector('input[name="organisme"]');
        if (!organisme.value.trim()) {
            alert("Le nom de l'organisme est obligatoire");
            organisme.focus();
            return false;
        }

        // Validation de la date limite
        const dateLimite = document.querySelector('input[name="dateLimite"]');
        if (!dateLimite.value) {
            alert('La date limite est obligatoire');
            dateLimite.focus();
            return false;
        }
        const today = new Date();
        const selectedDate = new Date(dateLimite.value);
        if (selectedDate < today) {
            alert('La date limite doit être ultérieure à aujourd\'hui');
            dateLimite.focus();
            return false;
        }

        // Validation de l'âge limite
        const ageLimite = document.querySelector('input[name="age_limite"]');
        if (!ageLimite.value) {
            alert("L'âge limite est obligatoire");
            ageLimite.focus();
            return false;
        }
        if (isNaN(ageLimite.value) || ageLimite.value < 16 || ageLimite.value > 100) {
            alert("L'âge limite doit être entre 16 et 100 ans");
            ageLimite.focus();
            return false;
        }

        // Validation du niveau d'études
        const niveau = document.querySelector('select[name="niveau"]');
        if (!niveau.value) {
            alert("Le niveau d'études est obligatoire");
            niveau.focus();
            return false;
        }

        // Validation du pays
        const pays = document.querySelector('select[name="pays"]');
        if (!pays.value) {
            alert('Le pays est obligatoire');
            pays.focus();
            return false;
        }

        // Validation du lien
        const lien = document.querySelector('input[name="lien"]');
        if (!lien.value.trim()) {
            alert('Le lien est obligatoire');
            lien.focus();
            return false;
        }
        const urlPattern = /^(https?:\/\/)?([\da-z.-]+)\.([a-z.]{2,6})([\/\w .-]*)*\/?$/;
        if (!urlPattern.test(lien.value)) {
            alert('Le format du lien est invalide');
            lien.focus();
            return false;
        }

        // Validation de l'ID programme
        const id_prog = document.querySelector('input[name="id_prog"]');
        if (!id_prog.value) {
            alert('L\'ID programme est obligatoire');
            id_prog.focus();
            return false;
        }

        return true;
    }
    </script>
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