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
                $sqlQuery = "SELECT ID, name, surname, username, email, password, membership FROM users WHERE username = ? AND password = ?";
                runQuery($db_connection, $stmt, $sqlQuery, $email_username, $password);
                if($_SESSION['Membership'] === "Admin") {
                    $sqlQuery = "SELECT ID, name, surname, username, email, membership, date FROM users WHERE username != ?";
                    $stmt = $db_connection->stmt_init();
                    setListUsers($db_connection, $stmt, $email_username, $sqlQuery);
                }
            }
            else if($whichOne === "email") {
                $sqlQuery = "SELECT ID, name, surname, username, email, password, membership FROM users WHERE email = ? AND password = ? ORDER BY ID";
                runQuery($db_connection, $stmt, $sqlQuery, $email_username, $password);

                if($_SESSION['Membership'] === "Admin") {
                    $sqlQuery = "SELECT ID, name, surname, username, email, membership, date FROM users WHERE email != ? ORDER BY ID";
                    $stmt = $db_connection->stmt_init();
                    setListUsers($db_connection, $stmt, $email_username, $sqlQuery);
                }
            }

            //Closing connection to database and redirecting to site.load-game-score php page to load score
            header("Location: /includes/site.load-game-score.php");
            $db_connection->close();
		}
		catch(Exception $e) {
			header("Location: /index.php?error=incorrectCredentials".$e->getMessage());
		}
    }	
    else {
		header("Location: /index.php");
	}

    //This function run query and set sessions
    function runQuery($db_connection, $stmt, $sqlQuery, $email_username, $passwordInput) {
        if(!$stmt->prepare($sqlQuery)) {
            header("Location: /index.php?error=incorrectCredentials");
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

            $stmt->bind_result($id, $name, $surname, $username, $email, $password, $membership);
            if(!$stmt->fetch()) {
                header("Location: /index.php?error=incorrectCredentials");
                $stmt->free_result();
                $db_connection->close();
                exit();
            }
            else {
                $_SESSION['Id'] = $id;
                $_SESSION['UserName'] = $username;
                $_SESSION['Password'] = $password;
                $_SESSION['Email'] = $email;
                $_SESSION['Name'] = $name;
                $_SESSION['Surname'] = $surname;
                $_SESSION['Membership'] = $membership;
                $_SESSION['ListUsers'] = null;
            }
        }
    }

    function setListUsers($db_connection, $stmt, $email_username, $sqlQuery) {
        if(!$stmt->prepare($sqlQuery)) {
            header("Location: /index.php?error=incorrectCredentials");
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
?>