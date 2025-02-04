<?php

/**
 * DEvolver el item de una calificación:
 *  - Deficiente, insuficiente, suficiente,..
 */
$calif = 7;
switch (true) {
    case ($calif < 0):
        echo "calificación no permitida";
        break;

    case ($calif < 2):
        echo "deficiente";
        break;

    case ($calif < 5):
        echo "insuficiente";
        break;

    case ($calif < 6):
        echo "suficiente";
        break;

    case ($calif < 7):
        echo "bien";
        break;

    case ($calif < 9):
        echo "notable";
        break;

    case ($calif <= 10):
        echo "sobresaliente";
        break;

    default:
        echo "Valor no permitido";
        break;
}

