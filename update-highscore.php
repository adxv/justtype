<?php
include "dbconnect.php";
session_start();
if (isset($_SESSION['username']) && isset($_POST['newScore'])) {
    $user = $_SESSION['username'];
    $newScore = $_POST['newScore'];

    // Get the current highscore from the database
    $sql = "SELECT highscore FROM users WHERE username='$user'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $currentHighscore = $row['highscore'];

    // Check if the new score is higher than the current highscore
    if ($newScore > $currentHighscore) {
        // Update the highscore in the database
        $sql = "UPDATE users SET highscore=$newScore WHERE username='$user'";
        mysqli_query($conn, $sql);
    }
}
?>
