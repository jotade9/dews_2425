<<<<<<< HEAD
<?php

/**
 * Modelo: model.create.php
 * 
 * Descripcion: añade un nuevo alumno a la tabla
 * 
 * Método POST:
 *      -nombre
 *      -poblacion
 *      -curso
 */

 #Extraemos los valores del formulario
 $id = $_POST['id'];


 # Cargar tabla ordenador
 $ordenador = generar_tabla();

 # Creo un array asociativo con los detalles del nuevo alumno
 $registro = [
    'id' => $id,

 ];

 # Añadir el nuevo alumno a la tabla
 $ordenador[] = $registro;


    
    
=======
<?php

/**
 * Modelo: model.create.php
 * 
 * Descripcion: añade un nuevo alumno a la tabla
 * 
 * Método POST:
 *      -nombre
 *      -poblacion
 *      -curso
 */

 #Extraemos los valores del formulario
 $id = $_POST['id'];


 # Cargar tabla ordenador
 $ordenador = generar_tabla();

 # Creo un array asociativo con los detalles del nuevo alumno
 $registro = [
    'id' => $id,

 ];

 # Añadir el nuevo alumno a la tabla
 $ordenador[] = $registro;


    
    
>>>>>>> 880701ca79aea3b9a52b24be21ccbac733d67c82
?>