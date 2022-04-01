<?php

namespace app\mails;
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use app\mails\mail;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class VerificationMail extends mail
{
    private $emailTo,$subject,$body;
    public function __construct(string $emailTo, string $subject, string $body)
    {
        $this->emailTo = $emailTo;
        $this->subject = $subject;
        $this->body = $body;
    }

    public function send()
    {

        try {
            $mail = $this->serverSetting();
            //Recipients
            $mail->setFrom('ntiproject.x1@gmail.com', 'Ecommerce');
            $mail->addAddress($this->emailTo);               //Name is optional

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $this->subject;
            $mail->Body    = $this->body;

            $mail->send();
            // echo 'Message has been sent';
            return true;
        } catch (Exception $e) {
            // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            return false;
        }
    }

}
