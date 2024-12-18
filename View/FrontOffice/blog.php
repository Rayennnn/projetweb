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


<script>
    const translations = {
        fr: {
            title: "Bourses et programmes d'échanges",
            description: "Accédez à des programmes d'échanges et des bourses d'études pour les lycéens et étudiants tunisiens, offrant un soutien financier pour vos études en Tunisie ou à l'international.",
            navbar: {
                home: "accueil",
                international: "internationale",
                scholarship: "bourse d'étude",
                exchangeProgram: "programme d'échange",
                activity: "activite",
                club: "club",
                training: "formation",
                quiz: "quiz",
                testimony: "témoiniage",
                contact: "contact",
                signIn: "s'inscririr",
                login: "se connecter"
            },
            healthSection: {
                title: "Investir dans l'avenir, soutenir l'excellence et donner du temps pour vous maintenant",
                stats: {
                    students: "Nombre d'étudiants",
                    successRate: "Taux de réussite",
                    employmentRate: "Emploi après la bourse"
                }
            },
            filterSection: {
                type: "Type",
                country: "Pays/Région",
                level: "Niveau d'études",
                duration: "Durée",
                all: "Tous",
                exchange: "Programme d'échange",
                scholarship: "Bourse",
                // Ajoutez d'autres traductions ici
            },
            // Ajoutez d'autres traductions ici
        },
        en: {
            title: "Scholarships and Exchange Programs",
            description: "Access exchange programs and scholarships for Tunisian high school and university students, providing financial support for your studies in Tunisia or abroad.",
            navbar: {
                home: "home",
                international: "international",
                scholarship: "scholarship",
                exchangeProgram: "exchange program",
                activity: "activity",
                club: "club",
                training: "training",
                quiz: "quiz",
                testimony: "testimony",
                contact: "contact",
                signIn: "Sign in",
                login: "login"
            },
            healthSection: {
                title: "Investing in the future, supporting excellence and giving time for yourself now",
                stats: {
                    students: "Number of students",
                    successRate: "Success rate",
                    employmentRate: "Employment after scholarship"
                }
            },
            filterSection: {
                type: "Type",
                country: "Country/Region",
                level: "Level of study",
                duration: "Duration",
                all: "All",
                exchange: "Exchange program",
                scholarship: "Scholarship",
                // Ajoutez d'autres traductions ici
            },
            // Ajoutez d'autres traductions ici
        }
    };

    function setLanguage(lang) {
        document.querySelector('#page-title').innerText = translations[lang].title;
        document.querySelector('p').innerText = translations[lang].description;

        // Mettre à jour la barre de navigation
        document.querySelector('.nav-item.nav-link[href="index.html"]').innerText = translations[lang].navbar.home;
        document.querySelector('.nav-item.dropdown .nav-link.dropdown-toggle[data-toggle="dropdown"]').innerText = translations[lang].navbar.international;
        document.querySelector('.dropdown-item[href="blog.html"]').innerText = translations[lang].navbar.scholarship;
        document.querySelector('.dropdown-item[href="single.html"]').innerText = translations[lang].navbar.exchangeProgram;
        document.querySelector('.nav-item.dropdown:nth-child(3) .nav-link.dropdown-toggle[data-toggle="dropdown"]').innerText = translations[lang].navbar.activity;
        document.querySelector('.dropdown-item[href="blog.html"]:nth-child(1)').innerText = translations[lang].navbar.club;
        document.querySelector('.dropdown-item[href="single.html"]:nth-child(2)').innerText = translations[lang].navbar.training;
        document.querySelector('.nav-item.nav-link[href="course.html"]').innerText = translations[lang].navbar.quiz;
        document.querySelector('.nav-item.nav-link[href="teacher.html"]:nth-child(1)').innerText = translations[lang].navbar.testimony;
        document.querySelector('.nav-item.nav-link[href="teacher.html"]:nth-child(2)').innerText = translations[lang].navbar.contact;
        document.querySelector('.btn.btn-primary[href="signup.html"]').innerText = translations[lang].navbar.signIn;
        document.querySelector('.btn.btn-primary[href="login.html"]').innerText = translations[lang].navbar.login;

        // Mettre à jour la section santé
        document.querySelector('#health-title').innerText = translations[lang].healthSection.title;
        document.querySelector('#students-label').innerText = translations[lang].healthSection.stats.students;
        document.querySelector('#success-rate-label').innerText = translations[lang].healthSection.stats.successRate;
        document.querySelector('#employment-rate-label').innerText = translations[lang].healthSection.stats.employmentRate;

        // Mettre à jour la section de filtrage
        document.querySelector('.filter-group label[for="typeFilter"]').innerText = translations[lang].filterSection.type;
        document.querySelector('.filter-group label[for="countryFilter"]').innerText = translations[lang].filterSection.country;
        document.querySelector('.filter-group label[for="levelFilter"]').innerText = translations[lang].filterSection.level;
        document.querySelector('.filter-group label[for="durationFilter"]').innerText = translations[lang].filterSection.duration;

        // Mettez à jour d'autres éléments de la page ici 
    }
</script>



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
            
      
      



      <div class="language-switcher">
    <button id="btn-fr" class="btn btn-primary" onclick="setLanguage('fr')">Français</button>
    <button id="btn-en" class="btn btn-primary" onclick="setLanguage('en')">English</button>
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


    

<!--recherche-->
<section id="aa">
<div class="title-section">
    <p class="subtitle">Bourses</p>
    <h2 class="main-title">nos bourses populaire</h2>
  </div>
</section>
  
  <!--autre-->
  
  <div class="courses-slider-container">
    <div class="courses-slider">
      <!-- Page 1 -->
      <div class="courses-slide">
        <div class="courses-section">
          <?php 
          $count = 0;
          if (!empty($bourses)):
              foreach ($bourses as $bourse):
                  if ($count < 3): // Afficher seulement les 3 premières bourses
          ?>
              <div class="course-card">
                  <?php 
                  // Définir un tableau d'images par défaut
                  $defaultImages = [
                      'img/e1.webp',
                      'img/e2.jpg',
                      'img/e3.jpeg',
                      'img/e4.jfif',
                      'img/e5.png',
                      'img/e1.webp',
                      'img/e2.jpg',
                      'img/e3.jpeg',
                      'img/e4.jfif'
                  ];
                  ?>
                  <img src="<?php echo $defaultImages[$count] ?? 'img/default.jpg'; ?>" 
                       alt="<?php echo htmlspecialchars($bourse['nom_bourse']); ?>"
                       onerror="this.src='img/default.jpg'">
                  <div class="course-info">
                      <div class="course-badge"><?php echo htmlspecialchars($bourse['pays']); ?></div>
                      <h3><?php echo htmlspecialchars($bourse['nom_bourse']); ?></h3>
                      <p class="course-details">
                          <i class="fas fa-calendar"></i> Date limite: <?php echo htmlspecialchars($bourse['date_limite']); ?>
                          <i class="fas fa-graduation-cap"></i> <?php echo htmlspecialchars($bourse['niveau_etude']); ?>
                      </p>
                      <p class="description"><?php echo htmlspecialchars($bourse['description']); ?></p>
                      <div class="course-footer">
                          <a href="../../backoffice/octopus/addBourse.php?titre=<?php echo urlencode($bourse['nom_bourse']); ?>&pays=<?php echo urlencode($bourse['pays']); ?>&description=<?php echo urlencode($bourse['description']); ?>" class="btn btn-login">
                              Découvrir
                          </a>
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
      </div>

      <!-- Page 2 -->
      <div class="courses-slide">
        <div class="courses-section">
          <?php 
          $count = 0;
          if (!empty($bourses)):
              foreach ($bourses as $bourse):
                  if ($count >= 3 && $count < 6): // Afficher les bourses 4 à 6
          ?>
              <div class="course-card">
                  <?php 
                  // Définir un tableau d'images par défaut
                  $defaultImages = [
                      'img/e1.webp',
                      'img/e2.jpg',
                      'img/e3.jpeg',
                      'img/e4.jfif',
                      'img/e9.jpg',
                      'img/e5.png',
                      'img/e1.webp',
                      'img/e2.jpg',
                      'img/e3.jpeg',
                      'img/e4.jfif',
                      'img/e9.jpg'
                  ];
                  ?>
                  <img src="<?php echo $defaultImages[$count] ?? 'img/default.jpg'; ?>" 
                       alt="<?php echo htmlspecialchars($bourse['nom_bourse']); ?>"
                       onerror="this.src='img/default.jpg'">
                  <div class="course-info">
                      <div class="course-badge"><?php echo htmlspecialchars($bourse['pays']); ?></div>
                      <h3><?php echo htmlspecialchars($bourse['nom_bourse']); ?></h3>
                      <p class="course-details">
                          <i class="fas fa-calendar"></i> Date limite: <?php echo htmlspecialchars($bourse['date_limite']); ?>
                          <i class="fas fa-graduation-cap"></i> <?php echo htmlspecialchars($bourse['niveau_etude']); ?>
                      </p>
                      <p class="description"><?php echo htmlspecialchars($bourse['description']); ?></p>
                      <div class="course-footer">
                          <a href="../../backoffice/octopus/addBourse.php?titre=<?php echo urlencode($bourse['nom_bourse']); ?>&pays=<?php echo urlencode($bourse['pays']); ?>&description=<?php echo urlencode($bourse['description']); ?>" class="btn btn-login">
                              Découvrir
                          </a>
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
      </div>

      <!-- Page 3 -->
      <div class="courses-slide">
        <div class="courses-section">
          <?php 
          $count = 0;
          if (!empty($bourses)):
              foreach ($bourses as $bourse):
                  if ($count >= 6 && $count < 9): // Afficher les bourses 7 à 9
          ?>
              <div class="course-card">
                  <?php 
                  // Définir un tableau d'images par défaut
                  $defaultImages = [
                      'img/e1.webp',
                      'img/e2.jpg',
                      'img/e3.jpeg',
                      'img/e4.jfif',
                      'img/e5.png',
                      'img/e1.webp',
                      'img/e2.jpg',
                      'img/e3.jpeg',
                      'img/e4.jfif'
                  ];
                  ?>
                  <img src="<?php echo $defaultImages[$count] ?? 'img/default.jpg'; ?>" 
                       alt="<?php echo htmlspecialchars($bourse['nom_bourse']); ?>"
                       onerror="this.src='img/default.jpg'">
                  <div class="course-info">
                      <div class="course-badge"><?php echo htmlspecialchars($bourse['pays']); ?></div>
                      <h3><?php echo htmlspecialchars($bourse['nom_bourse']); ?></h3>
                      <p class="course-details">
                          <i class="fas fa-calendar"></i> Date limite: <?php echo htmlspecialchars($bourse['date_limite']); ?>
                          <i class="fas fa-graduation-cap"></i> <?php echo htmlspecialchars($bourse['niveau_etude']); ?>
                      </p>
                      <p class="description"><?php echo htmlspecialchars($bourse['description']); ?></p>
                      <div class="course-footer">
                          <a href="../../backoffice/octopus/addBourse.php?titre=<?php echo urlencode($bourse['nom_bourse']); ?>&pays=<?php echo urlencode($bourse['pays']); ?>&description=<?php echo urlencode($bourse['description']); ?>" class="btn btn-login">
                              Découvrir
                          </a>
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
      </div>
    </div>

    <!-- Navigation buttons -->
    <button class="slider-nav prev" onclick="moveSlide(-1)">
      <i class="fas fa-chevron-left"></i>
    </button>
    <button class="slider-nav next" onclick="moveSlide(1)">
      <i class="fas fa-chevron-right"></i>
    </button>

    <!-- Dots/bullets/indicators -->
    <div class="slider-dots">
      <span class="dot active" onclick="goToSlide(0)"></span>
      <span class="dot" onclick="goToSlide(1)"></span>
      <span class="dot" onclick="goToSlide(2)"></span>
    </div>
  </div>

<!-- Les boutons -->
<div class="calculator-toggle">
    <button id="showCalculator" class="btn-calculator">
        <i class="fas fa-calculator"></i>
        Calculateur de coûts
    </button>
    <button id="showSimulator" class="btn-calculator">
        <i class="fas fa-check-circle"></i>
        Simulateur d'éligibilité
    </button>
</div>

<!-- Le simulateur d'éligibilité -->
<div id="simulateurSection" class="cost-calculator" style="display: none; margin-left: 335px; width: 80%; padding: 40px; border: 1px solid #ddd; border-radius: 8px; background-color: #f9f9f9; box-shadow: 0 4px 10px rgba(0,0,0,0.1); margin-top: 0;">
    <div class="container" id="aaa">
        <h1>Simulateur d'Éligibilité aux Bourses</h1>
        <form method="POST" action="" class="eligibility-form">
            <div class="form-group">
                <label for="age">Âge :</label>
                <input type="number" id="age" name="age"  class="form-control">
            </div>

            <div class="form-group">
                <label for="niveau">Niveau d'études :</label>
                <select id="niveau" name="niveau" required class="form-control">
                    <option value="Licence">Licence</option>
                    <option value="Master">Master</option>
                    <option value="Doctorat">Doctorat</option>
                </select>
            </div>

            <div class="form-group">
                <label for="langue">Compétences linguistiques :</label>
                <select id="langue" name="langue" required class="form-control">
                    <option value="Français">Français</option>
                    <option value="Anglais">Anglais</option>
                    <option value="Bilingue">Bilingue</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary" >Vérifier l'éligibilité</button>
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Récupérer les données du formulaire
            $age = intval($_POST['age']);
            $niveau = $_POST['niveau'];
            $langue = $_POST['langue'];

            // Logique d'évaluation de l'éligibilité
            $recommandations = [];
            $bourseProposee = "";

            // Exemple de critères d'éligibilité
            if ($age < 18) {
                $recommandations[] = "<div class='card alert-warning fade-in'><div class='card-body'><i class='fas fa-exclamation-triangle'></i> Vous devez avoir au moins 18 ans pour postuler à la plupart des bourses.</div></div>";
            } elseif ($age > 25) {
                $recommandations[] = "<div class='card alert-success fade-in'><div class='card-body'><i class='fas fa-check-circle'></i> Vous êtes grand pour avoir une bourse.</div></div>";
            } else {
                // Propositions de bourses selon le niveau et la langue
                if ($niveau == "Licence") {
                    $bourseProposee = "<div class='card alert-success fade-in'><div class='card-body'><i class='fas fa-check-circle'></i> Bourse d'études pour Licence - 5000 TND</div></div>";
                } elseif ($niveau == "Master") {
                    if ($langue == "Bilingue") {
                        $bourseProposee = "<div class='card alert-success fade-in'><div class='card-body'><i class='fas fa-check-circle'></i> Bourse de recherche pour Master - 10000 TND</div></div>";
                    } else {
                        $recommandations[] = "<div class='card alert-warning fade-in'><div class='card-body'><i class='fas fa-exclamation-triangle'></i> Pour les programmes de Master, une compétence bilingue est souvent requise.</div></div>";
                    }
                } elseif ($niveau == "Doctorat") {
                    $bourseProposee = "<div class='card alert-success fade-in'><div class='card-body'><i class='fas fa-check-circle'></i> Bourse de recherche pour Doctorat - 15000 TND</div></div>";
                }
            }

            if (empty($recommandations) && !empty($bourseProposee)) {
                echo "<h2>Félicitations ! Vous êtes éligible à une bourse.</h2>";
                echo "<h3>Bourse proposée :</h3><p>$bourseProposee</p>";
            } else {
                echo "<h2>Recommandations :</h2><ul>";
                foreach ($recommandations as $recommandation) {
                    echo "<li>$recommandation</li>";
                }
                echo "</ul>";
            }
        }
        ?>
    </div>
</div>

<style>
/* styles pour le simulateur */
.fade-in {
    animation: fadeIn 0.5s ease-in-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.card {
    border-radius: 10px;
    margin: 15px 0;
    padding: 20px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    transition: transform 0.3s, box-shadow 0.3s;
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    position: relative;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.25);
}

.alert-warning {
    color: #856404;
    border-left: 5px solid #ffeeba;
}

.alert-success {
    color: #155724;
    border-left: 5px solid #c3e6cb;
}

.card-body {
    font-size: 16px;
    line-height: 1.5;
}

.card-body i {
    margin-right: 10px;
    font-size: 20px;
}

.eligibility-form {
    background-color: #f9f9f9;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.form-group {
    margin-bottom: 15px;
}

.form-control {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.btn-primary {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 10px 15px;
    border-radius: 4px;
    cursor: pointer;
}

.btn-primary:hover {
    background-color: #0056b3;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const simulatorBtn = document.getElementById('showSimulator');
    const simulatorSection = document.getElementById('simulateurSection');

    simulatorBtn.addEventListener('click', function() {
        if (simulatorSection.style.display === 'block') {
            simulatorSection.style.display = 'none';
            this.innerHTML = '<i class="fas fa-check-circle"></i> Simulateur d\'éligibilité';
        } else {
            simulatorSection.style.display = 'block';
            this.innerHTML = '<i class="fas fa-times"></i> Fermer le simulateur';
        }
    });
});
</script>

<!-- Modifier le div du calculateur existant -->
 
<div id="calculatorSection" class="cost-calculator" style="display: none; margin-left: 335px; width: 80%; padding: 40px; border: 1px solid #ddd; border-radius: 8px; background-color: #f9f9f9; box-shadow: 0 4px 10px rgba(0,0,0,0.1); margin-top: 0;">
<?php
require_once '../../config.php';
require_once '../../Controller/bourseC.php';
require_once '../../Model/bourses.php';

// Définir le chemin pour les uploads
$uploadDir = '../../../uploads/';

// Initialiser $totalCost
$totalCost = 0;


// Récupérer les bourses disponibles
$bourseC = new BourseC();
$boursesDisponibles = $bourseC->getBourses();

// Vérifiez si $boursesDisponibles est un tableau
if (!is_array($boursesDisponibles)) {
    $boursesDisponibles = []; // Initialiser comme tableau vide
}

// Logique pour afficher les recommandations de bourses
$boursesCouvrantFrais = []; // Initialiser le tableau pour les bourses couvrant les frais
foreach ($boursesDisponibles as $bourse) {
    $fraisBourse = $bourse->getFrais();
    // Vérifiez si la bourse est supérieure au coût total
    if ($fraisBourse > $totalCost) {
        $boursesCouvrantFrais[] = $bourse; // Ajouter la bourse si elle est supérieure au coût total
    }
}

// Afficher les recommandations

?>
<center>
<!-- Afficher les recommandations -->
<div id="recommendations" style="margin-top: 0px; text-align: center; padding: 20px; z-index: 1; position: relative; margin-left: 300px;">
    <h3 style="color: #6c63ff; margin-bottom: 20px;">Recommandations de Bourses :</h3>
    <div style="display: flex; flex-wrap: wrap; justify-content: center;">
        <?php
        if (!empty($boursesCouvrantFrais)) {
            foreach ($boursesCouvrantFrais as $bourse) {
                echo '<div style="margin: 10px; background-color: #ffffff; border-radius: 8px; padding: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); flex: 0 1 calc(30% - 20px); transition: transform 0.3s;">';
                echo '<div style="text-align: center;">';
                echo '<h4 style="color: #6c63ff; font-size: 1.5em; margin-bottom: 10px;">' . htmlspecialchars($bourse->getNomBourse()) . '</h4>';
                echo '<p style="font-size: 20px; color: #333; margin-bottom: 10px;">' . htmlspecialchars($bourse->getFrais()) . ' TND</p>';
                echo '<button style="padding: 10px 15px; background-color: #6c63ff; color: white; border: none; border-radius: 5px; cursor: pointer; transition: background-color 0.3s;">Détails</button>'; // Bouton pour plus de détails
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<h3 style="color: #ff4d4d;">Aucune bourse ne couvre vos frais.</h3>';
        }

        // Afficher le coût total pour le débogage
        
        ?>
    </div>
</div>

<!-- ... existing code ... -->

<div class="cost-calculator" style="margin-left: 335px; width: 80%; padding: 40px; border: 1px solid #ddd; border-radius: 8px; background-color: #f9f9f9; box-shadow: 0 4px 10px rgba(0,0,0,0.1); margin-top: 0;">
    <h2 class="animated-title">Calculateur de Coûts de la Vie</h2>
    <form id="costForm" style="display: flex; flex-direction: column; gap: 20px;">
        <div style="display: flex; justify-content: space-between; gap: 10px;">
            <div style="flex: 1; position: relative;">
                <label for="tuition" style="font-weight: bold; color: #6c63ff;">Frais de Scolarité (€):</label>
                <input type="number" id="tuition" required style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc; transition: border-color 0.3s; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                <i class="fa fa-euro" style="position: absolute; right: 10px; top: 35%; color: #aaa;"></i>
            </div>
            <div style="flex: 1; position: relative;">
                <label for="housing" style="font-weight: bold; color: #6c63ff;">Logement (€):</label>
                <input type="number" id="housing" required style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc; transition: border-color 0.3s; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                <i class="fa fa-euro" style="position: absolute; right: 10px; top: 35%; color: #aaa;"></i>
            </div>
        </div>
        <div style="display: flex; justify-content: space-between; gap: 10px;">
            <div style="flex: 1; position: relative;">
                <label for="food" style="font-weight: bold; color: #6c63ff;">Nourriture (€):</label>
                <input type="number" id="food" required style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc; transition: border-color 0.3s; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                <i class="fa fa-euro" style="position: absolute; right: 10px; top: 35%; color: #aaa;"></i>
            </div>
            <div style="flex: 1; position: relative;">
                <label for="transport" style="font-weight: bold; color: #6c63ff;">Transport (€):</label>
                <input type="number" id="transport" required style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc; transition: border-color 0.3s; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                <i class="fa fa-euro" style="position: absolute; right: 10px; top: 35%; color: #aaa;"></i>
            </div>
        </div>
        <div style="position: relative;">
            <label for="scholarship" style="font-weight: bold; color: #6c63ff;">Montant de la Bourse (€):</label>
            <input type="number" id="scholarship" required style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc; transition: border-color 0.3s;">
            <i class="fa fa-euro" style="position: absolute; right: 10px; top: 35%; color: #aaa;"></i>
        </div>
        <button type="submit" style="padding: 10px; background-color: #6c63ff; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; transition: background-color 0.3s; box-shadow: 0 2px 5px rgba(0,0,0,0.2);">Calculer</button>
    </form>
    <div id="result" style="margin-top: 20px; text-align: center; font-weight: bold; font-size: 18px; color: #333;"></div>
    <div id="statistics" style="margin-top: 20px; text-align: center; font-size: 16px; color: #555;"></div>
</div>

<script>
    document.getElementById('costForm').addEventListener('submit', function(event) {
        event.preventDefault();

        const tuition = parseFloat(document.getElementById('tuition').value);
        const housing = parseFloat(document.getElementById('housing').value);
        const food = parseFloat(document.getElementById('food').value);
        const transport = parseFloat(document.getElementById('transport').value);
        const scholarship = parseFloat(document.getElementById('scholarship').value);

        const totalCost = tuition + housing + food + transport;

        const resultDiv = document.getElementById('result');
        const leadsConfirmedDiv = document.getElementById('leadsConfirmed').querySelector('.value');
        const profitTotalDiv = document.getElementById('profitTotal').querySelector('.value');
        const profitPerUnitDiv = document.getElementById('profitPerUnit').querySelector('.value');

        if (scholarship >= totalCost) {
            resultDiv.innerText = "La bourse couvre vos frais de vie.";
            resultDiv.style.color = "green"; // Couleur pour le succès
            profitPerUnitDiv.innerHTML = "0.00 <span>TND/Unité</span>"; // Pas de montant supplémentaire nécessaire
        } else {
            resultDiv.innerText = "La bourse ne couvre pas vos frais de vie.  " ;
            resultDiv.style.color = "red"; // Couleur pour l'erreur
            profitPerUnitDiv.innerHTML = (totalCost - scholarship).toFixed(2) + ' <span>TND</span>'; // Montant supplémentaire nécessaire
        }

        // Mettre à jour le coût total et le montant de la bourse dans les cartes respectives
        leadsConfirmedDiv.innerHTML = totalCost.toFixed(2) + ' <span>TND</span>';
        profitTotalDiv.innerHTML = scholarship.toFixed(2) + ' <span>TND</span>'; // Montant de la bourse
    });
</script>

<div class="stats-container">
    <div class="stat-box" id="leadsConfirmed">
        <div class="icon">🛍️</div>
        <p class="title">Coût total</p>
        <p class="value">0.00 <span>TND</span></p>
    </div>
  
    <div class="stat-box" id="profitTotal">
        <div class="icon"></div>
        <p class="title">Montant de la Bourse</p>
        <p class="value">0.00 <span>TND</span></p>  
    </div>
    <div class="stat-box" id="profitPerUnit">
        <div class="icon">🔄</div>
        <p class="title">Montant supplémentaire nécessaire</p>
        <p class="value">0.00 <span>TND</span></p>
    </div>
</div>

<style>
    .stats-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #f0f4ff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        width: 90%;
        max-width: 1200px;
        margin: 20px auto;
        margin-left:400px;
    }

    .stat-box {
        text-align: center;
        background-color: #ffffff;
        padding: 20px;
        border-radius: 8px;
        border: 1px solid #c4c4e8;
        flex: 1;
        margin: 0 10px;
        transition: transform 0.3s;
    }

    .stat-box:hover {
        transform: translateY(-5px);
    }

    .icon {
        font-size: 40px;
        color: #6c63ff;
        margin-bottom: 10px;
    }

    .title {
        font-weight: bold;
        color: #333;
        margin-bottom: 8px;
    }

    .value {
        font-size: 24px;
        color: #6c63ff;
    }

    .value span {
        font-size: 16px;
    }

    .animated-title {
        text-align: center;
        margin-bottom: 20px;
        color: #6c63ff;
        font-size: 2em;
        text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
        animation: fadeIn 1s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

</div>

<!-- Ajouter ce style -->
<style>
.calculator-toggle {
    text-align: center;
    margin: 20px 0;
}

.btn-calculator {
    background-color: #6c63ff;
    color: white;
    border: none;
    padding: 15px 30px;
    border-radius: 25px;
    font-size: 16px;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(108, 99, 255, 0.2);
    display: inline-flex;
    align-items: center;
    gap: 10px;
}

.btn-calculator:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(108, 99, 255, 0.3);
    background-color: #5648ff;
}

.btn-calculator i {
    font-size: 20px;
}

/* Animation pour l'apparition du calculateur */
@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.cost-calculator.show {
    display: block !important;
    animation: slideDown 0.3s ease-out;
}
</style>

<!-- Ajouter ce script -->
<script>
document.getElementById('showCalculator').addEventListener('click', function() {
    const calculator = document.getElementById('calculatorSection');
    const button = this;
    
    if (calculator.classList.contains('show')) {
        calculator.classList.remove('show');
        calculator.style.display = 'none';
        button.innerHTML = '<i class="fas fa-calculator"></i> Calculateur de coûts';
    } else {
        calculator.classList.add('show');
        calculator.style.display = 'block';
        button.innerHTML = '<i class="fas fa-times"></i> Fermer le calculateur';
    }
});
</script>
<script>
document.getElementById('showsimulateur').addEventListener('click', function() {
    const simulateur = document.getElementById('simulateurSection');
    const button = this;
    
    if (calculator.classList.contains('show')) {
        calculator.classList.remove('show');
        calculator.style.display = 'none';
        button.innerHTML = '<i class="fas fa-calculator"></i> Calculateur de coûts';
    } else {
        calculator.classList.add('show');
        calculator.style.display = 'block';
        button.innerHTML = '<i class="fas fa-times"></i> Fermer le calculateur';
    }
});
</script>


<!-- Compte à rebours pour la bourse DAAD -->
<!-- Compte à rebours exclusif pour la bourse DAAD -->
<div class="countdown-container">
  <div class="exclusive-badge">EXCLUSIF</div>
  <h3>Bourse DAAD - Opportunité Limitée</h3>
  <p class="exclusive-offer">
    <i class="fas fa-star"></i>
    Programme d'Excellence DAAD
    <i class="fas fa-star"></i>
  </p>
  <p>L'Office allemand d'échanges universitaires (DAAD) offre des bourses d'excellence aux étudiants internationaux pour poursuivre leurs études en Allemagne.</p>
  
  <div class="benefits">
    <div class="benefit-item">
      <i class="fas fa-euro-sign"></i>
      <span>850€/mois</span>
    </div>
    <div class="benefit-item">
      <i class="fas fa-plane"></i>
      <span>Vol A/R</span>
    </div>
    <div class="benefit-item">
      <i class="fas fa-graduation-cap"></i>
      <span>Frais de scolarité</span>
    </div>
  </div>

  <div id="countdown">
    <div class="countdown-item pulse">
      <span id="hours">24</span>
      <span class="label">Heures</span>
    </div>
    <div class="countdown-item pulse">
      <span id="minutes">00</span>
      <span class="label">Minutes</span> 
    </div>
    <div class="countdown-item pulse">
      <span id="seconds">00</span>
      <span class="label">Secondes</span>
    </div>
  </div>

  <div class="spots-left">
    <i class="fas fa-user-graduate"></i>
    <span>Seulement 5 places restantes !</span>
  </div>

  <button class="apply-now-btn">
    Postuler Maintenant
    <i class="fas fa-arrow-right"></i>
  </button>
</div>
<script>
// Fonction pour formater les nombres avec un zéro devant si nécessaire
function padNumber(number) {
    return number.toString().padStart(2, '0');
}

// Fonction pour calculer et afficher le temps restant
function updateCountdown() {
    // Date de fin (24 heures à partir de maintenant)
    const endDate = new Date();
    endDate.setHours(endDate.getHours() + 24);

    // Mettre à jour le compte à rebours chaque seconde
    setInterval(() => {
        const now = new Date();
        const timeDiff = endDate - now;

        if (timeDiff > 0) {
            // Calculer les heures, minutes et secondes
            const hours = Math.floor(timeDiff / (1000 * 60 * 60));
            const minutes = Math.floor((timeDiff % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((timeDiff % (1000 * 60)) / 1000);

            // Mettre à jour l'affichage
            document.getElementById('hours').textContent = padNumber(hours);
            document.getElementById('minutes').textContent = padNumber(minutes);
            document.getElementById('seconds').textContent = padNumber(seconds);
        } else {
            // Si le compte à rebours est terminé
            document.getElementById('hours').textContent = '00';
            document.getElementById('minutes').textContent = '00';
            document.getElementById('seconds').textContent = '00';
            
            // Optionnel : afficher un message quand le temps est écoulé
            document.querySelector('.countdown-container').insertAdjacentHTML(
                'beforeend',
                '<div class="expired-notice">Le délai de candidature est expiré</div>'
            );
        }
    }, 1000);
}

// Démarrer le compte à rebours quand la page est chargée
document.addEventListener('DOMContentLoaded', updateCountdown);
</script>

<style>
/* Ajouter ce style pour le message d'expiration */
.expired-notice {
    color: #ff4d4d;
    font-weight: bold;
    margin-top: 1rem;
    padding: 1rem;
    background-color: rgba(255, 77, 77, 0.1);
    border-radius: 8px;
}
</style>

<style>
.countdown-container {
  text-align: center;
  background: linear-gradient(145deg, #ffffff, #f8f9fa);
  padding: 3rem;
  border-radius: 15px;
  margin: 2rem auto;
  max-width: 700px;
  box-shadow: 0 10px 30px rgba(108, 99, 255, 0.1);
  position: relative;
  overflow: hidden;
}

.exclusive-badge {
  position: absolute;
  top: 20px;
  right: -35px;
  background: #ff4d4d;
  color: white;
  padding: 8px 40px;
  transform: rotate(45deg);
  font-weight: bold;
  box-shadow: 0 2px 5px rgba(0,0,0,0.2);
}

.countdown-container h3 {
  color: #6c63ff;
  margin-bottom: 1rem;
  font-size: 2em;
  font-weight: bold;
}

.exclusive-offer {
  color: #ffd700;
  font-size: 1.2em;
  margin: 1rem 0;
}

.benefits {
  display: flex;
  justify-content: center;
  gap: 2rem;
  margin: 2rem 0;
}

.benefit-item {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 0.5rem;
  color: #6c63ff;
}

.benefit-item i {
  font-size: 1.5em;
}

#countdown {
  display: flex;
  justify-content: center;
  gap: 2rem;
  margin: 2rem 0;
}

.countdown-item {
  background: #6c63ff;
  color: white;
  padding: 1.5rem;
  border-radius: 12px;
  min-width: 120px;
  box-shadow: 0 5px 15px rgba(108, 99, 255, 0.3);
  transition: transform 0.3s;
}

.countdown-item:hover {
  transform: translateY(-5px);
}

.pulse {
  animation: pulse 2s infinite;
}

@keyframes pulse {
  0% { transform: scale(1); }
  50% { transform: scale(1.05); }
  100% { transform: scale(1); }
}

.spots-left {
  color: #ff4d4d;
  font-weight: bold;
  margin: 1.5rem 0;
  font-size: 1.1em;
}

.apply-now-btn {
  background: #6c63ff;
  color: white;
  border: none;
  padding: 1rem 2rem;
  border-radius: 30px;
  font-size: 1.1em;
  cursor: pointer;
  transition: all 0.3s;
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
}

.apply-now-btn:hover {
  background: #5648ff;
  transform: translateY(-2px);
  box-shadow: 0 5px 15px rgba(108, 99, 255, 0.4);
}
</style>
<center>
<img src="projet web/img/qr.png" width="1000px" height="200px" />
</center>
  
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

