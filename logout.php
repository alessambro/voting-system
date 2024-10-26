<?php
session_start(); // Start the session


if (isset($_COOKIE['email'])) {
    setcookie('email', $_COOKIE['email'], time() - 1000000); //Deleting a Cookie
    header('location: login.php');
} else {
    header('location: login.php');
}

// Destroy the session
session_destroy();
// Redirect to the login page
header("Location: login.php");
exit();
