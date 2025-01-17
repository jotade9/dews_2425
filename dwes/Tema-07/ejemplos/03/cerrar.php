<?php
/**
 * Cerrar la sesión
 */

 // Inicia o continua sesión
 session_start();

 // destruye las variables de sesión
    session_unset();

 // destruye la sesión
 session_destroy();

 // muestra el SID y el NAME
    echo 'SID: ' . session_id() . '<br>';
    echo 'Name: ' . session_name() . '<br>';

 include 'index.php';