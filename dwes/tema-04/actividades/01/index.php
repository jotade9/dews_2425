<?php
/**
 * Ejemplo
 * Descripción: Crear un objeto a partir de la clase Class_calculadora y realizar operaciones
 */
include 'class/class.calculadora.php';
# Creo un objeto de la clase calculadora
 $calculadora = new Class_calculadora(10, 5);

# Realizamos operaciones
$calculadora->sumar();
echo "Resultado de la suma: " . $calculadora->getResultado();
echo "<br>";

$calculadora->restar();
echo "Resultado de la resta: " . $calculadora->getResultado();
echo "<br>";

$calculadora->producto();
echo "Resultado de la multiplicación: " . $calculadora->getResultado();
echo "<br>";

$calculadora->division();
echo "Resultado de la division: " . $calculadora->getResultado();
echo "<br>";

$calculadora->potenciar();
echo "Resultado de la potencia: " . $calculadora->getResultado();
echo "<br>";