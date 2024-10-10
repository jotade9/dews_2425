<?php
/**
 * Array de dos dimensiones con indices numñericos
 */

 $matriz = [
    [3, 5 ,6 ,7, 10],
    [6, 2, 7, 0, 9],
    [6, 4, 9, 1, 5]
 ];
//numero 7 del segundo array
 echo $matriz [1][2];
 echo "<br>";

 //mostrar todo el array
 foreach ($matriz as $valor){
    foreach($valor as $num){
        echo $num;
        echo ", ";
    }
    echo "<br>";
 };