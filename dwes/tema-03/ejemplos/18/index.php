<?php
/**
 * funciones y procedimientos
 */
#defino la funcion sumar
 function sumar($valor1, $valor2) {
    $resultado = $valor1 + $valor2;
    return $resultado;
 }
 function producto($valor1, &$valor2) {
    $resultado = $valor1 * $valor2;
    $valor2 = 7;
    return $resultado;
 }

 function division($valor1, $valor2 = 3) {
    $resultado = $valor1 / $valor2;
    return $resultado;
 }
 $v1 = 6;
 $v2 = 2;

 $calculo = division ($v1, $v2);

 echo $calculo;
 echo "<br>";
 echo $v2;

 # Utilizo la función sumar
 #$calculo = sumar(4.5,5);
 #si mandas decimales te lo redondea

 #echo $calculo;