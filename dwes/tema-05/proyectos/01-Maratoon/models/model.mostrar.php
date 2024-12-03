<?php

    /*
        modelo: model.mostrar.php
        descripción: carga los datos del libro que deseo actualizar

        Método GET:

            - id de la tabla en la que se encuentra el libro
    */

    # Cargamos el id del libro
    $id = $_GET['id'];

    # Creo un objeto de la clase tabla de corredores
    $tabla_corredores = new Class_tabla_corredores();

    #  Cargo los datos de los corredores
    $tabla_corredores->getCorredores();
    
    # Cargo el array de categorias - lista desplegable dinámica
    $categorias = $tabla_corredores->getCategorias();

    # Cargo el array de clubs - lista checbox dinámica
    $clubs = $tabla_corredores->getClubs();

    # Obtener el objeto de la clase artículo correspondiente a ese índice
    $corredor = $tabla_corredores->read($id);

    # Forma alternativa por la propiedad de no encapsulamiento
    // $libro = $obj_tabla_corredores->tabla[$id];
   
