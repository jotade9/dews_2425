<?php

    /*
        Manejo de directorios mediante la función:
        - Glob(): permite establecer un patrón de búsqueda para los archivos y directorios

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

    // Muestro el directorio actual
    echo 'Directorio actual: ' . getcwd() . '<br>';

    // Ver contenido de un directorio con glob()
    $files = glob('files/a*.*');

    // Muestro el contenido del directorio
    echo '<pre>';
    print_r($files);
    echo '</pre>';