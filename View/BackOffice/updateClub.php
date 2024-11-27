<?php
if (!class_exists('Club')) {
    require_once '../../Model/clubs.php';
}
require_once '../../Controller/clubC.php';

$error = "";
$club = null;
$clubC = new ClubC();

// Récupérer le club à modifier
if (isset($_GET['id_club'])) {
    $club = $clubC->getClubById($_GET['id_club']);
}
?>

<!doctype html>
<html class="fixed">
    <head>
        <!-- Basic -->
        <meta charset="UTF-8">
        <title>Modifier un Club</title>
        
        <!-- Mêmes liens CSS que dans addClub.php -->
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
                                    <?php if ($club): ?>
                                    <form class="form-horizontal form-bordered" method="POST" action="" enctype="multipart/form-data">
                                        <!-- Nom du Club -->
                                        <div class="form-group row">
                                            <label class="col-lg-3 control-label text-lg-right pt-2">Nom du Club</label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control" name="nom_club" value="<?php echo $club['nom_club']; ?>">
                                                <span class="error-message" id="nomError" style="color:red;"></span>
                                            </div>
                                        </div>

                                        <!-- Description -->
                                        <div class="form-group row">
                                            <label class="col-lg-3 control-label text-lg-right pt-2">Description</label>
                                            <div class="col-lg-9">
                                                <textarea class="form-control" rows="3" name="description"><?php echo $club['description']; ?></textarea>
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
                                                    <input type="date" class="form-control" name="date_creation" value="<?php echo $club['date_creation']; ?>">
                                                </div>
                                                <span class="error-message" id="dateError" style="color:red;"></span>
                                            </div>
                                        </div>

                                        <!-- Catégorie -->
                                        <div class="form-group row">
                                            <label class="col-lg-3 control-label text-lg-right pt-2">Catégorie</label>
                                            <div class="col-lg-9">
                                                <select class="form-control" name="categorie">
                                                    <option value="Culture" <?php echo ($club['categorie'] == 'Culture') ? 'selected' : ''; ?>>Culture</option>
                                                    <option value="Sport" <?php echo ($club['categorie'] == 'Sport') ? 'selected' : ''; ?>>Sport</option>
                                                    <option value="Technologie" <?php echo ($club['categorie'] == 'Technologie') ? 'selected' : ''; ?>>Technologie</option>
                                                    <option value="Art" <?php echo ($club['categorie'] == 'Art') ? 'selected' : ''; ?>>Art</option>
                                                    <option value="Social" <?php echo ($club['categorie'] == 'Social') ? 'selected' : ''; ?>>Social</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Lieu -->
                                        <div class="form-group row">
                                            <label class="col-lg-3 control-label text-lg-right pt-2">Lieu</label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control" name="lieu" value="<?php echo $club['lieu']; ?>">
                                                <span class="error-message" id="lieuError" style="color:red;"></span>
                                            </div>
                                        </div>

                                        <!-- Logo -->
                                        <div class="form-group row">
                                            <label class="col-lg-3 control-label text-lg-right pt-2">Logo</label>
                                            <div class="col-lg-9">
                                                <input type="file" class="form-control" name="logo">
                                                <div id="logoPreview">
                                                    <?php if ($club['logo']): ?>
                                                        <img src="<?php echo $club['logo']; ?>" alt="Logo actuel" style="max-width: 200px; margin-top: 10px;">
                                                    <?php endif; ?>
                                                </div>
                                                <span class="error-message" id="logoError" style="color:red;"></span>
                                            </div>
                                        </div>

                                        <!-- Lien -->
                                        <div class="form-group row">
                                            <label class="col-lg-3 control-label text-lg-right pt-2">Lien</label>
                                            <div class="col-lg-9">
                                                <input type="url" class="form-control" name="lien" value="<?php echo $club['lien']; ?>">
                                                <span class="error-message" id="lienError" style="color:red;"></span>
                                            </div>
                                        </div>

                                        <!-- Boutons -->
                                        <div class="form-group row">
                                            <div class="col-lg-9 col-lg-offset-3">
                                                <button type="submit" class="btn btn-primary">Modifier</button>
                                                <button type="reset" class="btn btn-default">Réinitialiser</button>
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

        <!-- Validation Script -->
        <script>
            // Votre script de validation existant
        </script>
    </body>
</html>