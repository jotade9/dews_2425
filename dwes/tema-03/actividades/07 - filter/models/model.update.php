<?php

    /*

        Modelo:  model.update.php
        Descripción: actauliza los detalles de un alumno

        Método POST:
            - id
            - titulo
            - autor
            - editorial
        
        Metodo GET:
            - id
    */

    # Extraemos los valores del formulario
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $editorial = $_POST['editorial'];
    $genero = $_POST['genero'];
    $precio = $_POST['precio'];

    #  Extraemos el id del alumno
    $id_editar = $_GET['id'];

    # Cargo la tabla libros
    $libros = get_tabla_libros();

    # Obtenemos el índice de la tabla donde se encuentra ese alumno
    $indice_editar = buscar_tabla_2($libros, 'id', $id_editar);

    # Creo un array asociativo con los detalles actualizados del alumno
    $registro = [
        'id' => $id,
        'titulo' => $titulo,
        'autor' => $autor,
        'editorial' => $editorial,
        'genero' => $genero,
        'precio' => $precio
    ];

   

    # Actualizo la tabla libros
    $libros[$indice_editar] = $registro;


