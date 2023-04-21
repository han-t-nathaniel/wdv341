<?php
session_start();

$isUserValid = false;

if (isset($_SESSION['isUserValid'])) {
    $isUserValid = $_SESSION['isUserValid'];
}

require_once(__DIR__ . "/../exceptionHandlers.php");
// Connect to the database. Creates a connection object called $connection.
require_once(__DIR__ . "/../dbConnect.php");

$sql = "SELECT * FROM wdv341_events WHERE id=2";

// Execute the query statement 
try {
    $stmt = $connection->prepare($sql);
} catch (PDOException $e) {
    handleConnectionException($connection, $e);
}
try {
    $stmt->execute();
} catch (PDOException $e) {
    handleStatementException($stmt, $e);
}

$stmt->setFetchMode(PDO::FETCH_ASSOC);

$queryResultOutput = "";

if (!$row = $stmt->fetch()) {
    $queryResultOutput = "No events found.";
} else {
    $queryResultOutput .= "<table class=\"database-table\"><thead><tr>";
    $queryResultOutput .= "<th class=\"name-column\">Name</th>";
    $queryResultOutput .= "<th class=\"description-column\">Description</th>";
    $queryResultOutput .= "<th class=\"presenter-column\">Presenter</th>";
    $queryResultOutput .= "<th class=\"date-column\">Date</th>";
    $queryResultOutput .= "<th class=\"time-column\">Time</th>";
    $queryResultOutput .= "<th class=\"date-inserted-column\">Date Inserted</th>";
    $queryResultOutput .= "<th class=\"date-updated-column\">Date Updated</th>";
    $queryResultOutput .= "</tr></thead><tbody>";
    do {
        $formattedTime = date("g:ia", strtotime($row["time"]));
        $formattedDate = date("m/d/y", strtotime($row["date"]));
        $formattedDateInserted = date("m/d/y", strtotime($row["date_inserted"]));
        $formattedDateUpdated = date("m/d/y", strtotime($row["date_updated"]));
        $queryResultOutput .= "<tr>";
        $queryResultOutput .= "<td>" . $row["name"] . '</td>';
        $queryResultOutput .= "<td class=\"description-column\">" . $row["description"] . '</td>';
        $queryResultOutput .= "<td>" . $row["presenter"] . '</td>';
        $queryResultOutput .= "<td>" . $formattedDate . '</td>';
        $queryResultOutput .= "<td>" . $formattedTime . '</td>';
        $queryResultOutput .= "<td>" . $formattedDateInserted . '</td>';
        $queryResultOutput .= "<td>" . $formattedDateUpdated . '</td>';
        $queryResultOutput .= "</tr>";
    } while ($row = $stmt->fetch());
    $queryResultOutput .= "</tbody></table>";
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
        <title>WDV 341 | 7-2: Create selectOneEvent.php</title>
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" href="/favicon.ico" sizes="16x16 32x32"><!-- 32×32 -->
        <link rel="icon" href="/icon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png"><!-- 180×180 -->
        <link rel="manifest" href="/manifest.webmanifest">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Jost&family=Libre+Baskerville:wght@400;700&display=swap" rel="stylesheet">     
        <link rel="stylesheet" href="/css/bubbles.css">
        <style>
            td {
                padding-left: 10px;
                padding-right: 10px;
            }
        </style>
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
                <a href="../wdv341.php">&lt; WDV 341</a>
                <a href="../contact.php">Contact Me</a>
                <?php
                    if ($isUserValid) {
                ?>
                    <a href="../login.php">Admin</a>
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
            <h1>WDV 341 | 7-2: Create selectOneEvent.php</h1>
            <p><?= $queryResultOutput; ?></p>
        </main>
    </body>
</html>