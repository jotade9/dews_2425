<?php

/**
 * 
 * Manejo de directorios
 * 
 * 
 * 
 * Funciones:
 * - chfir - cambiar directorio actual
 * - getcws() - directorio actual
 * - mkdir() - crear direcctorio
 * - rmdir - eliminar directorio
 * - glob() - acceder al contenido del directorio
 * - dirname() - devuelve el directorio padre de la ruta establecida
 * - isdir() - determina si es un directorio
 * - pathinfo() -devuelve informacion sobre ruta de un archivo
 * - basename()- devuelve el nombre
 */

// ruta completa directorio actual
echo 'Ruta completa directorio actual: : ' . getcwd() . '<br>';

// nombre del directorio actual
echo 'Directorio Actual: ' . basename(getcwd()) . "<br>";

/// Cambiamos el directorio actual

echo 'Directorio padre ';

$files = glob('files/a*.*');

//Muestra el contenifo del directorio files
echo '<pre>';
print_r($files);
echo '</pre>';
