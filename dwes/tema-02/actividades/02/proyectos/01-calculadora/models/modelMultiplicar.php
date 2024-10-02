<?php
/**
 * Modelo : modeloMultiplicar.php
 * Descripción: resta los valores del formulario
 */


//Cargo en variables
$valor1 = $_GET['valor1'];
$valor2 = $_GET['valor2'];

//Creo variable con la operacion
$operacion = "Multiplica";

//Realizo los cálculos
$resultado = $valor1 * $valor2;