<?php

    /*
        controlador: editar.php
        descripción: muestra los detalles de un articulo en modo edición

        parámetros:
            - GET - id
            -
    */

    # Clases
    include 'class/class.articulo.php';
    include 'class/class.tabla_articulos.php';

    # Librerias

    # Model
    include 'models/model.editar.php';

    # Vista
    include 'views/view.editar.php';