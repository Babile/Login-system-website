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
					header("Location: ../sign-in.php?error=incorrectCredentials");
					exit();
				}
			}
            //Connecting to database
            require 'db.connection.php';
            global $db_connection;

            $stmt = $db_connection->stmt_init();
            session_start();

			if($whichOne === "username") {
                $sqlQuery = "SELECT ID, name, surname, username, email, password, membership, flag FROM users WHERE username = ? AND password = ?";
                runQuery($db_connection, $stmt, $sqlQuery, $email_username, $password);

                if($_SESSION['Membership'] === "Admin") {
                    $sqlQuery = "SELECT ID, name, surname, username, email, membership, date, flag FROM users WHERE username != ?";
                    $stmt = $db_connection->stmt_init();
                    setListUsers($db_connection, $stmt, $email_username, $sqlQuery);
                }
            }
            else if($whichOne === "email") {
                $sqlQuery = "SELECT ID, name, surname, username, email, password, membership, flag FROM users WHERE email = ? AND password = ? ORDER BY ID";
                runQuery($db_connection, $stmt, $sqlQuery, $email_username, $password);

                if($_SESSION['Membership'] === "Admin") {
                    $sqlQuery = "SELECT ID, name, surname, username, email, membership, date, flag FROM users WHERE email != ? ORDER BY ID";
                    $stmt = $db_connection->stmt_init();
                    setListUsers($db_connection, $stmt, $email_username, $sqlQuery);
                }
            }

            $stmt = $db_connection->stmt_init();
            $sqlQuery = "SELECT username, score, date FROM player_score ORDER BY score DESC";
            setHighScoreTable($db_connection, $stmt, $sqlQuery);

            //Closing connection to database and redirecting to site.load-game-score php page to load score
            header("Location: site.load-game-score.php");
            $db_connection->close();
		}
		catch(Exception $e) {
			header("Location: ../sign-in.php?error=incorrectCredentials".$e->getMessage());
		}
    }	
    else {
		header("Location: ../sign-in.php");
	}

    //This function run query and set sessions
    function runQuery($db_connection, $stmt, $sqlQuery, $email_username, $passwordInput) {
        if(!$stmt->prepare($sqlQuery)) {
            header("Location: ../sign-in.php?error=incorrectCredentials");
            $db_connection->close();
            exit();
        }
        else {
            $stmt->bind_param('ss', $email_username, $passwordInput);
            $stmt->execute();

            $id = 0;
            $name = "";
            $surname = "";
            $email = "";
            $username = "";
            $password = "";
            $membership = "";
            $flag = 0;

            $stmt->bind_result($id, $name, $surname, $username, $email, $password, $membership, $flag);
            if(!$stmt->fetch()) {
                header("Location: ../sign-in.php?error=incorrectCredentials");
                $stmt->free_result();
                $db_connection->close();
                exit();
            }
            else {
                if($flag == 0){
                    header("Location: ../sign-in.php?error=userBlocked");
                    $stmt->free_result();
                    $db_connection->close();
                    exit();
                }
                
                $_SESSION['Id'] = $id;
                $_SESSION['UserName'] = $username;
                $_SESSION['Password'] = $password;
                $_SESSION['Email'] = $email;
                $_SESSION['Name'] = $name;
                $_SESSION['Surname'] = $surname;
                $_SESSION['Membership'] = $membership;
                $_SESSION['ListUsers'] = null;
                $_SESSION['HighScoreList'] = null;
            }
        }
    }

    //This function run query and set session for list of users if user is admin
    function setListUsers($db_connection, $stmt, $email_username, $sqlQuery) {
        if(!$stmt->prepare($sqlQuery)) {
            header("Location: ../sign-in.php?error=incorrectCredentials");
            $db_connection->close();
            exit();
        }
        else {
            $stmt->bind_param('s', $email_username);

            if($stmt->execute()) {
                //Credits goes to Jeffrey Way
                //Article https://code.tutsplus.com/tutorials/the-problem-with-phps-prepared-statements--net-13661
                $parameters = array();
                $results = array();
                $meta = $stmt->result_metadata();

                while($field = $meta->fetch_field()) {
                    $parameters[] = &$row[$field->name];
                }

                call_user_func_array(array($stmt, 'bind_result'), $parameters);

                while($stmt->fetch()) {
                    $x = array();
                    foreach($row as $key => $val) {
                        $x[$key] = $val;
                    }
                    $results[] = $x;
                }
                $_SESSION['ListUsers'] = $results;
            }
        }
    }

    //This function run query and set session for high score of users
    function setHighScoreTable($db_connection, $stmt, $sqlQuery) {
        if(!$stmt->prepare($sqlQuery)) {
            header("Location: ../sign-in.php?error=incorrectCredentials");
            $db_connection->close();
            exit();
        }
        else {
            if($stmt->execute()) {
                //Credits goes to Jeffrey Way
                //Article https://code.tutsplus.com/tutorials/the-problem-with-phps-prepared-statements--net-13661
                $parameters = array();
                $results = array();
                $meta = $stmt->result_metadata();

                while($field = $meta->fetch_field()) {
                    $parameters[] = &$row[$field->name];
                }

                call_user_func_array(array($stmt, 'bind_result'), $parameters);

                while($stmt->fetch()) {
                    $x = array();
                    foreach($row as $key => $val) {
                        $x[$key] = $val;
                    }
                    $results[] = $x;
                }
                $_SESSION['HighScoreList'] = $results;
            }
        }
    }
?>