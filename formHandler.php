<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form input.
	$contactName = $_POST["contact-name"];
	$contactEmail = $_POST["contact-email"];
	$contactReason = $_POST["contact-reason"];
	$contactMessage = $_POST["contact-message"];

    // This boolean stores whether or not an error has been encountered while validating the contact form input or sending the confirmation e-mail. 
    $contactError = false;

    // Validate the submitted e-mail.
    if (!filter_var($contactEmail, FILTER_VALIDATE_EMAIL)) {
        $contactError = true;
    }

    // Format the form data for e-mail display.
    $formattedName = htmlspecialchars($contactName);
    $formattedEmail = htmlspecialchars($contactEmail);
    $formattedMessage = nl2br(htmlspecialchars($contactMessage));

    $contactReasonNameMap = [
        "web-design"        => "Let's build a website",
        "graphic-design"    => "Design me a logo or graphic",
        "question"          => "I have a question",
    ];
    $formattedReason = $contactReasonNameMap[$contactReason];

    $formattedDate = date("m/d/Y");

    $headers = [];
    $headers[] = "From: Nathaniel Gomez-Han <contact@nthan.com>";
    $headers[] = "MIME-Version: 1.0";
    $headers[] = "Content-Type: text/html; charset=UTF-8";

    // Initialize variables for the page output.
    $h1Text = "";
    $confirmationMessage = "";

    // Send myself an e-mail with the submitted form data.
    if (!$contactError) {
        $subject = "\"Contact Me\" Form Submission";
        
        $message = <<<HTML
            <!DOCTYPE html>
            <html>
                <head>
                    <style>
                        body {
                            font-family: 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'Tahoma', sans-serif;
                        }

                        dt {
                            background: #193250;
                            color: white;
                            font-weight: bold;
                            padding-left: 5px;
                        }

                        dd {
                            border: solid 2px #193250;
                            margin-left: 0;
                            padding: 0.5em 0 0.5em 20px;
                        }
                    </style>
                </head>
                <body>
                <dl>
                    <dt>Date:</dt>
                    <dd>$formattedDate</dd>
                    <dt>Name:</dt>
                    <dd>$formattedName</dd>
                    <dt>E-mail:</dt>
                    <dd>$formattedEmail</dd>
                    <dt>Reason for Contact:</dt>
                    <dd>$formattedReason</dd>
                    <dt>Message:</dt>
                    <dd>$formattedMessage</dd>
                </dl>
                </body>
            </html>
            HTML;

        if (!mail("contact@nthan.com", $subject, $message, implode(PHP_EOL, $headers))) {
            $contactError = true;
        }
    }

    // Send the user a confirmation e-mail with a formatted copy of their submitted form data.
    // We check for errors again because we don't want to send the confirmation if we weren't able to send the form data as an e-mail the first time.
    if (!$contactError) {
        $subject = "Contact Confirmation";

        $message = <<<HTML
            <!DOCTYPE html>
            <html>
                <head>
                    <style>
                        body {
                            font-family: 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'Tahoma', sans-serif;
                        }

                        h1, h2, h3, h4, h5, h6 {
                            font-family: 'Georgia', 'Times', 'Times New Roman', serif;
                            margin: 0;
                        }
 
                        #nav {
                            padding: 0 20px;
                            display: flex;
                            justify-content: space-between;
                            height: 80px;
                            line-height: 80px;
                            background: #EC8413;
                        }
                        #nav .site-logo {
                            width: 80px;
                        }

                        #main {
                            padding: 0 20px;
                            padding-top: 2em;
                        }

                        table {
                            background: url('https://nthan.com/img/bubbles.png');
                            background-repeat: no-repeat;
                            width: 100%;
                        }
                        
                        #form-data-first-row {
                            border-radius: 5px 5px 0 0;
                        }

                        #form-data-last-row {
                            border-radius: 0 0 5px 5px;
                        }
                        
                        dt {
                            background: #EC8413;
                            color: white;
                            font-weight: bold;
                            padding-left: 5px;
                        }

                        dd {
                            border: solid 2px #EC8413;
                            margin-left: 0;
                            padding: 0.5em 0 0.5em 20px;
                        }

                        .solid-rule {
                            border: none;
                            border-top: 5px solid #EC8413;
                            border-radius: 5px;
                        }

                        #bubbles-bottom {
                            width: 100%;
                        }
                    </style>
                </head>
                <body>
                    <table>
                        <tr>
                            <td id="nav">
                                <div class="site-logo">
                                    <a href="https://nthan.com/wdv341" aria-label="Go to Nathaniel Gomez-Han's WDV341 Homework Page">
                                        <img src="https://nthan.com/img/ngh-logo.png" alt="NGH Logo" width="80">
                                    </a>
                                </div>
                             </td>
                        </tr>
                        <tr>
                            <td id="main">
                                <h1>Thanks for reaching out!</h1>
                                <p>
                                    I'll get back to you as soon as possible. Here is a copy of the information you submitted.
                                </p>
                                <hr class="solid-rule">
                                <dl id="form-data">
                                    <dt id="form-data-first-row">Date:</dt>
                                    <dd>$formattedDate</dd>
                                    <dt>Name:</dt>
                                    <dd>$formattedName</dd>
                                    <dt>E-mail:</dt>
                                    <dd>$formattedEmail</dd>
                                    <dt>Reason for Contact:</dt>
                                    <dd>$formattedReason</dd>
                                    <dt>Message:</dt>
                                    <dd id="form-data-last-row">$formattedMessage</dd>
                                </dl>
                            </td>
                        </tr>
                    </table>
                </body>
            </html>
            HTML;
        $headers = [];
        $headers[] = "From: Nathaniel Gomez-Han <contact@nthan.com>";
        $headers[] = "MIME-Version: 1.0";
        $headers[] = "Content-Type: text/html; charset=UTF-8";
        if (!mail($contactEmail, $subject, $message, implode(PHP_EOL, $headers))) {
            $contactError = true;
        }
    }

    if (!$contactError) {
        $h1Text = "Thanks for reaching out!";
        $confirmationMessage = "Your message has been sent. You will receive an e-mail confirmation with a copy of your message shortly.";
    } else {
        $h1Text = "Uh-oh";
        $confirmationMessage =
            "An error has occurred. Please make sure you've entered a valid e-mail and try again." .
            '<p><a href="contact.php"><button class="bubble-button">Go Back</button></a></p>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <!--
            Author: Nathaniel Han
            Date: February 9 2023
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
			    <a href="wdv341.php">&lt; Back</a>
			    <a href="contact.php">Contact Me</a>
            </div>
        </nav>
        <main>
            <h1><?= $h1Text ?></h1>
            <p>
                <?= $confirmationMessage ?>
            </p>
        </main>
    </body>
</html>