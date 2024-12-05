<?php

    /*
        Modelo: model.update.php
        Descripción: actualiza los datos del libro

         Métod POST:
            - detalles del alumno

        Método GET:

            - id del alumno
    */

    # Símbolo monetario local
    setlocale(LC_MONETARY, "es_ES");

    # Cargo el id del  libro que voy a editar
    $id = $_GET['id'];

    # Cargo los detalles del  formulario
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $fechaNac = $_POST['fechaNac'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $nacionalidad = $_POST['nacionalidad'];
    $dni = $_POST['dni'];
    $id_curso = $_POST['id_curso'];

    # Validación

    # Crear un objeto de la clase alumno a partir de los detalles del formulario
    $alumno = new Class_alumno (
        null,
        $nombre,
        $apellidos,
        $email,
        $telefono,
        $nacionalidad,
        $dni,
        $fechaNac, 
        $id_curso
    );

    # Actualizo los detalles del alumno en la tabla
    $alumnos = new Class_tabla_alumnos();

    # Llamo aal método update de la clase tabla_alumnos
    $alumnos->update($alumno, $id);

    //exit();