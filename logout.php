<?php
    session_start();

    //close the session
    session_unset();
    session_destroy();


    //close the database
    // Connect to the database. Contains a Connection object called $connection.
    require_once(__DIR__ . "/dbConnect.php");
    $connection = null;

    //redirect to the application home page/login page
    header("Location: login.php");
?>