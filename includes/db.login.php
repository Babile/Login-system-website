<?php
    if(isset($_POST['login_btn'])) {
        //Getting inputs form user
		$email_username = $_POST['email_username'];
		$password = $_POST['password'];
		//Checking if is username or email
		$whichOne = "email";
		
		try{
		    //Checking is email or username address valid before we get information from database
			if(!filter_var($email_username, FILTER_VALIDATE_EMAIL)) {
                $whichOne = "username";
				if(!preg_match('/^[a-zA-Z0-9]{5,}$/', $email_username)) { 
					header("Location: /index.php?error=incorrectCredentials");
					exit();
				}
			}
            //Connecting to database
            require 'db.connection.php';
            global $db_connection;

            $stmt = $db_connection->stmt_init();
            session_start();

			if($whichOne === "username") {
                $sqlQuery = "SELECT name, surname, username, email, password FROM users WHERE username = ?";
                runQuery($db_connection, $stmt, $sqlQuery, $email_username);
            }
            else if($whichOne === "email") {
                $sqlQuery = "SELECT name, surname, username, email, password FROM users WHERE email = ?";
                runQuery($db_connection, $stmt, $sqlQuery, $email_username);
            }

            //Closing connection to database
            $db_connection->close();
		}
		catch(exception $e) {
			header("Location: /index.php?error=incorrectCredentials".$e->getMessage());
		}
    }	
    else {
		header("Location: /index.php");
	}

    //This function run query and set sessions
    function runQuery($db_connection, $stmt, $sqlQuery, $email_username) {
        if(!$stmt->prepare($sqlQuery)) {
            header("Location: /index.php?error=incorrectCredentials");
            $db_connection->close();
            exit();
        }
        else {
            $stmt->bind_param('s', $email_username);
            $stmt->execute();

            $name = "";
            $surname = "";
            $email = "";
            $username = "";
            $password = "";

            $stmt->bind_result($name, $surname, $username, $email, $password);
            if(!$stmt->fetch()) {
                header("Location: /index.php?error=incorrectCredentials");
                $stmt->free_result();
                $db_connection->close();
                exit();
            }
            else {
                $_SESSION['UserName'] = $surname;
                $_SESSION['Password'] = $password;
                $_SESSION['Email'] = $email;
                $_SESSION['Name'] = $name;
                $_SESSION['Surname'] = $surname;
                header("Location: /home.php");
            }
        }
    }
?>