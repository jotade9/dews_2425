<?php

    /*
        Modelo: model.index.php
        Descripción: muestra los detalles de libros

    */

        # Símbolo monetario local
        setlocale(LC_MONETARY,"es_ES");

        # Creo un objeto de la clase tabla libros
        $conexion = new Class_tabla_libros();
    
        # Obtengo un objeto de la clase pdostatement con los detalles de libros
        $stmt_libros = $conexion->get_libros();
