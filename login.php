<?php
    session_start();

    $isUserValid = false;
    $invalidLoginErrorMessage = "";

    if (isset($_SESSION['isUserValid'])) {
        $isUserValid = $_SESSION['isUserValid'];
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        require_once(__DIR__ . "/exceptionHandlers.php");
        // Connect to the database. Contains a Connection object called $connection.
        require_once(__DIR__ . "/dbConnect.php");

        $inUserName = $_POST['inUserName'];
        $inPassword = $_POST['inPassword'];

        $sql = "SELECT event_user_username, event_user_password FROM event_users WHERE event_user_username=:username AND event_user_password=:password";

        try {
            $stmt = $connection->prepare($sql);
        } catch (PDOException $e) {
            handleConnectionException($connection, $e);
        }

        $stmt->bindParam(":username", $inUserName);
        $stmt->bindParam(":password", $inPassword);

        try {
            $stmt->execute();
        } catch (PDOException $e) {
            handleStatementException($stmt, $e);
        }

        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        if ($row = $stmt->fetch()) {
            $isUserValid = true;
            $_SESSION['isUserValid'] = true;
            $_SESSION['username'] = $inUserName;
        } else {
            $invalidLoginErrorMessage = "Invalid username or password!";
        }

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--
        Author: Nathaniel Gomez-Han
        Date: April 11 2023
    -->
    <meta http-equiv="X-UA-Compatible" content ="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WDV 341 | 13-1: Event Login</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" href="/favicon.ico" sizes="16x16 32x32"><!-- 32×32 -->
    <link rel="icon" href="/icon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png"><!-- 180×180 -->
    <link rel="manifest" href="/manifest.webmanifest">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost&family=Libre+Baskerville:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/bubbles.css">
    <script src="/js/bubbles.js"></script>
</head>
<body onload="themeLoad()">
<div class="body-bg"></div>
<nav>
    <div class="site-logo">
        <a href="/" aria-label="Return to the home page">
            <lottie-player role="img" aria-label="NGH logo" autoplay mode="normal" src="/img/ngh-logo.json"></lottie-player>
        </a>
    </div>
    <div class="nav-links">
        <a href="/">&lt; Back to Home</a>
    </div>
</nav>
<main>
    <h1>WDV 341 | 13-1 Event Login</h1>
    <?php
        if ($isUserValid) {
    ?>
            <h2>Welcome</h2>
            <p>You are signed in as: <?= $_SESSION['username'] ?>.</p>
            <p>Admin options are available to you:</p>
            <ul>
                <li>Enter new events</li>
                <li>Enter new event users</li>
                <li><a href="logout.php">Sign off</a></li>
            </ul>
    <?php
        } else {
    ?>
            <h2>Login Form</h2>
            <form method="post" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
                <p>
                    <label for="inUserName">Username: </label>
                    <input type="text" name="inUserName" id="inUserName" placeholder="Username">
                    <span class="error"><?= $invalidLoginErrorMessage ?></span>
                </p>
                <p>
                    <label for="inPassword">Password:</label>
                    <input type="password" name="inPassword" id="inPassword">
                </p>
                <p>
                    <input type="submit" name="submit" value="Log In">
                    <input type="reset" name="reset" value="Reset">
                </p>
            </form>
    <?php
        }
    ?>
</main>
</body>
</html>