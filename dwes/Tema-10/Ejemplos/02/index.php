<?php

// definir la cabecera del mensaje
$header .= "Mine-Version: 1.0\r\n";
$header .= "Content-Transfer-Encoding: 8bit\r\n";
$header .= "From: Juan Diego <jjuandi8@gmail.com>";
$header .= "Cc: juandiego.deb@gmail.com";
$header .= "Ccc: juandiego.deweb@gmail.com";
$header .= "X-mailer: PHP/".phpversion();



// definir destinatario
$destinatario = "jjuandi8@gmail.com";
$asunto = "Prueba de envio de email";
$mensaje = "Este es un mensaje de prueba";

// Enviar
mail($destinatario, $asunto, $mensaje, $header);