<?php

    /*
        Modelo: model.ordenar.php
        Descripción: ordena los Libros por algún criterio

        Parámetros:
            - criterio: el número que identifica la posición de la columna en
              en el select de getLibros()
    */

        # Símbolo monetario local
        setlocale(LC_MONETARY,"es_ES");

        # Obtener el criterio de ordenación
        $criterio = $_GET['criterio'];
    
        # Conecto con la base de datos gesbank
        $conexion = new Class_tabla_libros();
    
        # Ejecuto el  método order() y devuelve objeto PDOStatement
        $stmt_libros = $conexion->order($criterio);
