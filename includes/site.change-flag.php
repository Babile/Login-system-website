<?php
    //Getting ID and flag form user
    $IDUser = $_GET['ID'];

    try{
        //Connecting to database
        require 'db.connection.php';
        global $db_connection;
        session_start();

        $stmt = $db_connection->stmt_init();
        $sqlQuery = "SELECT flag FROM users WHERE ID = ?";
        $userFlag = 0;

        if(!$stmt->prepare($sqlQuery)) {
            header("Location: ../members.php?error=userBlocked");
            $db_connection->close();
            exit();
        }
        else {
            $stmt->bind_param('s', $IDUser);
            $stmt->execute();

            $stmt->bind_result($userFlag);
            if(!$stmt->fetch()){
                $stmt->free_result();
                $db_connection->close();
                header("Location: ../members.php?error=userBlocked");
                exit();
            }
            else {
                $stmt = $db_connection->stmt_init();

                if($userFlag == 0){
                    $sqlQuery = "UPDATE users SET flag = 1 WHERE ID = ?";
                    runQuery($db_connection, $stmt, $sqlQuery, $IDUser, 1);
                }
                else if($userFlag == 1){
                    $sqlQuery = "UPDATE users SET flag = 0 WHERE ID = ?";
                    runQuery($db_connection, $stmt, $sqlQuery, $IDUser, 0);
                }
            }
        }
    }
    catch(Exception $e) {
        header("Location: ../sign-in.php?error=userBlocked".$e->getMessage());
    }
    //This function run query
    function runQuery($db_connection, $stmt, $sqlQuery, $userID, $userFlag){
        if(!$stmt->prepare($sqlQuery)) {
            header("Location: ../members.php?error=userNotFound");
            $stmt->free_result();
            $db_connection->close();
        }
        else {
            $stmt->bind_param('s', $userID);
            if($stmt->execute()){
                //Closing connection to database and redirecting to members php page
                //Using & as reference to row in session
                foreach($_SESSION['ListUsers'] as &$row) {
                    if($row['ID'] == $userID){
                        $row['flag'] = $userFlag;
                    }
                }
                header("Location: ../members.php?message=successful");
                $stmt->free_result();
                $db_connection->close();
            }
            else {
                header("Location: ../members.php?error=userNotFound");
                $stmt->free_result();
                $db_connection->close();
            }
        }
    }
?>