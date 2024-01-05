<?php
include "dbconnect.php";
session_start();
if (isset($_SESSION['username'])) {
    $user = $_SESSION['username'];
    
    //increment
    $sql = "UPDATE users SET wordstyped = wordstyped + 1 WHERE username='$user'";
    mysqli_query($conn, $sql);
}
?>