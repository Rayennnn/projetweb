<?php
// Définir des constantes pour les chemins
define('CONTROLLER_PATH', '../../../Controller/');
define('MODEL_PATH', '../../../Model/');
define('ASSET_PATH', './assets/');

// Ajout des includes nécessaires
require_once CONTROLLER_PATH . 'bourseC.php';
require_once MODEL_PATH . 'bourses.php';
require_once CONTROLLER_PATH . 'programmeC.php';
require_once MODEL_PATH . 'programme.php';

// Initialisation des contrôleurs
$programmeController = new ProgrammeC();
$bourseC = new BourseC();
$programmeC = new ProgrammeC();

// Fonction pour récupérer les statistiques
function getStatistics($controller, $method) {
    return count($controller->$method());
}

// Récupération des statistiques
$totalBourses = getStatistics($bourseC, 'afficherBourses');
$totalProgrammes = getStatistics($programmeC, 'afficherProgrammes');

// Statistiques par pays
$bourseParPays = [];
$programmeParPays = [];

// Fonction pour compter les éléments par pays
function countByCountry($items) {
    $result = [];
    foreach ($items as $item) {
        $pays = htmlspecialchars($item['pays']);
        $result[$pays] = isset($result[$pays]) ? $result[$pays] + 1 : 1;
    }
    return $result;
}

// Compter les bourses et programmes par pays
$bourseParPays = countByCountry($bourseC->afficherBourses());
$programmeParPays = countByCountry($programmeC->afficherProgrammes());

// Récupération des statistiques supplémentaires
$totalEtudiants = 0; // Remplacez par la logique pour obtenir le nombre total d'étudiants
$nombreTotalBourses = array_sum($bourseParPays); // Total des bourses
$nombreTotalProgrammes = array_sum($programmeParPays); // Total des programmes

// Calcul de la moyenne des bourses par pays
$moyenneBoursesParPays = $nombreTotalBourses > 0 ? $nombreTotalBourses / count($bourseParPays) : 0;

// Calcul du pourcentage de programmes par rapport au total
$pourcentageProgrammes = $nombreTotalProgrammes > 0 ? ($nombreTotalProgrammes / ($nombreTotalBourses + $nombreTotalProgrammes)) * 100 : 0;

// Définir le chemin de base pour les assets de manière relative
$baseUrl = ASSET_PATH;
?>

<!doctype html>
<html class="fixed">
    <head>
        <!-- Basic -->
        <meta charset="UTF-8">
        <title>Dashboard | Gestion des Bourses</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="<?php echo $baseUrl; ?>vendor/bootstrap/css/bootstrap.css" />
        <link rel="stylesheet" href="<?php echo $baseUrl; ?>vendor/font-awesome/css/font-awesome.css" />
        <link rel="stylesheet" href="<?php echo $baseUrl; ?>vendor/magnific-popup/magnific-popup.css" />
        <link rel="stylesheet" href="<?php echo $baseUrl; ?>vendor/bootstrap-datepicker/css/datepicker3.css" />
        <link rel="stylesheet" href="<?php echo $baseUrl; ?>stylesheets/theme.css" />
        <link rel="stylesheet" href="<?php echo $baseUrl; ?>stylesheets/skins/default.css" />
        <link rel="stylesheet" href="<?php echo $baseUrl; ?>stylesheets/theme-custom.css">
        <script src="<?php echo $baseUrl; ?>vendor/modernizr/modernizr.js"></script>
        <?php
        echo "<!-- Current Directory: " . __DIR__ . " -->";
        echo "<!-- Document Root: " . $_SERVER['DOCUMENT_ROOT'] . " -->";
        ?>
    </head>
    <body>
        <section class="body">
            <header class="header">
                <div class="logo-container">
                    <a href="../" class="logo">
                        <img src="<?php echo $baseUrl; ?>images/logo.png" height="35" alt="Admin" />
                    </a>
                </div>
                <div class="header-right">
                    <div id="userbox" class="userbox">
                        <a href="#" data-toggle="dropdown">
                            <figure class="profile-picture">
                                <img src="<?php echo $baseUrl; ?>images/!logged-user.jpg" alt="User" class="img-circle" />
                            </figure>
                            <div class="profile-info">
                                <span class="name">Admin</span>
                                <span class="role">Administrateur</span>
                            </div>
                            <i class="fa custom-caret"></i>
                        </a>
                        <div class="dropdown-menu">
                            <ul class="list-unstyled">
                                <li>
                                    <a role="menuitem" tabindex="-1" href="logout.php"><i class="fa fa-power-off"></i> Déconnexion</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </header>

            <div class="inner-wrapper">
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
                    <li class="nav-active">
                        <a href="calcul.php">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            <span>calculateur</span>
                        </a>
                    </li>
                    
                                </ul>
                            </nav>
                        </div>
                    </div>
                </aside>

                <section role="main" class="content-body">
                    <header class="page-header">
                        <h2>Gestion des Programmes et Bourses</h2>
                    </header>

                    <?php if (isset($_GET['success']) && $_GET['success'] === 'delete'): ?>
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <strong>Succès!</strong> Le programme a été supprimé avec succès.
                        </div>
                    <?php endif; ?>

                    <?php if (isset($_GET['error']) && $_GET['error'] === 'delete'): ?>
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <strong>Erreur!</strong> 
                            <?php echo isset($_GET['message']) ? htmlspecialchars($_GET['message']) : 'Une erreur est survenue lors de la suppression.'; ?>
                        </div>
                    <?php endif; ?>

                    <div class="row">
                        <div class="col-md-6 col-lg-3">
                            <section class="panel">
                                <div class="panel-body">
                                    <div class="widget-summary">
                                        <div class="widget-summary-col">
                                            <div class="summary">
                                                <h4 class="title">Total des Bourses</h4>
                                                <div class="info">
                                                    <strong class="amount"><?php echo $totalBourses; ?></strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <section class="panel">
                                <div class="panel-body">
                                    <div class="widget-summary">
                                        <div class="widget-summary-col">
                                            <div class="summary">
                                                <h4 class="title">Total des Programmes</h4>
                                                <div class="info">
                                                    <strong class="amount"><?php echo $totalProgrammes; ?></strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <section class="panel">
                                <header class="panel-heading">
                                    <h2 class="panel-title">Bourses par Pays</h2>
                                </header>
                                <div class="panel-body">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Pays</th>
                                                <th>Nombre de Bourses</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($bourseParPays as $pays => $nombre): ?>
                                            <tr>
                                                <td><?php echo ucfirst(htmlspecialchars($pays)); ?></td>
                                                <td><?php echo $nombre; ?></td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </section>
                        </div>
                        <div class="col-md-6">
                            <section class="panel">
                                <header class="panel-heading">
                                    <h2 class="panel-title">Programmes par Pays</h2>
                                </header>
                                <div class="panel-body">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Pays</th>
                                                <th>Nombre de Programmes</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($programmeParPays as $pays => $nombre): ?>
                                            <tr>
                                                <td><?php echo ucfirst(htmlspecialchars($pays)); ?></td>
                                                <td><?php echo $nombre; ?></td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </section>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-lg-3">
                            <section class="panel">
                                <div class="panel-body">
                                    <div class="widget-summary">
                                        <div class="widget-summary-col">
                                            <div class="summary">
                                                <h4 class="title">Moyenne des Bourses par Pays</h4>
                                                <div class="info">
                                                    <strong class="amount"><?php echo number_format($moyenneBoursesParPays, 2); ?></strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <section class="panel">
                                <div class="panel-body">
                                    <div class="widget-summary">
                                        <div class="widget-summary-col">
                                            <div class="summary">
                                                <h4 class="title">Pourcentage de Programmes</h4>
                                                <div class="info">
                                                    <strong class="amount"><?php echo number_format($pourcentageProgrammes, 2) . '%'; ?></strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <section class="panel">
                                <div class="panel-body">
                                    <div class="widget-summary">
                                        <div class="widget-summary-col">
                                            <div class="summary">
                                                <h4 class="title">Total des Étudiants</h4>
                                                <div class="info">
                                                    <strong class="amount"><?php echo $totalEtudiants; ?></strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </section>

        </section>

        <script src="<?php echo $baseUrl; ?>vendor/jquery/jquery.js"></script>
        <script src="<?php echo $baseUrl; ?>vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
        <script src="<?php echo $baseUrl; ?>vendor/bootstrap/js/bootstrap.js"></script>
        <script src="<?php echo $baseUrl; ?>vendor/nanoscroller/nanoscroller.js"></script>
        <script src="<?php echo $baseUrl; ?>vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
        <script src="<?php echo $baseUrl; ?>vendor/magnific-popup/magnific-popup.js"></script>
        <script src="<?php echo $baseUrl; ?>vendor/jquery-placeholder/jquery.placeholder.js"></script>
        <script src="<?php echo $baseUrl; ?>javascripts/theme.js"></script>
        <script src="<?php echo $baseUrl; ?>javascripts/theme.custom.js"></script>
        <script src="<?php echo $baseUrl; ?>javascripts/theme.init.js"></script>
    </body>
</html>