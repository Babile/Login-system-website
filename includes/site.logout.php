<?php
    session_start();
    try {
        require 'db.connection.php';
        global $db_connection;
    
        $stmt = $db_connection->stmt_init();
        $sqlQuery = "SELECT score FROM player_score WHERE ID = ?";
    
        if(!$stmt->prepare($sqlQuery)) {
            header("Location: /index.php?error=failedToStoreScore");
            $db_connection->close();
            exit();
        }
        else {
            $stmt->bind_param('s', $_SESSION['Id']);
            $stmt->execute();
        
            $score = 0;
            $stmt->bind_result($score);
        
            if(!$stmt->fetch()) {
                $stmt = $db_connection->stmt_init();
                $sqlQuery = "INSERT INTO player_score(ID, username, score) VALUES(?, ?, ?)";
            
                if(!$stmt->prepare($sqlQuery)) {
                    header("Location: /index.php?error=failedToStoreScore");
                    $db_connection->close();
                    exit();
                }
                else {
                    $stmt->bind_param('sss', $_SESSION['Id'], $_SESSION['UserName'], $_GET["score"]);
                
                    if(!$stmt->execute()) {
                        header("Location: /index.php?error=failedToStoreScore");
                        $stmt->free_result();
                        $db_connection->close();
                        exit();
                    }
                }
            }
            else {
                $temp = $_GET["score"];
                if($score < $temp) {
                    $sqlQuery = "UPDATE player_score SET score = ? WHERE ID = ?";
                
                    if(!$stmt->prepare($sqlQuery)) {
                        header("Location: /index.php?error=failedToStoreScore");
                        $stmt->free_result();
                        $db_connection->close();
                        exit();
                    }
                    else {
                        $stmt->bind_param('ss', $temp, $_SESSION['ID']);
                    
                        if (!$stmt->execute()) {
                            header("Location: /index.php?error=failedToStoreScore");
                            $stmt->free_result();
                            $db_connection->close();
                            exit();
                        }
                    }
                }
            }
        }
    }
    catch (exception $e) {
        header("Location: /index.php?error=failedToStoreScore" . $e->getMessage());
    }
    session_start();
    session_unset();
    session_destroy();
    header("Location: /index.php");
?>