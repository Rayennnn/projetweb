<?php
require_once '../../../Controller/programmeC.php';
require_once '../../../Model/programme.php';

// Définir le chemin pour les uploads
$uploadDir = '../../../uploads/';

if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Traitement de l'image
        $imageName = '';
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $imageName = time() . '_' . basename($_FILES['image']['name']);
            $targetPath = $uploadDir . $imageName;
            
            if (!move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                throw new Exception("Erreur lors de l'upload de l'image.");
            }
        }

        // Créer une nouvelle instance de programme
        $programme = new Programme();
        $programme->setNomProgramme($_POST['titre']);
        $programme->setDescription($_POST['desc']);
        $programme->setOrganisme($_POST['organisme']);
        $programme->setDateLimite($_POST['dateLimite']);
        $programme->setAgeLimite($_POST['age_limite']);
        $programme->setNiveauEtude($_POST['niveau']);
        $programme->setPays($_POST['pays']);
        $programme->setLien($_POST['lien']);
        $programme->setImage($imageName);

        // Créer une instance du contrôleur
        $programmeC = new ProgrammeC();
        
        if ($programmeC->ajouterProgramme($programme)) {
            header('Location: index.php?success=add');
            exit;
        } else {
            throw new Exception("Erreur lors de l'ajout du programme d'echange.");
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
    <title>Ajouter un programme d'echange</title>
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
            <section role="main" class="content-body">
                <header class="page-header">
                    <h2>Ajouter un programme d'echange</h2>
                </header>

                <!-- Formulaire d'ajout -->
                <div class="row">
                    <div class="col-lg-12">
                        <section class="panel">
                            <header class="panel-heading">
                                <h2 class="panel-title">Nouveau programme d'echange</h2>
                            </header>
                            <div class="panel-body">
                                <?php if (isset($error)): ?>
                                    <div class="alert alert-danger">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <strong>Erreur!</strong> <?php echo $error; ?>
                                    </div>
                                <?php endif; ?>

                                <form action="" method="POST" enctype="multipart/form-data" class="form-horizontal form-bordered" onsubmit="return validateForm()">
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
                                            <a href="index.php" class="btn btn-default">
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
    <script src="assets/javascripts/theme.js"></script>
    <script>
   

			
			
			
function validateForm() {
    // Récupération des valeurs
    const image = document.getElementById('image').value;
    const titre = document.querySelector('input[name="titre"]').value;
    const description = document.querySelector('textarea[name="desc"]').value;
    const organisme = document.querySelector('input[name="organisme"]').value;
    const dateLimite = document.querySelector('input[name="dateLimite"]').value;
    const ageLimite = document.querySelector('input[name="age_limite"]').value;
    const niveau = document.querySelector('select[name="niveau"]').value;
    const pays = document.querySelector('select[name="pays"]').value;
    const lien = document.querySelector('input[name="lien"]').value;

    // Validation de l'image
    if (image === '') {
        alert('Veuillez sélectionner une image');
        return false;
    }

    // Validation du titre
    if (titre.trim() === '') {
        alert('Le titre du programme est obligatoire');
        return false;
    }
    if (titre.length < 3) {
        alert('Le titre doit contenir au moins 3 caractères');
        return false;
    }

    // Validation de la description
    if (description.trim() === '') {
        alert('La description est obligatoire');
        return false;
    }
    if (description.length < 10) {
        alert('La description doit contenir au moins 10 caractères');
        return false;
    }

    // Validation de l'organisme
    if (organisme.trim() === '') {
        alert("Le nom de l'organisme est obligatoire");
        return false;
    }

    // Validation de la date limite
    if (dateLimite === '') {
        alert('La date limite est obligatoire');
        return false;
    }
    const today = new Date();
    const selectedDate = new Date(dateLimite);
    if (selectedDate < today) {
        alert('La date limite doit être ultérieure à aujourd\'hui');
        return false;
    }

    // Validation de l'âge limite
    if (ageLimite === '' || isNaN(ageLimite)) {
        alert("L'âge limite doit être un nombre");
        return false;
    }
    if (ageLimite < 16 || ageLimite > 100) {
        alert("L'âge limite doit être entre 16 et 100 ans");
        return false;
    }

    // Validation du niveau d'études
    if (niveau === '') {
        alert("Le niveau d'études est obligatoire");
        return false;
    }

    // Validation du pays
    if (pays === '') {
        alert('Le pays est obligatoire');
        return false;
    }

    // Validation du lien
    if (lien.trim() === '') {
        alert('Le lien est obligatoire');
        return false;
    }
    const urlPattern = /^(https?:\/\/)?([\da-z.-]+)\.([a-z.]{2,6})([\/\w .-]*)*\/?$/;
    if (!urlPattern.test(lien)) {
        alert('Le format du lien est invalide');
        return false;
    }

    return true;
}

    </script>
    
    
</body>
</html>