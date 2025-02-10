<?php

    /*
        Operaciones básicas de archivos y directorios:

        - chdir: Cambia el directorio actual
        - chroot: Cambia el directorio raíz
        - closedir: Cierra un directorio abierto
        - dir: Abre un directorio
        - getcwd: Devuelve el directorio actual
        - opendir: Abre un directorio
        - readdir: Lee un directorio
        - rewinddir: Reinicia el puntero de un directorio
        - scandir: Devuelve un array con los elementos de un directorio
    */

    // Directorio actual
    echo 'Directorio actual:' . getcwd() . '<br>';

    // Abrir directorio 'files'
    $dir = opendir('files');

    // Leer directorio 'files'
    echo 'Contenido del directorio: ' . $dir . '<br>';
    while ($file = readdir($dir)) {
        if (is_file('files/' . $file)) { // Podemos hacer lo mismo con un if corto 
            echo '<br> Fichero: '. $file . ' - ';
            // Muestro el tamaño del fichero
            echo filesize('files/' . $file) . ' bytes<br>';
        } else {
            echo '<br> Directorio: '. $file . '<br>';
        }
    }
    
    // Podemos hacer lo mismo con un if corto
    
    // Cerrar directorio 'files'
    closedir($dir);