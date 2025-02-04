<?php
/**
 * Ejercicio 3. isset().
 * Crear un script PHP donde se muestre el resultado
 * de 3 valores verdaderos y 3 valores falsos
 * para la función isset()
 */
$v1;
var_dump(isset($v1));

echo "<BR>";

$v1 = null;
var_dump(isset($v1));

echo "<BR>";

$v1 = "";
var_dump(isset($v1));

echo "<BR>";

$v1 = true;
var_dump(isset($v1));

echo "<BR>";

$v1 = 0;
var_dump(isset($v1));

echo "<BR>";

unset($v1);
var_dump(isset($v1));

echo "<BR>";