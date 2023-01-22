<?php
    $yourName = "Nathaniel Gomez-Han";
    $yourNameH1 = '<h1>' . $yourName . '</h1>';

    $number1 = 525600;
    $number2 = 123456;
    $total = $number1 + $number2;
    $displayNumbersP =
        '<p>' .
            'number1: ' . $number1 . '<br>' .
            'number2: ' . $number2 . '<br>' .
            'total: ' . $total . 
        '</p>';

    $languages = ["PHP", "HTML", "Javascript"];
    $languagesArrayJS = '[';
    foreach ($languages as $language) {
        $languagesArrayJS .= '"' . $language . '", ';
    }
    $languagesArrayJS .= '];';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <!--
            Author: Nathaniel Han
            Date: January 21 2023
        -->
        <meta http-equiv="X-UA-Compatible" content ="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Nathaniel's WDV341 Homework Page</title>
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
            <div>
                <a href="/">
                        <object class="site-logo" type="image/svg+xml" data="/img/ngh-logo-white.svg"></object>
                </a>
            </div>
            <div>
                <a href="../wdv341.php">&lt; Back</a>
            </div>
        </nav>
        <main>
            <?php echo $yourNameH1; ?>
            <h2><?php echo $yourName; ?></h2>
            <?php echo $displayNumbersP; ?>
            <script>
                document.write("<p>");
                for (let i = 0; i < (languages.length - 1); i++) {
                    document.write(languages[i] + ", ");
                }
                document.write(languages[languages.length - 1] + "</p>");
            </script>
        </main>
    </body>
</html>