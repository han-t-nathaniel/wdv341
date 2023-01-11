<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content ="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Hello World!</title>
        <script>
            <?php
                echo "let firstName='Mary';";
            ?>
            console.log("The First Name is: " + firstName);

            let lastName = <?php echo "'Smith'"; ?>;
            console.log("The Last Name is: " + lastName);

            <?php
                $city = "Ankeny";
            ?>
            console.log("The City is: " + <?php echo "'$city'"; ?>);
        </script>
    </head>
    <body>
        <h1>WDV341 Intro PHP</h1>
        <h2>Hello World</h2>
        <h3>PHP code embedded below this heading.</h3>
        <?php
            echo "<p>Hello World!</p>";
            echo "<h1>All your base are belong to us.</h1>";
            echo "<ol>
                    <li>Line 1</li>
                    <li>Line 2</li>
                </ol>";
            echo "<div>Empty Div</div>";
        ?>
        <h3>Welcome back, <?php echo "Nathaniel"; ?>.</h3>
    </body>
</html>