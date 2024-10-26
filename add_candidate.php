<?php
session_start();
require("connection.php");

if (isset($_POST['candidate_name'])) {
    $candidate_name = $_POST['candidate_name'];
    $query = "INSERT INTO candidates (name) VALUES ('$candidate_name')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "Candidate added successfully.";
        header('location: dashboard.php');
        exit();
    } else {
        echo "Error adding candidate: " . mysqli_error($conn);
    }
}
