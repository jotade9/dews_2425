<?php

/**
 *  Eliminacion cookies
 */

 // Eliminar cookie nombre
    setcookie("nombre", "", time() - 3600);

    // Eliminar cookie edad
    setcookie("edad", "", time() - 3600);

    // Eliminar cookie ciudad
    setcookie("ciudad", "", time() - 3600);
    echo "Cookies eliminadas correctamente";