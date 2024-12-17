<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/PROJETWEB/config.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/PROJETWEB/Model/clubs.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/PROJETWEB/Controller/clubC.php');

$error = "";
$clubC = new ClubC();

// Récupérer le club à modifier
if (isset($_GET['id_club'])) {
    $club = $clubC->getClubById($_GET['id_club']);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Gestion du logo
        $logo = $club['logo']; // Garde l'ancien logo par défaut
        if (isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
            $logo = uniqid() . '_' . $_FILES['logo']['name'];
            $upload_dir = "../../uploads/";
            
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            
            move_uploaded_file($_FILES['logo']['tmp_name'], $upload_dir . $logo);
        }

        // Création de l'objet Club avec les nouvelles données
        $updatedClub = new Club(
            intval($_GET['id_club']),
            $_POST['nom_club'],
            $_POST['description'],
            $_POST['date_creation'],
            $_POST['categorie'],
            $_POST['lieu'],
            $logo,
            $_POST['lien']
        );

        // Tentative de mise à jour
        if ($clubC->updateClub($updatedClub)) {
            header('Location: listClubs.php');
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
    <title>Modifier un Club</title>
    
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
        <aside id="sidebar-left" class="sidebar-left">
    <div class="sidebar-header">
        <div class="sidebar-title">Navigation</div>
    </div>
    
    
    <div class="nano">
						<div class="nano-content">
							<nav id="menu" class="nav-main" role="navigation">
								<ul class="nav nav-main">
								<li class="nav-parent nav-active">
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
                    <li class="nav-parent ">
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
									
											
									<li class="nav-parent  ">
										<a>
											<i class="fa fa-list-alt" aria-hidden="true"></i>
											<span>suggestion</span>
										</a>
										<ul class="nav nav-children">
										<li >
											
												<a href="\PROJETWEB\View\BackOffice\octopus-master\octopus-master\octopus\addreponse.php">
													 ajouter reponse
												</a>
											</li>
											<li>
												<a href="\PROJETWEB\View\BackOffice\octopus-master\octopus-master\octopus\listereponsesug.php">
													 liste reponse
												</a>
											</li>
											<li>
												<a href="\PROJETWEB\View\BackOffice\octopus-master\octopus-master\octopus\listesuggestion.php">
												liste suggestion et reclamation
												</a>
											</li>
											<li>
												<a href="\PROJETWEB\View\BackOffice\octopus-master\octopus-master\octopus\statistiques.php">
													 statistiques
												</a>
											</li>
											
										</ul>
									</li>
									
									
							
				
							<hr class="separator" />
				
							
							
				
					</div>
</aside>

            <section role="main" class="content-body">
                <header class="page-header">
                    <h2>Modifier un Club</h2>
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
                                
                                <?php if ($club): ?>
                                    <form id="clubForm" class="form-horizontal form-bordered" method="POST" action="updateClub.php?id_club=<?php echo $club['id_club']; ?>" enctype="multipart/form-data">
                                        <input type="hidden" name="validated" value="false">
                                        
                                        <!-- Nom du Club -->
                                        <div class="form-group row">
                                            <label class="col-lg-3 control-label text-lg-right pt-2">Nom du Club</label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control" name="nom_club" value="<?php echo htmlspecialchars($club['nom_club']); ?>">
                                                <span class="error-message" id="nomError"></span>
                                            </div>
                                        </div>

                                        <!-- Description -->
                                        <div class="form-group row">
                                            <label class="col-lg-3 control-label text-lg-right pt-2">Description</label>
                                            <div class="col-lg-9">
                                                <textarea class="form-control" rows="3" name="description"><?php echo htmlspecialchars($club['description']); ?></textarea>
                                                <span class="error-message" id="descriptionError"></span>
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
                                                    <input type="date" class="form-control" name="date_creation" value="<?php echo htmlspecialchars($club['date_creation']); ?>">
                                                </div>
                                                <span class="error-message" id="dateError"></span>
                                            </div>
                                        </div>

                                        <!-- Catégorie -->
                                        <div class="form-group row">
                                            <label class="col-lg-3 control-label text-lg-right pt-2">Catégorie</label>
                                            <div class="col-lg-9">
                                                <select class="form-control" name="categorie">
                                                    <option value="">Sélectionnez une catégorie</option>
                                                    <option value="Sport" <?php echo $club['categorie'] == 'Sport' ? 'selected' : ''; ?>>Sport</option>
                                                    <option value="Culture" <?php echo $club['categorie'] == 'Culture' ? 'selected' : ''; ?>>Culture</option>
                                                    <option value="Art" <?php echo $club['categorie'] == 'Art' ? 'selected' : ''; ?>>Art</option>
                                                    <option value="Technologie" <?php echo $club['categorie'] == 'Technologie' ? 'selected' : ''; ?>>Technologie</option>
                                                    <option value="Social" <?php echo $club['categorie'] == 'Social' ? 'selected' : ''; ?>>Social</option>
                                                    <option value="Litérraire" <?php echo $club['categorie'] == 'Litérraire' ? 'selected' : ''; ?>>Litérraire</option>
                                                    <option value="Entrepreneriat" <?php echo $club['categorie'] == 'Entrepreneriat' ? 'selected' : ''; ?>>Entrepreneriat</option>
                                                    <option value="Environnement" <?php echo $club['categorie'] == 'Environnement' ? 'selected' : ''; ?>>Environnement</option>
                                                    <option value="Santé" <?php echo $club['categorie'] == 'Santé' ? 'selected' : ''; ?>>Santé</option>
                                                    
                                                    <!-- Ajoutez d'autres catégories selon vos besoins -->
                                                </select>
                                                <span class="error-message" id="categorieError"></span>
                                            </div>
                                        </div>

                                        <!-- Lieu -->
                                        <div class="form-group row">
                                            <label class="col-lg-3 control-label text-lg-right pt-2">Lieu</label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control" name="lieu" value="<?php echo htmlspecialchars($club['lieu']); ?>">
                                                <span class="error-message" id="lieuError"></span>
                                            </div>
                                        </div>

                                        <!-- Logo -->
                                        <div class="form-group row">
                                            <label class="col-lg-3 control-label text-lg-right pt-2">Logo</label>
                                            <div class="col-lg-9">
                                                <input type="file" class="form-control" name="logo">
                                                <span class="error-message" id="logoError"></span>
                                                <?php if (!empty($club['logo'])): ?>
                                                    <div id="currentLogo">
                                                        <img src="../../uploads/<?php echo htmlspecialchars($club['logo']); ?>" style="max-width: 200px; margin-top: 10px;">
                                                    </div>
                                                <?php endif; ?>
                                                <div id="logoPreview"></div>
                                            </div>
                                        </div>

                                        <!-- Lien -->
                                        <div class="form-group row">
                                            <label class="col-lg-3 control-label text-lg-right pt-2">Lien</label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control" name="lien" value="<?php echo htmlspecialchars($club['lien']); ?>">
                                                <span class="error-message" id="lienError"></span>
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
                                    <p>Club non trouvé.</p>
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
    document.getElementById('clubForm').addEventListener('submit', function(event) {
        event.preventDefault();
        if (validateForm()) {
            document.querySelector('[name="validated"]').value = 'true';
            this.submit();
        }
    });

    function validateForm() {
        // Réinitialiser les erreurs
        document.querySelectorAll('.error-message').forEach(error => {
            error.textContent = '';
        });
        
        let isValid = true;
        let errors = [];

        // Récupération des valeurs
        const nom = document.querySelector('[name="nom_club"]');
        const description = document.querySelector('[name="description"]');
        const date = document.querySelector('[name="date_creation"]');
        const categorie = document.querySelector('[name="categorie"]');
        const lieu = document.querySelector('[name="lieu"]');
        const lien = document.querySelector('[name="lien"]');
        const logo = document.querySelector('[name="logo"]');

        // Validation du nom
        if (!nom.value.trim()) {
            document.getElementById('nomError').textContent = 'Le nom est obligatoire';
            errors.push('Nom manquant');
            isValid = false;
        } else if (nom.value.trim().length < 3) {
            document.getElementById('nomError').textContent = 'Le nom doit contenir au moins 3 caractères';
            errors.push('Nom trop court');
            isValid = false;
        } else if (nom.value.trim().length > 30) {
            document.getElementById('nomError').textContent = 'Le nom ne doit pas dépasser 30 caractères';
            errors.push('Nom trop long');
            isValid = false;
        }

        // Validation de la description
        if (!description.value.trim()) {
            document.getElementById('descriptionError').textContent = 'La description est obligatoire';
            errors.push('Description manquante');
            isValid = false;
        } else if (description.value.trim().length < 10) {
            document.getElementById('descriptionError').textContent = 'La description doit contenir au moins 10 caractères';
            errors.push('Description trop courte');
            isValid = false;
        }

        // Validation de la date
        if (!date.value) {
            document.getElementById('dateError').textContent = 'La date est obligatoire';
            errors.push('Date manquante');
            isValid = false;
        } else {
            const selectedDate = new Date(date.value);
            const currentDate = new Date();
            if (selectedDate > currentDate) {
                document.getElementById('dateError').textContent = 'La date ne peut pas être dans le futur';
                errors.push('Date invalide');
                isValid = false;
            }
        }

        // Validation de la catégorie
        if (!categorie.value) {
            document.getElementById('categorieError').textContent = 'La catégorie est obligatoire';
            errors.push('Catégorie manquante');
            isValid = false;
        }

        // Validation du lieu
        if (!lieu.value.trim()) {
            document.getElementById('lieuError').textContent = 'Le lieu est obligatoire';
            errors.push('Lieu manquant');
            isValid = false;
        } else if (lieu.value.trim().length < 2) {
            document.getElementById('lieuError').textContent = 'Le lieu doit contenir au moins 2 caractères';
            errors.push('Lieu trop court');
            isValid = false;
        } else if (lieu.value.trim().length > 15) {
            document.getElementById('lieuError').textContent = 'Le lieu ne doit pas dépasser 15 caractères';
            errors.push('Lieu trop long');
            isValid = false;
        }



        // Validation du lien
        if (!lien.value.trim()) {
            document.getElementById('lienError').textContent = 'Le lien est obligatoire';
            errors.push('Lien manquant');
            isValid = false;
        } else {
            try {
                new URL(lien.value);
            } catch (_) {
                document.getElementById('lienError').textContent = 'Le lien doit être une URL valide';
                errors.push('Lien invalide');
                isValid = false;
            }
        }

        if (!isValid) {
            // Afficher le résumé des erreurs
            const errorSummary = document.createElement('div');
            errorSummary.className = 'alert alert-danger';
            errorSummary.innerHTML = '<strong>Erreurs:</strong><br>' + errors.join('<br>');
            
            // Supprimer l'ancien message d'erreur s'il existe
            const oldError = document.querySelector('.alert.alert-danger');
            if (oldError) {
                oldError.remove();
            }
            
            // Insérer le nouveau message d'erreur au début du formulaire
            const form = document.getElementById('clubForm');
            form.insertBefore(errorSummary, form.firstChild);
            
            // Faire défiler jusqu'au message d'erreur
            errorSummary.scrollIntoView({ behavior: 'smooth' });
        }

        return isValid;
    }

    // Prévisualisation du logo
    document.querySelector('[name="logo"]').addEventListener('change', function(e) {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('logoPreview').innerHTML = 
                    `<img src="${e.target.result}" style="max-width: 200px; margin-top: 10px;">`;
            }
            reader.readAsDataURL(file);
        }
    });
    </script>
</body>
</html>