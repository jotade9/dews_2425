<?php

    /*
        controlador: index.php
        descripción: muestra los detalles de los libros
    */

    include 'config/configDB.php';

    # Clases
    include 'class/class.libro.php';
    include 'class/class.conexion.php';
    include 'class/class.tabla_libros.php';

    # Librerias

    # Model
    include 'models/model.index.php';

    # Vista
    include 'views/view.index.php';