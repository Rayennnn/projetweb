<?php
include "../../Controller/reponseC.php";
$reponseC = new reponseC();
$listereponse = $reponseC->affichereponse();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<head>

<!-- Basic -->
<meta charset="UTF-8">

<title>liste reponses</title>
<meta name="keywords" content="HTML5 Admin Template" />
<meta name="description" content="JSOFT Admin - Responsive HTML5 Template">
<meta name="author" content="JSOFT.net">

<!-- Mobile Metas -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="assets/vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

		<!-- Specific Page Vendor CSS -->
		<link rel="stylesheet" href="assets/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />
		<link rel="stylesheet" href="assets/vendor/morris/morris.css" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="assets/stylesheets/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme-custom.css">

		<!-- Head Libs -->
		<script src="assets/vendor/modernizr/modernizr.js"></script>
  <!-- Custom CSS -->
  <style>
  body {
    background: linear-gradient(135deg, #f7f9fc, #eaf1f8);
    font-family: 'Open Sans', sans-serif;
    margin: 0;
    padding: 0;
  }

  

  /* Main Content */
  .main-content {
    margin-left: 240px;
    padding: 30px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
  }

  .card {
    background-color: #fff;
    border: none;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
    width: 70%;
    max-width: 900px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  }

  .card-header {
    background-color: #4e73df;
    color: #021a30;
    font-size: 2rem;
    font-weight: bold;
    padding: 5px;
    border-radius: 10px 10px 0 0;
    text-align: center; 
  }

  .card-body {
    padding: 20px;
  }

  body {
    background-color: #5666d4; /* Matches the background color */
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

.table {
    width: 100%;
    margin: 20px auto;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    border-collapse: collapse;
    overflow: hidden;
}

.table th, .table td {
    padding: 15px 25px;
    text-align: left;
    font-size: 1.7rem;
    font-weight: 500;
}

.table th {
    background-color: #f8f9fc;
    color: #2C3E50;
    font-weight:900;
    font-size: 1.5rem;
    text-transform: uppercase;
    border-bottom: 2px solid #e2e6ea;
}

.table td {
    color: #2C3E50;
    line-height: 1.5;
}

.table tr:hover {
    background-color: #f8f9fc;
    transition: background-color 0.3s ease;
}

  .btn-icon {
  width: 40px; /* Set width to make buttons circular */
  height: 40px; /* Set height to make buttons circular */
  font-size: 1.2rem; /* Slightly larger emoji size */
  display: inline-flex;
  align-items: center;
  justify-content: center;
  border-radius: 50%; /* Make buttons perfectly circular */
  border: none; /* Remove default borders */
  cursor: pointer;
  transition: background-color 0.3s ease, transform 0.2s ease;
}

.btn-icon:hover {
  transform: scale(1.1); /* Slight zoom effect on hover */
}
  .btn {
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    cursor: pointer;
    font-size: 1rem;
    transition: background-color 0.3s ease, transform 0.2s ease;
  }

  .btn-primary {
    background-color: #007bff;
    color: #fff;
  }

  .btn-primary:hover {
    background-color: #0056b3;
    transform: scale(1.05);
  }

  .btn-danger {
    background-color: #e3342f;
    color: #fff;
  }

  .btn-danger:hover {
    background-color: #cc1f1a;
    transform: scale(1.05);
  }

  .btn-add-question {
    background-color: #007bff;
    color: #fff;
  }

  .btn-add-question:hover {
    background-color: #0056b3;
    transform: scale(1.05);
  }

  /* Position the Add Button */
  .position-absolute {
    position: absolute;
    top: 80px;
    right: 700px;
  }

  /* Add these styles to match the dashboard theme */
.sidebar-left {
    background: #2C3E50; /* Base blue background */
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    width: 300px;
    padding: 0;
    z-index: 1000;
}

.logo-container {
    background: #2C3E50; /* Darker blue for logo area - exact match */
    padding: 15px;
    height: 90px;
    display: flex;
    align-items: center;
}

.logo-container img {
    max-height: 50px;
    margin-right: 10px;
}

.sidebar-header {
    position: relative;
    color: #ffffff;
    height: 50px;
    background: #3f72af; /* Same as sidebar background */
    padding: 15px;
}

.sidebar-title {
    color: #ffffff;
    font-size: 14px;
    font-weight: 600;
    text-transform: uppercase;
}

.nav-main {
    margin-top: 20px;
}

.nav-main li a {
    color: #ffffff;
    font-size: 13px;
    padding: 12px 15px;
    display: block;
    text-decoration: none;
}

.nav-main li a:hover {
    background: #2a4d84; /* Darker blue on hover - exact match */
    color: #fff;
}

.nav-main li.nav-active > a {
    background: #2a4d84; /* Darker blue for active state - exact match */
    color: #fff;
}

.nav-children {
    background: #2a4d84; /* Darker blue for child menus - exact match */
    padding-left: 20px;
}

/* Adjust main content margin to match sidebar width */
.main-content {
    margin-left: 300px;
}
  </style>

  
</head>
<body class="g-sidenav-show bg-primary">

  <!-- Sidebar -->
  <aside id="sidebar-left" class="sidebar-left">
    <!-- Add this logo container -->
    <div class="logo-container">
        <a href="../" class="logo">
            <img src="logo1.PNG" height="35" alt="JSOFT Admin" />
        </a>
        <div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
            <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
        </div>
    </div>

    <div class="nano">
        <div class="nano-content">
            <nav id="menu" class="nav-main" role="navigation">
                <ul class="nav nav-main">
                    <li class="nav-active">
                        <a href="http://localhost/parcouri/view/back/profile.php">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    
                    <li class="nav-parent">
										
									<li class="nav-parent">
										<a>
											<i class="fa fa-list-alt" aria-hidden="true"></i>
											<span>Quiz</span>
										</a>
										<ul class="nav nav-children">
											<li>
												<a href="http://localhost/Quiz/View/Back/afficherquestion.php">
													 questions
												</a>
											</li>
											<li>
												<a href="http://localhost/Quiz/View/Back/affichereponse.php">
													 reponses
												</a>
											</li>
											
										</ul>
									</li>
									
									
								</ul>
							</nav>
				
							
				
				</aside>

  <!-- Main Content -->
  <main class="main-content position-relative border-radius-lg">
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Liste des Réponses</h6>
              <div class="position-absolute top-3 start-100 translate-middle-x">
                <button type="button" class="btn btn-add-question" onclick="location.href='ajoutereponse.php'">
                  Ajouter des Réponses
                </button>
              </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>ID Utilisateur</th>
                      <th>Date</th>
                      <th>ID Question</th>
                      <th>Choix RP</th>
                      <th>score</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    foreach ($listereponse as $reponse) {
                      ?>
                      <tr>
                      <td class="text-center"><?php echo $reponse['id_reponse']; ?></td>
                        <td class="text-center"><?php echo $reponse['id_user']; ?></td>
                        <td class="text-center"><?php echo $reponse['date']; ?></td>
                        <td class="text-center"><?php echo $reponse['id_question']; ?></td>
                        <td class="text-center"><?php echo $reponse['choix_rp']; ?></td>
                        <td class="text-center"><?php echo $reponse['score']; ?></td>
                        <td class="text-center">
                          <button class="btn btn-primary" onclick="window.location.href='modifiereponse.php?id_reponse=<?php echo $reponse['id_reponse']; ?>'">
                            <i class="fas fa-pencil-alt" aria-hidden="true"></i>Edit✏️
                          </button>
                          <button class="btn btn-danger rounded-circle btn-icon" onclick="window.location.href='supprimereponse.php?id_reponse=<?php echo $reponse['id_reponse']; ?>'">
                            🗑️
                          </button>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- Vendor -->
  <script src="assets/vendor/jquery/jquery.js"></script>
		<script src="assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="assets/vendor/bootstrap/js/bootstrap.js"></script>
		<script src="assets/vendor/nanoscroller/nanoscroller.js"></script>
		<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="assets/vendor/magnific-popup/magnific-popup.js"></script>
		<script src="assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
		
		<!-- Specific Page Vendor -->
		<script src="assets/vendor/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
		<script src="assets/vendor/jquery-ui-touch-punch/jquery.ui.touch-punch.js"></script>
		<script src="assets/vendor/jquery-appear/jquery.appear.js"></script>
		<script src="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
		<script src="assets/vendor/jquery-easypiechart/jquery.easypiechart.js"></script>
		<script src="assets/vendor/flot/jquery.flot.js"></script>
		<script src="assets/vendor/flot-tooltip/jquery.flot.tooltip.js"></script>
		<script src="assets/vendor/flot/jquery.flot.pie.js"></script>
		<script src="assets/vendor/flot/jquery.flot.categories.js"></script>
		<script src="assets/vendor/flot/jquery.flot.resize.js"></script>
		<script src="assets/vendor/jquery-sparkline/jquery.sparkline.js"></script>
		<script src="assets/vendor/raphael/raphael.js"></script>
		<script src="assets/vendor/morris/morris.js"></script>
		<script src="assets/vendor/gauge/gauge.js"></script>
		<script src="assets/vendor/snap-svg/snap.svg.js"></script>
		<script src="assets/vendor/liquid-meter/liquid.meter.js"></script>
		<script src="assets/vendor/jqvmap/jquery.vmap.js"></script>
		<script src="assets/vendor/jqvmap/data/jquery.vmap.sampledata.js"></script>
		<script src="assets/vendor/jqvmap/maps/jquery.vmap.world.js"></script>
		<script src="assets/vendor/jqvmap/maps/continents/jquery.vmap.africa.js"></script>
		<script src="assets/vendor/jqvmap/maps/continents/jquery.vmap.asia.js"></script>
		<script src="assets/vendor/jqvmap/maps/continents/jquery.vmap.australia.js"></script>
		<script src="assets/vendor/jqvmap/maps/continents/jquery.vmap.europe.js"></script>
		<script src="assets/vendor/jqvmap/maps/continents/jquery.vmap.north-america.js"></script>
		<script src="assets/vendor/jqvmap/maps/continents/jquery.vmap.south-america.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="assets/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="assets/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="assets/javascripts/theme.init.js"></script>


		<!-- Examples -->
		<script src="assets/javascripts/dashboard/examples.dashboard.js"></script>
</body>
</html>