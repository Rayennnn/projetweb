<?php
require_once '../../../Controller/bourseC.php';
require_once '../../../Model/bourses.php';

// Initialisation
$bourseC = new BourseC();
$error = null;
$success = null;
$bourse = null;

// Vérifier si un ID est fourni
if (!isset($_GET['id'])) {
    header('Location: index.php?error=noid');
    exit();
}

// Récupérer la bourse
try {
    $bourse = $bourseC->getBourseById($_GET['id']);
    if (!$bourse) {
        header('Location: index.php?error=notfound');
        exit();
    }
} catch (Exception $e) {
    header('Location: index.php?error=fetch');
    exit();
}

// Traitement du formulaire de modification
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $updatedBourse = new Bourse();
        $updatedBourse->setId($_GET['id']);
        $updatedBourse->setNomBourse($_POST['titre']);
        $updatedBourse->setDescription($_POST['desc']);
        $updatedBourse->setOrganisme($_POST['organisme']);
        $updatedBourse->setDateLimite($_POST['dateLimite']);
        $updatedBourse->setAgeLimite($_POST['age_limite']);
        $updatedBourse->setNiveauEtude($_POST['niveau']);
        $updatedBourse->setPays($_POST['pays']);
        $updatedBourse->setLien($_POST['lien']);

        // Traitement de la nouvelle image si fournie
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $imageName = time() . '_' . basename($_FILES['image']['name']);
            $uploadDir = '../../../uploads/';
            $targetPath = $uploadDir . $imageName;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                // Supprimer l'ancienne image si elle existe
                if ($bourse['image'] && file_exists($uploadDir . $bourse['image'])) {
                    unlink($uploadDir . $bourse['image']);
                }
                $updatedBourse->setImage($imageName);
            } else {
                throw new Exception("Erreur lors de l'upload de l'image.");
            }
        } else {
            // Conserver l'ancienne image
            $updatedBourse->setImage($bourse['image']);
        }

        if ($bourseC->modifierBourse($updatedBourse)) {
            $success = "La bourse a été modifiée avec succès.";
            // Recharger les données mises à jour
            $bourse = $bourseC->getBourseById($_GET['id']);
        } else {
            throw new Exception("Erreur lors de la modification de la bourse.");
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
    <title>Modifier une Bourse</title>
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
                    <div class="sidebar-title">
                        Navigation
                    </div>
                    <div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
                        <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
                    </div>
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
                        <a href="addBourse.php">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            <span>ajout bourse</span>
                        </a>
                    </li>
                    <li class="nav-active">
                        <a href="addprogramme.php">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            <span>ajout programme d'echange</span>
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

            <section role="main" class="content-body">
                <header class="page-header">
                    <h2>Modifier une Bourse</h2>
                </header>

                <?php if ($error): ?>
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <strong>Erreur!</strong> <?php echo htmlspecialchars($error); ?>
                </div>
                <?php endif; ?>

                <?php if ($success): ?>
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <strong>Succès!</strong> <?php echo htmlspecialchars($success); ?>
                </div>
                <?php endif; ?>

                <div class="row">
                    <div class="col-lg-12">
                        <section class="panel">
                            <header class="panel-heading">
                                <h2 class="panel-title">Modifier la Bourse</h2>
                            </header>
                            <div class="panel-body">
                                <form action="" method="POST" enctype="multipart/form-data" class="form-horizontal form-bordered">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Image actuelle</label>
                                        <div class="col-md-6">
                                            <?php if ($bourse['image']): ?>
                                                <img src="../../../uploads/<?php echo htmlspecialchars($bourse['image']); ?>" 
                                                     alt="Image actuelle" style="max-width: 200px;">
                                            <?php else: ?>
                                                <p>Aucune image</p>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Nouvelle Image</label>
                                        <div class="col-md-6">
                                            <input type="file" name="image" class="form-control">
                                            <span class="help-block">Laissez vide pour conserver l'image actuelle</span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Titre</label>
                                        <div class="col-md-6">
                                            <input type="text" name="titre" class="form-control" 
                                                   value="<?php echo htmlspecialchars($bourse['nom_bourse']); ?>" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Description</label>
                                        <div class="col-md-6">
                                            <textarea name="desc" class="form-control" rows="3" required><?php echo htmlspecialchars($bourse['description']); ?></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Organisme</label>
                                        <div class="col-md-6">
                                            <input type="text" name="organisme" class="form-control" 
                                                   value="<?php echo htmlspecialchars($bourse['organisme']); ?>" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Date Limite</label>
                                        <div class="col-md-6">
                                            <input type="date" name="dateLimite" class="form-control" 
                                                   value="<?php echo htmlspecialchars($bourse['date_limite']); ?>" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Âge Limite</label>
                                        <div class="col-md-6">
                                            <input type="number" name="age_limite" class="form-control" 
                                                   value="<?php echo htmlspecialchars($bourse['age_limite']); ?>" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Niveau d'études</label>
                                        <div class="col-md-6">
                                            <select name="niveau" class="form-control" required>
                                                <option value="licence" <?php echo $bourse['niveau_etude'] == 'licence' ? 'selected' : ''; ?>>Licence</option>
                                                <option value="master" <?php echo $bourse['niveau_etude'] == 'master' ? 'selected' : ''; ?>>Master</option>
                                                <option value="doctorat" <?php echo $bourse['niveau_etude'] == 'doctorat' ? 'selected' : ''; ?>>Doctorat</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Pays</label>
                                        <div class="col-md-6">
                                            <select name="pays" class="form-control" required>
                                                <option value="allemagne" <?php echo $bourse['pays'] == 'allemagne' ? 'selected' : ''; ?>>Allemagne</option>
                                                <option value="france" <?php echo $bourse['pays'] == 'france' ? 'selected' : ''; ?>>France</option>
                                                <option value="canada" <?php echo $bourse['pays'] == 'canada' ? 'selected' : ''; ?>>Canada</option>
                                                <option value="usa" <?php echo $bourse['pays'] == 'usa' ? 'selected' : ''; ?>>États-Unis</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Lien</label>
                                        <div class="col-md-6">
                                            <input type="url" name="lien" class="form-control" 
                                                   value="<?php echo htmlspecialchars($bourse['lien']); ?>" required>
                                        </div>
                                    </div>
                                    
                                      <!-- Autres champs ici -->
                                     <div class="form-group">
                                      <label for="id_prog">ID Programme</label>
                                     <input type="number" name="id_prog" id="id_prog" value="<?php echo $bourse->getIdProg(); ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-3">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-save"></i> Enregistrer les modifications
                                            </button>
                                            <a href="index.php" class="btn btn-default">
                                                <i class="fa fa-arrow-left"></i> Retour
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
