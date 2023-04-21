<?php
    session_start();

    $isUserValid = false;

    if (isset($_SESSION['isUserValid'])) {
        $isUserValid = $_SESSION['isUserValid'];
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <!--
            Author: Nathaniel Gomez-Han
            Date: April 12 2023
        -->
        <meta http-equiv="X-UA-Compatible" content ="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Nathaniel's WDV341 Homework Page</title>
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
			    <a href="contact.php">Contact Me</a>
                <?php
                if ($isUserValid) {
                    ?>
                    <a href="login.php">Admin</a>
                    <a href="logout.php">Log Out</a>
                    <?php
                } else {
                    ?>
                    <a href="login.php">Log In</a>
                    <?php
                }
                ?>
            </div>
        </nav>
        <main>
            <h1>WDV 341 Homework Links</h1>
            <h2>Assignments:</h2>
            <ul>
                <li><a href="unit-2/git-terms.html">2-1: Download Git Client & Create a Repository Account (Research and Define Git Terms)</a></li>
                <li><a href="unit-3/php-basics.php">3-1: PHP Basics</a></li>
                <li><a href="unit-4/php-functions.php">4-1: PHP Functions</a></li>
                <li><a href="unit-5/WDV101-DemonstrateInputForm.html">5-1: HTML Form Processor</a></li>
                <li><a href="unit-7/selectEvents.php">7-1: Create selectEvents.php</a></li>
                <li><a href="unit-7/selectOneEvent.php">7-2: Create selectOneEvent.php</a></li>
                <li><a href="unit-9/deliverEventObject.php">9-1: PHP-JSON Event Object</a></li>
                <li><a href="unit-5/WDV101-DemonstrateInputForm.html">10-1: Protect Form Processors Part 1 - Updated Assignment 5-1</a></li>
                <li><a href="wdv341/contact.php">10-1: Protect Form Processors Part 2 - Updated E-mail Form</a></li>
                <li><a href="events/add-event.php">12-1: Create a form page for the events</a></li>
                <li><a href="login.php">13-2: Create a login.php page</a></li>
                <li><a href="logout.php">13-3: Create a logout.php page</a></li>
                <li><a href="login.php">14-1: Protect your dynamic pages</a></li>
            </ul>

            <h2>Projects:</h2>
            <ul>
                <li><a href="wdv341/contact.php">Contact Form with E-mail</a></li>
            </ul>
        </main>
    </body>
</html>