<?php
include('C:/xampp/htdocs/PROJETWEB/Controller/questionC.php');
require_once('C:/xampp/htdocs/PROJETWEB/Model/question.php');
include('C:/xampp/htdocs/PROJETWEB/Controller/reponseC.php');
require_once('C:/xampp/htdocs/PROJETWEB/Model/reponse.php');




$questionC = new questionC();
$questions = $questionC->afficherQuestions();
$reponseC = new reponseC();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (
        isset($_POST["id_user"]) && !empty($_POST["id_user"]) &&
        isset($_POST["date"]) && !empty($_POST["date"]) &&
        isset($_POST["id_question"]) && !empty($_POST["id_question"]) &&
        isset($_POST["choix_rp"]) && !empty($_POST["choix_rp"])
    ) {
        $reponse = new reponse($_POST["id_user"], $_POST["date"], $_POST["id_question"], $_POST["choix_rp"],$_POST["score"]);

        $reponseC = new reponseC();
        $reponseC->ajoutereponse($reponse);

        header('refresh:0;url=affichereponse.php');
        exit(); 
    } else {
        echo "Please fill out all required fields.";
    }
}
?>
<head>
<meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>ajoutreponse</title>
<style>
    /* General Reset */
body {
    margin: 0;
    padding: 0;
    font-family: 'Open Sans', sans-serif;
    background-color: #f5f7fa; /* Light background for better contrast */
}

/* Form Container */
.container-fluid {
    max-width: 800px;
    margin: 50px auto;
    padding: 30px;
    background: #ffffff; /* White background for the form */
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
}

/* Card Styling */
.card {
    border: none;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Add depth to the card */
}

/* Card Header */
.card-header {
    background-color: #4e73df;
    color: #ffffff;
    border-radius: 10px 10px 0 0;
    padding: 15px;
}

.card-header p {
    font-size: 1.2rem;
    margin: 0;
    font-weight: bold;
}

/* Form Group Styling */
.form-group {
    margin-bottom: 20px;
}

label {
    display: block;
    font-weight: 600;
    margin-bottom: 8px;
    color: #4e73df; /* Stylish color for labels */
}

.input-field, input, select {
    width: 100%;
    padding: 12px 15px;
    font-size: 1rem;
    border: 1px solid #d1d3e2;
    border-radius: 8px;
    background-color: #f8f9fc; /* Light gray for input background */
    color: #495057; /* Dark gray for text */
    transition: all 0.3s ease;
}

.input-field:focus, input:focus, select:focus {
    border-color: #4e73df; /* Add focus color to input borders */
    outline: none;
    box-shadow: 0 0 8px rgba(78, 115, 223, 0.3); /* Blue glow effect */
}

.error {
    border-color: #e74a3b; /* Red border for invalid fields */
}

/* Error Message Styling */
.error-message {
    color: #e74a3b;
    font-size: 0.85rem;
    margin-top: 5px;
}

/* Button Styling */
button {
    padding: 12px 20px;
    font-size: 1rem;
    font-weight: bold;
    color: #ffffff;
    background-color: #4e73df;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
}

button:hover {
    background-color: #3751a5; /* Darker blue on hover */
}

/* Responsive Design */
@media (max-width: 768px) {
    .container-fluid {
        padding: 20px;
    }

    input, select, button {
        font-size: 0.9rem;
        padding: 10px;
    }
}

  </style>
  <!-- Basic -->
  <meta charset="UTF-8">

<title>suggestion</title>
<meta name="keywords" content="HTML5 Admin Template" />
<meta name="description" content="Porto Admin - Responsive HTML5 Template">
<meta name="author" content="okler.net">

<!-- Mobile Metas -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

<!-- Web Fonts  -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

<!-- Vendor CSS -->
<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css" />
<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.css" />
<link rel="stylesheet" href="assets/vendor/magnific-popup/magnific-popup.css" />
<link rel="stylesheet" href="assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

<!-- Specific Page Vendor CSS -->
<link rel="stylesheet" href="assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.css" />

<!-- Theme CSS -->
<link rel="stylesheet" href="assets/stylesheets/theme.css" />

<!-- Skin CSS -->
<link rel="stylesheet" href="assets/stylesheets/skins/default.css" />

<!-- Theme Custom CSS -->
<link rel="stylesheet" href="assets/stylesheets/theme-custom.css">

<!-- Head Libs -->
<script src="assets/vendor/modernizr/modernizr.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
<!-- start: header -->
 <header class="header">
				<div class="logo-container">
					<a href="../" class="logo">
						<img src="assets/images/logo.png" height="35" alt="Porto Admin" />
					</a>
					<div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
						<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
					</div>
				</div>
			
				<!-- start: search & user box -->
				<div class="header-right">
			
					<form action="pages-search-results.html" class="search nav-form">
						<div class="input-group input-search">
							<input type="text" class="form-control" name="q" id="q" placeholder="Search...">
							<span class="input-group-btn">
								<button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
							</span>
						</div>
					</form>
			
					<span class="separator"></span>
			
					<ul class="notifications">
						<li>
							<a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
								<i class="fa fa-tasks"></i>
								<span class="badge">3</span>
							</a>
			
							<div class="dropdown-menu notification-menu large">
								<div class="notification-title">
									<span class="pull-right label label-default">3</span>
									Tasks
								</div>
			
								<div class="content">
									<ul>
										<li>
											<p class="clearfix mb-xs">
												<span class="message pull-left">Generating Sales Report</span>
												<span class="message pull-right text-dark">60%</span>
											</p>
											<div class="progress progress-xs light">
												<div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
											</div>
										</li>
			
										<li>
											<p class="clearfix mb-xs">
												<span class="message pull-left">Importing Contacts</span>
												<span class="message pull-right text-dark">98%</span>
											</p>
											<div class="progress progress-xs light">
												<div class="progress-bar" role="progressbar" aria-valuenow="98" aria-valuemin="0" aria-valuemax="100" style="width: 98%;"></div>
											</div>
										</li>
			
										<li>
											<p class="clearfix mb-xs">
												<span class="message pull-left">Uploading something big</span>
												<span class="message pull-right text-dark">33%</span>
											</p>
											<div class="progress progress-xs light mb-xs">
												<div class="progress-bar" role="progressbar" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100" style="width: 33%;"></div>
											</div>
										</li>
									</ul>
								</div>
							</div>
						</li>
						<li>
							<a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
								<i class="fa fa-envelope"></i>
								<span class="badge">4</span>
							</a>
			
							<div class="dropdown-menu notification-menu">
								<div class="notification-title">
									<span class="pull-right label label-default">230</span>
									Messages
								</div>
			
								<div class="content">
									<ul>
										<li>
											<a href="#" class="clearfix">
												<figure class="image">
													<img src="assets/images/!sample-user.jpg" alt="Joseph Doe Junior" class="img-circle" />
												</figure>
												<span class="title">Joseph Doe</span>
												<span class="message">Lorem ipsum dolor sit.</span>
											</a>
										</li>
										<li>
											<a href="#" class="clearfix">
												<figure class="image">
													<img src="assets/images/!sample-user.jpg" alt="Joseph Junior" class="img-circle" />
												</figure>
												<span class="title">Joseph Junior</span>
												<span class="message truncate">Truncated message. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sit amet lacinia orci. Proin vestibulum eget risus non luctus. Nunc cursus lacinia lacinia. Nulla molestie malesuada est ac tincidunt. Quisque eget convallis diam, nec venenatis risus. Vestibulum blandit faucibus est et malesuada. Sed interdum cursus dui nec venenatis. Pellentesque non nisi lobortis, rutrum eros ut, convallis nisi. Sed tellus turpis, dignissim sit amet tristique quis, pretium id est. Sed aliquam diam diam, sit amet faucibus tellus ultricies eu. Aliquam lacinia nibh a metus bibendum, eu commodo eros commodo. Sed commodo molestie elit, a molestie lacus porttitor id. Donec facilisis varius sapien, ac fringilla velit porttitor et. Nam tincidunt gravida dui, sed pharetra odio pharetra nec. Duis consectetur venenatis pharetra. Vestibulum egestas nisi quis elementum elementum.</span>
											</a>
										</li>
										<li>
											<a href="#" class="clearfix">
												<figure class="image">
													<img src="assets/images/!sample-user.jpg" alt="Joe Junior" class="img-circle" />
												</figure>
												<span class="title">Joe Junior</span>
												<span class="message">Lorem ipsum dolor sit.</span>
											</a>
										</li>
										<li>
											<a href="#" class="clearfix">
												<figure class="image">
													<img src="assets/images/!sample-user.jpg" alt="Joseph Junior" class="img-circle" />
												</figure>
												<span class="title">Joseph Junior</span>
												<span class="message">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sit amet lacinia orci. Proin vestibulum eget risus non luctus. Nunc cursus lacinia lacinia. Nulla molestie malesuada est ac tincidunt. Quisque eget convallis diam.</span>
											</a>
										</li>
									</ul>
			
									<hr />
			
									<div class="text-right">
										<a href="#" class="view-more">View All</a>
									</div>
								</div>
							</div>
						</li>
						<li>
							<a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
								<i class="fa fa-bell"></i>
								<span class="badge">3</span>
							</a>
			
							<div class="dropdown-menu notification-menu">
								<div class="notification-title">
									<span class="pull-right label label-default">3</span>
									Alerts
								</div>
			
								<div class="content">
									<ul>
										<li>
											<a href="#" class="clearfix">
												<div class="image">
													<i class="fa fa-thumbs-down bg-danger"></i>
												</div>
												<span class="title">Server is Down!</span>
												<span class="message">Just now</span>
											</a>
										</li>
										<li>
											<a href="#" class="clearfix">
												<div class="image">
													<i class="fa fa-lock bg-warning"></i>
												</div>
												<span class="title">User Locked</span>
												<span class="message">15 minutes ago</span>
											</a>
										</li>
										<li>
											<a href="#" class="clearfix">
												<div class="image">
													<i class="fa fa-signal bg-success"></i>
												</div>
												<span class="title">Connection Restaured</span>
												<span class="message">10/10/2014</span>
											</a>
										</li>
									</ul>
			
									<hr />
			
									<div class="text-right">
										<a href="#" class="view-more">View All</a>
									</div>
								</div>
							</div>
						</li>
					</ul>
			
					<span class="separator"></span>
			
					<div id="userbox" class="userbox">
						<a href="#" data-toggle="dropdown">
							<figure class="profile-picture">
								<img src="assets/images/!logged-user.jpg" alt="Joseph Doe" class="img-circle" data-lock-picture="assets/images/!logged-user.jpg" />
							</figure>
							<div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@okler.com">
								<span class="name">John Doe Junior</span>
								<span class="role">administrator</span>
							</div>
			
							<i class="fa custom-caret"></i>
						</a>
			
						<div class="dropdown-menu">
							<ul class="list-unstyled">
								<li class="divider"></li>
								<li>
									<a role="menuitem" tabindex="-1" href="pages-user-profile.html"><i class="fa fa-user"></i> My Profile</a>
								</li>
								<li>
									<a role="menuitem" tabindex="-1" href="#" data-lock-screen="true"><i class="fa fa-lock"></i> Lock Screen</a>
								</li>
								<li>
									<a role="menuitem" tabindex="-1" href="pages-signin.html"><i class="fa fa-power-off"></i> Logout</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- end: search & user box -->
			</header>
			<!-- end: header -->

			<div class="inner-wrapper">
				<!-- start: sidebar -->
				<aside id="sidebar-left" class="sidebar-left">
				
					<div class="sidebar-header">
						
						<div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
							<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
						</div>
					</div>
				
					<div class="nano">
						<div class="nano-content">
							<nav id="menu" class="nav-main" role="navigation">
								<ul class="nav nav-main">
								<li class="nav-parent ">
                        <a>
                            <i class="fa fa-users" aria-hidden="true"></i>
                            <span>Clubs</span>
                        </a>
                        <ul class="nav nav-children">
                            <li>
                                <a href="\PROJETWEB\View\BackOffice\addClub.php">
                                    Ajouter un club
                                </a>
                            </li>
                            <li>
                                <a href="\PROJETWEB\View\BackOffice\listClubs.php">
                                    Liste des clubs
                                </a>
                            </li>
                        </ul>
                    </li>
                    
                    <!-- Ajout du menu Formations -->
                    <li class="nav-parent ">
                        <a>
                            <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                            <span>Formations</span>
                        </a>
                        <ul class="nav nav-children">
                            <li>
                                <a href="\PROJETWEB\View\BackOffice\addFormation.php">
                                    Ajouter une formation
                                </a>
                            </li>
                            <li>
                                <a href="\PROJETWEB\View\BackOffice\listFormations.php">
                                    Liste des formations
                                </a>
                            </li>
                        </ul>
                    </li>
					<li class="nav-parent nav-expanded nav-active">
										<a>
											<i class="fa fa-list-alt" aria-hidden="true"></i>
											<span>Quiz</span>
										</a>
										<ul class="nav nav-children">
											<li>
												<a href="http://localhost/PROJETWEB/View/BackOffice/afficherquestion.php">
													 questions
												</a>
											</li>
											<li>
												<a href="http://localhost/PROJETWEB/View/BackOffice/affichereponse.php">
													 reponses
												</a>
											</li>
											
										</ul>
									</li>
									<li class="nav-parent">
										<a>
											<i class="fa fa-table" aria-hidden="true"></i>
											<span>interantional</span>
										</a>
										<ul class="nav nav-children">
											
											<li>
												<a href="octopus/addBourse.php">
													 Bourses
												</a>
											</li>
											<li>
												<a href="octopus/addprogramme.php">
													 programmes d'échanges
												</a>
											</li>
											
										</ul>
									</li>
									
									<li class="nav-parent ">
										<a href ="admin-comments.php">
											<i class="fa fa-columns" aria-hidden="true"></i>
											<span>témoignage</span>
										</a>
										
									</li>
							<!-- Ajout du menu suggestions -->		
											
									<li class="nav-parent">
										<a>
											<i class="fa fa-list-alt" aria-hidden="true"></i>
											<span>suggestion</span>
										</a>
										<ul class="nav nav-children">
										<li >
											
												<a href="octopus-master/octopus-master/octopus/addreponse.php">
													 ajouter reponse
												</a>
											</li>
											<li>
												<a href="octopus-master/octopus-master/octopus/addsuggestion.php">
													 liste reponse
												</a>
											</li>
											<li>
												<a href="octopus-master/octopus-master/octopus/listesuggestion.php">
												liste suggestion et reclamation
												</a>
											</li>
											<li>
												<a href="octopus-master/octopus-master/octopus/statistiques.php">
													 statistiques
												</a>
											</li>
											
										</ul>
									</li>
									
									
									
							
				
							<hr class="separator" />
				
							
							
				
					</div>
				
				</aside>
				<!-- end: sidebar -->
  <main class="main-content position-relative border-radius-lg">
    <form method="POST" action="">
      <div class="container-fluid py-4">
        <div class="row">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header pb-0">
                <div class="d-flex align-items-center">
                  <p class="mb-0">Ajouter une réponse</p>
                  <button class="btn btn-primary btn-sm ms-auto" type="submit">Ajouter</button>
                </div>
              </div>
              <div class="card-body">
                <p class="text-uppercase text-sm">Informations Réponses</p>
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="id_user">User :</label>
    <select id="id_user" name="id_user" class="input-field">
      <option value="">-- Sélectionnez un auteur --</option>
      <option value="rima">Rima</option>
      <option value="fatma">Fatma</option>
      <option value="mahmoud">Mahmoud</option>
      <option value="malek">Malek</option>
      <option value="rayen">Rayen</option>
      <option value="aziz">Aziz</option>
    </select>
    <span id="id_user-error" class="error-message"></span>
    <br><br>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="date" class="form-control-label">Date (YYYY-MM-DD)</label>
                      <input class="form-control" type="date" name="date" required>
                    </div>
                  </div>
                  <div class="col-md-6">
    <div class="form-group">
        <label for="id_question" class="form-control-label">Question</label>
        <select class="form-control" name="id_question" required>
            <option value="">Sélectionnez une question</option>
            <?php
            foreach ($questions as $question) {
                echo '<option value="' . htmlspecialchars($question['id']) . '">' . htmlspecialchars($question['titre']) . '</option>';
            }
            ?>
        </select>
    </div>
</div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="choix_rp" class="form-control-label">Choix Réponse</label>
                      <input class="form-control" type="text" name="choix_rp" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="score" class="form-control-label">score</label>
                      <input class="form-control" type="text" name="score" required>
                    </div>
                  </div>
                </div>
                <hr class="horizontal dark">
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </main>
  <script>
  function checkInput() {
    const id_user = document.getElementById("id_user");
    const date = document.getElementById("date");
    const id_question = document.getElementById("id_question");
    const choix_rp = document.getElementById("choix_rp");

    let isValid = true;

    // Effacer les erreurs précédentes
    clearErrors();

    // Valider 'id_user' (doit être un nombre entier positif)
    const idUserRegex = /^[0-9]+$/;
    if (id_user.value.trim().length === 0) {
      showError('id_user-error', "Le champ 'ID Utilisateur' est obligatoire.");
      id_user.classList.add('error');
      isValid = false;
    } else if (!idUserRegex.test(id_user.value.trim())) {
      showError('id_user-error', "L'ID Utilisateur doit être un nombre entier positif.");
      id_user.classList.add('error');
      isValid = false;
    }

    // Valider 'date' (doit correspondre au format YYYY-MM-DD)
    const dateRegex = /^\d{4}-\d{2}-\d{2}$/; // Format date: YYYY-MM-DD
    if (date.value.trim().length === 0) {
      showError('date-error', "Le champ 'Date' est obligatoire.");
      date.classList.add('error');
      isValid = false;
    } else if (!dateRegex.test(date.value.trim())) {
      showError('date-error', "Le champ 'Date' doit être au format YYYY-MM-DD.");
      date.classList.add('error');
      isValid = false;
    } else {
      // Vérification de la validité de la date (si nécessaire)
      const dateObj = new Date(date.value.trim());
      if (isNaN(dateObj.getTime())) {
        showError('date-error', "La date spécifiée est invalide.");
        date.classList.add('error');
        isValid = false;
      }
    }

    // Valider 'id_question' (doit être un nombre entier positif)
    if (id_question.value.trim().length === 0) {
      showError('id_question-error', "Le champ 'ID Question' est obligatoire.");
      id_question.classList.add('error');
      isValid = false;
    } else if (!idUserRegex.test(id_question.value.trim())) {
      showError('id_question-error', "L'ID Question doit être un nombre entier positif.");
      id_question.classList.add('error');
      isValid = false;
    }

    // Valider 'choix_rp' (maximum 255 caractères, sans caractères spéciaux)
    if (choix_rp.value.trim().length === 0) {
      showError('choix_rp-error', "Le champ 'Choix Réponse' est obligatoire.");
      choix_rp.classList.add('error');
      isValid = false;
    } else if (choix_rp.value.trim().length > 255) {
      showError('choix_rp-error', "Le champ 'Choix Réponse' ne peut pas dépasser 255 caractères.");
      choix_rp.classList.add('error');
      isValid = false;
    } else {
      const specialCharsRegex = /[!@#$%^&*(),.?":{}|<>]/;
      if (specialCharsRegex.test(choix_rp.value.trim())) {
        showError('choix_rp-error', "Le champ 'Choix Réponse' ne doit pas contenir de caractères spéciaux.");
        choix_rp.classList.add('error');
        isValid = false;
      }
    }

    return isValid; // Si 'isValid' est false, le formulaire ne sera pas soumis
  }

  // Affichage des messages d'erreur
  function showError(elementId, message) {
    const errorElement = document.getElementById(elementId);
    errorElement.textContent = message;
  }

  // Effacer les erreurs de validation
  function clearErrors() {
    const errorElements = document.querySelectorAll('.error-message');
    errorElements.forEach(el => el.textContent = "");
    const inputFields = document.querySelectorAll('.input-field');
    inputFields.forEach(field => field.classList.remove('error'));
  }
</script>
<!-- Vendor -->
<script src="assets/vendor/jquery/jquery.js"></script>
		<script src="assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="assets/vendor/bootstrap/js/bootstrap.js"></script>
		<script src="assets/vendor/nanoscroller/nanoscroller.js"></script>
		<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="assets/vendor/magnific-popup/magnific-popup.js"></script>
		<script src="assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
		
		<!-- Specific Page Vendor -->
		<script src="assets/vendor/jquery-autosize/jquery.autosize.js"></script>
		<script src="assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="assets/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="assets/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="assets/javascripts/theme.init.js"></script>
</body>
</html>