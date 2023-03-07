<?php

namespace App\Classes\Email;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class RegisterEmail
{

    public function Enviar_email_cadastro($email_usuario,$purl)
    {
        // criar o link para enviar para o usuario 
        $link = env('APP_URL')."/account_verificacion?token=".$purl;
        // Inicializar o PHPMAILER 
        require base_path("vendor/autoload.php");
        $mail = new PHPMailer(true);

        try {
            // Configurações do servidor 
            $mail->SMTPDebug = false;
            $mail->isSMTP();
            $mail->CharSet = "UTF-8";
            $mail->Host = 'smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = '99133464d6c3f7';
            $mail->Password = 'e01e96544261a6';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 2525;

            // Destinatário
            $mail->setFrom('gordolinosamukai@gmail.com', 'SMS Temporary');
            $mail->addAddress($email_usuario);

            $mail->isHTML(true);

            $mail->Subject = 'Confirmação de Cadastro';

            // Mensagem 
            $html = '<p>Seja Bem-Vindo a Comunidade Developer</p>';
            $html.= "<p>Para começar a usar a plataforma é necessário confirmar o seu Email </p>";
            $html.= "<p>Para confirmar o email clica no link a baixo </p>";
            $html.= '<p><a href="'.$link.'">Confirmar email</a></p>';

            $mail->Body = $html;
            // Preparação do envio do email 
            if (!$mail->send()) {
                return false;
            } else {
                return true;
            }
        } catch (Exception $erro) {
            return false;
        }
    }
}