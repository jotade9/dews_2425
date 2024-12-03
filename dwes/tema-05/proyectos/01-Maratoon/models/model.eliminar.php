<?php

/*
        modelo: model.eliminar.php
        descripción: elimina corredor de la tabla
        
        Método GET:

            - id: id del corredor
    */

# Cargamos el id del corredor que vamos a editar
$id = $_GET['id'];

# Creo un objeto de la clase tabla corredors
$tabla_corredores = new Class_tabla_corredores();

# Eliminar corredor
$corredor = $tabla_corredores->delete($id);
