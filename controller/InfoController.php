<?php


use PHPMailer\PHPMailer\MailConfig;

class InfoController extends Controller
{
    private $mailer ;
    function rgpd()
    {
        $this->render("rgpd");
    }
    function contact()
    {
        $this->render ("contact");
        $mailer = new MailConfig();
        if (isset($_POST["saisie"])){
            $nomExp = $_POST["prenomContact"]." ".$_POST["nomContact"];
            $PJS = $_FILES["PJMail"]["tmp_name"];
           // var_dump ($PJS);


            $mailer->config ("ufolep-usep@laligue17.org",$_POST["mailContact"],$_POST["objMail"],$_POST["message"],$nomExp, $PJS);
           // var_dump ($mailer->config ());

        }

    }

}