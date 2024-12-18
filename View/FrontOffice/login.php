<?php

session_start();

include 'C:\xampp\htdocs\PROJETWEB\db.php';
include 'C:\xampp\htdocs\PROJETWEB\Controller\usercontroller.php';

$controller = new UserController($pdo);
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
// Your reCAPTCHA secret key
$secretKey = "6LdyiZIqAAAAAOP54s2U3-rAdVNoAicFRAy0SWZj";
    
// The reCAPTCHA response from the form
$recaptchaResponse = $_POST['g-recaptcha-response'];

// Verify reCAPTCHA response with Google
$verifyUrl = "https://www.google.com/recaptcha/api/siteverify";
$response = file_get_contents($verifyUrl . "?secret=" . $secretKey . "&response=" . $recaptchaResponse);
$responseKeys = json_decode($response, true);

// Check if reCAPTCHA verification was successful
if (intval($responseKeys["success"]) !== 1) {
    echo "reCAPTCHA verification failed. Please try again.";
} else {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $controller->login($email,$password);

       
}
    }
?>
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
    <link href="css/style.css" rel="stylesheet">
 <!-- Add this script tag in the <head> section -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>



</head>

<body>
    <!-- Navbar Start -->
    <div class="container-fluid">
    <div class="row border-top px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <div class="d-flex align-items-start">
                <img href="index.html" class="logo-img" src="img/logo.png" alt="" style="width: 50px; margin-left: -px;">
                <h1 class="logo-text" style="position: relative; top: 38px; margin-left: -15px; text-transform: lowercase;">arcouri</h1>
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
                                <a href="http://localhost/PROJETWEB/View/FrontOffice/online-courses-html-template/formations,clubs.php" class="dropdown-item">Clubs/Associations</a>
                                <a href="single.html" class="dropdown-item">Formations</a>
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
            </nav>
        </div>
    </div>
</div>
<!-- Navbar End -->



   
    <!-- Header End -->


    <!-- login Start -->
    <div class="container-fluid py-2">
        <div class="container py-2">
            <div class="text-center mb-5">
                <h5 class="text-primary text-uppercase mb-3" style="letter-spacing: 5px;">login</h5>
                <h1>login to your account</h1>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="login-form bg-secondary rounded p-5">
                        <div id="success"></div>
                        <form name="userForm" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
    <div class="control-group">
        <input type="email" class="form-control border-0 p-4" name="email" placeholder="Your Email" required="required" data-validation-required-message="Please enter your email" />
        <p class="help-block text-danger"></p>
    </div>
    <div class="control-group">
        <input type="password" class="form-control border-0 p-4" name="password" placeholder="password" required="required" data-validation-required-message="Please enter a password" />
        <p class="help-block text-danger"></p>
    </div>

    <!-- reCAPTCHA Widget -->
    <div class="g-recaptcha" data-sitekey="6LdyiZIqAAAAAJKT73l5X0ho0q1Jr1yMaDbyKYIF"></div>
    <p class="text-center">mot de passe oublié? <a href="send_reset_token.php">cliquez ici </a> 
    </p>

    <div class="text-center">
        <button class="btn btn-primary py-3 px-5" type="submit" id="sendMessageButton" style="margin-left: 5px;"> login</button>
    </div>
</form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- login End -->
<style>
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
    }<style>
/* Update existing button styles */
.btn:not(:disabled):not(.disabled) {
    cursor: pointer;
}

.custom-btn {
    padding: 8px 25px;
    font-size: 14px;
    font-weight: 500;
    border-radius: 5px;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: all 0.3s ease;
    white-space: nowrap;
    min-width: 100px;
    text-align: center;
}

.btn-primary {
    color: #fff;
    background-color: #145DA0;
    border-color: #145DA0;
}

.btn-primary:hover {
    background-color: #0f4c8a;
    border-color: #0f4c8a;
    transform: translateY(-2px);
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.nav-buttons {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-left: 20px;
    height: 100%;
}

/* Add animation for buttons */
.custom-btn {
    animation: fadeInButtons 0.5s ease-out;
}

@keyframes fadeInButtons {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
    <style>
/* Update existing button styles */
.btn:not(:disabled):not(.disabled) {
    cursor: pointer;
}

.custom-btn {
    padding: 8px 25px;
    font-size: 14px;
    font-weight: 500;
    border-radius: 5px;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: all 0.3s ease;
    white-space: nowrap;
    min-width: 100px;
    text-align: center;
}

.btn-primary {
    color: #fff;
    background-color: #145DA0;
    border-color: #145DA0;
}

.btn-primary:hover {
    background-color: #0f4c8a;
    border-color: #0f4c8a;
    transform: translateY(-2px);
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.nav-buttons {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-left: 20px;
    height: 100%;
}

/* Add animation for buttons */
.custom-btn {
    animation: fadeInButtons 0.5s ease-out;
}

@keyframes fadeInButtons {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
}
     </style>


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

    <!-- login Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>