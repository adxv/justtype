<?php
session_start();
include "dbconnect.php";
if (isset($_POST['username']) && isset($_POST['password'])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $user = validate($_POST['username']);
    $pass = validate($_POST['password']);

    if (empty($user)) {
        header("Location: index.php?error=invalid username or password");
        exit();
    } else if (empty($pass)) {
        header("Location: index.php?error=invalid username or password");
        exit();
    } else {
        $pass = md5($pass);
        
        $sql = "SELECT * FROM users WHERE username='$user' AND password='$pass'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);

            if ($row['username'] === $user && $row['password'] === $pass) {
                $_SESSION['username'] = $row['username'];
                $_SESSION['id'] = $row['id'];
                $_SESSION['highscore'] = $row['highscore'];
                $_SESSION['playcount'] = $row['playcount'];
                $_SESSION['wordstyped'] = $row['wordstyped'];
                header("Location: game.php");
                exit();
            } else {
                header("Location: index.php?error=incorrect username or password");
                exit();
            }   
        } else {
            header("Location: index.php?error=incorrect username or password");
            exit();
        }
    }


} else {
    header("Location: index.php");
    exit();
}
?>