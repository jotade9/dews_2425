<?php

/**
 * leer archivo
 * 
 * fread — Lee un número de bytes determinado desde un archivo
 */

$archivo = fopen('archivo.txt', 'r');

if (!$archivo) {
    echo 'No se pudo abrir el archivo';
    exit;
}
$contenido = fread($archivo, filesize('archivo.txt'));

echo nl2br($contenido);

fclose($archivo);