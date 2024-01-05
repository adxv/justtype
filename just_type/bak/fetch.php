<?php
// connect to your database
include('connect.php');

// SQL query to get the top 10 scores
$sql = "SELECT username, score FROM leaderboard ORDER BY score DESC LIMIT 10";

// execute the SQL query
$result = $conn->query($sql);

// check if there are any results
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "username: " . $row["username"]. " - score: " . $row["score"]. "<br>";
  }
} else {
  echo "0 results";
}

// close the database connection
$conn->close();
?>
