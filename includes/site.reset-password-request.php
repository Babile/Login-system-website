<?php
    require 'site.mailer.php';

    if(isset($_POST['password_recovery_btn'])) {
        $selector = bin2hex(random_bytes(8));
        $token = random_bytes(32);
        $tokenExpireTime = date('U') + 3600;
        $userEmail = $_POST['email'];
    
        $url = "https://nemanjababic.000webhostapp.com/create-new-password.php?selector=".$selector."&validator=".bin2hex($token);
    
        try{
            //Connecting to database
            require 'db.connection.php';
            global $db_connection;

            //Checking is email valid
            if(!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
                header("Location: /reset-password.php?error=emailIsNotValid");
                exit();
            }

            //Checking if user exist in database
            $sqlQuery = "SELECT * FROM users WHERE email = ?";
            $stmt = $db_connection->stmt_init();

            if(!$stmt->prepare($sqlQuery)) {
                header("Location: /index.php?error=emailIsNotValid");
                $db_connection->close();
                exit();
            }
            else {
                $stmt->bind_param('s', $userEmail);
                $stmt->execute();

                if(!$stmt->fetch()) {
                    header("Location: /index.php?error=emailIsNotValid");
                    $stmt->free_result();
                    $db_connection->close();
                    exit();
                }
            }

            //Deleting old password reset request if exist
            $sqlQuery = "DELETE FROM passwordReset WHERE email = ?";
            $stmt = $db_connection->stmt_init();
        
            if(!$stmt->prepare($sqlQuery)) {
                $stmt->free_result();
                $db_connection->close();
                header("Location: /reset-password.php?error=serverError");
                exit();
            }
            else {
                $stmt->bind_param("s", $userEmail);
                $stmt->execute();
            }

            //Inserting new password request to database
            $sqlQuery = "INSERT INTO passwordReset (email, passwordResetSelector, passwordResetToken, timeExpires) VALUES(?, ?, ?, ?)";
        
            $stmt = $db_connection->stmt_init();
        
            if(!$stmt->prepare($sqlQuery)) {
                $stmt->free_result();
                $db_connection->close();
                header("Location: /reset-password.php?error=serverError");
                exit();
            }
            else {
                $hashedToken = password_hash($token, PASSWORD_DEFAULT);
                $stmt->bind_param("ssss", $userEmail, $selector, $hashedToken, $tokenExpireTime);
                $stmt->execute();
            }
            //Closing connection
            $stmt->free_result();
            $db_connection->close();

            //Setting email message
            $emailBody = '
                <p>We recieved a password reset request. The link to reset your password is below. If you did not make this request, you can ignore this email.</p>
                <p>Here is your password reset link: <a href="'.$url.'">Click here</a></p> ';
            //Setting header if email is not sent
            $header = "Location: /reset-password.php?error=SendingEmail";
            //Setting subject of email
            $subject = 'Reset password request';

            sendEmail($userEmail, $subject, $emailBody, $header);

            header("Location: /reset-password.php?message=passwordRequestSuccessful");
        }
        catch(Exception $e) {
            header("Location: /reset-password.php?error=fatalError&".$e->getMessage());
		}
    }
    else {
        header("Location: /reset-password.php");
    }
?>