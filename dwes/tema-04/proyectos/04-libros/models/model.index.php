<?php

    /*
        Modelo: model.index.php
        Descripción: genera array objetos de la clase artículos
    */

    # Símbolo monetario local
    setlocale(LC_MONETARY,"es_ES");

    # Creo un objeto de la clase tabla artículos
    $obj_tabla_libros = new Class_tabla_libros();

    # Cargo tabla de marcas
    $materia = $obj_tabla_libros->getMaterias();

    # Cargo tabla de categorías
    $etiquetas = $obj_tabla_libros->getEtiquetas();

    # Relleno el array de objetos
    $obj_tabla_libros->getDatos();

    # Obtener tabla de libros
    $array_libros = $obj_tabla_libros->tabla;

