<?php
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Insert into vsusers table
    $insert_user = mysqli_query(
        $conn,
        "INSERT INTO vsusers (first_name, last_name) VALUES('$first_name', '$last_name')"
    );

    if (!$insert_user) {
        die('User insert error: ' . mysqli_error($conn));
    }

    // Get the last inserted id for vsusers
    $id_users = mysqli_insert_id($conn);

    // Insert into vsaccounts table
    $insert_account = mysqli_query(
        $conn,
        "INSERT INTO vsaccounts (id_users, email, password) VALUES('$id_users', '$email', '$password')"
    );

    if (!$insert_account) {
        die('Account insert error: ' . mysqli_error($conn));
    } else {
        header("location: login.php?m=register");
        exit(); // Exit to prevent further execution
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="registration.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
        <div class="con">
            <div class="row">
                <div class="col"><input type="text" name="first_name" placeholder="First Name" required /></div>
                <div class="col"><input type="text" name="last_name" placeholder="Last Name" required /></div>
            </div>
            <div class="row aa">
                <div class="email--1"><input type="text" name="email" placeholder="Email" required /></div>
            </div>
            <div class=""><input type="text" name="password" placeholder="Password" required /></div>
            <div class="asd">
                <input class="btn btn-primary" type="submit" name="submit_btn" value="Register" />
            </div>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>

<?php include('closeconnection.php'); ?>