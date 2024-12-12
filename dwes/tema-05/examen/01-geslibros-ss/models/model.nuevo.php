<?php

    /*
        Modelo: model.nuevo.php
        Descripción: genera los datos necesarios para añadir nuevo libro
    */

    


    # Símbolo monetario local
    setlocale(LC_MONETARY,"es_ES");

    # Creo un objeto de la clase tabla libro
    $conexion = new Class_tabla_libros();
    
    # Cargo tabla de libros
    $libros = $conexion->get_libros();