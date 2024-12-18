<?php
require_once '../../Controller/bourseC.php';
require_once '../../Model/bourses.php';
require_once '../../Controller/programmeC.php';
require_once '../../Model/programme.php';

// Initialiser les contrôleurs
$bourseC = new BourseC();
$programmeC = new ProgrammeC();

// Récupérer toutes les bourses et programmes
try {
    $bourses = $bourseC->afficherBourses();
    $programmes = $programmeC->afficherProgrammes();
} catch (Exception $e) {
    $error = $e->getMessage();
    $bourses = [];
    $programmes = [];
}
?>

<!DOCTYPE html>
<html>
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
    <script src="main.js"></script>
    <meta name="google" content="notranslate">
    
    
  </head>
  <body>
  <!-- Navbar Start -->
  <div class="container-fluid">
    <div class="row border-top px-xl-5">
        <div class="col-lg- ml-auto mr-auto  d-none d-lg-block">
                        <img href="index.html" class="img-fluid" src="img/logo.jfif" width="50" 
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
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav py-0">
                        <a href="index.html" class="nav-item nav-link">accueil </a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">internationale</a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="blog.php" class="dropdown-item">bourse d'étude</a>
                                <a href="prog.php" class="dropdown-item">programme d'échange</a>
                            </div>
                        </div>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">activite</a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="online-courses-html-template/formations,clubs.php" class="dropdown-item">club</a>
                                <a href="online-courses-html-template/formations,clubs.php" class="dropdown-item">formation</a>
                            </div>
                        </div>
                        <a href="afficherQuestRep.php" class="nav-item nav-link">quiz</a>

                        <a href="teacher.html" class="nav-item nav-link">témoiniage</a>
                        <a href="online-courses-html-template/contact.php" class="nav-item nav-link">contact</a>
                    </div>
                    <a class="btn btn-primary py-2 px-4 ml-auto d-none d-lg-block" href="signup.html">Sign in</a>
                    <a class="btn btn-primary py-2 px-4 ml-3     d-none d-lg-block" href="login.html">login</a>    
                    </div>
            </nav>
        </div>
    </div>
</div>
<!-- Navbar End -->




    <div class="he">
        <div class="over"></div>
        <div class="content" >
        <h1 id="page-title">Bourses et programmes d'échanges</h1>
        <p id="page-description">Accédez à des programmes d'échanges et des bourses d'études pour les lycéens et étudiants tunisiens, offrant un soutien financier pour vos études en Tunisie ou à l'international.</p>
          <div class="buttons">
            <a href="#" class="btn btn-primary">commencer</a>
            <a href="#aa" class="btn btn-secondary">savoir plus</a>
          </div>
        </div>
      </div>
            
      
      



      



<div class="health-section">
    <div class="health-content">
      <h1 id="health-title">Investir dans l'avenir, soutenir l'excellence  et<br>donnez du temps pour vous maintenant</h1>
      <div class="statistics">
        <div class="stat-item">
          <p class="stat-number">10 000</p>
          <p class="stat-label" id="students-label">Nombre d'étudiants</p>
        </div>
        <div class="stat-item">
          <p class="stat-number">80%</p>
          <p class="stat-label" id="success-rate-label">Taux de réussite</p>
        </div>
        <div class="stat-item">
          <p class="stat-number">70%</p>
          <p class="stat-label" id="employment-rate-label">Emploi aprés la bourse</p>
        </div>
      </div>
    </div>
    <div class="health-image">
      <img src="img/pro2.avif" alt="Image de bourse" class="animated-image" onerror="this.src='img/fallback.jpg'">
    </div>
  </div>
  <!--recherche-->

<!-- Section de filtrage -->

<!--slider-->
<!-- Section Programmes d'échange -->
<section id="programmes-echange">
    <div class="title-section">
        <p class="subtitle">Programmes d'échange</p>
        <h2 class="main-title">Opportunités d'échange international</h2>
    </div>

    <!-- Page 1 -->
    <div class="exchange-grid" id="page1">
        <?php 
        $count = 0;
        if (!empty($programmes)):
            foreach ($programmes as $programme):
                if ($count < 3): // Premiers 3 programmes
        ?>
            <div class="exchange-item">
                <div class="exchange-content">
                    <div class="exchange-icon">
                        <i class="fas fa-globe-americas"></i>
                    </div>
                    <h3><?php echo htmlspecialchars($programme['nom_prog']); ?></h3>
                    <span class="duration">Date limite: <?php echo htmlspecialchars($programme['date_limite']); ?></span>
                    <div class="exchange-details">
                        <p><?php echo htmlspecialchars($programme['description']); ?></p>
                        <ul>
                            <li><i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($programme['pays']); ?></li>
                            <li><i class="fas fa-users"></i> Age limite: <?php echo htmlspecialchars($programme['age_limite']); ?> ans</li>
                            <li><i class="fas fa-graduation-cap"></i> <?php echo htmlspecialchars($programme['niveau_etude']); ?></li>
                        </ul>
                       
                        
                        <div class="course-footer">
                            <a href="../backoffice/octopus/addProgramme.php?titre=<?php echo urlencode($programme['nom_prog']); ?>&pays=<?php echo urlencode($programme['pays']); ?>&description=<?php echo urlencode($programme['description']); ?>" class="btn btn-login">
                                Découvrir
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php 
                $count++;
                endif;
            endforeach;
        endif; 
        ?>
    </div>

    <!-- Page 2 -->
    <div class="exchange-grid" id="page2" style="display: none;">
        <?php 
        $count = 0;
        if (!empty($programmes)):
            foreach ($programmes as $programme):
                if ($count >= 3 && $count < 6): // Programmes 4 à 6
        ?>
            <div class="exchange-item">
                <div class="exchange-content">
                    <div class="exchange-icon">
                        <i class="fas fa-globe-americas"></i>
                    </div>
                    <h3><?php echo htmlspecialchars($programme['nom_prog']); ?></h3>
                    <span class="duration">Date limite: <?php echo htmlspecialchars($programme['date_limite']); ?></span>
                    <div class="exchange-details">
                        <p><?php echo htmlspecialchars($programme['description']); ?></p>
                        <ul>
                            <li><i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($programme['pays']); ?></li>
                            <li><i class="fas fa-users"></i> Age limite: <?php echo htmlspecialchars($programme['age_limite']); ?> ans</li>
                            <li><i class="fas fa-graduation-cap"></i> <?php echo htmlspecialchars($programme['niveau_etude']); ?></li>
                        </ul>
                        <div class="course-footer">
                            <a href="../backoffice/octopus/addProgramme.php?titre=<?php echo urlencode($programme['nom_prog']); ?>&pays=<?php echo urlencode($programme['pays']); ?>&description=<?php echo urlencode($programme['description']); ?>" class="btn btn-login">
                                Découvrir
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php 
                endif;
                $count++;
            endforeach;
        endif; 
        ?>
    </div>

    <!-- Page 3 -->
    <div class="exchange-grid" id="page3" style="display: none;">
        <?php 
        $count = 0;
        if (!empty($programmes)):
            foreach ($programmes as $programme):
                if ($count >= 6 && $count < 9): // Programmes 7 à 9
        ?>
            <div class="exchange-item">
                <div class="exchange-content">
                    <div class="exchange-icon">
                        <i class="fas fa-globe-americas"></i>
                    </div>
                    <h3><?php echo htmlspecialchars($programme['nom_prog']); ?></h3>
                    <span class="duration">Date limite: <?php echo htmlspecialchars($programme['date_limite']); ?></span>
                    <div class="exchange-details">
                        <p><?php echo htmlspecialchars($programme['description']); ?></p>
                        <ul>
                            <li><i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($programme['pays']); ?></li>
                            <li><i class="fas fa-users"></i> Age limite: <?php echo htmlspecialchars($programme['age_limite']); ?> ans</li>
                            <li><i class="fas fa-graduation-cap"></i> <?php echo htmlspecialchars($programme['niveau_etude']); ?></li>
                        </ul>
                        <div class="course-footer">
                            <a href="../backoffice/octopus/addProgramme.php?titre=<?php echo urlencode($programme['nom_prog']); ?>&pays=<?php echo urlencode($programme['pays']); ?>&description=<?php echo urlencode($programme['description']); ?>" class="btn btn-login">
                                Découvrir
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php 
                endif;
                $count++;
            endforeach;
        endif; 
        ?>
    </div>

    <!-- Pagination -->
    <div class="pagination">
        <button onclick="showPage(1)" class="page-btn active">1</button>
        <button onclick="showPage(2)" class="page-btn">2</button>
        <button onclick="showPage(3)" class="page-btn">3</button>
    </div>
</section>
<script>function showPage(pageNum) {
  // Cacher toutes les pages
  document.getElementById('page1').style.display = 'none';
  document.getElementById('page2').style.display = 'none';
  document.getElementById('page3').style.display = 'none';
  
  // Afficher la page sélectionnée
  document.getElementById('page' + pageNum).style.display = 'grid';
  
  // Mettre à jour les boutons actifs
  const buttons = document.querySelectorAll('.page-btn');
  buttons.forEach(btn => btn.classList.remove('active'));
  buttons[pageNum-1].classList.add('active');
}

// Afficher la première page au chargement
showPage(1);</script>
    


  
<!-- Slider des logos -->
<section id="aa">
  <div class="title-section">
      
      <h2 class="main-title">nos partenaires</h2>
    </div>
  </section>
<div class="logo-slider-container">
  <div class="logo-slider">
      <div class="slide-track">
          <!-- Les logos seront dupliqués pour créer l'effet infini -->
          <div class="slide">
              <img src="projet web/img/e1.webp" alt="DAAD" />
          </div>
          <div class="slide">
              <img src="projet web/img/e2.jpg" alt="Fulbright" />
          </div>
          <div class="slide">
              <img src="projet web/img/e3.jpeg" alt="Erasmus" />
          </div>
          <div class="slide">
              <img src="projet web/img/e4.jfif" alt="Chevening" />
          </div>
          <div class="slide">
              <img src="projet web/img/e5.png" alt="Eiffel" />
          </div>
          <!-- Duplication des logos pour l'effet infini -->
          <div class="slide">
              <img src="projet web/img/e1.webp" alt="DAAD" />
          </div>
          <div class="slide">
              <img src="projet web/img/e2.jpg" alt="Fulbright" />
          </div>
          <div class="slide">
              <img src="projet web/img/e3.jpeg" alt="Erasmus" />
          </div>
          <div class="slide">
              <img src="projet web/img/e4.jfif" alt="Chevening" />
          </div>
          <div class="slide">
              <img src="projet web/img/e5.png" alt="Eiffel" />
          </div>
      </div>
  </div>
</div>


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
  


  <!-- Ajoutez ce script à la fin du body -->
  


  

  <script>
let currentSlide = 0;
const slides = document.querySelectorAll('.courses-slide');
const dots = document.querySelectorAll('.dot');

function showSlide(index) {
    slides.forEach((slide, i) => {
        slide.style.display = (i === index) ? 'block' : 'none';
    });
    dots.forEach((dot, i) => {
        dot.classList.toggle('active', i === index);
    });
}
 
function moveSlide(step) {
    currentSlide = (currentSlide + step + slides.length) % slides.length;
    showSlide(currentSlide);
}

function goToSlide(index) {
    currentSlide = index;
    showSlide(currentSlide);
}

// Initialiser le premier slide
showSlide(currentSlide);
</script>
  

  

  </body>
</html>

