<?php

/**
 * 3.2 Calculamos los valores solicitados
 */

//Cargo en variables
$valor1 = $_GET['num1'];
$valor2 = $_GET['num2'];
$g = 9.8; // Aceleración de la gravedad en m/s²

//Creo variable para radianes
$radianes = $valor2 * (M_PI / 180);

//Creo variable para componentes de velocidad
$v_x = $valor1 * cos($radianes); // Componente horizontal
$v_y = $valor1 * sin($radianes); // Componente vertical

// Calcular tiempo de vuelo (doble del tiempo para alcanzar la altura máxima)
$tiempo_vuelo = (2 * $v_y) / $g;

// Calcular altura máxima
$altura_maxima = ($v_y ** 2) / (2 * $g);

// Calcular alcance horizontal
$alcance_horizontal = $v_x * $tiempo_vuelo;

$radianes = round($radianes, 5);
$v_x = round($v_x, 2);
$v_y = round($v_y, 2);
$tiempo_vuelo = round($tiempo_vuelo, 2);
$altura_maxima = round($altura_maxima, 2);
$alcance_horizontal = round($alcance_horizontal, 2);
