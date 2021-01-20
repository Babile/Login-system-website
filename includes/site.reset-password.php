<?php
    require 'site.mailer.php';
    
    if (isset($_POST['reset_password_btn'])) {
        //Getting information selector and validator from url
        $selector = $_POST['selector'];
        $validator = $_POST['validator'];
        //Getting inputs form user
        $password = $_POST['password'];
        $password_retype = $_POST['password_retype'];

        //Checking if selector and validator are not null and password is same as password_retype
        if((!empty($selector) || !empty($validator)) || ($password !== $password_retype)) {
            header("Location: ../sign-in.php?error=newPasswordEmpty");
            exit();
        }
    
        $userEmail = "";
        $currentDate = date("U");
        
        try {
            //Connecting to database
            require 'db.connection.php';
            global $db_connection;

            //Checking if url information match in database and if current date is not past date of expire to reset password
            $sqlQuery = "SELECT email, passwordResetToken FROM passwordReset WHERE passwordResetSelector = ? AND timeExpires >= ?";
            $stmt = $db_connection->stmt_init();

            if(!$stmt->prepare($sqlQuery)) {
                header("Location: ../sign-in.php?error=incorrectCredentials");
                $db_connection->close();
                exit();
            }
            else {
                $stmt->bind_param('ss', $selector, $currentDate);
                $stmt->execute();

                $tokenEmail = "";
                $passwordResetToken = "";
                $stmt->bind_result($tokenEmail, $passwordResetToken);

                if(!$stmt->fetch()) {
                    header("Location: ../sign-in.php?error=failedToGetPassword");
                    $stmt->free_result();
                    $db_connection->close();
                    exit();
                }
                else {
                    $userEmail = $tokenEmail;
                    $tokenBin = hex2bin($validator);
                    $tokenCheck = password_verify($tokenBin, $passwordResetToken);

                    if(!$tokenCheck) {
                        header("Location: ../sign-in.php?error=invalidToken");
                        $stmt->free_result();
                        $db_connection->close();
                        exit();
                    }
                    else {
                        //Checking if user from database exist
                        $sqlQuery = "SELECT * FROM users WHERE email = ?";
                        $stmt = $db_connection->stmt_init();

                        if(!$stmt->prepare($sqlQuery)) {
                            header("Location: ../sign-in.php?error=invalidEmail");
                            $stmt->free_result();
                            $db_connection->close();
                            exit();
                        }
                        else {
                            $stmt->bind_param('s', $tokenEmail);
                            $stmt->execute();
                            $stmt->bind_result($tokenEmail);

                            if(!$stmt->fetch()) {
                                header("Location: ../sign-in.php?error=invalidEmail");
                                $stmt->free_result();
                                $db_connection->close();
                                exit();
                            }
                            else {
                                //Updating password
                                $sqlQuery = "UPDATE users SET password = ? WHERE email = ?";
                                $stmt = $db_connection->stmt_init();

                                if(!$stmt->prepare($sqlQuery)) {
                                    header("Location: ../sign-in.php?error=faildToSetPassword");
                                    $stmt->free_result();
                                    $db_connection->close();
                                    exit();
                                }

                                $stmt->bind_param('ss', $password, $tokenEmail);
                                $stmt->execute();
                                //Deleting request for password reset
                                $sqlQuery = "DELETE FROM passwordReset WHERE email = ?";
                                $stmt = $db_connection->stmt_init();

                                if(!$stmt->prepare($sqlQuery)) {
                                    header("Location: ../sign-in.php?error=fatalError");
                                    $stmt->free_result();
                                    $db_connection->close();
                                    exit();
                                }
                                else {
                                    $stmt->bind_param('s', $tokenEmail);
                                    $stmt->execute();
                                    header("Location: ../sign-in.php?message=passwordUpdated");
                                }
                            }
                        }

                    }
                }
            }
            //Closing connection
            $stmt->free_result();
            $db_connection->close();


            //Setting email message
            $emailBody = '<p>Your password has been successfully changed.</p>';
            //Setting header if email is not sent
            $header = "Location: ../sign-in.php?message=passwordUpdated";
            //Setting subject of email
            $subject = 'Password reset successful';
        
            sendEmail($userEmail, $subject, $emailBody, $header);
        }
        catch(Exception $e) {
            header("Location: ../sign-in.php?error=fatalError&".$e->getMessage());
        }
    }
    else {
        header("Location: ../sign-in.php");
    }
?>