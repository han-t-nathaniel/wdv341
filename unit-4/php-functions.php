<?php
    /**
     * Format a timestamp as a string in the "mm/dd/yyyy" format.
     * @param $inTimestamp A unix Timecode;
     * @return string
     */
    function formatTimestampMDY($inTimestamp) {
        $date = new DateTime();
        $date->setTimestamp($inTimestamp);
        return $date->format("m/d/Y");
    }

     /**
     * Format a timestamp as a string in the "dd/mm/yyyy" format.
     * @param $inTimestamp 
     * @return string
     */
    function formatTimestampDMY($inTimestamp) {
        $date = new DateTime();
        $date->setTimestamp($inTimestamp);
        return $date->format("d/m/Y");
    }

    /**
     * This function will:
     *  1. Display the number of characters in the string.
     *  2. Trim any leading or trailing whitespace.
     *  3. Display the string as all lowercase characters.
     *  4. Will display whether or not the string contains "DMACC" either upper or lowercase.
     * @param $inString 
     * @return string
     */
    function processString($inString) {
        global $charCountBefore, $charCountAfter, $containsDMACCString, $stringResult;
        $charCountBefore = strlen($inString);
        $stringResult = strtolower(trim($inString));
        $charCountAfter = strlen($stringResult);
        $containsDMACC = strpos($stringResult, "dmacc");
        $containsDMACCString = $containsDMACC ? "Yes" : "No";
    }

    /**
     * Format a number as a string styled like a phone number.
     * @param $inNumber 
     * @return string
     */
    function formatPhoneNumber($inNumber) {
        return '('.substr($inNumber, 0, 3).') '.substr($inNumber, 3, 3).'-'.substr($inNumber,6);
    }

    /**
     * Format a number as a string styled like US currency with a dollar sign.
     * @param $inNumber 
     * @return string
     */
    function formatUSCurrency($inNumber) {
        $formatter = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
        return $formatter->formatCurrency($inNumber, 'USD');
    }

    // Set the default values for the form input and output.
    $stringInputValue = "     Enter a string! wElcOMe tO dMAcC ";
    $charCountBefore = "";
    $charCountAfter = "";
    $stringResult = "";
    $containsDMACCString = "";

    $inPhone = 1234567890;
    $inCurrency = 123456 ;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get form input.
        $stringInputValue = $_POST["string-input"];
    }

    processString($stringInputValue);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8"></meta>
        <!--
            Author: Nathaniel Han
            Date: January 30 2023
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
            <h1>WDV 341 | 4-1: PHP Functions</h1>
            <div>
                <dl>
                    <dt>1. The formatTimestampMDY() takes a timestamp and formats it into mm/dd/yyyy format.</dt>
                    <dd>
                        Input: <?php echo time(); ?><br>
                        Result: <?php echo formatTimestampMDY(time()); ?>
                    </dd>
                    <dt>2. The formatTimestampDMY() function takes a timestamp and formats it into dd/mm/yyyy format.</dt>
                    <dd>
                        Input: <?php echo time(); ?><br>
                        Result: <?php echo formatTimestampDMY(time()); ?>
                    </dd>
                    <dt>
                        3. The processString() function will:
                        <ol>
                            <li>Display the number of characters in the string.</li>
                            <li>Trim any leading or trailing whitespace.</li>
                            <li>Display the string as all lowercase characters.</li>
                            <li>Will display whether or not the string contains "DMACC" either upper or lowercase.</li>
                        </ol>
                    </dt>
                    <dd>
                        <p>
                            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                <input type="text" name="string-input" size="50" value="<?php echo $stringInputValue; ?>">
                                <input type="submit" value="Submit">
                            </form>
                            <strong># of characters before:</strong> <?php echo $charCountBefore; ?><br>
                            <strong># of characters after:</strong> <?php echo $charCountAfter; ?><br>
                            <strong>Contains "DMACC":</strong> <?php echo $containsDMACCString; ?><br>
                            <strong>Result:</strong> <?php echo $stringResult; ?>
                        </p>
                    </dd>
                    <dt>4. The formatPhoneNumber() function takes a number and formats it as a phone number.</dt>
                    <dd>
                        Input: <?php echo $inPhone; ?><br>
                        Result: <?php echo formatPhoneNumber($inPhone); ?>
                    </dd>
                    <dt>5. The formatUSCurrency() function takes a number and formats it as US currency with a dollar sign.</dt>
                    <dd>
                        Input: <?php echo $inCurrency; ?><br>
                        Result: <?php echo formatUSCurrency($inCurrency); ?>
                    </dd>
                </dl>
            </div>
        </main>
    </body>
</html>