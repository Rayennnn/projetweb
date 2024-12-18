<?php
session_start();

require_once '../../Controller/usercontroller.php';
$controller = new UserController($pdo);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Profil</title>
</head>
<body>
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
</head>

<body>
   
 <!-- Navbar Start -->
 <div class="container-fluid">
    <div class="row border-top px-xl-5">
        <div class="col-lg- ml-auto mr-auto  d-none d-lg-block">
                        <img href="index.php" class="img-fluid" src="img/logo.jfif" width="50" 
                        height="50"alt="">
        
         
        </div>
        <div class="col-lg-9">
            <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                <a href="" class="text-decoration-none d-block d-lg-none">
                    <h1 class="m-0"><span class="text-primary">E</span>COURSES</h1>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <?php if (isset($_SESSION['user_id'])) {?>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav py-0">
                        <a href="index.php" class="nav-item nav-link">accueil </a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">internationale</a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="blog.php" class="dropdown-item">bourse d'étude</a>
                                <a href="single.php" class="dropdown-item">programme d'échange</a>
                            </div>
                        </div>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">activite</a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="blog.php" class="dropdown-item">club</a>
                                <a href="single.php" class="dropdown-item">formation</a>
                            </div>
                        </div>
                        <a href="course.php" class="nav-item nav-link">quiz</a>

                        <a href="teacher.php" class="nav-item nav-link">témoiniage</a>
                        <a href="contact.php" class="nav-item nav-link active">Contact</a>
                    </div>
                    <?php }?>
                    <?php if (!isset($_SESSION['user_id'])) {?>
                    <a class="btn btn-primary py-2 px-4 ml-auto d-none d-lg-block" href="signup.php">Sign in</a>
                    <a class="btn btn-primary py-2 px-4 ml-3     d-none d-lg-block" href="login.php">login</a>  
                    <?php }?>  
                    <?php if (isset($_SESSION['user_id'])) {?>
                        <a class="nav-item nav-link"><?php echo $_SESSION['user_name']; ?>  <?php echo $_SESSION['user_last_name']; ?></a>
                    <a class="btn btn-primary py-2 px-4 ml-3     d-none d-lg-block" href="logout.php">logout</a>  
                    <?php }?>   
                    </div>
            </nav>
        </div>
    </div>
</div>
<!-- Navbar End -->

    <!-- Header Start -->
    <div class="container-fluid page-header" style="margin-bottom: 90px;">
        <div class="container">
            <div class="d-flex flex-column justify-content-center" style="min-height: 300px">
                <h3 class="display-4 text-white text-uppercase">Bienvenue, <?php echo $_SESSION['user_name']; ?>  <?php echo $_SESSION['user_last_name']; ?>!</h3>
                <div class="d-inline-flex text-white">
                    <p class="m-0 text-uppercase"><a class="text-white" href="">Home</a></p>
                    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row pb-3">
                        <div class="col-lg-6 mb-4">
                            <div class="blog-item position-relative overflow-hidden rounded mb-2">
                            <?php if ($_SESSION['photo']): ?>
        <img src="../uploads/<?php echo $_SESSION['photo']; ?>" alt="Photo de profil" width="450 ">
    <?php else: ?>
        <h5 class="text-white mb-3">   Pas de photo </h5>
    <?php endif; ?>
                     
                                <a class="blog-overlay text-decoration-none" href="logout.php" onclick="return confirm('do you want to logout?')">
                                    <h5 class="text-white mb-3"><strong>Email: </strong><?php echo $_SESSION['user_email']; ?></h5>
                                    <h5 class="text-white mb-3"><strong>nom: </strong><?php echo $_SESSION['user_name']; ?></h5>
                                    <h5 class="text-white mb-3"><strong>prenom: </strong><?php echo $_SESSION['user_last_name']; ?></h5>
                                    <h5 class="text-white mb-3"><strong>FAC: </strong><?php echo $_SESSION['fac']; ?></h5>
                                    <h5 class="text-white mb-3"><strong>DOMAINE: </strong><?php echo $_SESSION['domaine']; ?></h5>
                                  
                                </a>
                              
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->

</body>
</html>
