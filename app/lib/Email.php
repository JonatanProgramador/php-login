<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


require_once RUTA. "app/PHPMailer/src/PHPMailer.php";
require_once RUTA. "app/PHPMailer/src/Exception.php";
require_once RUTA. "app/PHPMailer/src/SMTP.php";


class Email
{
    private $email;

    public function __construct($fromName, $address, $toName, $subject, $body)
    {
        $this->email = new PHPMailer();
        $this->email->isSMTP();
        $this->email->Host = EMAIL_HOST;
        $this->email->SMTPAuth  = true;
        $this->email->Username  = EMAIL_NAME;
        $this->email->Password  = EMAIL_PASSWORD;
        $this->email->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->email->Port  = EMAIL_PORT;
        $this->email->setFrom(EMAIL_NAME, $fromName);
        $this->email->addAddress($address, $toName);
        $this->email->isHTML(true);
        $this->email->Subject = $subject;
        $this->email->Body  = $body;
        $this->email->AltBody = $body;
    }

    public function send() {
        $this->email->send();
    }
}
