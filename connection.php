<?php
// Connection credentials
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'voting_system';

// Create connection
$conn = mysqli_connect($host, $user, $pass);

// Check connection
if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}

// Select database
$db_select = mysqli_select_db($conn, $dbname);
if (!$db_select) {
    die('Database selection failed: ' . mysqli_error($conn));
}
