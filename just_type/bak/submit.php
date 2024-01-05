<?php
// connect to your database
include('connect.php');

// get the score and username from the AJAX request
$username = $_POST['username'];
$score = $_POST['score'];

// SQL query to insert the score into the database
$sql = "INSERT INTO leaderboard (username, score) VALUES ('$username', '$score')";

// execute the SQL query
if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

// close the database connection
$conn->close();
?>
