<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>ECOURSES - Online Courses HTML Template</title>
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
    <link href="assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="quiz.css">
</head>

<body>
<!-- Navbar Start -->
<div class="container-fluid">
    <div class="row border-top px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <div class="d-flex align-items-start">
                <img href="index.html" class="logo-img" src="assets/img/logo.jfif" alt="" style="width: 50px; margin-left: -px;">
                <h1 class="logo-text" style="position: relative; top: 38px; margin-left: -15px; text-transform: lowercase;">arcouri</h1>
            </div>
        </div>
        <div class="col-lg-9">
            <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav py-0">
                        <a href="http://localhost/Quiz/View/Back/dashboard.html" class="nav-item nav-link" style="margin-left: 5px;">dashsboard</a>
                        <a href="indelx.html" class="nav-item nav-link" style="margin-left: 5px;">Accueil</a>
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
                                <a href="blog.html" class="dropdown-item">Clubs/Associations</a>
                                <a href="single.html" class="dropdown-item">Formations</a>
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
    <div class="container-fluid page-header" style="margin-bottom: 90px;">
        <div class="container">
            <div class="d-flex flex-column justify-content-center" style="min-height: 160px">
                <h3 class="display-4 text-white text-uppercase">quiz</h3>
                <div class="d-inline-flex text-white">
                    <p class="m-0 text-uppercase"><a class="text-white" href="">Home</a></p>
                    <i class="fa fa-angle-double-right pt-1 px-3"></i>
                    <p class="m-0 text-uppercase">quiz</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->
<!-- quiz Start -->














<style>
    /* Logo et texte */
.logo-img {
    width: 150px;
    margin-left: -15px;
    object-fit: contain;
    transition: transform 0.3s ease;
}

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

/* Animation du dégradé au survol */
.logo-text:hover {
    background: linear-gradient(45deg, var(--primary), #ff0000);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    transform: translateY(-2px);
    text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
}

/* Navigation */
.navbar {
    height: 100px;
    background: #ffffff !important;
    padding: 0 2rem;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    width: calc(100% + 42px);
    margin-right: -20px;
    display: flex;
    align-items: center;
}

.navbar-nav {
    display: flex;
    align-items: center;
    height: 100%;
}

.navbar-nav .nav-link {
    color: #333333 !important;
    font-size: 1.1rem;
    font-weight: 500;
    padding: 1rem 1.5rem !important;
    transition: all 0.3s ease;
    text-transform: capitalize;
    display: flex;
    align-items: center;
    height: 100%;
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

.navbar-nav .nav-link:hover {
    color: var(--primary) !important;
}

/* Ajustement du logo et du texte */
.logo-container {
    display: flex;
    align-items: center;
    height: 100%;
}

/* Animation au chargement de la page */
@keyframes fadeInLogo {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.d-flex.align-items-start {
    animation: fadeInLogo 0.8s ease-out forwards;
}
    
    .btn-check:checked + .btn-outline-primary {
        background-color: #007bff;
        color: white;
    }
    .btn-check:checked + .btn-outline-danger {
        background-color: #dc3545;
        color: white;
    }
    .btn-check:checked + .btn-outline-success {
        background-color: #28a745;
        color: white;
    }


    .custom-container {
        padding-top: 0px; /* Adjust this value as needed */
    }
    .custom-text {
        margin-top: -20px; /* Adjust this value as needed */
    }
    .quiz-form {
        background-color: #f9f9f92a;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .quiz-form h1 {
        font-size: 2.5rem;
        margin-bottom: 20px;
    }
    .quiz-form label {
        font-weight: bold;
    }
    .quiz-form .form-label {
        margin-bottom: 10px;
    }
    .quiz-form .form-check {
        margin-bottom: 10px;
    }
    .quiz-form .btn {
        margin-top: 20px;
    }
</style>





















<div class="container-fluid custom-container py-5">
    <div class="container pt-5 pb-5">
        <!-- Heading Section -->
        <div class="text-center mb-5 custom-text">
            <h1 class="text-primary text-uppercase mb-3" style="letter-spacing: 5px;">Student Motivation Quiz</h1>
            <p class="text-muted" style="font-size: 18px;">Let's find out what drives you! 🌟</p>
        </div>



        <?php
// Inclure les fichiers nécessaires
require_once 'C:/xampp/htdocs/Quiz/Controller/questionC.php';
require_once 'C:/xampp/htdocs/Quiz/Model/question.php';
require_once 'C:/xampp/htdocs/Quiz/Controller/reponseC.php';
require_once 'C:/xampp/htdocs/Quiz/Model/reponse.php';

// Instancier les classes
$questionC = new questionC();
$reponseC = new reponseC();

// Récupérer toutes les questions
$questions = $questionC->affichequestion();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questions et Réponses Dynamiques</title>
    <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
    <style>
        /* Styles supplémentaires */
        body {
            background-color: #f5f7fa;
            font-family: 'Open Sans', sans-serif;
        }

        .quiz-form {
            max-width: 800px;
            margin: 50px auto;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
        }

        .question-container {
            margin-bottom: 30px;
        }

        .response-buttons {
            display: flex;
            justify-content: center;
            gap: 15px; /* Espacement entre les boutons */
            flex-wrap: wrap; /* Si la taille de l'écran est petite, les boutons passeront à la ligne suivante */
        }

        .btn {
            font-size: 18px;
            padding: 10px 20px;
            margin: 5px;
        }
    </style>
</head>

<body>
    <main class="main-content position-relative border-radius-lg">
        <form id="account-check-form" class="quiz-form" method="POST">
            <?php foreach ($questions as $question) : ?>
                <div class="question-container">
                    <p class="text-center" style="font-size: 22px; font-weight: bold;">
                        <?php echo $question['titre']; ?>
                    </p>

                    <?php
                    // Récupérer les réponses pour chaque question
                    $reponses = $reponseC->getReponsesByQuestionId($question['id']);
                    ?>
                    <div class="response-buttons">
                        <?php foreach ($reponses as $reponse) : ?>
                            <button type="submit" name="reponse" value="<?php echo $reponse['id_reponse']; ?>" class="btn btn-outline-primary">
                                <?php echo $reponse['choix_rp']; ?>
                            </button>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
            <div class="text-center">
                <button type="submit" class="btn btn-success">Soumettre Réponses</button>
            </div>
        </form>
    </main>
</body>

</html>
