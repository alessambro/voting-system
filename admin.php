<?php
session_start();

// Handle logout
if (isset($_POST['logout'])) {
    session_destroy(); // Destroy the session
    header("Location: admin.php"); // Redirect to the login page
    exit();
}

// Hardcoded admin credentials
$admin_username = 'admin';
$admin_password = 'admin';

// Check if the admin is already logged in
if (isset($_SESSION['admin_logged_in'])) {
    header("Location: dashboard.php");
    exit();
}

// Handle login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate credentials
    if ($username === $admin_username && $password === $admin_password) {
        $_SESSION['admin_logged_in'] = true; // Set session variable
        header("Location: dashboard.php"); // Redirect to the admin dashboard
        exit();
    } else {
        $error_message = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container--1">
        <button class="btn--1 btn-2" id="btn3" onclick="changeTwo()">User</button>
        <h1 class="text--1">Admin Panel</h1>
        <?php if (isset($error_message)) : ?>
            <p style="color: red;"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <div class="box-1">
            <form action="" method="POST" class="form--1">
                <label for="">Username:</label>
                <input type="text" class="input--1" name="username" placeholder="Enter Username" required>
                <label for="">Password:</label>
                <input type="password" class="input--1" name="password" placeholder="Enter Password" required>
                <div class="con-btn">
                    <input type="submit" value="Login" class="btn--1">
                </div>
            </form>
        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>