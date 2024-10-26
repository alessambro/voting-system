<?php
// Start session and include database connection
session_start();
require("connection.php");

// Handle deletion of a candidate
if (isset($_POST['delete_candidate'])) {
    $candidate_id = $_POST['candidate_id']; // Get the ID of the candidate to delete
    $query = "DELETE FROM candidates WHERE id = $candidate_id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "Candidate deleted successfully.";
    } else {
        echo "Error deleting candidate: " . mysqli_error($conn);
    }
}

// Fetch candidates to display
$query = "SELECT * FROM candidates";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-4">
        <h1>Admin Dashboard</h1>

        <!-- Form to Add a Candidate -->
        <h3>Add Candidate</h3>
        <form action="add_candidate.php" method="POST">
            <input type="text" name="candidate_name" placeholder="Enter Candidate Name" required>
            <input type="submit" value="Add Candidate" class="btn btn-primary">
        </form>

        <!-- Candidates List -->
        <h3>Candidates List</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Loop through and display all candidates
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>
                        <form method='POST' action='dashboard.php'>
                            <input type='hidden' name='candidate_id' value='" . $row['id'] . "' />
                            <input type='submit' name='delete_candidate' value='Delete' class='btn btn-danger'>
                        </form>
                    </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        <h2>Current Vote Counts</h2>
        <ul>
            <?php
            // Fetch and display vote counts from the database
            $vote_counts_result = mysqli_query($conn, "SELECT candidate_name, COUNT(*) as vote_count FROM votes GROUP BY candidate_name");
            while ($row = mysqli_fetch_assoc($vote_counts_result)) {
                echo "<li>" . htmlspecialchars($row['candidate_name']) . ": " . $row['vote_count'] . " votes</li>";
            }
            ?>
        </ul>

        <div class="for--btn--1">
            <form action="logout.php">
                <a href="admin.php"><button class="btn btn-primary">Logout</button></a>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>