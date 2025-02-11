<?php

/**
 * Leer y guardar contenido de un archivo de texto plano
 * 
 * -file_put_contents
 * -file_get_contents
 */
$archivo = file_get_contents('archivo.txt');

//Añado una nueva informacion al archivo
$archivo .= 'Nueva información';

//Guardo el archivo
file_put_contents('archivo.txt', $archivo);