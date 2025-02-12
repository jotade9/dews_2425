<?php
/**
 * leer archivo como array
 * 
 * file — Lee todo un archivo a un array
 */
$archivo = file('archivo.txt');

echo"<pre>";
print_r($archivo);
echo"</pre>";

echo 'Ultima linea: '. $archivo[count($archivo)-1];