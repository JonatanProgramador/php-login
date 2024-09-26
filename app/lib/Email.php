<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


require_once RUTA. "app/PHPMailer/src/PHPMailer.php";
require_once RUTA. "app/PHPMailer/src/Exception.php";
require_once RUTA. "app/PHPMailer/src/SMTP.php";


class Email
{
    
    public static function send($fromName, $address, $toName, $subject, $body) {
        $email = new PHPMailer();
        $email->isSMTP();
        $email->Host = EMAIL_HOST;
        $email->SMTPAuth  = true;
        $email->Username  = EMAIL_NAME;
        $email->Password  = EMAIL_PASSWORD;
        $email->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $email->Port  = EMAIL_PORT;
        $email->setFrom(EMAIL_NAME, $fromName);
        $email->addAddress($address, $toName);
        $email->isHTML(true);
        $email->Subject = $subject;
        $email->Body  = $body;
        $email->AltBody = $body;
        $email->send();
    }
}
