<?php
    /**
     * definimos los privilegios de la aplicacion
     * 
     * Recordamos los perfiles:
     * - 1: Administrador
     * - 2: editaror
     * - 3: Registrado
     * 
     * Recordamos los controladores o recursos:
     * - 1: Alumno
     * 
     * Los privilegios son:
     * - 1: main
     * - 2: nuevo
     * - 3: editar
     * - 4: eliminar
     * - 5: mostrar
     * - 6: ordenar
     * - 7: filtrar
     * 
     * Los perfiles se asignaras mediante un array asociativo
     * donde la clave principal se corresponde con el controlador
     * la clave secundaria el método.
     * 
     * $Global['alumno']['main'] = [1, 2, 3];
     * 
     * Se asignan  los perfiles que tienen acceso a un determinado metodo del controlador
     */

    $Global['alumno']['main'] = [1, 2, 3];
    $Global['alumno']['nuevo'] = [1, 2];
    $Global['alumno']['editar'] = [1, 2];
    $Global['alumno']['eliminar'] = [1];
    $Global['alumno']['mostrar'] = [1, 2, 3];
    $Global['alumno']['ordenar'] = [1, 2, 3];
    $Global['alumno']['filtrar'] = [1, 2, 3];

