<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/PROJETWEB/Controller/clubC.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/PROJETWEB/config.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/PROJETWEB/Model/clubs.php');

$clubC = new Clubc();

// Vérifiez si l'ID du club est passé en paramètre pour incrémenter les clics
if (isset($_GET['id_club'])) {
    $clubC->incrementClicks($_GET['id_club']); // Incrémenter les clics pour le club spécifié
}

$list = $clubC->getAllClubs();
if ($list instanceof PDOStatement) {
    $list = $list->fetchAll(PDO::FETCH_ASSOC); // Récupérer les résultats sous forme de tableau associatif
}
// Vérifiez que chaque club a la clé 'clicks'
foreach ($list as &$club) {
    if (!isset($club['clicks'])) {
        $club['clicks'] = 0; // Assurez-vous que 'clicks' existe, sinon initialisez-le à 0
    }
}
usort($list, function($a, $b) {
    return $b['clicks'] <=> $a['clicks']; // Trier par nombre de clics décroissant
});

$totalClicks = array_sum(array_column($list, 'clicks')); // Calculer le total des clics
$topClubs = $totalClicks > 0 ? array_slice($list, 0, 3) : array_slice($list, 0, 3); // Obtenir les 3 premiers clubs
?>

<!doctype html>
<html class="fixed">
    <head>
        <!-- Basic -->
        <meta charset="UTF-8">
        <title>Liste des Clubs</title>
        
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
                        <h2>Liste des Clubs</h2>
                    </header>

                    <!-- start: page -->
                    <div class="row">
                        <div class="col-lg-12">
                            <section class="panel">
                                <header class="panel-heading">
                                    <h2 class="panel-title">Clubs enregistrés</h2>
                                </header>
                                <div class="panel-body">
                                    <table class="table table-bordered table-striped mb-none" id="datatable-default">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nom du Club</th>
                                                <th>Description</th>
                                                <th>Date de Création</th>
                                                <th>Catégorie</th>
                                                <th>Lieu</th>
                                                <th>Logo</th>
                                                <th>Lien</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($list as $club): ?>
                                            <tr>
                                                <td><?php echo $club['id_club']; ?></td>
                                                <td><?php echo $club['nom_club']; ?></td>
                                                <td><?php echo substr($club['description'], 0, 50) . '...'; ?></td>
                                                <td><?php echo $club['date_creation']; ?></td>
                                                <td>
                                                    <span class="badge badge-primary"><?php echo $club['categorie']; ?></span>
                                                </td>
                                                <td><?php echo $club['lieu']; ?></td>
                                                <td>
                                                    <img src="<?php echo $club['logo']; ?>" alt="Logo" class="img-thumbnail" style="max-width: 50px;">
                                                </td>
                                                <td>
                                                    <a href="<?php echo $club['lien']; ?>" target="_blank" class="btn btn-info btn-sm">
                                                        <i class="fa fa-link"></i> Visiter
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="updateClub.php?id_club=<?php echo $club['id_club']; ?>" class="btn btn-warning btn-sm">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                    <a href="deleteClub.php?id_club=<?php echo $club['id_club']; ?>" 
                                                       class="btn btn-danger btn-sm"
                                                       onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce club ?');">
                                                        <i class="fa fa-trash-o"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </section>
                        </div>
                    </div>
                </section>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            <h2 class="panel-title">Clubs les Plus Populaires</h2>
                        </header>
                        <div class="panel-body">
                            <div class="popular-clubs-container">
                                <?php foreach ($topClubs as $club): 
                                    $percentage = $totalClicks > 0 ? ($club['clicks'] / $totalClicks) * 100 : 0; ?>
                                <div class="popular-club">
                                    <h3><?php echo htmlspecialchars($club['nom_club']); ?></h3>
                                    <p class="percentage">Pourcentage de Popularité : <span><?php echo number_format($percentage) . '%'; ?></span></p>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </section>

        <!-- Vendor -->
        <!-- Mêmes scripts JS que dans addClub.php -->
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
        <style>
            .popular-clubs-container {
                display: flex;
                overflow: hidden;
                position: relative;
                animation: slide 10s infinite alternate;
            }

            .popular-club {
                border: 1px solid #ddd;
                border-radius: 5px;
                padding: 15px;
                margin: 10px;
                text-align: center;
                background-color: #f9f9f9;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                flex: 0 0 auto; /* Ne pas permettre à l'élément de se réduire */
                transition: transform 0.5s ease;
            }

            .percentage {
                font-size: 1.5em; /* Agrandir la taille de la police */
                font-weight: bold; /* Mettre en gras */
                color: #007bff; /* Couleur du texte */
            }

            @keyframes slide {
                0% { transform: translateX(0); }
                100% { transform: translateX(-30%); }
            }
        </style>
        <script>
            // Optionnel : Vous pouvez ajouter un script pour faire défiler les clubs
            const container = document.querySelector('.popular-clubs-container');
            let scrollAmount = 0;

            function scrollClubs() {
                scrollAmount += 1; // Ajustez la vitesse de défilement ici
                container.style.transform = `translateX(-${scrollAmount}px)`;
                if (scrollAmount > container.scrollWidth - container.clientWidth) {
                    scrollAmount = 0; // Réinitialiser le défilement
                }
            }

            setInterval(scrollClubs, 100); // Ajustez l'intervalle pour la vitesse de défilement
    </script>

    <script src="/clubClicks.js"></script> <!-- ou clubClicks.js -->
    </body>
</html>