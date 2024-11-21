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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Update User</h1>
    <?php if ($error): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form action="" method="POST">
        <label for="name">First Name:</label>
        <input type="text" name="name" value="<?= htmlspecialchars($user->getName()) ?>" required>
        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" value="<?= htmlspecialchars($user->getLastName()) ?>" required>
        <label for="email">Email:</label>
        <input type="email" name="email" value="<?= htmlspecialchars($user->getEmail()) ?>" required>
        <label for="role">Role (1 = Admin, 0 = User):</label>
        <input type="number" name="role" value="<?= htmlspecialchars($user->getRole()) ?>" min="0" max="1" required>
        <button type="submit">Update</button>
    </form>
</body>
</html>
