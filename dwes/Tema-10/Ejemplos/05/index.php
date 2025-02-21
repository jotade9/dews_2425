<?php

/**
 * ejemplo uso clase PHP MAiler

 */
require_once 'config/smtp_brevo.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    // Juego de caracteres UTF-8
    $mail->CharSet = 'UTF-8';
    $mail->Encoding = 'quoted-printable';

    // Configurar el servidor
    // $mail->SMTPDebug = 2;                      // habilitar el debug por si hay errores
    $mail->SMTPDebug = 0;
    $mail->isSMTP();                                            // Usar smtp

    // Configurar el acceso al servidor
    $mail->SMTPAuth = true;                               // Habilitar la autenticación SMTP

    // Servidor SMTP brevo
    $mail->Host = SMTP_HOST;        

    // Puerto SMTP brevo
    $mail->Port = SMTP_PORT;        

    // Usuario SMTP brevo
    $mail->Username = SMTP_USER;
    // Contraseña SMTP brevo
    $mail->Password = SMTP_PASS;

    //Cabecera del mensaje
    $destinatario = 'nerom24@gmail.com';
    $remitente = 'jjuandi8@gmail.com';
    $asunto = 'Email con PHPMailer SMTP brevo';
    $mensaje = '
    <h1>Lorem ipsum dolor sit amet</h1>
    <b>Cádiz</b> es una ciudad y municipio de España, capital de la provincia homónima,
    <i>Maecenas</i> es una ciudad y municipio de España, capital de la provincia homónima,
    <p>Maecenas es una ciudad y municipio de España, capital de la provincia homónima,
    </p>
    ">
    ';

    // remitente
    $mail->setFrom($remitente, 'Juan Diego');

    // destinatario
    $mail->addAddress($destinatario, 'Nerón Moreno');

    // responder a
    $mail->addReplyTo($remitente, 'Juan Diego');

    // Con código HTML
    $mail->isHTML(true);

    // Asunto
    $mail->Subject = $asunto;

    // Mensaje
    $mail->Body = $mensaje;

    //Envias el mensaje
    $mail->send();

    // Mensaje de éxito
    echo 'Mensaje enviado correctamente';
} catch (Exception $e) {
    echo "Error al enviar el mensaje: {$mail->ErrorInfo}";
}
