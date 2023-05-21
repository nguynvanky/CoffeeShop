<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '././vendor/PHPMailer-master/src/Exception.php';
require '././vendor/PHPMailer-master/src/PHPMailer.php';
require '././vendor/PHPMailer-master/src/SMTP.php';

function mailto($address, $name)
{
    $mail = new PHPMailer(true);


    try {
        //Server settings
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.elasticemail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'nguynvanky.work@gmail.com';                     //SMTP username
        $mail->Password   = '437F873C9536EBAB69932D6F2D1E9655EA84';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('nguynvanky.work@gmail.com', 'Coffee shop');
        $mail->addReplyTo($address, $name);
        $mail->addAddress($address, $name);     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = "Thanks for using our service";
        $mail->Body    = "Thank you very much for using our services. We will always strive to do our best.";
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
