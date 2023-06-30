<?php
namespace PHPMailer\PHPMailer;

//use PHPMailer\PHPMailer\Exception;
//use PHPMailer;
// use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\SMTP;
// use PHPMailer\PHPMailer\OAuth;
require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
//require 'PHPMailer/OAuth.php';

class MailConfig
{
    public function __construct()
    {
        return true;
    }

    public function config($dest, $exp, $obj, $mess , $nomExp, $PJS = null){

            $mail= new PHPMailer(true);

        try {
            //configuration
            //$mail->SMTPDebug = 2;
            $mail->setLanguage ("fr","PHPMailer/phpmailer.lang-fr.php");
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;

            //$mail->SMTPDebug = SMTP::DEBUG_CONNECTION;
            //configure smtp
            $mail->isSMTP();
            $mail->Host = "ssl://mail.btssio17.com";
            $mail->SMTPAuth="true";
            $mail->SMTPSecure = "ssl";
            $mail->Port = 465;
            $mail->Username = "projets@btssio17.com";
            $mail->Password = "projetsdivers";
            //config mailhog
            //$mail->Host = "localhost";
            //$mail->Port = 1025;
            //CharSet
            $mail->CharSet = "utf-8";

            //destinataires
            $mail->addAddress($dest);
            //Expediteur
            $mail->setFrom($exp, $nomExp);

            //contenu
                        $mail->Subject = $obj;
                        $mail->Body = $mess;
            // PJ
            foreach ($PJS as $PJ){
                $mail->addAttachment ($PJ,"PieceJointe");
            }
            //envoi du mail
            $mail->send();

            //vérif envoi
                        echo "mail envoyé v2";
            //var_dump($mail);
            return $mail;

        } catch (Exception $e) {
            echo "message non envoyé. Erreur : {$mail->ErrorInfo}";
        }

    }
}