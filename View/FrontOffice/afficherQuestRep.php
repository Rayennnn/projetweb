<?php
session_start(); // Appelé au tout début, avant toute sortie

require_once 'C:/xampp/htdocs/PROJETWEB/Controller/questionC.php';
require_once 'C:/xampp/htdocs/PROJETWEB/Model/question.php';
require_once 'C:/xampp/htdocs/PROJETWEB/Controller/reponseC.php';
require_once 'C:/xampp/htdocs/PROJETWEB/Model/reponse.php';

// Instancier les classes
$questionC = new questionC();
$reponseC = new reponseC();

// Récupérer toutes les questions
$questions = $questionC->affichequestion();

// Définir le nombre de questions par page
$questionsPerPage = 2;

// Obtenir le numéro de la page actuelle
$page = isset($_POST['page']) ? (int)$_POST['page'] : 1;

// Calculer l'index de début et de fin
$startIndex = ($page - 1) * $questionsPerPage;
$endIndex = $startIndex + $questionsPerPage;

// Obtenir les questions pour la page actuelle
$totalQuestions = count($questions);
$questionsOnPage = array_slice($questions, $startIndex, $questionsPerPage);

// Déterminer si c'est la dernière page
$isLastPage = $endIndex >= $totalQuestions;

// Variable to track score
$totalScore = 0;
$message = "";

// Handling form submission to calculate the score
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // This flag checks if the form is being fully submitted (not just navigation)
    $submitForm = isset($_POST['submit_quiz']);

    if ($submitForm) {
        $userResponses = $_POST['reponse'] ?? [];

        // Iterate over the responses to calculate score
        foreach ($userResponses as $questionId => $responseId) {
            // Fetch the score for the selected response
            $response = $reponseC->getreponse($responseId);
            
            if ($response) {
                $totalScore += $response['score']; // Assuming 'score' is stored in the 'reponse' table
                // Debugging: Print the response score to check if it's correct
                echo "Question ID: $questionId, Response ID: $responseId, Score: " . $response['score'] . "<br>";
            }
        }

        // Display the result message after submitting the quiz
        if ($totalScore >= 4) {
            $message = '<img src="image.jpg" alt="Motivated" style="width: 200px; height: 200px; margin-right: 10px;">Excellent! You\'re highly motivated! 🌟.';
            
        } elseif ($totalScore >= 2) {
            $message = '<img src="image1.jpg" alt="Motivated" style="width: 200px; height: 200px; margin-right: 10px;">You\'re not motivated yet 😞, but we got you!.';
           
        } else {
            $message = '<img src="image2.jpg" alt="Motivated" style="width: 200px; height: 200px; margin-right: 10px;">Not motivated at all? No worries, you\'re in good hands!.';
           
        }
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
                        
                    <a href="course.html" class="nav-item nav-link" style="margin-left: 5px;">Accueil</a>
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
                                <a href="http://localhost/PROJETWEB/View/online-courses-html-template/formations,clubs.php" class="dropdown-item">Clubs/Associations</a>
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


    <!-- Header Start -->
    <div class="container-fluid page-header" style="margin-bottom: 120px; background-image: url('image8.jpg'); background-size: cover; background-position: center;">
            <div class="d-flex flex-column justify-content-center" style="min-height: 350px">
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
    /* Styling for the email form container */
.email-form-container {
    background-color: #fff;
    padding: 20px;
    margin-top: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    max-width: 400px;
    margin: 20px auto;
    text-align: center;
}

/* Styling for the form inputs and buttons */
.email-form-container input {
    padding: 10px;
    font-size: 1rem;
    margin-bottom: 15px;
    border-radius: 5px;
    border: 1px solid #ccc;
    width: 100%;
}

.email-form-container button {
    padding: 10px 20px;
    font-size: 1rem;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.email-form-container button:hover {
    background-color: #45a049;
}

/* Close button style */
.email-form-container #close-email-form {
    background-color: #f44336;
}

.email-form-container #close-email-form:hover {
    background-color: #e53935;
}

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

/* General Styles */
body {
    font-family: 'Poppins', sans-serif;
    background-color: #f4f7fc;
    margin: 0;
    padding: 0;
}

/* Header */
.page-header {
    background-color: #007bff;
    color: white;
    padding: 50px 0;
    text-align: center;
}

.page-header h3 {
    font-size: 2.5rem;
    font-weight: 600;
    text-transform: uppercase;
}

/* Quiz Container */
.quiz-container {
    max-width: 1200px; /* Plus large pour l'alignement horizontal */
    margin: 30px auto;
    padding: 20px;
    background-color: #ffffff;
    border-radius: 15px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    animation: fadeIn 0.8s ease-in-out;
}

/* Conteneur flex pour l'alignement horizontal des questions */
.questions-wrapper {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
}

/* Style individuel pour chaque question */
.question-container {
    flex: 0 1 calc(50% - 20px); /* Deux questions par ligne */
    min-width: 300px;
    background: #fff;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    margin-bottom: 20px;
    transform: translateY(20px);
    opacity: 0;
    animation: slideUp 0.5s ease forwards;
}

/* Style pour le titre de la question */
.question-container p {
    font-size: 1.2rem;
    color: #2C3E50;
    margin-bottom: 20px;
    font-weight: 600;
    border-bottom: 2px solid #e9ecef;
    padding-bottom: 10px;
}

/* Style pour les boutons de réponse */
.response-buttons {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.response-buttons div {
    transform: translateX(-20px);
    opacity: 0;
    animation: slideIn 0.5s ease forwards;
}

/* Style pour les labels de réponse */
.response-buttons label {
    display: block;
    padding: 15px 20px;
    background-color: #f8f9fa;
    border: 2px solid #e9ecef;
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 1.1rem;
    color: #495057;
}

.response-buttons label:hover {
    background-color: #e9ecef;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.response-buttons input[type="radio"]:checked + label {
    background-color: #4e73df;
    color: white;
    border-color: #4e73df;
    transform: translateY(-2px);
}

/* Animations */
@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

@keyframes slideUp {
    from {
        transform: translateY(20px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

@keyframes slideIn {
    from {
        transform: translateX(-20px);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

/* Animation delay pour les réponses */
.response-buttons div:nth-child(1) { animation-delay: 0.1s; }
.response-buttons div:nth-child(2) { animation-delay: 0.2s; }
.response-buttons div:nth-child(3) { animation-delay: 0.3s; }
.response-buttons div:nth-child(4) { animation-delay: 0.4s; }

/* Style pour les boutons de navigation */
.navigation-buttons {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin-top: 30px;
}

.navigation-buttons button {
    padding: 12px 25px;
    border-radius: 8px;
    font-size: 1.1rem;
    font-weight: 600;
    transition: all 0.3s ease;
}

.navigation-buttons button:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

/* Result Message */
.result-container {
    text-align: center;
    margin-top: 20px;
}

.result-container h2 {
    font-size: 2rem;
    margin-bottom: 10px;
}

.result-container p {
    font-size: 1.2rem;
    font-weight: bold;
}

/* Footer */
footer {
    background-color: #007bff;
    color: white;
    padding: 20px 0;
    text-align: center;
    position: fixed;
    bottom: 0;
    width: 100%;
}

footer p {
    font-size: 1rem;
}

/* Navigation Buttons */
button[type="submit"] {
    margin: 10px 5px;
    padding: 10px 20px;
    background-color: #007bff;
    color: white;
    border-radius: 5px;
    font-size: 1rem;
    border: none;
}

button[type="submit"]:hover {
    background-color: #007bff;
}

/* Custom Styling for the Quiz Page */
.quiz-form {
    background-color: #f9f9f92a;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.quiz-form label {
    font-weight: bold;
    font-size: 1rem;
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

.rating-container {
    margin: 20px 0;
    text-align: center;
}

.stars {
    font-size: 24px;
    cursor: pointer;
    color: #ddd;
    padding: 10px 0;
}

.stars i {
    margin: 0 5px;
    transition: all 0.2s ease;
    color: #e4e4e4; /* Unselected star color */
}

.stars i.active {
    color: #ffd700; /* Selected star color (gold) */
}

.stars i:hover {
    transform: scale(1.1);
}

#rating-message {
    margin-top: 10px;
    font-weight: bold;
    color: #333;
    min-height: 20px;
}

</style>

    <div class="quiz-container">
        <form id="quiz-form" method="POST">
            <div class="quiz-header">
                <h2>Quiz: Answer the questions</h2>
            </div>

            <div class="questions-wrapper">
                <?php foreach ($questionsOnPage as $question): ?>
                    <div class="question-container">
                        <p><?php echo $question['titre']; ?></p>
                        <?php
                        $responses = $reponseC->getReponsesByQuestionId($question['id']);
                        ?>
                        <div class="response-buttons">
                            <?php foreach ($responses as $response): ?>
                                <div>
                                    <input type="radio" id="reponse-<?php echo $response['id_reponse']; ?>" 
                                           name="reponse[<?php echo $question['id']; ?>]" 
                                           value="<?php echo $response['id_reponse']; ?>" required>
                                    <label for="reponse-<?php echo $response['id_reponse']; ?>">
                                        <?php echo $response['choix_rp']; ?>
                                    </label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="navigation-buttons">
                <?php if ($page > 1): ?>
                    <button type="submit" name="page" value="<?php echo $page - 1; ?>" class="btn btn-secondary">Previous</button>
                <?php endif; ?>

                <?php if (!$isLastPage): ?>
                    <button type="submit" name="page" value="<?php echo $page + 1; ?>" class="btn btn-primary">Next</button>
                <?php else: ?>
                    <button type="submit" name="submit_quiz" class="btn btn-success">Submit</button>
                <?php endif; ?>
            </div>
        </form>

        <!-- Display result after submission -->
        <?php if (isset($message) && $message !== ""): ?>
            <style>
                .result-page {
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background: white;
                    z-index: 1000;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    padding: 20px;
                }

                .result-content {
                    max-width: 600px;
                    width: 100%;
                    background: white;
                    padding: 30px;
                    border-radius: 15px;
                    box-shadow: 0 0 20px rgba(0,0,0,0.1);
                    text-align: center;
                }

                .result-message {
                    margin-bottom: 30px;
                }

                .result-message img {
                    max-width: 200px;
                    margin: 20px auto;
                    display: block;
                    border-radius: 10px;
                }

                .rating-container {
                    margin: 30px 0;
                    padding: 20px;
                    background: #f8f9fa;
                    border-radius: 10px;
                }

                .mailing-button {
                    margin-top: 30px;
                }

                .email-form-container {
                    margin-top: 20px;
                    padding: 20px;
                    background: #f8f9fa;
                    border-radius: 10px;
                }

                .btn-secondary {
                    background-color: #007bff;
                    color: white;
                    padding: 10px 20px;
                    border: none;
                    border-radius: 5px;
                    cursor: pointer;
                    transition: all 0.3s ease;
                }

                .btn-secondary:hover {
                    background-color: #5a6268;
                }
            </style>

            <!-- Hide the quiz form -->
            <script>
                document.getElementById('quiz-form').style.display = 'none';
            </script>

            <div class="result-page">
                <div class="result-content">
                    <div class="result-message">
                        <h2>Your Quiz Result</h2>
                        <p><?php echo $message; ?></p>
                    </div>
                    
                    <!-- Rating System -->
                    <div class="rating-container">
                        <h3>Rate your experience</h3>
                        <div class="stars">
                            <i class="fas fa-star" data-rating="1"></i>
                            <i class="fas fa-star" data-rating="2"></i>
                            <i class="fas fa-star" data-rating="3"></i>
                            <i class="fas fa-star" data-rating="4"></i>
                            <i class="fas fa-star" data-rating="5"></i>
                        </div>
                        <p id="rating-message"></p>
                        <input type="hidden" id="user-rating" name="user-rating" value="0">
                    </div>

                    <!-- Mailing Button -->
                    <div class="mailing-button">
                        <button id="open-email-form" class="btn btn-secondary">Send Results by Email</button>
                    </div>

                    <!-- Hidden Email Form -->
                    <div id="email-form-container" class="email-form-container" style="display: none;">
                    <form id="emailForm" action="http://localhost/PROJETWEB/View/FrontOffice/mail.php" method="POST">
            <input type="email" id="email" name="email" required />
            <input type="hidden" name="message" value="<?php echo htmlspecialchars($message); ?>">
            <input type="hidden" name="score" value="<?php echo $totalScore; ?>">
            <button type="submit" class="btn btn-primary">Send</button>
            <button type="button" id="close-email-form" class="btn btn-secondary">Cancel</button>
        </form>

    </div>
    
<?php endif; ?>






</div>
    <script>
    document.getElementById("open-email-form").addEventListener("click", function() {
        document.getElementById("email-form-container").style.display = "block";
    });

    document.getElementById("close-email-form").addEventListener("click", function() {
        document.getElementById("email-form-container").style.display = "none";
    });
    
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.querySelector('.stars');
    const stars = container.querySelectorAll('i');
    const messageElement = document.getElementById('rating-message');
    let currentRating = 0; // Variable to store the current rating

    const messages = {
        1: "We'll work harder to improve! 😔",
        2: "Thanks for your feedback! 🤔",
        3: "We appreciate your rating! 😊",
        4: "Thanks! We're glad you enjoyed it! 😄",
        5: "Excellent! Thank you so much! 🌟"
    };

    function updateStars(rating) {
        stars.forEach((star, index) => {
            if (index < rating) {
                star.classList.add('active');
            } else {
                star.classList.remove('active');
            }
        });
        
        messageElement.textContent = messages[rating] || '';
        currentRating = rating; // Store the current rating
    }

    // Handle click events
    stars.forEach((star, index) => {
        star.addEventListener('click', () => {
            const rating = index + 1;
            updateStars(rating);
            
            // Update hidden input for the form
            const ratingInput = document.createElement('input');
            ratingInput.type = 'hidden';
            ratingInput.name = 'rating';
            ratingInput.value = rating;

            // Remove any existing rating input
            const existingRating = document.querySelector('input[name="rating"]');
            if (existingRating) {
                existingRating.remove();
            }

            // Add the new rating input to the form
            const form = document.querySelector('form');
            if (form) {
                form.appendChild(ratingInput);
            }
        });

        // Handle hover events
        star.addEventListener('mouseover', () => {
            updateStars(index + 1);
        });
    });

    // Handle mouse leave from container
    container.addEventListener('mouseleave', () => {
        updateStars(currentRating);
    });

    // Update the email form submit handler
    const emailForm = document.querySelector('form');
    if (emailForm) {
        emailForm.addEventListener('submit', function(e) {
            if (!currentRating) {
                const ratingInput = document.createElement('input');
                ratingInput.type = 'hidden';
                ratingInput.name = 'rating';
                ratingInput.value = currentRating;
                this.appendChild(ratingInput);
            }
        });
    }
});
</script>

<script>
// Sauvegarder la position de défilement avant la soumission du formulaire
document.getElementById('quiz-form').addEventListener('submit', function() {
    // Stocker la position actuelle dans sessionStorage
    sessionStorage.setItem('scrollPosition', window.scrollY);
});

// Restaurer la position de défilement après le chargement de la page
document.addEventListener('DOMContentLoaded', function() {
    // Récupérer la position sauvegardée
    const scrollPosition = sessionStorage.getItem('scrollPosition');
    
    if (scrollPosition) {
        // Restaurer la position avec une petite animation
        window.scrollTo({
            top: scrollPosition,
            behavior: 'smooth'
        });
        // Effacer la position sauvegardée
        sessionStorage.removeItem('scrollPosition');
    }
});

// Désactiver le comportement de défilement par défaut du navigateur
if (window.history.scrollRestoration) {
    window.history.scrollRestoration = 'manual';
    function checkAccount(answer) {
        if (answer === 'yes') {
            window.location.href = 'login.html'; // Redirect to login pa
        }
}
</script>

    
</body>
</html>

<!-- Add these before </body> -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
