<?php
/**
 * tipos de variables
 * 
 * 
 */
//boolean
$test = false;
echo "\$test: ";
var_dump($test);
echo "<BR>";
//int
$edad= 30;
echo "\$edad: ";
var_dump($edad);
echo "<BR>";
//float
$altura = 1.83;
echo "\$altura: ";
var_dump($altura);
echo "<BR>";
//float exponencial
$distancia = 1.83e4;
echo "\$distancia: ";
var_dump($distancia);
echo "<BR>";

# tipo string
$mensaje = " La distancia recorrida fue de $distancia km";
echo "\$mensaje: ";
var_dump($mensaje);
echo "<BR>";
 # tipo string ''
$mensaje = 'La distancia recorrida fue de' . $distancia . ' km';
echo "\$mensaje: ";
var_dump($mensaje);