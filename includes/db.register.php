<?php
	 if(isset($_POST['register_btn'])) {
	     //Getting inputs form user
		 $name = $_POST['name'];
		 $surname = $_POST['surname'];
		 $username = $_POST['username'];
		 $email = $_POST['email'];
		 $password = $_POST['password'];
		 $passwordRepeat = $_POST['password_retype'];
 
		 try{
		     //Connecting to database
             require 'db.connection.php';
             global $db_connection;

			 //Checking is everything valid before insert to database
			 if(($password === $passwordRepeat && $password != null) && ($username != null && preg_match('/^[a-zA-Z0-9]{5,}$/', $username)) && 
				 ($email != null && filter_var($email, FILTER_VALIDATE_EMAIL)) && $name != null && $surname != null) {
				 $sqlQuery = "INSERT INTO users(name, surname, username, email, password) VALUES(?, ?, ?, ?, ?)";
                 $stmt = $db_connection->stmt_init();

                 if(!$stmt->prepare($sqlQuery)) {
                     header("Location: /register.php?error=registrationFailed&Name=".$name."&Surname=".$surname."&Username=".$username."&Email=".$email);
                     $db_connection->close();
                     exit();
                 }
                 else {
                     $stmt->bind_param('sssss', $name,$surname, $username, $email, $password);

                     if(!$stmt->execute()) {
                         header("Location: /register.php?error=registrationFailed&Name=".$name."&Surname=".$surname."&Username=".$username."&Email=".$email);
                         $stmt->free_result();
                         $db_connection->close();
                         exit();
                     }
                     else {
                         header("Location: /register.php?message=registrationSuccessful");
                     }
                 }
			 }
			 else {
				 header("Location: /register.php?error=registrationFailed&Name=".$name."&Surname=".$surname."&Username=".$username."&Email=".$email);
			 }
             //Closing connection to database and free memory
             $stmt->free_result();
             $db_connection->close();
		 }
		 catch(exception $e) {
             header("Location: /index.php?error=incorrectCredentials".$e->getMessage());
		 }
	 }
	 else {
		 header("Location: /register.php");
	 }
?>