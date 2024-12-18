<?php

session_start();

include 'C:\xampp\htdocs\PROJETWEB\db.php';
include 'C:\xampp\htdocs\PROJETWEB\Controller\usercontroller.php';

$controller = new UserController($pdo);
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];
    $statusCompte = $_POST['status_compte'];
	$fac  = $_POST['fac'];
	$domaine = $_POST['domaine'];
// Gestion de l'upload de la photo
$photoName = null;
if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
	$uploadDir = "../uploads/";
	$photoName = uniqid() . "-" . basename($_FILES['photo']['name']);
	$targetPath = $uploadDir . $photoName;

	// Vérifiez si le dossier d'upload existe
	if (!is_dir($uploadDir)) {
		mkdir($uploadDir, 0777, true);
	}
    
	move_uploaded_file($_FILES['photo']['tmp_name'], $targetPath);
}
    if ($password === $confirmPassword) {
        if ($controller->createclient($name, $lastName, $email, $password, $statusCompte, $fac, $domaine, $photoName)) {
            header("Location: login.php");
            exit;
        } else {
            $error = "Failed to create user.";
        }
    } else {
        $error = "Passwords do not match!";
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
    <script src="../formValidation.js"></script>
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
                </div>
            </nav>
        </div>
    </div>
</div>
<!-- Navbar End -->

<!-- After Navbar End -->

<!-- Sign up Start -->
<div class="container-fluid py-2">
    <div class="container py-2">
        <div class="text-center mb-4">
            <h5 class="text-primary text-uppercase mb-3" style="letter-spacing: 5px;">sign up</h5>
            <h1>créer votre compte</h1>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="contact-form bg-secondary rounded p-5">
                    <div id="success"></div>
                    <form name="userForm" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
                    <div class="form-group mb-lg">
        <label for="name">Name:</label>
        <input type="text" name="name"  class="form-control input-lg" required><br>
        </div>

        <div class="form-group mb-lg">
        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name"  class="form-control input-lg" required><br>
        </div>

        <div class="form-group mb-lg">
        <label for="email">Email:</label>
        <input type="email" name="email"  class="form-control input-lg" required><br>
        </div>

        <div class="form-group mb-lg">
        <label for="password">Password:</label>
        <input type="password" name="password"  class="form-control input-lg" required><br>
        </div>

        <div class="form-group mb-lg">
        <label for="confirm_password">Confirm Password:</label>
        <input type="password" name="confirm_password"  class="form-control input-lg" required><br>
        </div>


        <div class="form-group mb-lg">
        <label for="photo">Photo:</label>
        <input type="file" name="photo"  class="form-control input-lg"><br>
        </div>

        <div class="form-group mb-lg">
        <label for="fac">Faculty:</label>
        <input type="text" name="fac"  class="form-control input-lg"><br>
        </div>

        <div class="form-group mb-lg">
        <label for="domaine">Domain:</label>
        <input type="text" name="domaine"  class="form-control input-lg"><br>
        </div>
        <div class="row">
								<div class="col-sm-8">
									<div class="checkbox-custom checkbox-default">
										<input id="AgreeTerms" name="agreeterms" type="checkbox"/>
										<label for="AgreeTerms">I agree with <a href="#">terms of use</a></label>
									</div>
								</div>
								<div class="col-sm-4 text-right">
									<button type="submit" class="btn btn-primary btn-block btn-lg visible-xs mt-lg" value="Create User">Sign Up</button>
								</div>
							</div>


						

							<p class="text-center">Already have an account? <a href="login.php">Sign In!</a>

    </form>   
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Sign up End -->


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

    <!-- sign up Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>