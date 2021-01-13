<?php

    $server = "localhost";
    $username = "msteinmetz";
    $password = "Fr0gTr!p#2298";
    $dbname = "msteinmetz_guestbook";

    try {
        $db = new PDO("mysql:host=$server;dbname=$dbname", $username, $password );
    }
    catch( PDOException $e ){
        echo "Error! " . $e->getMessage();
        die();
    }
?>