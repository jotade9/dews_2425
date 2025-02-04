<?php

/**
 * 3.2 Calculamos los valores solicitados
 */

//Cargo en variables
$valor1 = $_POST['num1'];
$valor2 = $_POST['num2'];

//definimos la constante gravedad
define("G", 9.8);

//Creo variable para radianes
$radianes = $valor2 * (M_PI / 180);

//Creo variable para componentes de velocidad
$v_x = $valor1 * cos($radianes); // Componente horizontal
$v_y = $valor1 * sin($radianes); // Componente vertical

// Calcular tiempo de vuelo (doble del tiempo para alcanzar la altura máxima)
$tiempo_vuelo = (2 * $v_y) / G;

// Calcular altura máxima
$altura_maxima = ($v_y ** 2) / (2 * G);

// Calcular alcance horizontal
$alcance_horizontal = $v_x * $tiempo_vuelo;

//formateo de las variable snumericas
$radianes= number_format($radianes, 5, ',', '.');
$v_x= number_format($v_x, 2, ',', '.');
$v_y= number_format($v_y, 2, ',', '.');
$tiempo_vuelo= number_format($tiempo_vuelo, 2, ',', '.');
$altura_maxima= number_format($altura_maxima, 2, ',', '.');
$alcance_horizontal= number_format($alcance_horizontal, 2, ',', '.');
