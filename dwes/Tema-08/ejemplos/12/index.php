<?php

    /*
        Manejo de directorios mediante la función:
        - scandir()

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

    // Ver contenido del directorio files con scandir
    $files = scandir('files', 0);

    // Muestro el contenido del directorio files
    echo '<pre>';
    print_r($files);
    echo '</pre>';

    // Recorro el array de ficheros y directorios
    echo 'Contenido del directorio files:<br>';
    foreach ($files as $file) {
        if (is_dir('files/' . $file)) {
            echo 'Directorio: ' . $file . '<br>';
        } else {
            echo 'Fichero: ' . $file . ' - ' . filesize('files/' . $file) . ' bytes<br>';
        }
    }
    