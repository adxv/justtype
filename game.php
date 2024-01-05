<?php


session_start();
include "dbconnect.php";
if (isset($_SESSION['username'])) {
    $user = $_SESSION['username'];

    //get current highscore of user
    $sql = "SELECT highscore FROM users WHERE username='$user'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['highscore'] = $row['highscore'];
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

if (isset($_SESSION['id']) && isset($_SESSION['username'])) {
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Just Type.</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">
    <script src="./js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/78bff20619.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/typed.js@2.0.16/dist/typed.umd.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="container">
        <div class="center">
            <div class="row">
                <div id="warning" style="text-align:center;">
                    <span class="subtext">Warning: This page may not be compatible with small screens.</span>
                </div>
            </div>
            <div class="row" style="margin-bottom: 1rem;">
                <div class="col-4">
                    <div class="text" id="timer"></div>
                </div>
                <div class="col-8">
                    <span class="title" id="element"></span>
                </div>
            </div>
            <div class="row" style="margin-bottom: 9rem;">
                <div class="col">
                    <input class="gameFieldClass" type="text" id="gameField" oninput="checkInput()"
                        style="position: absolute; z-index: 2;">
                    <div class="text" id="game-messages" style="position: absolute; z-index: 1;"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <button class="button p-0 act" onclick="location.reload();"><i class="fa-solid fa-arrows-rotate"></i></button>
                    <button class="button act" id="toggleGamemode"></button>
                    <a class="button act" href="https://github.com/adxv/justtype" target="_blank"><i class="button git fa-brands fa-github" style="color: #f5f5f5;"></i></a>
                </div>
                <div class="col-8">
                    <span class="subtext" style="margin-right:5rem;">user: <?php echo $_SESSION['username']; ?></span><span class="subtext">highest WPM: <?php echo $_SESSION['highscore']; ?></span>
                </div>
                <div class="col-1" style="text-align: right;">
                    <a class="button act m-0" href="logout.php"><i class="fa-solid fa-right-from-bracket" style="color: #f5f5f5;"></i></a>
                </div>
                <span class="subtext" id="gameovertext"></span>
            </div>
            <div class="row">
                <div class="col" onclick="scrollToTable()" style="text-align:center; margin-top: 10rem;">
                    <i class="fa-solid fa-angle-down" style="color: #f5f5f5; font-size: 2.5rem; text-shadow: 1px 3px 3px rgba(0,0,0,0.31);"></i>
                        <span class="leaderboardtext">Scroll for Leaderboard</span>
                    <i class="fa-solid fa-angle-down" style="color: #f5f5f5; font-size: 2.5rem; text-shadow: 1px 3px 3px rgba(0,0,0,0.31);"></i>
                </div>
            </div>
            <div class="row">
                <div class="leaderboard" id="tableId">
                <?php
                    include "dbconnect.php";
                    $sql = "SELECT * FROM users";
                    $result = mysqli_query($conn, $sql);
                    if ($result) {
                        echo '<table>';
                        echo '<tr><th>Username</th><th>Highest WPM</th><th>Playcount</th><th>Games Started</th><th>True Total Words Typed</th></tr>';
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr>';
                            echo '<td>' . htmlspecialchars($row['username']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['highscore']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['playcount']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['startcount']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['wordstyped']) . '</td>';
                            echo '</tr>';
                        }
                        echo '</table>';
                    } else {
                        echo "Error: " . mysqli_error($conn);
                    }
                ?>

                </div>
            </div>
        </div>
    </div>
    <script src="./js/words.js"></script>
    <script src="./js/poems.js"></script>
    <script src="./js/typist.js"></script>
</body>

</html>

<?php
}else{
    header("Location: index.php");
    exit(); 
}
?>