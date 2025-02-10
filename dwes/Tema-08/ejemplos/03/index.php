<?php

    /*
        Leer y guardar en un archivo de texto plano

        - file_get_contents
        - file_put_contents
    */

    // Guardo el contenido del archivo en una variable
    $archivo = file_get_contents("archivo.txt");

    // Añado una nueva línea al archivo
    $archivo .= "Nueva información añadida al archivo\n";

    // Guardo el contenido en el archivo
    file_put_contents("archivo.txt", $archivo);