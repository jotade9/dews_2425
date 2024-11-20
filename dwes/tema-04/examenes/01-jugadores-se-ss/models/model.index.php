<?php

    /*
        Modelo: model.index.php
        Descripción: genera array objetos de la clase jugadores
    */
    
    
    # Creo un objeto de la clase tabla jugadores
    $obj_tabla_jugadores = new Class_tabla_jugadores();

    # Cargo los datos de los jugadores
    $obj_tabla_jugadores->getDatos();

    # Cargo los datos de los equipos
    $equipos = $obj_tabla_jugadores->getEquipos();

    # Cargo los datos de las posiciones
    $posiciones = $obj_tabla_jugadores->getPosiciones();

    $array_jugador = $obj_tabla_jugadores->tabla;


