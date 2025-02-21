<?php

/**
 * ejemplo uso clase PHP MAiler

 */

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

    //Server settings
    //$mail->SMTPDebug = 2;                      //Enable verbose debug output
    //$mail->isSMTP();                                            //Send using SMTP
    // $mail->Host       = 'smtp1.example.com';                    //Set the SMTP server to send through
    // $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    // $mail->Username   = '

    // fake SMTP PAPERCUT
    $mail->isSMTP();

    //Cabecera del mensaje
    $destinatario = 'nerom24@gmail.com';
    $remitente = 'jjuandi8@gmail.com';
    $asunto = 'Prueba de envio de correo';
    $mensaje = '
    <h1>Lorem ipsum dolor sit amet</h1>
    <b>Cádiz</b> es una ciudad y municipio de España, capital de la provincia homónima,
    en la comunidad autónoma de Andalucía. Con 118 048 habitantes empadronados en 2020,
    es la ciudad más poblada de la bahía de Cádiz y la tercera de la provincia tras Jerez de la Frontera y Algeciras.
    Está situada en la costa suroeste de la península ibérica, a orillas del mar de la provincia homónima, en la comunidad autónoma de Andalucía.
    Con 118 048 habitantes empadronados en 2020, es la ciudad más poblada de la bahía de Cádiz y la tercera de la provincia tras Jerez de la Frontera y Algeciras.
    Está situada en la costa suroeste de la península ibérica, a orillas del mar
    <img src="https://www.cadizturismo.com/storage/app/media/uploaded-files/p-cadiz.jpg" alt="Cádiz">
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
