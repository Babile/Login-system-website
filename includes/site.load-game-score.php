<?php
    $playerScore = 0;
    try{
        session_start();
        //Connecting to database
        require 'db.connection.php';
        global $db_connection;

        //Checking if user exist in database and getting his score
        $stmt = $db_connection->stmt_init();
        $sqlQuery = "SELECT score FROM player_score WHERE ID = ?";

        if(!$stmt->prepare($sqlQuery)) {
            header("Location: /index.php?error=incorrectCredentials");
            $db_connection->close();
            exit();
        }
        else {
            $stmt->bind_param('s', $_SESSION['Id']);
            $stmt->execute();

            $stmt->bind_result($playerScore);

            //If user doesnt exit then just go to home page and start game
            if(!$stmt->fetch()) {
                $stmt->free_result();
                $db_connection->close();
                header("Location: /home.php");
                exit();
            }
            else {
                //>
                $stmt->free_result();
                $db_connection->close();
                echo '<script> 
                        localStorage.setItem("highScoreStore", '.$playerScore.') 
                        location.href = "/home.php"; 
                     </script>';
                exit();
            }
        }

        //Closing connection to database and free memory
        $stmt->free_result();
        $db_connection->close();
    }
    catch(exception $e) {
        header("Location: /index.php?error=incorrectCredentials".$e->getMessage());
    }
?>