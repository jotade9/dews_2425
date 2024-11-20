<?php

    /*
        modelo: model.mostrar.php
        descripción: carga los datos del jugadores que deseo mostrar

        Método GET:

            - indice de la tabla en la que se encuentra el jugadores
    */
    # Cargamos el id del libro
    $indice = $_GET['indice'];

    # Creo un objeto de la clase tabla de jugadores
    $obj_tabla_jugadores = new Class_tabla_jugadores();

    #  Cargo los datos de jugadores
    $obj_tabla_jugadores->getDatos();
    
    # Cargo el array de Equipos - lista desplegable dinámica
    $equipos= $obj_tabla_jugadores->getEquipos();

    # Cargo el array de tPosiciones - lista checbox dinámica
    $posiciones = $obj_tabla_jugadores->getPosiciones();

    # Obtener el objeto de la clase libro correspondiente a ese índice
    $array_jugador = $obj_tabla_jugadores->read($indice);



