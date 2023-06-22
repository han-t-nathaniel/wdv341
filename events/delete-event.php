<?php
session_start();

$isUserValid = false;

if (isset($_SESSION["isUserValid"])) {
    $isUserValid = $_SESSION["isUserValid"];
} else {
    header("Location: ../login.php");
}

$eventID = $_GET["eventID"];


//
//require_once(__DIR__ . "/../exceptionHandlers.php");
//// Connect to the database. Creates a connection object called $connection.
//require_once(__DIR__ . "/../dbConnect.php");
//
//$sql = "SELECT * FROM wdv341_events";
//
//// Execute the query statement
//try {
//    $stmt = $connection->prepare($sql);
//} catch (PDOException $e) {
//    handleConnectionException($connection, $e);
//}
//try {
//    $stmt->execute();
//} catch (PDOException $e) {
//    handleStatementException($stmt, $e);
//}
//
//$stmt->setFetchMode(PDO::FETCH_ASSOC);


?>