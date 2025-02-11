<?php
/**
 * leer archivo como array
 * 
 * file — Lee todo un archivo a un array
 */
$archivo = fopen('archivo.txt', 'r');

//validar si el archivo se abrio correctamente
if (!$archivo) {
    echo 'No se pudo abrir el archivo';
    exit;
}
//recorro el archivo linea por linea
while (!feof($archivo)) {
    $linea=fgets($archivo);
    echo $linea;
}
fclose($archivo);

echo"<pre>";
print_r($archivo);
echo"</pre>";

