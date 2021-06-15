<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "rebus";

    // Connecting with MySQL local server
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check if connection was successful
    if(!$conn){
        $connerr = true;
    }
?>