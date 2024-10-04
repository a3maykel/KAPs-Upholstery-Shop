<?php

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;


//Load Composer's autoloader
require 'vendor/autoload.php';

function sendInquiry($mail, $sender, $recipient, $name, $subject, $message) {


    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp-relay.brevo.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'brandalbuz@gmail.com';                     //SMTP username
    $mail->Password   = 'sD2Vzmf6Ph8ackQ0';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom($sender, $subject);
    $mail->addAddress($recipient, $name);     //Add a recipient
    $mail->addReplyTo($sender, 'Information');
    $mail->addCC($sender);
    $mail->addBCC($sender);

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $message;
    $mail->AltBody = $message;
    
    $mail->SMTPDebug = 0;
    
    if ($mail->send()) {
        echo '200';
    } else {
        echo '500';
        // return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    

}


//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
$recipient = "michaeumali234@gmail.com";

$name = $_POST['name'];
$sender = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];


sendInquiry($mail, $sender, $recipient, $name, $subject, $message );

?>