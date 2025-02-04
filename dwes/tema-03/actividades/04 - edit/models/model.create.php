<?php

/**
 * 
 * Modelo: model.create.php
 * 
 * Descripcion: añade un nuevo alumno a la tabla
 * 
 * Método POST:
 *      -titulo
 *      -autor
 *      -editorial
 *       -genero
 *       -precio
 */

 #Extraemos los valores del formulario
 $id = $_POST['id'];
 $titulo = $_POST['titulo'];
 $autor = $_POST['autor'];
 $editorial = $_POST['editorial'];
 $genero = $_POST['genero'];
 $precio = $_POST['precio'];

 # Cargar tabla alumnos
 $libros = get_tabla_libros();

 # Creo un array asociativo con los detalles del nuevo alumno
 $registro = [
    'id' => $id,
    'titulo' => $titulo,
    'autor' => $autor,
    'editorial' => $editorial,
    'genero' => $genero,
    'precio' => $precio
 ];

 # Añadir el nuevo alumno a la tabla
 $libros[] = $registro;