<?php

    /*
        Modelo: model.nuevo.php
        Descripción: genera los datos necesarios para añadir nuevo artículo
    */

    # Símbolo monetario local
    setlocale(LC_MONETARY,"es_ES");

    # Creo un objeto de la clase tabla artículos
    $obj_tabla_libros = new Class_tabla_libros();

    # Cargo tabla de marcas
    $materia = $obj_tabla_libros->getMaterias();

    # Cargo tabla de categorías
    $etiquetas = $obj_tabla_libros->getEtiquetas();

    

