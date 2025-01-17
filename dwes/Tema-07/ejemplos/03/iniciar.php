<?php
/**
 * Inicio de sesion
 */
 // inicio de sesion

session_start();

echo 'SID: '.session_id();
echo '<br>';
echo 'NAME: '.session_name();

include 'index.php';