<?php

/*
        controlador: eliminar.php
        descripción: elimina un artículo a la tabla

        parámetros:

            - Método GET
                - indice del artículo que voy a eliminar
    */

# Clases
include 'class/class.articulo.php';
include 'class/class.tabla_articulos.php';

# Librerias

# Model
include 'models/model.eliminar.php';

# Vista
include 'views/view.index.php';