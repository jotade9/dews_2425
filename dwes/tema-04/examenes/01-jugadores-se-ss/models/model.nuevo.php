<?php

    /*
        Modelo: model.nuevo.php
        Descripción: genera los datos necesarios para añadir nuevo jugador
    */
    
    # Crear un objeto de la clase tabla_jugadores
    $obj_tabla_jugadores = new Class_tabla_jugadores();

    # Cargo los jugadores
    $obj_tabla_jugadores->getDatos();

    # Obtengo el array de equipos
    $equipos = $obj_tabla_jugadores->getEquipos();

    # Obtengo el  array de posiciones
    $posiciones= $obj_tabla_jugadores->getPosiciones();



    

