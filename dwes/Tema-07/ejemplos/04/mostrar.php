<?php
 /**
  * Mostrar cookies

  */

  // Comprobar si existe la cookie nombre
    if(isset($_COOKIE['nombre'])){
        echo 'Nombre: ' . $_COOKIE['nombre'] . '<br>';
    }else{
        echo 'La cookie nombre no existe <br>';
    }
    // Comprobar si existe la cookie edad
    if(isset($_COOKIE['edad'])){
        echo 'Edad: ' . $_COOKIE['edad'] . '<br>';
    }else{
        echo 'La cookie edad no existe <br>';
    }
    // Comprobar si existe la cookie ciudad
    if(isset($_COOKIE['ciudad'])){
        echo 'Ciudad: ' . $_COOKIE['ciudad'] . '<br>';
    }else{
        echo 'La cookie ciudad no existe <br>';
    }
    // mostrar array asociativo con todas las cookies
    print_r($_COOKIE);