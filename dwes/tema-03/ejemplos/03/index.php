<?php

/**
 * ejemplo3
 * Calificacion de una nota de 0 a 10
 * Mostrará: deficiente, insuficiente, suficiente, bien, notable o sobresaliente
 */

$a = 8;

if($a < 0) {

    echo "Valor no permitido";

} elseif ($a < 2 ) {

    echo "deficiente";

} elseif ( $a < 5 ) {

    echo "insuficiente";

} elseif ( $a < 6 ) {

    echo "suficiente";
    
} elseif ($a < 7) {
    
    echo "bien";

} elseif ($a < 9) {
    
    echo "notable";

} elseif ($a <= 10 ) {
    
    echo "sobresaliente";

} else {
    
    echo "Valor no permitido";

}

