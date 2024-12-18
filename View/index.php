<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/PROJETWEB/config.php');
?>

<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link
    href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    rel="stylesheet" />
  <link rel="stylesheet" href="./styles/style.css" />
  <link rel="stylesheet" href="./styles/footer.css" />
  <link rel="stylesheet" href="./styles/components.css" />
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
                        <a href="http://localhost/Quiz/View/Front/course.html" class="nav-item nav-link" style="margin-left: 5px;">Accueil</a>
                        <div class="nav-item dropdown" style="margin-left: 5px;">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Internationale</a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="blog.html" class="dropdown-item">Bourses d'Études</a>
                                <a href="single.html" class="dropdown-item">Programmes d'Échange</a>
                            </div>
                        </div>
                        <div class="nav-item dropdown" style="margin-left: 5px;">
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
                    <?php
                    if (isset($_SESSION['user'])) {
                        // If user is logged in, show logout button
                        echo '<a class="btn btn-primary custom-btn" href="logout.php">Logout</a>';
                    } else {
                        // If user is not logged in, show login and sign in buttons
                        ?>
                        <a class="btn btn-primary custom-btn" href="http://localhost/PROJETWEB/View/FrontOffice/signup.php">Sign In</a>
                        <a class="btn btn-primary custom-btn" href="http://localhost/PROJETWEB/View/FrontOffice/login.php" style="margin-left: 5px;">Login</a>
                        <?php
                    }
                    ?>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
<!-- Navbar End -->
 
<!-- Header Start -->
<div class="container-fluid page-header" style="margin-bottom: 120px; background-image: url('kteb.jpg'); background-size: cover; background-position: center;">
            <div class="d-flex flex-column justify-content-center" style="min-height:500px">
                <h3 class="display-4 text-white text-uppercase">Feed Back</h3>
                <div class="d-inline-flex text-white">
                    <p class="m-0 text-uppercase"><a class="text-white" href="">Home</a></p>
                    <i class="fa fa-angle-double-right pt-1 px-3"></i>
                    <p class="m-0 text-uppercase">commentaires</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->

v>
    </div>
    <!-- Header End -->
  <div class="container20">
    <div class="usersection">
      <h1 class="comment box">Partager une idée</h1>
      <form class="form-idea" method="POST" action="">
        <input
          type="text"
          id="username"
          name="username"
          placeholder="Entrez le nom d'utilisateur"
          required /><br />
        <input
          type="text"
          id="metier"
          name="job"
          placeholder="Entrez votre Metier"
          required /><br />
        <input
          type="email"
          id="email"
          name="email"
          placeholder="Entrez Email"
          required />
        <br />

        <div class="opinion-conseils">
          <div class="option">
            <input
              type="radio"
              name="type"
              id="type-idee"
              value="opinion"
              checked />
            <label for="type-idee">Opinion</label>
          </div>
          <div class="option">
            <input
              type="radio"
              name="type"
              id="type-conseil"
              value="conseil" />
            <label for="type-conseil">Conseil</label>
          </div>
        </div>

        <textarea
          id="commentText"
          name="comment"
          rows="4"
          placeholder="Entrez vos commentaires ici"></textarea>
        <br />

        <button id="submitComment" class="button" name="submitComment" type="submit">
          Publier
        </button>
      </form>
    </div>
    <div class="Commentsection">
      <h2>Commentaires</h2>
      <div id="commentsContainer" class="comments-container"></div>
    </div>
  </div>
  <div class="mt-5 pt-5 pb-5 footer">
    <div class="container">
      <div class="row">
        <div class="col-lg-5 col-xs-12 about-company">
          <h2>Parcouris</h2>
          <p class="pr-5 text-white-50">Where we strive to become better</p>
          <p>
            <a href="#"><i class="fa fa-facebook-square mr-1"></i></a><a href="#"><i class="fa fa-linkedin-square"></i></a>
          </p>
        </div>
        <div class="col-lg-3 col-xs-12 links">
          <h4 class="mt-lg-0 mt-sm-3">Links</h4>
          <ul class="m-0 p-0">
            <li>- <a href="#">Support</a></li>
            <li>- <a href="#">Linkedin</a></li>
            <li>- <a href="#">Facebook</a></li>
            <li>- <a href="#">Instagram</a></li>
            <li>- <a href="#">Github</a></li>
            <li>- <a href="#">Tiktok</a></li>
          </ul>
        </div>
        <div class="col-lg-4 col-xs-12 location">
          <h4 class="mt-lg-0 mt-sm-4">Location</h4>
          <p>Sousse,Khzeama,4071</p>
          <p class="mb-0"><i class="fa fa-phone mr-3"></i>+216 12345678</p>
          <p><i class="fa fa-envelope-o mr-3"></i>info@parcouris.com</p>
        </div>
        <div class="comment">
      </div>
      <div class="row mt-5">
        <div class="col copyright">
          <p class="">
            <small class="text-white-50">© 2024. All Rights Reserved.</small>
          </p>
        </div>
      </div>
    </div>
  </div>
  <style>
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
a {
    color: #145DA0;
    text-decoration: none;
    background-color: transparent;
}
*, *::before, *::after {
    box-sizing: border-box;
}
feuille de style de l’agent utilisateur
a:-webkit-any-link {
    color: -webkit-link;
    cursor: pointer;
    text-decoration: underline;
}
body {
    font-family: 'Poppins', sans-serif;
    background-color: #f4f7fc;
    margin: 0;
    padding: 0;
}
body {
    margin: 0;
    font-family: "Poppins", sans-serif;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #6C6A74;
    text-align: left;
    background-color: #fff;
}
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
    }
}
     </style>
</body>
<script src="./js/script.js"></script>
<script src="./js/comments.js"></script>
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

</html>