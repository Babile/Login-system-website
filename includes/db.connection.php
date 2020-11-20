<?php
    //Database credentials (host, user, password, database name)
    //Here is just example of host, user, password, database name
    $dbhost = "exampleHost";
    $dbuser = "exampleUser";
    $dbpass = "examplePass";
    $dbname = "exapmleDataBase";

    //Creating connection
    $db_connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

    //Checking if connection to database is okay
    if($db_connection->connect_error) {
        header("Location: /index.php?error=failedToConnectToDataBase");
        $db_connection->close();
        exit();
    }
?>