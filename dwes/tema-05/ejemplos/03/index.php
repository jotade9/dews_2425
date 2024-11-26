<?php
/**
 * Ejemplo clase genérica Exception
 * Estructura try{} catch{}
 * 
 *  */

 function division($valor1, $valor2){
    try {
        if($valor2 == 0){
            throw new Exception("ERROR: División por cero no permitida");
        }

        return($valor1/$valor2);

    } catch (Exception $e) {
        echo "Mensaje: " . $e->getMessage();
        echo "<br>";
        echo "Line: " . $e->getLine();
        echo "<br>";
        echo "Line: " . $e->getFile();
    }
 }
 