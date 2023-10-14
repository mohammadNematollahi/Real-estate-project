<?php

namespace App\Services;

use Exception;
use System\Config\Config;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\PHPMailer;

class EmailSendingService
{
    public static function SendMail($email, $subject, $body)
    {
        $mail = new PHPMailer();

        try {
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host = Config::get("mail.SMTP.Host");
            $mail->SMTPAuth = Config::get("mail.SMTP.SMTPAuth");
            $mail->Port = Config::get("mail.SMTP.Port");
            $mail->Username = Config::get("mail.SMTP.Username");
            $mail->Password = Config::get("mail.SMTP.Password");
    
            $mail->From = Config::get("mail.SMTP.From.email");
            $mail->FromName = Config::get("mail.SMTP.From.name");

            $mail->addAddress($email);
    
            $mail->isHTML(true);
            
            $mail->Subject = $subject;
            $mail->Body = $body;
    
            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            return false;
        }
    }
}
