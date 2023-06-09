<?php

use PHPMailer\PHPMailer\PHPMailer;

function enviarEmail($email, $assunto, $mensagemHTML)
{

    require 'vendor/autoload.php';

    $mail = new PHPMailer;
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    $mail->isSMTP();
    $mail->SMTPDebug = 0;
    $mail->Host = gethostbyname('smtp.office365.com');
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->Username = '***';
    $mail->Password = '***';

    $mail->setFrom('***', "Rafaela Projeto");

    $mail->addAddress($email);
    $mail->Subject = $assunto;
    $mail->CharSet = 'UTF-8';

    $mail->Body = $mensagemHTML;

    if ($mail->send()) {
        return true;
    } else {
        return false;
    }
}
