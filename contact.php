<?php
    session_start();

    $isUserValid = false;
    $invalidLoginErrorMessage = "";

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
        <title>Contact Nathaniel Gomez-Han</title>
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
        <script src="https://www.google.com/recaptcha/api.js"></script>
        <script>
            function onSubmit(token) {
                document.getElementById("contact-form").submit();
            }
        </script>
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
			    <a href="wdv341.php">&lt; WDV 341</a>
			    <a href="contact.php">Contact Me</a>
                <?php
                    if ($isUserValid) {
                ?>
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
            <h1>Contact Me</h1>
            <form id="contact-form" class="theme-form" name="contact-form" method="post" action="formHandler.php">
                <p>
                    <label for="contact-name">Name: </label><br>
                    <input type="text" id="contact-name" name="contact-name" required>
                </p>
                <p>
                    <label for="contact-email">E-mail: </label><br>
                    <input type="email" id="contact-email" name="contact-email" required>
                </p>
                <p>
                    <label for="contact-reason">Reason for Contact: </label><br>
                    <select id="contact-reason" name="contact-reason" required>
                        <option value="" selected disabled>Select a subject matter</option>
                        <option value="web-design">Let's build a website</option>
                        <option value="graphic-design">Design me a logo or graphic</option>
                        <option value="question">I have a question</option>
                        <option value="other">Other</option>
                    </select>
                </p>
                <p>
                    <label for="contact-message">Message: </label><br>
                    <textarea id="contact-message" name="contact-message" rows="6"></textarea>
                </p>
                <p>
                    <button id="contact-send" class="bubble-button g-recaptcha" type="submit"
                        name="contact-send" form="contact-form" value="Submit"
                        data-sitekey="6Lcl0SMlAAAAANodz-IF2r0Mu8biO7I3CGjPJs3C" 
                        data-callback='onSubmit' 
                        data-action='submit'>Send</button>
                    <button id="contact-send" class="bubble-button" name="contact-reset" type="reset" form="contact-form" value="Reset">Reset</button>
                </p>
            </form>
        </main>
    </body>
</html>