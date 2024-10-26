<?php
session_start();
require("connection.php");

// Check if the user is already logged in
if (isset($_COOKIE['email'])) {
    header("location: voting.php");
    exit(); // Ensure no further code is executed
}

if (isset($_POST['submit_btn'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Ensure email is escaped to prevent SQL injection
    $email = mysqli_real_escape_string($conn, $email);

    // Query to check for valid email and password
    $query = "SELECT * FROM vsusers 
              INNER JOIN vsaccounts ON vsusers.id_users = vsaccounts.id_users 
              WHERE vsaccounts.email = '$email' AND vsaccounts.password = '$password'";

    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        // User found
        setcookie('email', $email, time() + 1000000); // Create a Cookie
        header('location: voting.php');
        exit();
    } else {
        echo "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voting System</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container--1">
        <button class="btn--1 btn-2" id="btn2" onclick="change()">Admin</button>
        <h1 class="text--1">Voting System</h1>
        <div class="box-1">
            <form action="" method="POST" class="form--1"> <!-- Added method attribute -->
                <label for="">Email:</label>
                <input type="text" class="input--1" name="email" placeholder="Enter Email" required>
                <label for="">Password:</label>
                <input type="password" class="input--1" name="password" placeholder="Enter Password" required>
                <div class="con-btn">
                    <input type="submit" name="submit_btn" value="Login" class="btn--1">
                    <p class="p--1">Doesn't Have an account yet? <span><a href="" data-bs-toggle="modal" data-bs-target="#exampleModal" class="reg--1">Register</a></span></p>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Register</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <?php require('register.php'); ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>