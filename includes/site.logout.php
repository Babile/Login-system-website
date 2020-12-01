<?php
    session_start();
    try {
        //Connecting to database
        require 'db.connection.php';
        global $db_connection;

        //Remove cookie
        unset($_COOKIE['cookie_table']);

        //Checking if user exist in database and getting his score
        $stmt = $db_connection->stmt_init();
        $sqlQuery = "SELECT score FROM player_score WHERE ID = ?";
    
        if(!$stmt->prepare($sqlQuery)) {
            clear();
            header("Location: /index.php?error=failedToStoreScore");
            $db_connection->close();
            exit();
        }
        else {
            $stmt->bind_param('s', $_SESSION['Id']);
            $stmt->execute();

            $playerScore = 0;
            $stmt->bind_result($playerScore);

            //If user doesnt exit then insert in database user with his score
            if(!$stmt->fetch()) {
                $stmt = $db_connection->stmt_init();
                $sqlQuery = "INSERT INTO player_score(ID, username, score) VALUES(?, ?, ?)";
            
                if(!$stmt->prepare($sqlQuery)) {
                    clear();
                    header("Location: /index.php?error=failedToStoreScore");
                    $db_connection->close();
                    exit();
                }
                else {
                    $stmt->bind_param('sss', $_SESSION['Id'], $_SESSION['UserName'], $_GET["score"]);
                
                    if(!$stmt->execute()) {
                        clear();
                        header("Location: /index.php?error=failedToStoreScore");
                        $stmt->free_result();
                        $db_connection->close();
                        exit();
                    }
                    else {
                        clear();
                        header("Location: /index.php");
                    }
                }
            }
            //If user exist then update his score and date that he got that score
            else {
                $temp = $_GET["score"];
                if($playerScore < $temp) {
                    $sqlQuery = "UPDATE player_score SET score = ?, date = now() WHERE ID = ?";
                
                    if(!$stmt->prepare($sqlQuery)) {
                        clear();
                        header("Location: /index.php?error=failedToStoreScore");
                        $stmt->free_result();
                        $db_connection->close();
                        exit();
                    }
                    else {
                        $stmt->bind_param('ss', $temp, $_SESSION['Id']);
                    
                        if (!$stmt->execute()) {
                            clear();
                            header("Location: /index.php?error=failedToStoreScore");
                            $stmt->free_result();
                            $db_connection->close();
                            exit();
                        }
                        else {
                            clear();
                            header("Location: /index.php");
                        }
                    }
                }
                else {
                    clear();
                    header("Location: /index.php");
                }
            }
        }
    }
    catch(Exception $e) {
        clear();
        header("Location: /index.php?error=failedToStoreScore".$e->getMessage());
    }
    //Cleaning session and redirecting to index page
    function clear() {
        session_start();
        session_unset();
        session_destroy();
    }
?>