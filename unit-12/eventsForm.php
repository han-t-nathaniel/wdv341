<?php
    session_start();

    $isUserValid = false;
    $invalidLoginErrorMessage = "";

    if (isset($_SESSION['isUserValid'])) {
        $isUserValid = $_SESSION['isUserValid'];
    } else {
        header("Location: ../login.php");
    }

    $isFormRequested = false;
    $isFormSubmitted = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $isFormSubmitted = true;

        // Check the honeypot field.
        if (!empty($_POST["url"])) {
            die("Thank you for your submission!");
        }

        $inEventName = $_POST["inEventName"];
        $inEventDescription = $_POST["inEventDescription"];
        $inEventPresenter = $_POST["inEventPresenter"];
        $inEventDate = $_POST["inEventDate"];
        $inEventTime = $_POST["inEventTime"];

        $today = date("Y-m-d");

        require_once(__DIR__ . "/../exceptionHandlers.php");
        // Connect to the database. Creates a connection object called $connection.
        require_once(__DIR__ . "/../dbConnect.php");

        $sql = "
            INSERT INTO wdv341_events (name, description, presenter, date, time, date_inserted, date_updated)
            VALUES (:inEventName, :inEventDescription, :inEventPresenter, :inEventDate, :inEventTime, :today, :today)";

        // Execute the query statement
        try {
            $stmt = $connection->prepare($sql);
        } catch (PDOException $e) {
            handleConnectionException($connection, $e);
        }

        $stmt->bindParam(":inEventName", $inEventName);
        $stmt->bindParam(":inEventDescription", $inEventDescription);
        $stmt->bindParam(":inEventPresenter", $inEventPresenter);
        $stmt->bindParam(":inEventDate", $inEventDate);
        $stmt->bindParam(":inEventTime", $inEventTime);
        $stmt->bindParam(":today", $today);

        try {
            $stmt->execute();
        } catch (PDOException $e) {
            handleStatementException($stmt, $e);
        }
    } else {
        // Add event form
        $isFormRequested = true;
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
        <title>WDV 341 | 12-1: Create a form page for the events</title>
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
        <style>
            .form-row {
                width: 500px;
                display: flex;
                gap: 5px;
            }

            .form-row.row-2columns .form-column {
                flex: auto;
            }

            .form-row.row-2columns .form-column input {
                width: 100%;
            }
        </style>
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
                <a href="../wdv341.php">&lt; WDV 341</a>
                <a href="../contact.php">Contact Me</a>
                <?php
                    if ($isUserValid) {
                ?>
                    <a href="../logout.php">Log Out</a>
                <?php
                    } else {
                ?>
                    <a href="../login.php">Log In</a>
                <?php
                    }
                ?>
            </div>
        </nav>
        <main>
            <h1>WDV 341 | 12-1: Create a form page for the events</h1>
            <?php
                if ($isFormRequested) {
                // Display Input Event form.
            ?>
                <form id="add-event-form" class="theme-form" method="post" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
                    <h3>Event Input Form</h3>
                    <i class="required-field">* Required field</i>
                    <p class="hidden" aria-hidden="true">
                        <!-- Honeypot Field -->
                        <label for="input-url">Website URL:</label>
                        <input type="text" name="url" id="input-url" tabindex="-1" autocomplete="nope"/>
                    </p>
                    <p>
                        <label for="inEventName">Event Name: </label><span class="required-field">*</span><br/>
                        <input type="text" name="inEventName" id="inEventName" required>
                    </p>
                    <p>
                        <label for="inEventDescription">Description: </label><span class="required-field">*</span><br/>
                        <textarea name="inEventDescription" id="inEventDescription" rows="6"  required></textarea>
                    </p>
                    <p>
                        <label for="inEventPresenter">Presenter: </label><span class="required-field">*</span><br/>
                        <input type="text" name="inEventPresenter" id="inEventPresenter" required>
                    </p>
                    <div class="form-row row-2columns">
                        <div class="form-column">
                            <p>
                                <label for="inEventDate">Date: </label><span class="required-field">*</span><br/>
                                <input type="date" name="inEventDate" id="inEventDate" required>
                            </p>
                        </div>
                        <div class="form-column">
                            <p>
                                <label for="inEventTime">Time: </label><span class="required-field">*</span><br/>
                                <input type="time" name="inEventTime" id="inEventTime" required>
                            </p>
                        </div>
                    </div>
                    <p>
                        <button class="bubble-button" type="submit" form="add-event-form" name="eventSubmit" value="Submit">Add Event</button>
                        <button class="bubble-button" type="reset" form="add-event-form" name="eventReset" value="Reset">Reset</button>
                    </p>
                </form>
            <?php
                } else if ($isFormSubmitted) {
                // Display confirmation
            ?>
                <h3>Thank You!</h3>
                    <p>Your event has been added to the database. You can see your new event on <a href="../unit-7/selectEvents.php">this page</a>.</p>
            <?php
                }
            ?>
        </main>
    </body>
</html>