<?php

    /*
        Modelo: model.index.php
        Descripción: ordena los alumnos por algún criterio

        Parámetros:
            - criterio: el número que identifica la posición de la columna en lta bla alumnos

    */

    # Símbolo monetario local
    setlocale(LC_MONETARY,"es_ES");

    # Obtener el criterio de ordenacion
    $criterio = $_GET['criterio'];

    # Creo un objeto de la clase tabla alumnos
    $tabla_alumnos = new Class_tabla_alumnos();

    # Ejecuto el método order
    $alumnos = $tabla_alumnos->order($criterio);

    
