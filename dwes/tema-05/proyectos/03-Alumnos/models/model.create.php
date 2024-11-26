<?php
    /*
        apellidos: model.create.php
        descripción: añade el nuevo artículo a la tabla
        
        Métod POST:
            - id
            - nombre
            - apellidos
            - telefono
            - nacionalidad (indice)
            - dni (array)
            - id_curso
    */

    # Cargo los detalles del  formulario
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $fechaNAc = $_POST['fechaNac'];
    $apellidos = $_POST['apellidos'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $nacionalidad = $_POST['nacionalidad'];
    $dni = $_POST['dni'];
    $id_curso = $_POST['id_curso'];
    

    # Validación

    # Crear un objeto de la clase alumno
    $alumno = new Class_alumno(
                                null,
                                $nombre,
                                $apellidos,
                                $email,
                                $telefono,
                                $nacionalidad,
                                $dni,
                                $fechaNAc,
                                $id_curso
    );



    # Crear un objeto de la clase artículos a partir de los detalles del formulario
    $alumno = new Class_alumno(
        $id,
        $nombre,
        $apellidos,
        $email,
        $telefono,
        $nacionalidad,
        $dni,
        $id_curso
    );

    # Añadimos alumno a la tabla
    # Creo un objeto de la clase tabla alumnos
    $alumnos = new Class_tabla_alumnos();
    $alumnos->create($alumno);

    # Redirecciono al controlador index
     header("location: index.php");