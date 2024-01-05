<!DOCTYPE html>
<html lang="en">

<head>
    <title>Signup</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/login.css" rel="stylesheet">
    <script src="./js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/78bff20619.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/typed.js@2.0.16/dist/typed.umd.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    
    <div class="container">
        <div class="center">
            <form action="signup-check.php" method="post">
                <label class="text">
                    signup
                </label><br>
                <?php if (isset($_GET['error'])) { ?>
                    <p class="error"><?php echo $_GET['error']; ?> </p>
                <?php } ?>
                
                <?php if (isset($_GET['success'])) { ?>
                    <p class="success"><?php echo $_GET['success']; ?> </p>
                <?php } ?>

                <input class="loginfield subtext" type="text" name="username" placeholder="username"><br>
                <input class="loginfield subtext" type="password" name="password" placeholder="password"><br>
                <input class="loginfield subtext" type="password" name="repassword" placeholder="repeat password"><br>
                <button class="button act m-0" type="submit">Sign Up</button>
                <input type="button" class="button act m-0" onclick="window.location.href='index.php';" value="Have an account?" />
            </form>
        </div>
    </div>
    
    <script src="./js/words.js"></script>
    <script src="./js/poems.js"></script>
    <script src="./js/typist.js"></script>
</body>

</html>