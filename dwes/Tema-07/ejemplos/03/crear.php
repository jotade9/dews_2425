<?php
/**
 * Crear variables de sesion
 */

 // // inicia o continua sessión
 session_start();
 echo "SID: " . session_id() . "<br>";
 echo "Name: " . session_name() . "<br>";

 // Crea variables de sesion
 $_SESSION['nombre']= 'Juan';
 $_SESSION['email']= 'juan@gmail.com';
 $_SESSION['perfil'] = 'admin';

 include 'index.php';