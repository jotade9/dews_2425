<?php
/**
 * Función: is_null()
 */
//variable no definida
var_dump(is_null($var));
echo "<br>";

//variabe definida asignando valor null
$var=null;
var_dump(is_null($var));
echo "<br>";

//variable eliminada
unset($var);
var_dump(is_null($var));