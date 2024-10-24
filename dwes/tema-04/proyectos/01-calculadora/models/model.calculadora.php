<?php

/**
 * modelo: model.calculadora.php 
 * descripción: realiza los calculos
 */

# Cargar los datos del formulario
$valor1 = $_GET['valor1'];
$valor2 = $_GET['valor2'];
$operador = $_GET['operador'];

# Creo objeto calculadora
$calc = new Class_calculadora(
    $valor1,
    $valor2,
    $operador,
    null
);

# Evalúo la operación
switch ($operador) {
    case 'sumar':
        $calc->sumar();
        break;
    case 'restar':
        $calc->restar();
        break;
    case 'multiplicar':
        $calc->producto();
        break;
    case 'dividir':
        $calc->division();
        break;
    case 'potencia':
        $calc->potenciar();
        break;

    default:
        $calc->restar();
        break;
}
