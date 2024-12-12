<?php

    /*
        controlador: nuevo.php
        descripción: muestra formulario añadir libro
    */

   
    include 'config/configDB.php';

    # Clases
    include 'class/class.libro.php';
    include 'class/class.conexion.php';
    include 'class/class.tabla_libros.php';

    # Librerias

    # Model
    include 'models/model.nuevo.php';

    # Vista
    include 'views/view.nuevo.php';