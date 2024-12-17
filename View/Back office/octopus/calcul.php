<?php
require_once '../../../config.php';
require_once '../../../Controller/bourseC.php';
require_once '../../../Model/bourses.php';

// Définir le chemin pour les uploads
$uploadDir = '../../../uploads/';

// Initialiser $totalCost
$totalCost = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les valeurs des frais
    $tuition = floatval($_POST['tuition']);
    $housing = floatval($_POST['housing']);
    $food = floatval($_POST['food']);
    $transport = floatval($_POST['transport']);

    // Calculer le coût total
    $totalCost = $tuition + $housing + $food + $transport; // Total des frais de la vie
    echo '<!-- Coût total calculé : ' . $totalCost . ' -->'; // Débogage
}

// Récupérer les bourses disponibles
$bourseC = new BourseC();
$boursesDisponibles = $bourseC->getBourses();

// Vérifiez si $boursesDisponibles est un tableau
if (!is_array($boursesDisponibles)) {
    $boursesDisponibles = []; // Initialiser comme tableau vide
}

// Logique pour afficher les recommandations de bourses
$boursesCouvrantFrais = []; // Initialiser le tableau pour les bourses couvrant les frais
foreach ($boursesDisponibles as $bourse) {
    $fraisBourse = $bourse->getFrais();
    // Vérifiez si la bourse est supérieure au coût total
    if ($fraisBourse > $totalCost) {
        $boursesCouvrantFrais[] = $bourse; // Ajouter la bourse si elle est supérieure au coût total
    }
}

// Afficher les recommandations
if (!empty($boursesCouvrantFrais)) {
    echo '<h3>Recommandations de Bourses :</h3>';
    echo '<ul>';
    foreach ($boursesCouvrantFrais as $bourse) {
        echo '<li>' . htmlspecialchars($bourse->getNomBourse()) . ' - ' . htmlspecialchars($bourse->getFrais()) . ' TND</li>';
    }
    echo '</ul>';
} else {
    echo '<h3>Aucune bourse ne couvre vos frais.</h3>'; // Message si aucune bourse ne correspond
}

// Afficher le coût total pour le débogage
if ($totalCost > 0) {
    echo '<p>Coût total calculé : ' . htmlspecialchars($totalCost) . ' TND</p>';
}
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
                     <form method="GET" action="index.php" class="form-inline mb-3">
                            <div class="form-group mr-2">
                                <input type="text" name="search" class="form-control" placeholder="Rechercher un programme" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" style="border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                            </div>
                            <button type="submit" class="btn btn-primary" style="border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">Rechercher</button>
                        </form>
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

<section role="main" class="content-body" style="margin-bottom: 0;">
    <header class="page-header" style="margin-bottom: 0;">
        <h2>calculateur</h2>
    </header>
</section>
<!-- ... existing code ... -->
<center>
<!-- Afficher les recommandations -->
<div id="recommendations" style="margin-top: 0px; text-align: center; padding: 20px; z-index: 1; position: relative; margin-left: 300px;">
    <h3 style="color: #6c63ff; margin-bottom: 20px;">Recommandations de Bourses :</h3>
    <div style="display: flex; flex-wrap: wrap; justify-content: center;">
        <?php
        if (!empty($boursesCouvrantFrais)) {
            foreach ($boursesCouvrantFrais as $bourse) {
                echo '<div style="margin: 10px; background-color: #ffffff; border-radius: 8px; padding: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); flex: 0 1 calc(30% - 20px); transition: transform 0.3s;">';
                echo '<div style="text-align: center;">';
                echo '<h4 style="color: #6c63ff; font-size: 1.5em; margin-bottom: 10px;">' . htmlspecialchars($bourse->getNomBourse()) . '</h4>';
                echo '<p style="font-size: 20px; color: #333; margin-bottom: 10px;">' . htmlspecialchars($bourse->getFrais()) . ' TND</p>';
                echo '<button style="padding: 10px 15px; background-color: #6c63ff; color: white; border: none; border-radius: 5px; cursor: pointer; transition: background-color 0.3s;">Détails</button>'; // Bouton pour plus de détails
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<h3 style="color: #ff4d4d;">Aucune bourse ne couvre vos frais.</h3>';
        }

        // Afficher le coût total pour le débogage
        echo '<p style="font-weight: bold;">Coût total calculé : ' . htmlspecialchars($totalCost) . ' TND</p>';
        ?>
    </div>
</div>
</center>
<!-- ... existing code ... -->

<div class="cost-calculator" style="margin-left: 335px; width: 80%; padding: 40px; border: 1px solid #ddd; border-radius: 8px; background-color: #f9f9f9; box-shadow: 0 4px 10px rgba(0,0,0,0.1); margin-top: 0;">
    <h2 class="animated-title">Calculateur de Coûts de la Vie</h2>
    <form id="costForm" style="display: flex; flex-direction: column; gap: 20px;">
        <div style="display: flex; justify-content: space-between; gap: 10px;">
            <div style="flex: 1; position: relative;">
                <label for="tuition" style="font-weight: bold; color: #6c63ff;">Frais de Scolarité (€):</label>
                <input type="number" id="tuition" required style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc; transition: border-color 0.3s; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                <i class="fa fa-euro" style="position: absolute; right: 10px; top: 35%; color: #aaa;"></i>
            </div>
            <div style="flex: 1; position: relative;">
                <label for="housing" style="font-weight: bold; color: #6c63ff;">Logement (€):</label>
                <input type="number" id="housing" required style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc; transition: border-color 0.3s; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                <i class="fa fa-euro" style="position: absolute; right: 10px; top: 35%; color: #aaa;"></i>
            </div>
        </div>
        <div style="display: flex; justify-content: space-between; gap: 10px;">
            <div style="flex: 1; position: relative;">
                <label for="food" style="font-weight: bold; color: #6c63ff;">Nourriture (€):</label>
                <input type="number" id="food" required style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc; transition: border-color 0.3s; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                <i class="fa fa-euro" style="position: absolute; right: 10px; top: 35%; color: #aaa;"></i>
            </div>
            <div style="flex: 1; position: relative;">
                <label for="transport" style="font-weight: bold; color: #6c63ff;">Transport (€):</label>
                <input type="number" id="transport" required style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc; transition: border-color 0.3s; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                <i class="fa fa-euro" style="position: absolute; right: 10px; top: 35%; color: #aaa;"></i>
            </div>
        </div>
        <div style="position: relative;">
            <label for="scholarship" style="font-weight: bold; color: #6c63ff;">Montant de la Bourse (€):</label>
            <input type="number" id="scholarship" required style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc; transition: border-color 0.3s;">
            <i class="fa fa-euro" style="position: absolute; right: 10px; top: 35%; color: #aaa;"></i>
        </div>
        <button type="submit" style="padding: 10px; background-color: #6c63ff; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; transition: background-color 0.3s; box-shadow: 0 2px 5px rgba(0,0,0,0.2);">Calculer</button>
    </form>
    <div id="result" style="margin-top: 20px; text-align: center; font-weight: bold; font-size: 18px; color: #333;"></div>
    <div id="statistics" style="margin-top: 20px; text-align: center; font-size: 16px; color: #555;"></div>
</div>

<script>
    document.getElementById('costForm').addEventListener('submit', function(event) {
        event.preventDefault();

        const tuition = parseFloat(document.getElementById('tuition').value);
        const housing = parseFloat(document.getElementById('housing').value);
        const food = parseFloat(document.getElementById('food').value);
        const transport = parseFloat(document.getElementById('transport').value);
        const scholarship = parseFloat(document.getElementById('scholarship').value);

        const totalCost = tuition + housing + food + transport;

        const resultDiv = document.getElementById('result');
        const leadsConfirmedDiv = document.getElementById('leadsConfirmed').querySelector('.value');
        const profitTotalDiv = document.getElementById('profitTotal').querySelector('.value');
        const profitPerUnitDiv = document.getElementById('profitPerUnit').querySelector('.value');

        if (scholarship >= totalCost) {
            resultDiv.innerText = "La bourse couvre vos frais de vie.";
            resultDiv.style.color = "green"; // Couleur pour le succès
            profitPerUnitDiv.innerHTML = "0.00 <span>TND/Unité</span>"; // Pas de montant supplémentaire nécessaire
        } else {
            resultDiv.innerText = "La bourse ne couvre pas vos frais de vie.  " ;
            resultDiv.style.color = "red"; // Couleur pour l'erreur
            profitPerUnitDiv.innerHTML = (totalCost - scholarship).toFixed(2) + ' <span>TND</span>'; // Montant supplémentaire nécessaire
        }

        // Mettre à jour le coût total et le montant de la bourse dans les cartes respectives
        leadsConfirmedDiv.innerHTML = totalCost.toFixed(2) + ' <span>TND</span>';
        profitTotalDiv.innerHTML = scholarship.toFixed(2) + ' <span>TND</span>'; // Montant de la bourse
    });
</script>

<div class="stats-container">
    <div class="stat-box" id="leadsConfirmed">
        <div class="icon">🛍️</div>
        <p class="title">Coût total</p>
        <p class="value">0.00 <span>TND</span></p>
    </div>
  
    <div class="stat-box" id="profitTotal">
        <div class="icon"></div>
        <p class="title">Montant de la Bourse</p>
        <p class="value">0.00 <span>TND</span></p>  
    </div>
    <div class="stat-box" id="profitPerUnit">
        <div class="icon">🔄</div>
        <p class="title">Montant supplémentaire nécessaire</p>
        <p class="value">0.00 <span>TND</span></p>
    </div>
</div>

<style>
    .stats-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #f0f4ff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        width: 90%;
        max-width: 1200px;
        margin: 20px auto;
        margin-left:400px;
    }

    .stat-box {
        text-align: center;
        background-color: #ffffff;
        padding: 20px;
        border-radius: 8px;
        border: 1px solid #c4c4e8;
        flex: 1;
        margin: 0 10px;
        transition: transform 0.3s;
    }

    .stat-box:hover {
        transform: translateY(-5px);
    }

    .icon {
        font-size: 40px;
        color: #6c63ff;
        margin-bottom: 10px;
    }

    .title {
        font-weight: bold;
        color: #333;
        margin-bottom: 8px;
    }

    .value {
        font-size: 24px;
        color: #6c63ff;
    }

    .value span {
        font-size: 16px;
    }

    .animated-title {
        text-align: center;
        margin-bottom: 20px;
        color: #6c63ff;
        font-size: 2em;
        text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
        animation: fadeIn 1s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
<!-- ... existing code ... -->
</body>
</html>
</html>