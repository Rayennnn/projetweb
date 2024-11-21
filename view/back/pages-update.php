<?php
include 'C:\xampp\htdocs\parcouri\db.php';
include 'C:\xampp\htdocs\parcouri\controller\usercontroller.php';

$controller = new UserController($pdo);
$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: index.php");
    exit;
}

$user = $controller->getUserById($id);
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    if ($controller->updateUser($id, $name, $lastName, $email, $role)) {
        header("Location: listuser.php");
        exit;
    } else {
        $error = "Failed to update user.";
    }
}
?>
<!doctype html>
<html class="fixed">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">

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

		<!-- Theme CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="assets/stylesheets/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme-custom.css">

		<!-- Head Libs -->
		<script src="assets/vendor/modernizr/modernizr.js"></script>

	</head>
	<body>
		<!-- start: page -->
		<section class="body-sign">
			<div class="center-sign">
				<a href="/" class="logo pull-left">
					<img src="assets/images/logo.png" height="54" alt="Porto Admin" />
				</a>

				<div class="panel panel-sign">
					<div class="panel-title-sign mt-xl text-right">
						<h2 class="title text-uppercase text-bold m-none"><i class="fa fa-user mr-xs"></i> Sign Up</h2>
					</div>
					<div class="panel-body">
					<?php if ($error): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
					<form name="userForm" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
    <div class="form-group mb-lg">
        <label for="name">Name:</label>
        <input type="text" name="name"  class="form-control input-lg" value="<?= htmlspecialchars($user->getName()) ?>" required><br>
        </div>

        <div class="form-group mb-lg">
        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name"  class="form-control input-lg" value="<?= htmlspecialchars($user->getLastName()) ?>" required><br>
        </div>

        <div class="form-group mb-lg">
        <label for="email">Email:</label>
        <input type="email" name="email"  class="form-control input-lg"   value="<?= htmlspecialchars($user->getEmail()) ?>" required><br>
        </div>
        <div class="form-group mb-lg">
        <label for="role">Role:</label>
        <input type="number" name="role" class="form-control input-lg" value="<?= htmlspecialchars($user->getRole()) ?>" required><br>
        </div>

        <div class="form-group mb-lg">
        <label for="status_compte">Status Compte:</label>
        <input type="number" name="status_compte"  class="form-control input-lg" ><br>
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
						
								</div>
								<div class="col-sm-4 text-right">
									<button type="submit" class="btn btn-primary hidden-xs">update</button>
									<button type="submit" class="btn btn-primary btn-block btn-lg visible-xs mt-lg" value="Create User">Sign Up</button>
								</div>
							</div>

						
    </form>
					</div>
				</div>

				<p class="text-center text-muted mt-md mb-md">&copy; Copyright 2018. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>
			</div>
		</section>
		<!-- end: page -->

		<!-- Vendor -->
		<script src="assets/vendor/jquery/jquery.js"></script>
		<script src="assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="assets/vendor/bootstrap/js/bootstrap.js"></script>
		<script src="assets/vendor/nanoscroller/nanoscroller.js"></script>
		<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="assets/vendor/magnific-popup/magnific-popup.js"></script>
		<script src="assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="assets/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="assets/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="assets/javascripts/theme.init.js"></script>

	</body>
</html>