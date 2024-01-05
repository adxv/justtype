<?php
session_start();
include "dbconnect.php";
if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['repassword'])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $user = validate($_POST['username']);
    $pass = validate($_POST['password']);
    $repass = validate($_POST['repassword']);

    $missing_data = 'uname='. $user;

    if (empty($user)) {
        header("Location: signup.php?error=username is required.&$missing_data");
        exit();
    } else if (empty($pass)) {
        header("Location: signup.php?error=password is required&$missing_data");
        exit();
    }
    else if (empty($repass)) {
        header("Location: signup.php?error=repeated password is required&$missing_data");
        exit();
    }
    else if ($pass !== $repass) {
        header("Location: signup.php?error=the passwords do not match&$missing_data");
        exit();
    }
    else if (strlen($pass) < 5) {
        header("Location: signup.php?error=the password must be 5 or more characters&$missing_data");
        exit();
    }
    else {

        $pass = md5($pass);

        $sql = "SELECT * FROM users WHERE username='$user' ";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
        
        header("Location: signup.php?error=the selected username is already taken&$missing_data");
        exit();
        }else{
            $sql2 = "INSERT INTO users(username, password) VALUES('$user','$pass')";
            $result2 = mysqli_query($conn, $sql2);
            if($result2) {
                header("Location: index.php?success=account created");
                exit();
            }else{
                header("Location: signup.php?error=an unknown error occured&$missing_data");
                exit();

            }
        }
    }


} else {
    header("Location: signup.php");
    exit();
}
?>