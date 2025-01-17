<?php

/** 
 * Creacion cookies
 */

// Crear cookie nombre con valor Juan
setcookie("nombre", "Juan", time() + 3600);

// Crear cookie edad con valor 30
setcookie("edad", 30, time() + 3600);

// Crear cookie ciudad con valor Ubrique
setcookie("ciudad", "Ubrique", time() + 3600);

echo "Cookies creadas correctamente";
require 'index.php';