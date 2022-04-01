<?php 
namespace app\mails;

use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\PHPMailer;

class mail {
    public function serverSetting () {
         //Server settings 
         $mail = new PHPMailer(true);
         $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
         $mail->isSMTP();                                            //Send using SMTP
         $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
         $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
         $mail->Username   = 'ntiproject.x1@gmail.com';                     //SMTP username
         $mail->Password   = 'ntipro777';                               //SMTP password
         $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
         $mail->Port       = 465; 
         return $mail;
    }
}