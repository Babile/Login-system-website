<?php
    //PHPMailer Library
    require '../PHPMailer/src/Exception.php';
    require '../PHPMailer/src/PHPMailer.php';
    require '../PHPMailer/src/SMTP.php';

    function sendEmail($userEmail, $subject, $msg, $header) {
        $mail = new PHPMailer\PHPMailer\PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->Host = "smtp.gmail.com";                // setting SMTP Host
        $mail->Port = 587;                             // setting port
        $mail->SMTPSecure = 'tls';                     // setting wich protocol to use
        $mail->SMTPAuth = true;
        $mail->Username = 'example@gmail.com';         // example email to connect
        $mail->Password = 'examplepassword';           // example password to connect
        $mail->setFrom('example@gmail.com');    // who is sending
        $mail->addAddress($userEmail);                 // to who will be sent
        $mail->Subject = $subject;
        $mail->Body = $msg;
        $mail->IsHTML (true);

        //Checking is email sent
        if(!$mail->send()) {
            header($header.$mail->ErrorInfo);
            exit();
        }
    }
?>