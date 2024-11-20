<?php
    /*
        f_nacimiento: model.create.php
        descripción: añade el nuevo jugador a la tabla
        
        Métod POST:
            
    */
    # Cargo los detalles del  formulario
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $f_nacimiento = $_POST['f_nacimiento'];
    $altura = $_POST['altura'];
    $peso = $_POST['peso'];
    $nacionalidad = $_POST['nacionalidad'];
    $num_camiseta = $_POST['num_camiseta'];
    $valor_mercado = $_POST['valor_mercado'];
    $equipo_id = $_POST['equipo_id'];
    $posiciones_id = $_POST['posiciones_id'];

    

    # Crear un objeto de la clase tabla_jugadores
    $obj_tabla_jugadores = new Class_tabla_jugadores();

    # Cargo los jugadores
    $obj_tabla_jugadores->getDatos();

    # Obtengo el array de equipos
    $equipos = $obj_tabla_jugadores->getEquipos();

    # Obtengo el  array de posiciones
    $posiciones= $obj_tabla_jugadores->getPosiciones();

    # Crear un objeto de la clase artículos a partir de los detalles del formulario
    $libro = new Class_libro(
        $id,
        $nombre,
        $f_nacimiento,
        $altura,
        $peso,
        $nacionalidad,
        $num_camiseta,
        $valor_mercado,
        $equipo_id,
        $posiciones_id
    );

    # Añadir el artículo a la tabla
    $obj_tabla_jugadores->create($jugador);

    # Obtener la array artículos
    $array_jugadores = $obj_tabla_jugadores->tabla;