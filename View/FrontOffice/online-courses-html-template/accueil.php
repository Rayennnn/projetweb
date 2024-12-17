<?php
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
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
</head>
<style>
:root {
    
    --primary: #83A6CE;
    --primary-light: #9bb8d7;
    --primary-dark: #6b93bf;
    --secondary: #0D1E4C;
    --secondary-light: #1a2b5c;
    --secondary-dark: #081636;
    --dark: #0B1B32;
    --dark-light: #162942;
    --dark-darker: #071425;
    --accent: #B4182D;
    --accent-light: #d41e35;
    --accent-dark: #931424;
    --deep: #54162B;
    --white: #ffffff;
    --gray-100: #f8f9fa;
    --gray-200: #e9ecef;
    --gray-300: #dee2e6;
}

/* Header Carousel Styles */
#header-carousel {
    position: relative;
    height: 80vh;
    overflow: hidden;
}

.carousel-item {
    position: relative;
    height: 80vh;
}

.carousel-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
}

.carousel-caption {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 100%;
    max-width: 1200px;
    text-align: center;
    padding: 0 20px;
}

.carousel-caption h3 {
    font-size: 24px;
    font-weight: 500;
    color: #ffffff;
    margin-bottom: 20px;
    letter-spacing: 1px;
    text-transform: uppercase;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
}

.carousel-caption h1 {
    font-size: 56px;
    font-weight: 700;
    color: #ffffff;
    margin-bottom: 30px;
    line-height: 1.2;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
}

.carousel-caption p {
    font-size: 18px;
    color: #ffffff;
    margin-bottom: 30px;
    max-width: 800px;
    margin-left: auto;
    margin-right: auto;
    line-height: 1.6;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
}

/* Bouton personnalisé */
.btn-discover {
    display: inline-block;
    padding: 15px 30px;
    background-color: transparent;
    border: 2px solid #ffffff;
    color: #ffffff;
    font-size: 16px;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 1px;
    text-decoration: none;
}

.btn-discover:hover {
    background-color: #ffffff;
    color: #000000;
}

/* Contrôles du carousel */
.carousel-control-prev,
.carousel-control-next {
    width: 50px;
    height: 50px;
    top: 50%;
    transform: translateY(-50%);
}

.carousel-control-prev {
    left: 30px;
}

.carousel-control-next {
    right: 30px;
}

/* Indicateurs du carousel */
.carousel-indicators {
    bottom: 30px;
}

.carousel-indicators li {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    margin: 0 6px;
    background-color: rgba(255, 255, 255, 0.7);
    border: none;
}

.carousel-indicators li.active {
    background-color: #ffffff;
}

/* Media Queries */
@media (max-width: 1200px) {
    .carousel-caption h1 {
        font-size: 48px;
    }
}

@media (max-width: 992px) {
    #header-carousel,
    .carousel-item {
        height: 70vh;
    }

    .carousel-caption h1 {
        font-size: 40px;
    }

    .carousel-caption h3 {
        font-size: 20px;
    }
}

@media (max-width: 768px) {
    #header-carousel,
    .carousel-item {
        height: 60vh;
    }

    .carousel-caption h1 {
        font-size: 32px;
    }

    .carousel-caption h3 {
        font-size: 18px;
    }

    .carousel-caption p {
        font-size: 16px;
        display: none;
    }

    .btn-discover {
        padding: 12px 24px;
        font-size: 14px;
    }
}

@media (max-width: 576px) {
    .carousel-caption h1 {
        font-size: 28px;
    }
}
/* Section À propos */
.section-title {
    position: relative;
    padding-bottom: 20px;
}

.section-title::before {
    position: absolute;
    content: "";
    width: 80px;
    height: 3px;
    bottom: 0;
    left: 0;
    background: var(--primary);
}

.section-title h6 {
    font-size: 1rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 2px;
    color: var(--primary);
}

.section-title h1 {
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--dark);
}

/* Cubes statistiques */
.counter-box {
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.counter-box:hover {
    transform: translateY(-5px);
}

.counter-value {
    font-size: 48px;
    font-weight: 700;
    margin-bottom: 10px;
}

/* Animation des compteurs */
@keyframes countUp {
    from {
        opacity: 0;
        transform: translate3d(0, 100%, 0);
    }
    to {
        opacity: 1;
        transform: none;
    }
}

.counter-animated {
    animation: countUp 1s ease-out;
}
/*navbar*/
.logo-img:hover {
    transform: scale(1.05) rotate(-2deg);
}

.logo-text {
    position: relative;
    top: 0;
    font-size: 2rem;
    text-transform: lowercase;
    background: linear-gradient(45deg, #ff0000, var(--primary));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
}
.nav-buttons {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-left: 20px;
    height: 100%;
}

.custom-btn {
    padding: 8px 25px;
    font-size: 14px;
    font-weight: 500;
    border-radius: 5px;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: all 0.3s ease;
    white-space: nowrap;  /* Empêche le texte de passer à la ligne */
    min-width: 100px;    /* Largeur minimale pour chaque bouton */
    text-align: center;  /* Centre le texte dans le bouton */
}

.custom-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}
.page-btn {
    width: 40px;
    height: 40px;
    border: none;
    border-radius: 50%;
    background: #f8f9fa;
    color: #333;
    font-weight: 600;
    font-size: 1.1rem;
    cursor: pointer;
    transition: all 0.3s ease;
}

.page-btn:hover {
    background: var(--primary);
    color: white;
    transform: translateY(-2px);
}

.page-btn.active {
    background: var(--primary);
    color: white;
    box-shadow: 0 2px 10px rgba(0,0,0,0.2);
}
/* Animation du dégradé au survol */
.logo-text:hover {
    background: linear-gradient(45deg, var(--primary), #ff0000);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    transform: translateY(-2px);
    text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
}
/* Statistics Section Styles */
.statistics-section {
    background-color: #f8f9fa;
    padding: 80px 0;
}

.stat-box {
    background: white;
    border-radius: 15px;
    padding: 30px 20px;
    text-align: center;
    transition: all 0.3s ease;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
    height: 100%;
    position: relative;
    overflow: hidden;
}

.stat-box::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 3px;
    background: #1a76d2; /* Bleu principal */
    transition: all 0.3s ease;
}

.stat-box:hover {
    transform: translateY(-10px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
}

.stat-box:hover::before {
    height: 5px;
}

.stat-icon {
    font-size: 2.5rem;
    color: #1a76d2; /* Bleu principal */
    margin-bottom: 20px;
    transition: all 0.3s ease;
}

.stat-box:hover .stat-icon {
    transform: scale(1.1);
}

.stat-content h2 {
    font-size: 2.5rem;
    font-weight: 700;
    color: #1a76d2; /* Bleu principal */
    margin-bottom: 10px;
}

.stat-content p {
    font-size: 1.1rem;
    color: #6c757d;
    margin: 0;
    font-weight: 500;
}

/* Animation pour les compteurs */
.counter {
    display: inline-block;
    position: relative;
}

.counter::after {
    content: '+';
    position: absolute;
    top: 0;
    right: -20px;
    font-size: 2rem;
    color: #1a76d2;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .stat-box {
        margin-bottom: 30px;
    }
    
    .stat-content h2 {
        font-size: 2rem;
    }
    
    .stat-icon {
        font-size: 2rem;
    }
}

/* Animation d'entrée */
.fade-in-up {
    opacity: 0;
    transform: translateY(30px);
    transition: all 0.6s ease-out;
}

.fade-in-up.visible {
    opacity: 1;
    transform: translateY(0);
}
/* Section Vidéo */
.video-container {
    position: relative;
    padding-bottom: 56.25%; /* Ratio 16:9 */
    height: 0;
    overflow: hidden;
    border-radius: 15px;
    box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
}

.btn-play {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: var(--primary);
    border: none;
    cursor: pointer;
    z-index: 1;
    transition: all 0.3s ease;
}

.btn-play:hover {
    transform: translate(-50%, -50%) scale(1.1);
}

.btn-play span {
    display: block;
    width: 0;
    height: 0;
    border-style: solid;
    border-width: 15px 0 15px 25px;
    border-color: transparent transparent transparent #ffffff;
    position: absolute;
    top: 50%;
    left: 55%;
    transform: translate(-50%, -50%);
}

/* Modal Vidéo */
.modal-content {
    background: transparent;
    border: none;
}

.modal-body {
    padding: 0;
}

/* Animations */
@keyframes slideInDown {
    from {
        transform: translate3d(0, -100%, 0);
        opacity: 0;
    }
    to {
        transform: translate3d(0, 0, 0);
        opacity: 1;
    }
}

@keyframes slideInUp {
    from {
        transform: translate3d(0, 100%, 0);
        opacity: 0;
    }
    to {
        transform: translate3d(0, 0, 0);
        opacity: 1;
    }
}

@keyframes slideInRight {
    from {
        transform: translate3d(100%, 0, 0);
        opacity: 0;
    }
    to {
        transform: translate3d(0, 0, 0);
        opacity: 1;
    }
}

/* Responsive Design */
@media (max-width: 991.98px) {
    .carousel-caption h1 {
        font-size: 2.5rem;
    }

    .section-title h1 {
        font-size: 2rem;
    }

    .counter-box {
        margin-bottom: 30px;
    }
}

@media (max-width: 767.98px) {
    .carousel-caption h1 {
        font-size: 2rem;
    }

    .carousel-caption p {
        font-size: 1rem;
    }

    .section-title h1 {
        font-size: 1.75rem;
    }

    .btn-play {
        width: 60px;
        height: 60px;
    }
}

header {
    height: 60px;
    padding: 10px 20px;
    background-color: #f8f9fa;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.header-title {
    font-size: 1.5em;
    margin: 0;
}
/* Styles pour les cubes statistiques */
.counter-box {
    opacity: 0;
    transform: translateY(30px);
    transition: all 0.6s ease-out;
}

.counter-box.visible {
    opacity: 1;
    transform: translateY(0);
}

/* Amélioration des transitions */
.fade-in-up, .fade-in-left, .fade-in-right {
    will-change: transform, opacity;
}

/* Animation plus fluide pour les grands écrans */
@media (min-width: 992px) {
    .fade-in-up, .fade-in-left, .fade-in-right {
        transition-duration: 0.8s;
    }
}
.description-text {
    line-height: 1.6; /* Augmente l'espacement entre les lignes */
    margin-top: 15px; /* Espace au-dessus du texte */
    margin-bottom: 15px; /* Espace en dessous du texte */
    text-align: justify; /* Justifie le texte pour un meilleur alignement */
}
/*Q/A style*/
.faq-section {
    padding: 80px 0;
    background-color: #f8f9fa;
}

.section-title {
    margin-bottom: 50px;
}

.section-title h2 {
    font-size: 36px;
    font-weight: 700;
    margin-bottom: 15px;
    color: #333;
}

.section-title p {
    color: #666;
    font-size: 18px;
}

.faq-container {
    max-width: 800px;
    margin: 0 auto;
}

.faq-item {
    background: #fff;
    border-radius: 10px;
    margin-bottom: 20px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    overflow: hidden;
}

.faq-question {
    padding: 25px;
}

.faq-question h3 {
    font-size: 18px;
    font-weight: 600;
    color: #333;
    margin: 0;
    position: relative;
    cursor: pointer;
    transition: color 0.3s ease;
}

.faq-question h3:hover {
    color: #1a76d2;
}

.faq-answer {
    padding-top: 15px;
}

.faq-answer p {
    margin: 0;
    color: #666;
    line-height: 1.6;
    font-size: 16px;
}

/* Animation hover */
.faq-item {
    transition: transform 0.3s ease;
}

.faq-item:hover {
    transform: translateY(-5px);
}

/* Responsive */
@media (max-width: 768px) {
    .faq-section {
        padding: 50px 0;
    }

    .section-title h2 {
        font-size: 28px;
    }

    .section-title p {
        font-size: 16px;
    }

    .faq-question {
        padding: 20px;
    }

    .faq-question h3 {
        font-size: 16px;
    }

    .faq-answer p {
        font-size: 14px;
    }
}
</style>
<script>
    // Animation des compteurs
document.addEventListener('DOMContentLoaded', function() {
    const counters = document.querySelectorAll('[data-toggle="counter-up"]');
    
    const animateCounter = (counter) => {
        const target = parseInt(counter.innerText);
        const duration = 2000;
        const step = target / duration * 10;
        let current = 0;
        
        const updateCounter = () => {
            current += step;
            if (current < target) {
                counter.innerText = Math.ceil(current);
                setTimeout(updateCounter, 10);
            } else {
                counter.innerText = target;
            }
        };
        
        updateCounter();
    };

    // Observer pour démarrer l'animation quand les éléments sont visibles
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateCounter(entry.target);
                observer.unobserve(entry.target);
            }
        });
    });

    counters.forEach(counter => observer.observe(counter));
});

// Gestion de la modal vidéo
$('#videoModal').on('hidden.bs.modal', function () {
    $('#videoModal video').get(0).pause();
});
// Observer pour les animations au scroll
document.addEventListener('DOMContentLoaded', function() {
    const observerOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.2
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target); // Arrête d'observer une fois animé
            }
        });
    }, observerOptions);

    // Observe tous les éléments avec les classes d'animation
    document.querySelectorAll('.fade-in-up, .fade-in-left, .fade-in-right').forEach((element) => {
        observer.observe(element);
    });
});

// Animation des compteurs (code existant amélioré)
const animateCounter = (counter) => {
    const target = parseInt(counter.innerText);
    const duration = 2000;
    let start = 0;
    const increment = target / (duration / 16); // 60 FPS

    const updateCounter = () => {
        start += increment;
        if (start < target) {
            counter.innerText = Math.floor(start);
            requestAnimationFrame(updateCounter);
        } else {
            counter.innerText = target;
        }
    };

    requestAnimationFrame(updateCounter);
};

// Observer pour les compteurs
const counterObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            animateCounter(entry.target);
            counterObserver.unobserve(entry.target);
        }
    });
}, {
    threshold: 0.5
});

document.querySelectorAll('[data-toggle="counter-up"]').forEach(counter => {
    counterObserver.observe(counter);
});
</script>

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

<!-- Header Slider Start -->
<div class="container-fluid p-0">
    <div id="header-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="w-100" src="img/carousel-2.jpg" alt="Image">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 900px;">
                        <h3 class="text-white text-uppercase mb-3">Explorez les Meilleures Opportunités Locales</h3>
                        <h1 class="display-3 text-white mb-3">Clubs et Formations</h1>
                        <p class="mx-md-5 px-5">Trouvez les clubs et formations qui enrichiront votre parcours académique et professionnel.</p>
                        <a class="btn btn-outline-light py-3 px-4 mt-3" href="#">En savoir plus</a>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img class="w-100" src="img/carousel-3.jpg" alt="Image">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 900px;">
                        <h3 class="text-white text-uppercase mb-3">Partez à la Découverte du Monde</h3>
                        <h1 class="display-3 text-white mb-3">Bourses et Échanges</h1>
                        <p class="mx-md-5 px-5">Accédez à des opportunités internationales et bâtissez votre carrière avec confiance.</p>
                        <a class="btn btn-outline-light py-3 px-4 mt-3" href="#">En savoir plus</a>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img class="w-100" src="img/carousel-1.jpg" alt="Image">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 900px;">
                        <h3 class="text-white text-uppercase mb-3">Découvrez Encore Plus</h3>
                        <h1 class="display-3 text-white mb-3">Outils Intelligents</h1>
                        <p class="mx-md-5 px-5">Évaluez votre motivation et vérifiez si vous êtes sur la bonne voie pour atteindre vos objectifs.</p>
                        <a class="btn btn-outline-light py-3 px-4 mt-3" href="#">En savoir plus</a>
                    </div>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
            <div class="btn btn-dark" style="width: 45px; height: 45px;">
                <span class="carousel-control-prev-icon mb-n2"></span>
            </div>
        </a>
        <a class="carousel-control-next" href="#header-carousel" data-slide="next">
            <div class="btn btn-dark" style="width: 45px; height: 45px;">
                <span class="carousel-control-next-icon mb-n2"></span>
            </div>
        </a>
    </div>
</div>
<!-- Header Slider End -->

<!-- About Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-5 mb-5 mb-lg-0 fade-in-left" style="min-height: 500px;">
                <div class="position-relative h-100">
                    <img class="position-absolute w-100 h-100" src="img/about.jpg" style="object-fit: cover;">
                </div>
            </div>
            <div class="col-lg-7 fade-in-right">
                <div class="section-title position-relative mb-4">
                    <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">À propos de nous</h6>
                    <h1 class="display-4">L'équipe 'PARCOURI'</h1>
                </div>
                <p class="description-text">En tant qu’équipe de jeunes étudiants ambitieux, Parcouri a pour mission d’offrir à chacun une chance équitable de découvrir et de saisir les opportunités disponibles en Tunisie. Nous croyons que chaque étudiant mérite d’avoir accès aux ressources et aux informations nécessaires pour réaliser ses aspirations, sans barrières ni inégalités. Notre engagement est de créer un espace inclusif, fiable et inspirant, qui ouvre des portes à un avenir meilleur pour tous.</p>
                </div>
        </div>
    </div>
</div>
<!-- About End -->
 <!-- Statistics Section Start -->
<div class="statistics-section container-fluid py-5">
    <div class="container py-5">
        <div class="section-title text-center mb-5">
            <h6 class="text-primary text-uppercase">Nos Chiffres</h6>
            <h1>Découvrez les opportunités en Tunisie</h1>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-3 col-md-6 mb-4 fade-in-up" style="transition-delay: 0.1s;">
                <div class="stat-box">
                    <div class="stat-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <div class="stat-content">
                        <h2 class="counter" data-toggle="counter-up">400</h2>
                        <p>Formations Disponibles</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 fade-in-up" style="transition-delay: 0.3s;">
                <div class="stat-box">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-content">
                        <h2 class="counter" data-toggle="counter-up">231</h2>
                        <p>Clubs Actifs</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 fade-in-up" style="transition-delay: 0.5s;">
                <div class="stat-box">
                    <div class="stat-icon">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <div class="stat-content">
                        <h2 class="counter" data-toggle="counter-up">50</h2>
                        <p>Bourses d'études</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 fade-in-up" style="transition-delay: 0.7s;">
                <div class="stat-box">
                    <div class="stat-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stat-content">
                        <h2 class="counter" data-toggle="counter-up">72</h2>
                        <p>Programmes d'échanges</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Statistics Section End -->

<!-- Video Section Start -->
<div class="container-fluid bg-image py-5 fade-in-up" style="margin: 90px 0;">
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-lg-5 mb-5 mb-lg-0 fade-in-left">
                <div class="section-title position-relative mb-4">
                    <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">Découvrez-nous</h6>
                    <h1 class="display-4">Regardez notre vidéo de présentation</h1>
                </div>
                <p class="m-0">Description de la vidéo et de son contenu</p>
            </div>
            <div class="col-lg-7 fade-in-right">
                <div class="video-container position-relative">
                    <img class="w-100 h-100" src="img/video-thumb.jpg" alt="Video Thumbnail">
                    <button type="button" class="btn-play" data-toggle="modal" data-target="#videoModal">
                        <span></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Video Section End -->

<!-- Video Modal -->
<div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="videoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <video class="w-100" controls>
                    <source src="video/presentation.mp4" type="video/mp4">
                    Votre navigateur ne supporte pas la lecture de vidéos.
                </video>
            </div>
        </div>
    </div>
</div>
<!-- Video Modal End -->
 <!-- FAQ Section Start -->
<div class="faq-section">
    <div class="container">
        <div class="section-title text-center">
            <h2>Questions Fréquentes</h2>
            <p>Tout ce que vous devez savoir sur notre plateforme</p>
        </div>
        
        <div class="faq-container">
            <div class="faq-item">
                <div class="faq-question">
                    <h3>Qu'est-ce que ce site propose ?</h3>
                    <div class="faq-answer">
                        <p>Ce site aide les étudiants tunisiens à améliorer leur parcours académique en leur offrant des informations sur les clubs, formations, bourses d'études, programmes d'échange, et d'autres outils utiles.</p>
                    </div>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <h3>Comment puis-je m'inscrire sur le site ?</h3>
                    <div class="faq-answer">
                        <p>Cliquez sur le bouton "S'inscrire" en haut de la page, remplissez le formulaire avec vos informations, et commencez à explorer toutes les fonctionnalités !</p>
                    </div>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <h3>Puis-je sauvegarder des favoris ?</h3>
                    <div class="faq-answer">
                        <p>Oui, mais cette fonctionnalité est réservée aux utilisateurs inscrits. Créez un compte pour en profiter.</p>
                    </div>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <h3>Qui peut ajouter des informations sur le site ?</h3>
                    <div class="faq-answer">
                        <p>Seule l'équipe de gestion peut ajouter ou modifier les informations, mais vous pouvez toujours nous envoyer des suggestions.</p>
                    </div>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <h3>Puis-je contacter l'équipe pour poser une question ou donner un avis ?</h3>
                    <div class="faq-answer">
                        <p>Bien sûr ! Utilisez le formulaire dans la section "À propos de nous" pour nous envoyer un message directement.</p>
                    </div>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <h3>Comment puis-je obtenir plus de détails sur un club, une formation, une bourse ou un programme d'échange ?</h3>
                    <div class="faq-answer">
                        <p>Nous fournissons uniquement les informations essentielles pour vous aider à faire un choix éclairé. Pour en savoir plus, cliquez sur le bouton dédié, qui vous redirigera vers le site officiel ou la source d'information correspondante.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<iframe
src="https://www.chatbase.co/chatbot-iframe/wIMt_Z_WK-QmHC-zDvou-"
width="100%"
style="height: 100%; min-height: 700px"
frameborder="0"
></iframe>
<!-- FAQ Section End -->


</body>
</html>
<!DOCTYPE html>
<html lang="en">

