<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/PROJETWEB/config.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/PROJETWEB/Model/clubs.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/PROJETWEB/Controller/clubC.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/PROJETWEB/Model/formations.php'); // Inclure le modèle des formations
require_once($_SERVER['DOCUMENT_ROOT'] . '/PROJETWEB/Controller/formationC.php'); // Inclure le contrôleur des formations
require_once($_SERVER['DOCUMENT_ROOT'] . '/PROJETWEB/Model/favoris.php'); // Inclure le modèle des formations
require_once($_SERVER['DOCUMENT_ROOT'] . '/PROJETWEB/Controller/favorisC.php');
$clubC = new ClubC();
$clubs = $clubC->getAllClubs();

// Configuration de la pagination
$clubs_per_page = 3; // Nombre de clubs par page
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($current_page - 1) * $clubs_per_page;

// Récupérer tous les clubs et les convertir en array
$clubs = $clubC->getAllClubs()->fetchAll(PDO::FETCH_ASSOC);
$total_clubs = count($clubs);
$total_pages = ceil($total_clubs / $clubs_per_page);

// Récupérer les clubs pour la page actuelle
$clubs_page = array_slice($clubs, $offset, $clubs_per_page);

// Récupérer les formations
$formationC = new Formationc();
$formations = $formationC->getAllFormations()->fetchAll(PDO::FETCH_ASSOC); // Récupérer toutes les formations
// Récupérer les détails de la prochaine formation
$nextFormationDetails = $formationC->getNextFormationDetails();
$nextFormationDate = $nextFormationDetails['date'];
// Récupérer la date de la prochaine formation
$nextFormationDate = $formationC->getNextFormationDate();
if (isset($_GET['id_club']) && !empty($_GET['id_club'])) {
    $id_club = intval($_GET['id_club']);
    // Récupérer les formations du club sélectionné
    $formations = $clubC->afficherFormations($id_club);
}

if (isset($_GET['ajax']) && $_GET['ajax'] === 'true') {
    // Configuration de la pagination
    $clubs_per_page = 3;
    $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($current_page - 1) * $clubs_per_page;

    // Récupérer les clubs pour la page actuelle
    $clubs = $clubC->getAllClubs()->fetchAll(PDO::FETCH_ASSOC);
    $total_clubs = count($clubs);
    $total_pages = ceil($total_clubs / $clubs_per_page);
    $clubs_page = array_slice($clubs, $offset, $clubs_per_page);

    // Renvoyer uniquement le HTML des clubs
    foreach ($clubs_page as $club): ?>
        <div class="col-auto">
            <div class="club-tile" onclick="window.location.href='incrementClicks.php?id_club=<?php echo htmlspecialchars($club['id_club']); ?>';">
                <div class="cube">
                    <div class="face front">
                        <img src="/PROJETWEB/uploads/<?php echo htmlspecialchars($club['logo']); ?>" alt="<?php echo htmlspecialchars($club['nom_club']); ?>" class="club-logo">
                    </div>
                    <div class="face back">
                        <div class="text"><?php echo htmlspecialchars($club['nom_club']); ?></div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach;
    exit();
}
// Configuration de la pagination des formations
$formations_per_page = 3; // Nombre de formations par page
$current_page_formations = isset($_GET['page_formations']) ? (int)$_GET['page_formations'] : 1;
$offset_formations = ($current_page_formations - 1) * $formations_per_page;

// Récupérer toutes les formations
$formationC = new Formationc();
$formations = $formationC->getAllFormations()->fetchAll(PDO::FETCH_ASSOC);
$total_formations = count($formations);
$total_pages_formations = ceil($total_formations / $formations_per_page);

// Récupérer les formations pour la page actuelle
$formations_page = array_slice($formations, $offset_formations, $formations_per_page);

if (isset($_GET['id_club']) && !empty($_GET['id_club'])) {
    $id_club = intval($_GET['id_club']);
    // Récupérer les formations du club sélectionné
    $formations = $clubC->afficherFormations($id_club);
    $total_formations = count($formations);
    $total_pages_formations = ceil($total_formations / $formations_per_page);
    $formations_page = array_slice($formations, $offset_formations, $formations_per_page);
}

if (isset($_GET['ajax_formations']) && $_GET['ajax_formations'] === 'true') {
    // Récupérer les formations selon le club sélectionné
    if (isset($_GET['id_club']) && !empty($_GET['id_club'])) {
        $id_club = intval($_GET['id_club']);
        $formations = $clubC->afficherFormations($id_club);
    } else {
        $formations = $formationC->getAllFormations()->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Pagination
    $formations_per_page = 3;
    $current_page_formations = isset($_GET['page_formations']) ? (int)$_GET['page_formations'] : 1;
    $offset_formations = ($current_page_formations - 1) * $formations_per_page;
    
    $total_formations = count($formations);
    $total_pages_formations = ceil($total_formations / $formations_per_page);
    $formations_page = array_slice($formations, $offset_formations, $formations_per_page);

    if (!empty($formations_page)): ?>
        <?php foreach ($formations_page as $formation): ?>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="formation-card">
                    <div class="formation-image">
                        <img src="/PROJETWEB/uploads/<?php echo htmlspecialchars($formation['image']); ?>" alt="<?php echo htmlspecialchars($formation['nom_formation']); ?>" class="formation-image">
                    </div>
                    <div class="formation-content">
                        <h3><?php echo htmlspecialchars($formation['nom_formation']); ?></h3>
                        <p class="formation-date">
                        <i class="fa fa-calendar"></i> 
                        <?php 
                        if (!empty($formation['date'])) {
                            $date = new DateTime($formation['date']);
                            echo $date->format('d/m/Y');
                        } else {
                            echo "Date non définie";
                        }
                        ?>
                        </p>
                        <p><strong>Description :</strong> <?php echo !empty($formation['description']) ? htmlspecialchars($formation['description']) : 'Description non disponible'; ?></p>
                        <p><strong>Organisme :</strong> <?php echo htmlspecialchars($formation['organisme']); ?></p>
                        <p><strong>Prix :</strong> <?php echo htmlspecialchars($formation['prix']); ?> TND</p>
                        <?php
                        $nom_club = $clubC->getNomClubById($formation['id_club']);
                        ?>
                        <p><strong>Club :</strong> <?php echo htmlspecialchars($nom_club); ?></p>
                        <a href="<?php echo htmlspecialchars($formation['lien']); ?>" class="btn-formation" target="_blank">Visitez le site</a>
                        <button onclick="toggleFavorite('formation', <?php echo $formation['id_formation']; ?>)" class="favorite-btn">
                    <i class="fas fa-heart"></i> <!-- Utilisez fa-star pour une étoile -->
                </button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        
        
    <?php else: ?>
        <p>Aucune formation trouvée.</p>
    <?php endif;
    exit();
}

if (isset($_GET['id_formation'])) {
    $id_formation = intval($_GET['id_formation']);
    $formationC = new Formationc();
    $formationC->deleteFormationdate($id_formation);
    echo json_encode(['status' => 'success']);
    exit(); // Terminer le script après la suppression
}

//favoris
//$data = json_decode(file_get_contents("php://input"));
$_SESSION['user_id']=1;
$user_id = $_SESSION['user_id']; // Assurez-vous que l'utilisateur est connecté
$favorisC = new FavorisC();
$favorites = $favorisC->getUserFavorites($user_id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"));

    if (isset($data->type) && isset($data->item_id)) {
        $type = $data->type;
        $item_id = intval($data->item_id);
        $user_id = $_SESSION['user_id']; // Assurez-vous que l'utilisateur est connecté

        $favorisC = new FavorisC();
        if ($favorisC->toggleFavorite($user_id, $type, $item_id)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Données manquantes']);
    }
    exit(); // Terminer le script après la gestion de la requête
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>PARCOURI</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <!--button favoris-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <!-- Formations,clubs CSS -->
    <link href="formations,clubs.css" rel="stylesheet">
    <script src="/clubClicks.js"></script> <!-- ou clubClicks.js -->
    <script>
        function loadClubs(page) {
            fetch('formations,clubs.php?page=' + page + '&ajax=true') // Remplacez par le chemin correct vers votre fichier PHP
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.text(); // Récupérer le contenu HTML
                })
                .then(html => {
                    // Mettre à jour uniquement la section des clubs
                    const clubsSection = document.getElementById('clubsContainer');
                    if (clubsSection) {
                        clubsSection.innerHTML = html;
                        // Mettre à jour l'URL sans recharger la page
                        window.history.pushState({}, '', 'formations,clubs.php?page=' + page);
                    }
                })
                .catch(error => console.error('There was a problem with the fetch operation:', error));
        }
        function loadFormations(page) {
            fetch('formations,clubs.php?page_formations=' + page + '&ajax_formations=true')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.text();
                })
                .then(html => {
                    const formationsSection = document.getElementById('formationsContainer');
                    if (formationsSection) {
                        formationsSection.innerHTML = html;
                        window.history.pushState({}, '', 'formations,clubs.php?page_formations=' + page);
                    }
                })
                .catch(error => console.error('There was a problem with the fetch operation:', error));
        }
        function searchFormations(event) {
            event.preventDefault(); // Empêcher le rechargement de la page
            
            const id_club = document.getElementById('id_club').value;
            const formationsContainer = document.getElementById('formationsContainer');
            
            // Effectuer la requête AJAX
            fetch('formations,clubs.php?id_club=' + id_club + '&ajax_formations=true')
                .then(response => response.text())
                .then(data => {
                    formationsContainer.innerHTML = data;
                })
                .catch(error => console.error('Erreur:', error));
            
            return false; // Empêcher le comportement par défaut du formulaire
        }
        document.addEventListener("DOMContentLoaded", function() {
    const countdownDate = new Date("<?php echo $nextFormationDate; ?>").getTime();
    const formationId = <?php echo $nextFormationDetails['id_formation']; ?>; // Récupérer l'ID de la formation

    const countdownFunction = setInterval(function() {
        const now = new Date().getTime();
        const distance = countdownDate - now;

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        document.getElementById("days").innerText = days;
        document.getElementById("hours").innerText = hours;
        document.getElementById("minutes").innerText = minutes;
        document.getElementById("seconds").innerText = seconds;

        if (distance < 0) {
            clearInterval(countdownFunction);
            document.getElementById("countdown").innerHTML = "Formation commencée !";

            // Supprimer la formation de la base de données
            fetch('formations,clubs.php?id_formation=' + formationId)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Erreur lors de la suppression de la formation');
                    }
                    // Optionnel : Mettre à jour l'affichage ou recharger la page
                    location.reload(); // Recharger la page pour mettre à jour la liste
                })
                .catch(error => console.error('Erreur:', error));
        }
    }, 1000);
});
    function toggleFavorite(type, itemId) {
        fetch('formations,clubs.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ type: type, item_id: itemId })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            alert('Favori mis à jour !');
            // Optionnel : Vous pouvez recharger la page ou mettre à jour l'icône ici
            location.reload(); // Recharger la page pour mettre à jour l'état des favoris
        } else {
            alert('Erreur lors de la mise à jour du favori.');
        }
    })
    .catch(error => console.error('Erreur:', error));
}
    function toggleFavorites(type, itemId) {
        const favoritesSection = document.getElementById('favoritesSection');
        if (favoritesSection.style.display === 'none') {
            favoritesSection.style.display = 'block';
            loadFavorites(); // Charger les favoris lorsque la section est affichée
        } else {
            favoritesSection.style.display = 'none';
        }
        
    }

    function loadFavorites() {
        fetch('formations,clubs.php?action=getFavorites')
            .then(response => response.json())
            .then(data => {
                const favoritesContainer = document.getElementById('favoritesContainer');
                favoritesContainer.innerHTML = ''; // Vider le conteneur avant de le remplir
                if (data.length > 0) {
                    data.forEach(favorite => {
                        const listItem = document.createElement('div');
                        listItem.innerHTML = `<a href="${favorite.link}" target="_blank">${favorite.name}</a>`;
                        favoritesContainer.appendChild(listItem);
                    });
                } else {
                    favoritesContainer.innerHTML = '<p>Aucun favori trouvé.</p>';
                }
            })
            .catch(error => console.error('Erreur:', error));
    }
    </script>
    <style>
.countdown-container {
    background-color: #f8f9fa;
    padding: 20px;
    border-radius: 10px;
    margin-bottom: 30px;
}

.countdown {
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 1.5em;
}

.countdown-item {
    margin: 0 15px;
    text-align: center;
}

.countdown-label {
    display: block;
    font-size: 0.8em;
    color: #6c757d;
}
.favorite-btn {
    background: none;
    border: none;
    cursor: pointer;
    color: #ff4081; /* Couleur de l'icône */
    font-size: 1.5em; /* Taille de l'icône */
    transition: color 0.3s;
}

.favorite-btn:hover .fa-heart{
    color: #e91e63; /* Couleur au survol */
}
#favoritesSection {
    margin-top: 20px;
    padding: 20px; /* Augmenter le rembourrage */
    background-color: #f8f9fa; /* Couleur de fond */
    border-radius: 10px; /* Coins arrondis */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Ombre douce */
}

#favoritesContainer {
    margin-top: 10px; /* Espacement supérieur */
}

#favoritesContainer ul {
    list-style-type: none; /* Pas de puces */
    padding: 0;
}

#favoritesContainer li {
    margin: 10px 0; /* Espacement entre les éléments */
    padding: 15px; /* Rembourrage */
    background-color: #ffffff; /* Couleur de fond des éléments */
    border: 1px solid #ddd; /* Bordure */
    border-radius: 5px; /* Coins arrondis */
    transition: background-color 0.3s; /* Transition douce */
}

#favoritesContainer li:hover {
    background-color: #f1f1f1; /* Couleur au survol */
}
#favoritesButton {
    background-color: #e91e63; /* Couleur de fond */
    color: white; /* Couleur du texte */
    border: none; /* Pas de bordure */
    border-radius: 5px; /* Coins arrondis */
    padding: 10px 20px; /* Rembourrage */
    font-size: 16px; /* Taille de la police */
    cursor: pointer; /* Curseur en main */
    transition: background-color 0.3s, transform 0.3s; /* Transition douce */
    display: inline-flex; /* Pour centrer le contenu */
    align-items: center; /* Centrer verticalement */
}

#favoritesButton:hover {
    background-color: #d81b60; /* Couleur au survol */
    transform: scale(1.05); /* Légère augmentation de la taille */
}

#favoritesButton i {
    margin-right: 8px; /* Espacement entre l'icône et le texte */
}

.favorite-btn .favorited {
    color: #e91e63; /* Couleur pour les favoris */
}
.favorite-btn .fa-heart {
    color: #ccc; /* Couleur par défaut pour les non-favoris */
    transition: color 0.3s; /* Transition pour un effet doux */
}

</style>
    
</head>

<body>
   
 <!-- Navbar Start -->
 <div class="container-fluid">
    <div class="row border-top px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <div class="d-flex align-items-start">
                <div class="logo-container">
                    <img src="img/logo.png" alt="Logo">
                    <h1 class="logo-text">Arcouri</h1>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav py-0">
                        <a href="http://localhost/PROJETWEB/View/FrontOffice/course.html" class="nav-item nav-link" style="margin-left: 5px;">Accueil</a>
                        <div class="nav-item dropdown" style="margin-left: 5px;">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Internationale</a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="blog.html" class="dropdown-item">Bourses d'Études</a>
                                <a href="single.html" class="dropdown-item">Programmes d'Échange</a>
                            </div>
                        </div>
                        <div class="nav-item dropdown" style="margin-left: 5px;">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Activités</a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="formations,clubs.php" class="dropdown-item">Clubs/Associations</a>
                                <a href="formations,clubs.html#formations-section" class="dropdown-item">Formations</a>
                            </div>
                        </div>
                        <a href="http://localhost/PROJETWEB/View/FrontOffice/afficherQuestRep.php" class="nav-item nav-link" style="margin-left: 5px;">Quiz</a>
                        <a href="http://localhost/PROJETWEB/View/index.php" class="nav-item nav-link" style="margin-left: 5px;">Témoignages</a>
                        <a href="http://localhost/PROJETWEB/View/FrontOffice/contact.html" class="nav-item nav-link" style="margin-left: 5px;">Contact</a>
                    </div>
                    <div class="nav-buttons d-flex align-items-center">
                        <a class="btn btn-primary custom-btn" href="http://localhost/PROJETWEB/View/FrontOffice/signup.php">Sign In</a>
                        <a class="btn btn-primary custom-btn" href="http://localhost/PROJETWEB/View/FrontOffice/login.php" style="margin-left: 5px;">Login</a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
<!-- Navbar End -->

    <!-- Header Start -->
    <div class="container-fluid p-0 position-relative animate-header header-hover" style="margin-bottom: 30px; cursor: pointer;">
        <img src="img/header club.jpg" class="w-100 animate-image" style="height: 400px; object-fit: cover; object-position: center 30%; filter: brightness(0.5);" alt="Header Image">
        <div class="container position-absolute animate-text" style="top: 50%; left: 50%; transform: translate(-50%, -50%);">
            <div class="d-flex flex-column justify-content-center text-center">
                <h3 class="display-4 text-white text-uppercase mb-4 animated-title">Clubs et Associations</h3>
                <p class="header-description text-white mb-4">Découvrez les clubs et associations étudiantes qui enrichissent la vie universitaire en Tunisie. Engagez-vous dans des activités passionnantes, développez de nouvelles compétences et élargissez votre réseau.</p>
                <div class="d-inline-flex text-white justify-content-center">
                    <p class="m-0 text-uppercase"><a class="text-white" href="">Accueil</a></p>
                    <i class="fa fa-angle-double-right pt-1 px-3"></i>
                    <p class="m-0 text-uppercase">Clubs et Associations</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->


    <!-- Blog Start -->
    <!-- Bouton pour afficher la section des favoris -->
    <button id="favoritesButton" onclick="toggleFavorites()">
        <i class="fas fa-star"></i> <!-- Utilisez une icône de votre choix -->
        Favoris
    </button>

    <!-- Section pour afficher les favoris -->
    <div id="favoritesSection" style="display: none;">
        <h2 style="text-align: center; color: #e91e63;">Mes Favoris</h2>
        <div id="favoritesContainer">
        <?php if (!empty($favorites)): ?>
            <ul>
                <?php foreach ($favorites as $favorite): ?>
                    <?php if ($favorite['type'] === 'club'): ?>
                        <?php 
                        // Récupérer le nom du club
                        $club = $clubC->getClubById($favorite['item_id']); // Assurez-vous d'avoir cette méthode
                        ?>
                        <li>
                            <a href="club.php?id_club=<?php echo $favorite['item_id']; ?>" target="_blank" style="text-decoration: none; color: #333;">
                                <?php echo htmlspecialchars($club['nom_club']); ?>
                            </a>
                        </li>
                    <?php elseif ($favorite['type'] === 'formation'): ?>
                        <?php 
                        // Récupérer le nom de la formation
                        $formation = $formationC->getFormationById($favorite['item_id']); // Assurez-vous d'avoir cette méthode
                        ?>
                        <li>
                            <a href="formation.php?id_formation=<?php echo $favorite['item_id']; ?>" target="_blank">
                                <?php echo htmlspecialchars($formation['nom_formation']); ?>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Aucun favori trouvé.</p>
        <?php endif; ?>
    </div>
</div>
    <div class="container-fluid py-3">
        <div class="container py-3">
            <div class="row">
                <div class="container mt-5">
                    <!-- Titre principal -->
                    <div class="text-center">
                        <h2 class="section-title">
                            Découvrez nos Clubs et Associations
                            <div class="title-underline"></div>
                        </h2>
                        <p class="section-subtitle">Une vie étudiante riche en opportunités et en expériences</p>
                    </div>

                    <!-- Clubs Page -->
                    <div class="container mt-5">
        <div id="clubsContainer" class="row justify-content-center">
            <?php foreach ($clubs_page as $club): ?>
                <?php 
                // Vérifiez si le club est en favoris
                $isFavorite = $favorisC->isFavorite($_SESSION['user_id'], 'club', $club['id_club']); // Assurez-vous que l'utilisateur est connecté
                ?>
                <div class="col-auto">
                <div class="club-tile" onclick="window.location.href='incrementClicks.php?id_club=<?php echo htmlspecialchars($club['id_club']); ?>';">
                        <div class="cube">
                            <div class="face front">
                                <img src="/PROJETWEB/uploads/<?php echo htmlspecialchars($club['logo']); ?>" alt="<?php echo htmlspecialchars($club['nom_club']); ?>" class="club-logo">
                            </div>
                            <div class="face back">
                                <div class="text"><?php echo htmlspecialchars($club['nom_club']); ?></div>
                            </div>
                        </div>
                        <button onclick="toggleFavorite('club', <?php echo $club['id_club']; ?>)" class="favorite-btn">
    <i class="fas fa-heart" style="color: <?php echo $isFavorite ? '#e91e63' : '#ccc'; ?>;"></i>
</button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="pagination-container text-center">
            <div class="pagination">
                <?php for($i = 1; $i <= $total_pages; $i++): ?>
                    <button class="page-btn <?php echo ($i == $current_page) ? 'active' : ''; ?>" 
                            onclick="loadClubs(<?php echo $i; ?>)">
                        <?php echo $i; ?>
                    </button>
                <?php endfor; ?>
            </div>
        </div>
    </div>
    

                    <!-- Séparateur -->
                    <div class="section-divider mt-5 mb-5"></div>

                    <!-- Section Formations -->
                    <div id="formations-section" class="text-center mt-5">
                        <h2 class="section-title">
                            Explorez nos Formations
                            <div class="title-underline"></div>
                        </h2>
                        <p class="section-subtitle">Développez vos compétences avec nos formations certifiantes</p>
                    </div>
                    <div class="countdown-container text-center">
    <h2>Ne ratez pas votre chance !</h2>
    <div id="countdown" class="countdown">
        <div class="countdown-item">
            <span id="days">00</span>
            <span class="countdown-label">Jours</span>
        </div>
        <div class="countdown-item">
            <span id="hours">00</span>
            <span class="countdown-label">Heures</span>
        </div>
        <div class="countdown-item">
            <span id="minutes">00</span>
            <span class="countdown-label">Minutes</span>
        </div>
        <div class="countdown-item">
            <span id="seconds">00</span>
            <span class="countdown-label">Secondes</span>
        </div>
    </div>
    <div class="next-formation">
        <h3>Prochaine formation : <?php echo htmlspecialchars($nextFormationDetails['nom_formation']); ?></h3>
        <img src="/PROJETWEB/uploads/<?php echo htmlspecialchars($nextFormationDetails['image']); ?>" alt="<?php echo htmlspecialchars($nextFormationDetails['nom_formation']); ?>" style="max-width: 200px;">
        <p><a href="#formations-section" class="btn btn-primary">Voir la formation</a></p>
    </div>
</div>
                    <!-- Formulaire de recherche de formations par club -->
                    <div class="container mt-5">
                        <h2>Rechercher des Formations par Club</h2>
                        <form id="searchForm" onsubmit="return searchFormations(event)">
                            <label for="id_club">Sélectionnez un club :</label>
                            <select name="id_club" id="id_club">
                                <option value="">-- Choisissez un club --</option>
                                <?php
                                foreach ($clubs as $club) {
                                    $selected = (isset($id_club) && $id_club == $club['id_club']) ? 'selected' : '';
                                    echo '<option value="' . htmlspecialchars($club['id_club']) . '" ' . $selected . '>' . htmlspecialchars($club['nom_club']) . '</option>';
                                }
                                ?>
                            </select>
                            <button type="submit">Rechercher</button>
                        </form>
                    </div>
                    <!-- Affichage des formations -->
                    <!-- Section Formations -->
                    <div class="container mt-5">
                        <!-- Conteneur pour le message de résultat -->
                        <div id="searchResultMessage"></div>
                        
                        <!-- Conteneur pour les formations -->
                        <div id="formationsContainer" class="row">
                            <?php if (!empty($formations_page)): ?>
                                <?php foreach ($formations_page as $formation): ?>
                                    <?php 
                                    // Vérifiez si la formation est en favoris
                                    $isFavorite = $favorisC->isFavorite($_SESSION['user_id'], 'formation', $formation['id_formation']); // Assurez-vous que l'utilisateur est connecté
                                    ?>
                                    <div class="col-lg-4 col-md-6 mb-4">
                                        <div class="formation-card">
                                            <div class="formation-image">
                                                <img src="/PROJETWEB/uploads/<?php echo htmlspecialchars($formation['image']); ?>" alt="<?php echo htmlspecialchars($formation['nom_formation']); ?>" class="formation-image">
                                            </div>
                                            <div class="formation-content">
                                                <h3><?php echo htmlspecialchars($formation['nom_formation']); ?></h3>
                                                <p class="formation-date">
    <i class="fa fa-calendar"></i> 
    <?php 
    if (!empty($formation['date'])) {
        $date = new DateTime($formation['date']);
        echo $date->format('d/m/Y');
    } else {
        echo "Date non définie";
    }
    ?>
</p>
                                                <p><strong>Description :</strong> <?php echo !empty($formation['description']) ? htmlspecialchars($formation['description']) : 'Description non disponible'; ?></p>
                                                <p><strong>Organisme :</strong> <?php echo htmlspecialchars($formation['organisme']); ?></p>
                                                <p><strong>Prix :</strong> <?php echo htmlspecialchars($formation['prix']); ?> TND</p>
                                                <?php
                                                $nom_club = $clubC->getNomClubById($formation['id_club']);
                                                ?>
                                                <p><strong>Club :</strong> <?php echo htmlspecialchars($nom_club); ?></p>
                                                <a href="<?php echo htmlspecialchars($formation['lien']); ?>" class="btn-formation" target="_blank">Visitez le site</a>
                                                <button onclick="toggleFavorite('formation', <?php echo $formation['id_formation']; ?>)" class="favorite-btn">
                                                <i class="fas fa-heart" style="color: <?php echo $isFavorite ? '#e91e63' : '#ccc'; ?>;"></i> <!-- Utilisez fa-star pour une étoile -->
                </button>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p>Aucune formation trouvée.</p>
                            <?php endif; ?>
                        </div>

                        <!-- Pagination des formations -->
                        <div id="paginationContainer" class="pagination-container text-center">
                            <div class="pagination">
                                <?php for($i = 1; $i <= $total_pages_formations; $i++): ?>
                                    <button class="page-btn <?php echo ($i == $current_page_formations) ? 'active' : ''; ?>" 
                                            onclick="loadFormations(<?php echo $i; ?>)">
                                        <?php echo $i; ?>
                                    </button>
                                <?php endfor; ?>
                            </div>
                        </div>
                    </div>
                    
                        
                </div>
            </div>
        </div>
    </div>
    
    <!-- Blog End -->

    <!-- Formations Section -->
    

<!-- Recent Post -->
<div class="mb-5">
    <h3 class="text-uppercase mb-4" style="letter-spacing: 5px;">Recent Post</h3>
    <a class="d-flex align-items-center text-decoration-none mb-3" href="">
        <img class="img-fluid rounded" src="img/blog-80x80.jpg" alt="">
        <div class="pl-3">
            <h6 class="m-1">Diam lorem dolore justo eirmod lorem dolore</h6>
            <small>Jan 01, 2050</small>
        </div>
    </a>
    <a class="d-flex align-items-center text-decoration-none mb-3" href="">
        <img class="img-fluid rounded" src="img/blog-80x80.jpg" alt="">
        <div class="pl-3">
            <h6 class="m-1">Diam lorem dolore justo eirmod lorem dolore</h6>
            <small>Jan 01, 2050</small>
        </div>
    </a>
    <a class="d-flex align-items-center text-decoration-none mb-3" href="">
        <img class="img-fluid rounded" src="img/blog-80x80.jpg" alt="">
        <div class="pl-3">
            <h6 class="m-1">Diam lorem dolore justo eirmod lorem dolore</h6>
            <small>Jan 01, 2050</small>
        </div>
    </a>
</div>
    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-white py-5 px-sm-3 px-lg-5" style="margin-top: 90px;">
        <div class="row pt-5">
            <div class="col-lg-7 col-md-12">
                <div class="row">
                    <div class="col-md-6 mb-5">
                        <h5 class="text-primary text-uppercase mb-4" style="letter-spacing: 5px;">Get In Touch</h5>
                        <p><i class="fa fa-map-marker-alt mr-2"></i>123 Street, New York, USA</p>
                        <p><i class="fa fa-phone-alt mr-2"></i>+012 345 67890</p>
                        <p><i class="fa fa-envelope mr-2"></i>info@example.com</p>
                        <div class="d-flex justify-content-start mt-4">
                            <a class="btn btn-outline-light btn-square mr-2" href="#"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-light btn-square mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light btn-square mr-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a class="btn btn-outline-light btn-square" href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                    <div class="col-md-6 mb-5">
                        <h5 class="text-primary text-uppercase mb-4" style="letter-spacing: 5px;">Our Courses</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Web Design</a>
                            <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Apps Design</a>
                            <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Marketing</a>
                            <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Research</a>
                            <a class="text-white" href="#"><i class="fa fa-angle-right mr-2"></i>SEO</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-12 mb-5">
                <h5 class="text-primary text-uppercase mb-4" style="letter-spacing: 5px;">Newsletter</h5>
                <p>Rebum labore lorem dolores kasd est, et ipsum amet et at kasd, ipsum sea tempor magna tempor. Accu kasd sed ea duo ipsum. Dolor duo eirmod sea justo no lorem est diam</p>
                <div class="w-100">
                    <div class="input-group">
                        <input type="text" class="form-control border-light" style="padding: 30px;" placeholder="Your Email Address">
                        <div class="input-group-append">
                            <button class="btn btn-primary px-4">Sign Up</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-dark text-white border-top py-4 px-sm-3 px-md-5" style="border-color: rgba(256, 256, 256, .1) !important;">
        <div class="row">
            <div class="col-lg-6 text-center text-md-left mb-3 mb-md-0">
                <p class="m-0 text-white">&copy; <a href="#">Domain Name</a>. All Rights Reserved. Designed by <a href="https://htmlcodex.com">HTML Codex</a>
                </p>
            </div>
            <div class="col-lg-6 text-center text-md-right">
                <ul class="nav d-inline-flex">
                    <li class="nav-item">
                        <a class="nav-link text-white py-0" href="#">Privacy</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white py-0" href="#">Terms</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white py-0" href="#">FAQs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white py-0" href="#">Help</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    
    
</body>

</html>