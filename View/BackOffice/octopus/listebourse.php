<?php
// Ajout des includes nécessaires
require_once '../../../Controller/bourseC.php';
require_once '../../../Model/bourses.php';
require_once '../../../Controller/programmeC.php';
require_once '../../../Model/programme.php';


//test
$programmeController = new ProgrammeC();

// Initialisation des contrôleurs
$bourseC = new BourseC();
$programmeC = new ProgrammeC();

// Récupération des statistiques
$totalBourses = count($bourseC->afficherBourses());
$totalProgrammes = count($programmeC->afficherProgrammes());

// Statistiques par pays
$bourseParPays = [];
$programmeParPays = [];

foreach ($bourseC->afficherBourses() as $bourse) {
    $pays = $bourse['pays'];
    $bourseParPays[$pays] = isset($bourseParPays[$pays]) ? $bourseParPays[$pays] + 1 : 1;
}

foreach ($programmeC->afficherProgrammes() as $programme) {
    $pays = $programme['pays'];
    $programmeParPays[$pays] = isset($programmeParPays[$pays]) ? $programmeParPays[$pays] + 1 : 1;
}

// Définir le chemin de base pour les assets de manière relative
$baseUrl = './assets/';

// Créer une instance du contrôleur
$bourseC = new BourseC();

// Vérifiez si une recherche a été effectuée
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

// Récupérer les bourses avec les programmes
$boursesAvecProgrammes = $bourseC->afficherBoursesAvecProgrammes($searchTerm);
?>


<!doctype html>
<html class="fixed">
    <head>
        <!-- Basic -->
        <meta charset="UTF-8">
        <title>Dashboard | Gestion des Bourses</title>

        <!-- Mobile Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

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

        <!-- Débogage des chemins -->
        <?php
        echo "<!-- Current Directory: " . __DIR__ . " -->";
        echo "<!-- Document Root: " . $_SERVER['DOCUMENT_ROOT'] . " -->";
        ?>
    </head>
    <body>
        <section class="body">
            <!-- start: header -->
            <header class="header">
    <div class="logo-container">
        <a href="../" class="logo">
            <img src="assets/images/logo.png" height="35" alt="Admin" />
        </a>
    </div>
    <div class="header-right">
        <div id="userbox" class="userbox">
            <a href="#" data-toggle="dropdown">
                <figure class="profile-picture">
                    <img src="assets/images/!logged-user.jpg" alt="User" class="img-circle" />
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
    <div class="search-container">
        <form method="GET" action="listebourse.php">
            <input type="text" name="search" placeholder="Rechercher une bourse" />
            <button type="submit">Rechercher</button>
        </form>
    </div>
</header>
<style>
    .search-container {
        margin: 20px 0;
        display: flex;
        justify-content: flex-end; /* Aligne la barre de recherche à droite */
    }

    .search-container input[type="text"] {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        width: 300px; /* Largeur de la barre de recherche */
        margin-right: 10px; /* Espace entre l'input et le bouton */
    }

    .search-container button {
        padding: 10px 15px;
        background-color: #007bff; /* Couleur du bouton */
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .search-container button:hover {
        background-color: #0056b3; /* Couleur du bouton au survol */
    }
    
    img {
        max-width: 100px; /* Largeur maximale */
        max-height: 100px; /* Hauteur maximale */
        object-fit: cover; /* Pour garder le ratio d'aspect */
        vertical-align: middle; /* Aligne l'image au milieu de la ligne */
        margin-right: 10px; /* Espace à droite de l'image */
    }
</style>
</style>
                    
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
                        <h2>liste des Bourses</h2>
                       
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

                    <!-- start: page -->
                
                    <div class="row">
    <div class="col-lg-12">
        <div class="panel">
            <div class="panel-body">
            <div class="mb-md text-center">
                                                
                                                <a href="addBourse.php" class="btn btn-primary btn-lg" style="padding: 12px 25px; font-weight: 600; text-transform: uppercase; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                                                    <i class="fa fa-plus" style="margin-right: 8px;"></i>
                                                    Ajouter une bourse
                                                </a>
                                            </div>
                <h1>les bourses</h1>
                <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom de la Bourse</th>
                    <th>Description</th>
                    <th>Organisme</th>
                    <th>Date Limite</th>
                    <th>Programme</th>
                    <th>Description du Programme</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($boursesAvecProgrammes)): ?>
                    <?php foreach ($boursesAvecProgrammes as $bourse): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($bourse['id']); ?></td>
                            <td><?php echo htmlspecialchars($bourse['nom_bourse']); ?></td>
                            <td><?php echo htmlspecialchars($bourse['description']); ?></td>
                            <td><?php echo htmlspecialchars($bourse['organisme']); ?></td>
                            <td><?php echo htmlspecialchars($bourse['date_limite']); ?></td>
                            <td><?php echo htmlspecialchars($bourse['nom_prog']); ?></td>
                            <td><?php echo htmlspecialchars($bourse['prog_description']); ?></td>
                            <td>
                                    <?php if (!empty($bourse['image'])): ?>
                                        <img src="../../../uploads/<?php echo htmlspecialchars($bourse['image']); ?>" 
                                             alt="Image programme" style="max-width: 50px;">
                                    <?php else: ?>
                                        <span>Pas d'image</span>
                                    <?php endif; ?>
                                </td>
                            <td>
                                <a href="updateBourse.php?id=<?php echo htmlspecialchars($bourse['id']); ?>" class="btn btn-warning">Modifier</a>
                                <a href="deleteBourse.php?id=<?php echo htmlspecialchars($bourse['id']); ?>" class="btn btn-danger">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9">Aucune bourse trouvée.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
            </div>
        </div>
    </div>
</div>
                    
                     

                   
                    <!-- end: page -->
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