<?php
    //Database credentials (host, user, password, database name)
    //Here is just example of host, user, password, database name
    //This is Loclhost database
    $dbhost = "localhost";
    $dbuser = "websiteuser";
    $dbpass = "user12345";
    $dbname = "website";

    //Creating connection
    $db_connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

    //Checking if connection to database is okay
    if($db_connection->connect_error) {
        header("Location: index.php?error=failedToConnectToDataBase");
        $db_connection->close();
        exit();
    }
?>