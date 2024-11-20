<?php
    /*
        controlador: mostrar.php
        descripción: muestra los detalles de un libro sin edición

        parámetros:

            - Método GET:
                - indice donde se ecuentra el libro dentro de la tabla
    */

    # Clases
    include 'class/class.jugador.php';
    include 'class/class.tabla_jugadores.php';

    # Modelo
    include 'models/model.mostrar.php';

    # Vista
    include 'views/view.mostrar.php';