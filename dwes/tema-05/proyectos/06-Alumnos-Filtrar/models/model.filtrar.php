<?php

    /*
        Modelo: model.ordenar.php
        Descripción: ordena los alumnos por algún expresion

        Parámetros:
            - expresion
    */


    # Obtener la expresion
    $expresion = $_GET['expresion'];

    # Creo un objeto de la clase tabla alumnos
    $tabla_alumnos = new Class_tabla_alumnos();

    # Ejecuto el  método filtrar() y devuelve objeto de la clase
    # mysqli_result
    $alumnos = $tabla_alumnos->filtrar($expresion);

    
