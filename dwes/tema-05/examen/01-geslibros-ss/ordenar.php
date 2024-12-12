<?php

/*
    controlador: ordenar.php
    descripción: ordena los detalles de los libros
*/

include 'config/configDB.php';

# Clases
include 'class/class.libro.php';
include 'class/class.conexion.php';
include 'class/class.tabla_libros.php';

# Librerias

# Model
include 'models/model.ordenar.php';

# Vista
include 'views/view.index.php';