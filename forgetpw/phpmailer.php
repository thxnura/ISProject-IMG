
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../phpmailer/phpmailer/src/Exception.php';
require '../phpmailer/phpmailer/src/PHPMailer.php';
require '../phpmailer/phpmailer/src/SMTP.php';

require '../vendor/autoload.php';





    $mail = new PHPMailer(true);

    try {
        //Server settings
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->SMTPAuth = TRUE;
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->Host = 'smtp.zoho.com';
        $mail->Username = 'isphashimg@zohomail.com';
        $mail->Password = 'HashImg!123';                                 //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('isphashimg@zohomail.com', 'HashIMG');
        $mail->addAddress($email);     //Add a recipient
        $mail->addReplyTo('isphashimg@zohomail.com', 'HashIMG');
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = ' Password Reset request';
        $mail->Body    =  '
        Dear User,<br>
        <br>
        We received a password reset request from your account. Please enter the following code to confirm your request.<br>

        
        <br><b><h1>
        '.$emailkey.'
        </h1></b><br><br>

        If you did not request this #IMG, let us know .<br>
        
        ';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }





?>