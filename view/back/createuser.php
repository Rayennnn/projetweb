<?php
include 'C:\xampp\htdocs\parcouri\db.php';
include 'C:\xampp\htdocs\parcouri\model\user.php';
include 'C:\xampp\htdocs\parcouri\controller\usercontroller.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userController = new UserController($pdo);

    // Handle file upload for photo
    $photo = null;
    if (!empty($_FILES['photo']['name'])) {
        $photo = 'uploads/' . basename($_FILES['photo']['name']);
        move_uploaded_file($_FILES['photo']['tmp_name'], $photo);
    }

    // Create a new user object
    $user = new User(
        null, // ID is auto-incremented
        $_POST['name'], 
        $_POST['last_name'], 
        $_POST['email'], 
        password_hash($_POST['password'], PASSWORD_BCRYPT), // Hash the password
        $_POST['role'], 
        $_POST['status_compte'], 
        $photo, 
        $_POST['fac'], 
        $_POST['domaine']
    );

    // Save the user in the database
    $userController->createUser($user);
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create User</title>
    <script>
        // Client-side input validation
        function validateForm() {
            const name = document.forms["userForm"]["name"].value.trim();
            const lastName = document.forms["userForm"]["last_name"].value.trim();
            const email = document.forms["userForm"]["email"].value.trim();
            const password = document.forms["userForm"]["password"].value;
            const confirmPassword = document.forms["userForm"]["confirm_password"].value;

            if (name === "" || lastName === "" || email === "" || password === "") {
                alert("All required fields must be filled out.");
                return false;
            }

            if (password !== confirmPassword) {
                alert("Passwords do not match.");
                return false;
            }

            return true;
        }
    </script>
</head>
<body>
    <h2>Create User</h2>
 
</body>
</html>
<form>
							<div class="form-group mb-lg">
								<label>Name</label>
								<input name="name" type="text" />
							</div>

							<div class="form-group mb-lg">
								<label>E-mail Address</label>
								<input name="email" type="email" class="form-control input-lg" />
							</div>

							<div class="form-group mb-none">
								<div class="row">
									<div class="col-sm-6 mb-lg">
										<label>Password</label>
										<input name="pwd" type="password" class="form-control input-lg" />
									</div>
									<div class="col-sm-6 mb-lg">
										<label>Password Confirmation</label>
										<input name="pwd_confirm" type="password" class="form-control input-lg" />
									</div>
								</div>
							</div>

						

						</form>