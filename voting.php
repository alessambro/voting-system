<?php
require('connection.php'); // Include your database connection

// Check if candidates are set in the session
if (!isset($_SESSION['candidates']) || empty($_SESSION['candidates'])) {
    // Fetch candidates from the database
    $candidates_result = mysqli_query($conn, "SELECT * FROM candidates");
    $candidates = [];
    while ($row = mysqli_fetch_assoc($candidates_result)) {
        $candidates[] = $row['name'];
    }

    if (empty($candidates)) {
        echo "<h1 class='mx-3 mt-3'>No candidates available for voting.</h1>";
        echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">';
        echo '<form class="mx-3 mt-3" action="logout.php"><input class="btn btn-primary" type="submit" placeholder="Logout"></form>';
        exit();
    }

    // Store candidates in session for future use
    $_SESSION['candidates'] = $candidates;
}

// Initialize votes array in session if it doesn't exist
if (!isset($_SESSION['votes'])) {
    $_SESSION['votes'] = [];
}

// Handle voting
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['vote'])) {
    $candidate_name = $_POST['candidate_name'];

    // Check if the candidate is valid
    if (in_array($candidate_name, $_SESSION['candidates'])) {
        // Increment the vote count for the candidate in the database
        $query = "INSERT INTO votes (candidate_name) VALUES ('$candidate_name')";
        if (mysqli_query($conn, $query)) {
            $message = "Thank you for voting for " . htmlspecialchars($candidate_name) . "!";
        } else {
            $message = "Error recording vote: " . mysqli_error($conn);
        }
    } else {
        $message = "Invalid candidate selected.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voting Area</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container--1">
        <div class="container--2" id="containerTwo">
            <h1 class="text--1">Vote for Your Candidate</h1>

            <?php if (isset($message)): ?>
                <p><?php echo $message; ?></p>
            <?php endif; ?>

            <form method="POST">
                <h2>Select a Candidate</h2>
                <?php foreach ($_SESSION['candidates'] as $candidate): ?>
                    <div>
                        <input type="radio" id="<?php echo htmlspecialchars($candidate); ?>" name="candidate_name" value="<?php echo htmlspecialchars($candidate); ?>" required>
                        <label for="<?php echo htmlspecialchars($candidate); ?>"><?php echo htmlspecialchars($candidate); ?></label>
                    </div>
                <?php endforeach; ?>
                <input id="vote-button" type="submit" name="vote" value="Vote" class="btn--1">
            </form>
        </div>


        <div class="con-btn">
            <form method="POST" action="logout.php">
                <a href="login.php"><input type="submit" value="Logout" class="btn--1"></a>
            </form>
        </div>
    </div>
    <script src="script.js"></script>
    <script src="voting.js"></script>
</body>

</html>

<?php include('closeconnection.php'); ?>