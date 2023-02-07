<?php
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];

echo "First Name: $firstName";
echo "Last Name: $lastName";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8"></meta>
        <!--
            Author: Nathaniel Han
            Date: January 31 2023
        -->
        <meta http-equiv="X-UA-Compatible" content ="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>4-1: PHP Functions</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Jost&family=Libre+Baskerville:wght@400;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="/css/bubbles.css">
        <script>
            let languages = <?php echo $languagesArrayJS; ?>
        </script>
    </head>
    <body>
        <div class="body-bg"></div>
        <nav>
            <div class="site-logo">
            <a href="/">
                <object type="image/svg+xml" data="/img/ngh-logo-white.svg"></object>
            </a>
            </div>
            <div class="nav-links">
                <a href="../wdv341.php">&lt; Back</a>
            </div>
        </nav>
        <main>
            <h1>Your form has been processed on the server!</h1>
            <h2>Confirmation Page!</h2>
            <p>You entered the following information:</p>
            <p>First Name: <?php echo $firstName ?></p>
            <p>Last Name: <?php echo $lastName ?></p>
        </main>
    </body>
</html>