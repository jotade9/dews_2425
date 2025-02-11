<?php
/**
 * Ejemplo 01: Crear un archivo de texto plano
 * 
 * Abrir y cerrar archivo
 */
// Abrir archivo
$archivo = fopen('archivo.txt', 'w');
if($archivo === false) {
    echo 'Error al abrir archivo';
    exit;
}
fwrite($archivo, "Hola mundo\n");
fwrite($archivo, "Este es un archivo de texto\n");
fwrite($archivo, "Soy Maximo decimo Meridio, comandante de los ejercitos del norte\n");
// Cerrar archivo
fclose($archivo);