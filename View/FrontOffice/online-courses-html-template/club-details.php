<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/PROJETWEB/config.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/PROJETWEB/Model/clubs.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/PROJETWEB/Controller/clubC.php');

$clubC = new ClubC();

// Récupérer l'ID du club depuis l'URL

if (isset($_GET['id'])) {
    $club = $clubC->getClubById($_GET['id']);
    if (!$club) {
        header('Location: formations,clubs.php');
        exit();
    }
} else {
    header('Location: formations,clubs.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>PARCOURI - <?php echo htmlspecialchars($club['nom_club']); ?></title>
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

    <!-- Club Details CSS -->
    <link href="../club-details.css" rel="stylesheet"> 
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
                        <a href="online-courses-html-template/index.html" class="nav-item nav-link" style="margin-left: 5px;">Accueil</a>
                        <div class="nav-item dropdown" style="margin-left: 5px;">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Internationale</a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="online-courses-html-template/blog.html" class="dropdown-item">Bourses d'Études</a>
                                <a href="online-courses-html-template/single.html" class="dropdown-item">Programmes d'Échange</a>
                            </div>
                        </div>
                        <div class="nav-item dropdown" style="margin-left: 5px;">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Activités</a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="online-courses-html-template/formations,clubs.php" class="dropdown-item">Clubs/Associations</a>
                                <a href="online-courses-html-template/formations,clubs.php#formations-section" class="dropdown-item">Formations</a>
                            </div>
                        </div>
                        <a href="online-courses-html-template/course.html" class="nav-item nav-link" style="margin-left: 5px;">Quiz</a>
                        <a href="online-courses-html-template/teacher.html" class="nav-item nav-link" style="margin-left: 5px;">Témoignages</a>
                        <a href="online-courses-html-template/contact.html" class="nav-item nav-link" style="margin-left: 5px;">Contact</a>
                    </div>
                    <div class="nav-buttons d-flex align-items-center">
                        <a class="btn btn-primary custom-btn" href="online-courses-html-template/signup.html">Sign In</a>
                        <a class="btn btn-primary custom-btn" href="online-courses-html-template/login.html" style="margin-left: 5px;">Login</a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
<!-- Navbar End -->
    <div class="header-club">
        <div class="text-center text-white">
        </div>
    </div>
<!-- Détails du club -->
<div class="club-details-container fade-in">
    <div class="container mt-5">
        <div class="club-card">
            <div class="row">
                <div class="col-lg-6">
                    <img src="/PROJETWEB/uploads/<?php echo htmlspecialchars($club['logo']); ?>" 
                         alt="<?php echo htmlspecialchars($club['nom_club']); ?>" 
                         class="club-logo-details">
                </div>
                <div class="col-lg-6">
                    <div class="info-box">
                        <h2 class="club-title"><?php echo htmlspecialchars($club['nom_club']); ?></h2>
                        <p class="creation-date">Créé le <?php echo htmlspecialchars($club['date_creation']); ?></p>
                        <span class="badge badge-primary"><?php echo htmlspecialchars($club['categorie']); ?></span>
                        <p class="club-description"><?php echo nl2br(htmlspecialchars($club['description'])); ?></p>
                        
                        <div class="location-section">
                            <h4>Localisation</h4>
                            <p><?php echo htmlspecialchars($club['lieu']); ?></p>
                        </div>

                        <div class="mt-4">
                            <a href="<?php echo htmlspecialchars($club['lien']); ?>" 
                               class="btn btn-primary" 
                               target="_blank">
                                Visiter le site web
                            </a>
                            <a href="formations,clubs.php" 
                               class="btn btn-secondary ml-2">
                                Retour aux clubs
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>
<script src="mail/jqBootstrapValidation.min.js"></script>
<script src="mail/contact.js"></script>
<script src="js/main.js"></script>


</body>
</html>