<?php

    /*
        Modelo: model.ordenar.php
        Descripción: ordena los clientes por algún criterio

        Parámetros:
            - criterio: el número que identifica la posición de la columna en
            el select de getClientes()
    */

    # Símbolo monetario local
    setlocale(LC_MONETARY,"es_ES");

    # Obtener el criterio de ordenación
    $criterio = $_GET['criterio'];

    # Conecto con la base d edatos gesbank
    $conexion = new Class_tabla_clientes();

    # Ejecuto el  método order() y devuelve objeto PDOStatement
    $stmt_clientes = $conexion->order($criterio);

    
