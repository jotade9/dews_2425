<?php
session_start();

echo "SID: " . session_id() . "<br>";
echo "Name: " . session_name() . "<br>";

echo "Nombre: " . $_SESSION['nombre'] . "<br>";
echo "Email: " . $_SESSION['email'] . "<br>";
echo "Perfil: " . $_SESSION['perfil'] . "<br>";
?>