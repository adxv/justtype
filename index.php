<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/login.css" rel="stylesheet">
    <script src="./js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/78bff20619.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    
    <div class="container">
        <div class="center">
            <form action="login.php" method="post">
                <label class="text">
                welcome
                </label><br>
                <?php if (isset($_GET['error'])) { ?>
                    <p class="error"><?php echo $_GET['error']; ?> </p>
                <?php } ?>
                <input class="loginfield subtext" type="text" name="username" placeholder="username"><br>
                <input class="loginfield subtext" type="password" name="password" placeholder="password"><br>
                <button class="button act m-0" type="submit">Login</button>
                <input type="button" class="button act m-0" onclick="window.location.href='signup.php';" value="Sign Up" />
            </form>
        </div>
    </div>
</body>

</html>