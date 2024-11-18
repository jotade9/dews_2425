<?php
/**
 * Controlador: eliminar.php 
 * descripcion: elimina un profesor de la tabla
 * 
 * parámetros:
 *      - metodo GET
 *          - indice del profesor que voy a eliminar
 */

 # Clases
 include 'class/class.profesor.php';
 include 'class/class.tabla_profesores.php';

 # modelo
 include 'models/model.eliminar.php';

 # Vista
 include 'views/view.index.php';