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
    //script calendrier
        // Fonction pour récupérer les dates des formations favorites
        async function getFavoriteFormationDates() {
            try {
                const response = await fetch('get_favorite_formation_dates.php');
                if (!response.ok) {
                    throw new Error('Erreur réseau');
                }
                const data = await response.json();
                console.log('Formations récupérées:', data); // Pour vérifier les données
                return data;
            } catch (error) {
                console.error('Erreur lors de la récupération des dates:', error);
                return [];
            }
        }

        async function generateCalendar(year, month) {
            // Récupérer les formations favorites avec leurs dates
            const favoriteFormations = await getFavoriteFormationDates();
            
            const firstDay = new Date(year, month, 1);
            const lastDay = new Date(year, month + 1, 0);
            const startingDay = firstDay.getDay();
            const monthLength = lastDay.getDate();
            
            const calendarDays = document.getElementById('calendarDays');
            calendarDays.innerHTML = '';
            
            // Ajouter les jours du mois précédent
            const prevMonthDays = new Date(year, month, 0).getDate();
            for (let i = startingDay - 1; i >= 0; i--) {
                const dayDiv = document.createElement('div');
                dayDiv.className = 'calendar-day other-month';
                dayDiv.textContent = prevMonthDays - i;
                calendarDays.appendChild(dayDiv);
            }
            
            // Ajouter les jours du mois actuel
            const today = new Date();
            for (let i = 1; i <= monthLength; i++) {
                const dayDiv = document.createElement('div');
                dayDiv.className = 'calendar-day';
                
                // Vérifier si c'est aujourd'hui
                if (year === today.getFullYear() && month === today.getMonth() && i === today.getDate()) {
                    dayDiv.classList.add('today');
                }
                
                // Vérifier les formations pour ce jour
                const currentDate = new Date(year, month, i);
                const formationsForDay = favoriteFormations.filter(formation => {
                    const formationDate = new Date(formation.date);
                    return formationDate.getDate() === currentDate.getDate() &&
                        formationDate.getMonth() === currentDate.getMonth() &&
                        formationDate.getFullYear() === currentDate.getFullYear();
                });
                
                if (formationsForDay.length > 0) {
                    dayDiv.classList.add('has-formation');
                    
                    // Créer une liste des formations pour ce jour
                    const formationsList = formationsForDay
                        .map(formation => formation.nom_formation)
                        .join('\n');
                    
                    dayDiv.setAttribute('data-formations', formationsList);
                    
                    // Ajouter l'indicateur visuel
                    const indicator = document.createElement('div');
                    indicator.className = 'formation-indicator';
                    dayDiv.appendChild(indicator);
                    
                    // Ajouter un gestionnaire d'événements pour afficher les détails
                    dayDiv.addEventListener('click', () => {
                        alert(`Formations prévues:\n${formationsList}`);
                    });
                }
                
                dayDiv.textContent = i;
                calendarDays.appendChild(dayDiv);
            }
            
            // Ajouter les jours du mois suivant
            const remainingDays = 42 - (startingDay + monthLength);
            for (let i = 1; i <= remainingDays; i++) {
                const dayDiv = document.createElement('div');
                dayDiv.className = 'calendar-day other-month';
                dayDiv.textContent = i;
                calendarDays.appendChild(dayDiv);
            }
        }

        // Mettre à jour la fonction updateCalendar pour être async
        async function updateCalendar() {
            const monthNames = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin",
                            "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"];
            document.getElementById('currentMonth').textContent = 
                `${monthNames[currentDate.getMonth()]} ${currentDate.getFullYear()}`;
            await generateCalendar(currentDate.getFullYear(), currentDate.getMonth());
        }

        // Mettre à jour les fonctions de navigation
        async function previousMonth() {
            currentDate.setMonth(currentDate.getMonth() - 1);
            await updateCalendar();
        }

        async function nextMonth() {
            currentDate.setMonth(currentDate.getMonth() + 1);
            await updateCalendar();
        }

        // Initialiser le calendrier
        let currentDate = new Date();
        updateCalendar();

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
            color: #e63946; /* Couleur rouge */
            font-size: 1.5em; /* Taille de l'icône */
            transition: color 0.3s;
        }

        .favorite-btn:hover .fa-heart{
            color: #d62839; /* Couleur rouge au survol */
        }
        #favoritesSection {
            margin: 40px auto;
            max-width: 1200px;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        #favoritesSection h2 {
            text-align: center;
            color: #e63946; /* Couleur rouge */
            font-size: 2.5em;
            margin-bottom: 30px;
            font-weight: 600;
            position: relative;
        }

        #favoritesSection h2:after {
            content: '';
            display: block;
            width: 60px;
            height: 3px;
            background: #e63946; /* Couleur rouge */
            margin: 15px auto;
        }

        #favoritesContainer {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            padding: 20px;
        }

        #favoritesContainer li {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            transition: all 0.3s ease;
            border: 1px solid #eee;
            list-style: none;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        #favoritesContainer li:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-color: #e63946; /* Couleur rouge au survol */
        }

        #favoritesContainer li a {
            color: #333;
            text-decoration: none;
            font-size: 1.1em;
            font-weight: 500;
            display: flex;
            align-items: center;
            width: 100%;
        }

        #favoritesContainer li a:hover {
            color: #e91e63;
        }

        #favoritesButton {
            position: fixed;
            right: 30px;
            bottom: 30px;
            background-color: #e63946; /* Couleur rouge pour le bouton "Mes Favoris" */
            color: white; /* Couleur du texte en blanc pour le contraste */
            border: none;
            border-radius: 50px;
            padding: 15px 30px;
            font-size: 1rem;
            font-weight: 500;
            box-shadow: 0 4px 15px rgba(233, 30, 99, 0.2);
            transition: all 0.3s ease;
            z-index: 1000;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        #favoritesButton:hover {
            background-color: #d81b60;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(233, 30, 99, 0.3);
        }

        #favoritesButton i {
            font-size: 1.2em;
        }

        #favoritesSection {
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        #favoritesContainer p {
            text-align: center;
            color: #666;
            font-style: italic;
            grid-column: 1 / -1;
            padding: 20px;
        }

        .favorite-item-icon {
            margin-right: 15px;
            color: #e63946; /* Couleur rouge pour les icônes */
            font-size: 1.2em;
        }

        .favorite-type-badge {
            background-color: #e91e63;
            color: white;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.8em;
            margin-left: 10px;
        }

        /*style calendrier*/
        .calendar-day.has-formation {
            position: relative;
            background-color: #ffe6e6; /* Fond légèrement rouge pour les jours avec formation */
        }

        .formation-indicator {
            position: absolute;
            bottom: 2px;
            left: 50%;
            transform: translateX(-50%);
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background-color: #e63946; /* Couleur rouge */
        }

        .calendar-day.has-formation:hover::after {
            content: attr(data-formations); /* Utilise les noms des formations stockés dans l'attribut data */
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
            background-color: #e63946; /* Couleur rouge */
            color: white;
            padding: 5px;
            border-radius: 3px;
            font-size: 12px;
            white-space: nowrap;
            z-index: 1000;
        }

        .calendar-wrapper {
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            padding: 20px;
            max-width: 400px;
            margin: 20px auto;
        }

        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding: 0 10px;
        }

        .calendar-header h2 {
            color: #333;
            font-size: 1.5em;
            margin: 0;
        }

        .calendar-nav {
            display: flex;
            gap: 15px;
        }

        .calendar-nav button {
            background: none;
            border: none;
            font-size: 1.2em;
            cursor: pointer;
            color: #ff0000;
        }

        .calendar-weekdays {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            text-align: center;
            font-weight: bold;
            color: #e63946; /* Couleur rouge pour les textes des jours (lundi, mardi, etc.) */
            margin-bottom: 10px;
        }

        .calendar-days {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 5px;
        }

        .calendar-day {
            aspect-ratio: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.3s ease;
            color: black; /* Couleur noire pour les numéros des jours */
        }

        .calendar-day:hover {
            background-color: #f0f0f0;
        }

        .calendar-day.today {
            background-color: #ff0000;
            color: white;
        }

        .calendar-day.has-event {
            border: 2px solid #ff0000;
        }

        .calendar-day.other-month {
            color: #ccc;
        }

        /* Style pour les favoris */
        .favorites-section {
            margin-bottom: 30px;
        }

        .favorites-title {
            color: #e63946; /* Couleur rouge */
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .favorites-category {
            margin-bottom: 20px;
        }

        .favorites-category-title {
            color: #e63946; /* Couleur rouge */
            font-size: 18px;
            margin-bottom: 10px;
        }

        .favorites-list {
            list-style: none;
            padding: 0;
        }

        .favorites-item {
            display: flex;
            align-items: center;
            padding: 8px;
            background: #f8f9fa;
            margin-bottom: 5px;
            border-radius: 5px;
        }

        .favorites-item i {
            margin-right: 10px;
            color: #ff0000;
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
                        <a href="index.html" class="nav-item nav-link" style="margin-left: 5px;">Accueil</a>
                        <div class="nav-item dropdown" style="margin-left: 5px;">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Internationale</a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="../blog.php" class="dropdown-item">Bourses d'Études</a>
                                <a href="../prog.php" class="dropdown-item">Programmes d'Échange</a>
                            </div>
                        </div>
                        <div class="nav-item dropdown" style="margin-left: 5px;">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Activités</a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="formations,clubs.php" class="dropdown-item">Clubs/Associations</a>
                                <a href="#formation" class="dropdown-item">Formations</a>
                            </div>
                        </div>
                        <a href="../afficherQuestRep.php" class="nav-item nav-link" style="margin-left: 5px;">Quiz</a>
                        <a href="teacher.html" class="nav-item nav-link" style="margin-left: 5px;">Témoignages</a>
                        <a href="contact.php" class="nav-item nav-link" style="margin-left: 5px;">Contact</a>
                    </div>
                    <div class="nav-buttons d-flex align-items-center">
                        <a class="btn btn-primary custom-btn" href="signup.html">Sign In</a>
                        <a class="btn btn-primary custom-btn" href="login.html" style="margin-left: 5px;">Login</a>
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
    <i class="fas fa-heart"></i>
    Mes Favoris
</button>

<!-- Section pour afficher les favoris -->
<div id="favoritesSection" style="display: none;">
    <h2 style="text-align: center; color: #e63946;">Mes Favoris</h2>
    
    <!-- Section Clubs Favoris -->
    <div class="favorites-section">
        <h3><i class="fas fa-users"></i> Clubs favoris</h3>
        <div id="clubsFavorites">
            <?php
            $clubFavorites = array_filter($favorites, function($fav) {
                return $fav['type'] === 'club';
            });
            
            if (!empty($clubFavorites)): ?>
                <ul>
                    <?php foreach ($clubFavorites as $favorite): 
                        $club = $clubC->getClubById($favorite['item_id']);
                    ?>
                        <li>
                            <a href="club.php?id_club=<?php echo $favorite['item_id']; ?>">
                                <i class="fas fa-users favorite-item-icon"></i>
                                <?php echo htmlspecialchars($club['nom_club']); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p class="no-favorites">Vous n'avez pas encore de clubs en favoris</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Section Formations Favorites -->
    <div class="favorites-section">
        <h3><i class="fas fa-graduation-cap"></i> Formations favorites</h3>
        <div id="formationsFavorites">
            <?php
            $formationFavorites = array_filter($favorites, function($fav) {
                return $fav['type'] === 'formation';
            });
            
            if (!empty($formationFavorites)): ?>
                <ul>
                    <?php foreach ($formationFavorites as $favorite): 
                        $formation = $formationC->getFormationById($favorite['item_id']);
                    ?>
                        <li>
                            <a href="formation.php?id_formation=<?php echo $favorite['item_id']; ?>">
                                <i class="fas fa-graduation-cap favorite-item-icon"></i>
                                <?php echo htmlspecialchars($formation['nom_formation']); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <!-- Structure HTML du calendrier -->
<div class="calendar-wrapper">
    <div class="calendar-header">
        <button class="calendar-nav-btn" onclick="previousMonth()">
            <i class="fas fa-chevron-left"></i>
        </button>
        <h2 id="currentMonth">Décembre 2024</h2>
        <button class="calendar-nav-btn" onclick="nextMonth()">
            <i class="fas fa-chevron-right"></i>
        </button>
    </div>
    
    <div class="calendar-weekdays">
        <div>Dim</div>
        <div>Lun</div>
        <div>Mar</div>
        <div>Mer</div>
        <div>Jeu</div>
        <div>Ven</div>
        <div>Sam</div>
    </div>
    
    <div class="calendar-days" id="calendarDays">
        <!-- Les jours seront générés en JavaScript -->
    </div>
</div>
            <?php else: ?>
                <p class="no-favorites">Vous n'avez pas encore de formations en favoris</p>
            <?php endif; ?>
        </div>
    </div>
</div>

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
                    <div class="container mt-5" id="formation">
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

<script>
window.embeddedChatbotConfig = {
chatbotId: "wIMt_Z_WK-QmHC-zDvou-",
domain: "www.chatbase.co"
}
</script>
<script
src="https://www.chatbase.co/embed.min.js"
chatbotId="wIMt_Z_WK-QmHC-zDvou-"
domain="www.chatbase.co"
defer>
</script>
    
    <!-- Blog End -->


    <!--footer-->
<footer class="footer">
    <div class="footer-container">
      <div class="footer-column">
        <h3>contactez nous</h3>
        <p><i class="fas fa-map-marker-alt"></i> tunisie</p>
        <p><i class="fas fa-phone"></i> 99 444 222</p>
        <p><i class="fas fa-envelope"></i> parcouri@gmail.com</p>
        <div class="social-icons">
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-facebook-f"></i></a>
          <a href="#"><i class="fab fa-linkedin-in"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
        </div>
      </div>
  
      <div class="footer-column">
        <h3>SERVICES</h3>
        <ul>
          <li><a href="#">bourses</a></li>
          <li><a href="#">programme d'echanges</a></li>
          <li><a href="#">formation</a></li>
          <li><a href="#">clubs</a></li>
         
        </ul>
      </div>
  
      <div class="footer-column">
        <h3>mail</h3>
        <p>Abonnez-vous à notre newsletter pour les dernières mises à jour et offres.</p>
        <form>
          <input type="email" placeholder="Ton adresse mail">
          <button type="submit">s'inscrire</button>
        </form>
      </div>
    </div>
  
    <div class="footer-bottom">
      <p>&copy; designed by team <a href="#">parcouri </a></p>
     
    </div>
  </footer>


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