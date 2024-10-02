<?php
/**
 * Modelo : modeloSumar.php
 * Descripción: suma los valores del formulario
 */

//print_r($_GET);

//Cargo en variables
$valor1 = $_GET['valor1'];
$valor2 = $_GET['valor2'];

//Creo variable con la operacion
$operacion = "Suma";

//Realizo los cálculos
$resultado = $valor1 + $valor2;

//echo $resultado;