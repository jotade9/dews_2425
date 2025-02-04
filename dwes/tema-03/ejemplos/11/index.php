<?php
/**
 * ejemplo
 * array de tipo indexado o escalar
 * sólo un indice numerico
 */

 //$numeros = array(3, 4, 5, 9)

 $numeros = [3, 4, 5 ,9];

 //Mostrar array
 //printi_r($numeros);

 foreach ($numeros as $i => $valor) {
    echo "[$i] = $valor";
    echo "<BR>";
 }