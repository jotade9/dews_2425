<?php

    /*
        controlador: ordenar.php
        descripción: ordena la tabla libros a partir de una de las  columnas
    */

    # Archivos de configuración
    include 'config/configDB.php';

    # Clases
    include 'class/class.alumno.php';
    include 'class/class.conexion.php';
    include 'class/class.tabla_alumnos.php';

    # Librerias

    # Model
    include 'models/model.ordenar.php';

    # Vista
    include 'views/view.index.php';