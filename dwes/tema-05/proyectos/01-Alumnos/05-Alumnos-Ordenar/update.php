<?php

/*
        controlador: update.php
        descripción: actualiza los detalles de un artículo
    */

    # Archivos de configuración
    include 'config/configDB.php';

    # Clases
    include 'class/class.alumno.php';
    include 'class/class.conexion.php';
    include 'class/class.tabla_alumnos.php';

    # Librerias

    # Model
    include 'models/model.update.php';

    # Redirecciono al controlador index
    header("location: index.php");