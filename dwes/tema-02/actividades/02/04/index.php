<?php
/**
 * Ejercicio 4. empty().
 * Crear un script PHP donde se muetre el resultado de 
 * 3 valores verdaderos y 3 valores falsos
 * para la función empty()
 */

 $v1;
var_dump(empty($v1));

echo "<BR>";

$v1 = null;
var_dump(empty($v1));

echo "<BR>";

$v1 = "Hola Mundo";
var_dump(empty($v1));

echo "<BR>";

$v1 = true;
var_dump(empty($v1));

echo "<BR>";

$v1 = 2;
var_dump(empty($v1));

echo "<BR>";

unset($v1);
var_dump(empty($v1));

echo "<BR>";