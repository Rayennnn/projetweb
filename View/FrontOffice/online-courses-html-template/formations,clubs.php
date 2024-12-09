<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/PROJETWEB/config.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/PROJETWEB/Model/clubs.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/PROJETWEB/Controller/clubC.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/PROJETWEB/Model/formations.php'); // Inclure le modèle des formations
require_once($_SERVER['DOCUMENT_ROOT'] . '/PROJETWEB/Controller/formationC.php'); // Inclure le contrôleur des formations

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

if (isset($_GET['id_club']) && !empty($_GET['id_club'])) {
    $id_club = intval($_GET['id_club']);
    // Récupérer les formations du club sélectionné
    $formations = $clubC->afficherFormations($id_club);
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

    <!-- Formations,clubs CSS -->
    <link href="formations,clubs.css" rel="stylesheet">
    <script src="/clubClicks.js"></script> <!-- ou clubClicks.js -->
    <script>
        function loadClubs(page) {
            fetch('formations,clubs.php?page=' + page) // Remplacez par le chemin correct vers votre fichier PHP
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.text(); // Récupérer le contenu HTML
                })
                .then(html => {
                    // Remplacer le contenu de la section des clubs avec le nouveau contenu
                    document.getElementById('clubsContainer').innerHTML = html; // Assurez-vous d'avoir un conteneur avec cet ID
                })
                .catch(error => console.error('There was a problem with the fetch operation:', error));
        }
    </script>
    
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
                                <a href="blog.html" class="dropdown-item">Bourses d'Études</a>
                                <a href="single.html" class="dropdown-item">Programmes d'Échange</a>
                            </div>
                        </div>
                        <div class="nav-item dropdown" style="margin-left: 5px;">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Activités</a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="formations,clubs.html" class="dropdown-item">Clubs/Associations</a>
                                <a href="formations,clubs.html#formations-section" class="dropdown-item">Formations</a>
                            </div>
                        </div>
                        <a href="course.html" class="nav-item nav-link" style="margin-left: 5px;">Quiz</a>
                        <a href="teacher.html" class="nav-item nav-link" style="margin-left: 5px;">Témoignages</a>
                        <a href="contact.html" class="nav-item nav-link" style="margin-left: 5px;">Contact</a>
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
                <div class="col-auto">
                    <div class="club-tile" onclick="incrementClubClicks(<?php echo htmlspecialchars($club['id_club']); ?>);">
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

                    <div class="row mt-5 formations-container">
                    <div class="row mt-5 formations-container">
                    <div class="row mt-5 formations-container">
                    <?php foreach ($formations as $formation): ?>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="formation-card">
                            <div class="formation-image">
                                <img src="/PROJETWEB/uploads/<?php echo htmlspecialchars($formation['image']); ?>" alt="<?php echo htmlspecialchars($formation['nom_formation']); ?>" class="formation-image">
                            </div>
                            <div class="formation-content">
                                <h3><?php echo htmlspecialchars($formation['nom_formation']); ?></h3>
                                <p><strong>Description :</strong> <?php echo !empty($formation['description']) ? htmlspecialchars($formation['description']) : 'Description non disponible'; ?></p>
                                <p><strong>Organisme :</strong> <?php echo htmlspecialchars($formation['organisme']); ?></p>
                                <p><strong>Prix :</strong> <?php echo htmlspecialchars($formation['prix']); ?> TND</p>
                                
                                <?php
                                // Récupérer le nom du club à partir de l'ID du club
                                $nom_club = $clubC->getNomClubById($formation['id_club']);
                                ?>
                                <p><strong>Club :</strong> <?php echo htmlspecialchars($nom_club); ?></p> <!-- Afficher le nom du club -->
                                
                                <!-- Bouton pour visiter le site -->
                                <a href="<?php echo htmlspecialchars($formation['lien']); ?>" class="btn-formation" target="_blank">Visitez le site</a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                    <!-- Pagination des formations -->
                    <div class="container mt-5">
                        <div class="pagination-container text-center">
                            <div class="pagination">
                                <button class="page-btn active" onclick="showPage(1)">1</button>
                                <button class="page-btn" onclick="showPage(2)">2</button>
                                <button class="page-btn" onclick="showPage(3)">3</button>
                            </div>
                        </div>
                    </div>
                    <!-- Formulaire de recherche de formations par club -->
                    <div class="container mt-5">
                        <h2>Rechercher des Formations par Club</h2>
                        <form method="GET" action="formations,clubs.php">
                            <label for="id_club">Sélectionnez un club :</label>
                            <select name="id_club" id="id_club">
                                <option value="">-- Choisissez un club --</option>
                                <?php
                                // Remplir le menu déroulant avec les clubs
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
                        <div class="row mt-5 formations-container">
                        <?php if (!empty($formations)): ?>
                            <h2>Formations disponibles :</h2>
                            <?php foreach ($formations as $formation): ?>
                                <div class="col-lg-4 col-md-6 mb-4">
                                    <div class="formation-card">
                                        <div class="formation-image">
                                            <img src="/PROJETWEB/uploads/<?php echo htmlspecialchars($formation['image']); ?>" alt="<?php echo htmlspecialchars($formation['nom_formation']); ?>" class="formation-image">
                                        </div>
                                        <div class="formation-content">
                                            <h3><?php echo htmlspecialchars($formation['nom_formation']); ?></h3>
                                            <p><strong>Description :</strong> <?php echo !empty($formation['description']) ? htmlspecialchars($formation['description']) : 'Description non disponible'; ?></p>
                                            <p><strong>Organisme :</strong> <?php echo htmlspecialchars($formation['organisme']); ?></p>
                                            <p><strong>Prix :</strong> <?php echo htmlspecialchars($formation['prix']); ?> TND</p>
                                            
                                            <?php
                                            // Récupérer le nom du club à partir de l'ID du club
                                            $nom_club = $clubC->getNomClubById($formation['id_club']);
                                            ?>
                                            <p><strong>Club :</strong> <?php echo htmlspecialchars($nom_club); ?></p> <!-- Afficher le nom du club -->
                                            
                                            <!-- Bouton pour visiter le site -->
                                            <a href="<?php echo htmlspecialchars($formation['lien']); ?>" class="btn-formation" target="_blank">Visitez le site</a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>Aucune formation trouvée.</p>
                        <?php endif; ?>
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