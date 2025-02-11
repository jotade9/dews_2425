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

    // Cambiar de directorio actual a 'files'
    chdir('files');
    echo 'Directorio actual:' . getcwd() . '<br>'; // Comprobar que se ha cambiado de directorio a 'files'

    // Cambiar al directorio padre
    chdir('..');
    echo 'Directorio actual:' . getcwd() . '<br>'; // Comprobar que se ha cambiado de directorio de nuevo al directorio raíz

    // Cambiar directorio actual a 'files/pdf'
    chdir('files/pdf');
    echo 'Directorio actual:' . getcwd() . '<br>'; // Comprobar que se ha cambiado de directorio a 'files/pdf'

    // Mostrar el contenido de un directorio
    $dir = opendir('.');
    echo 'Contenido del directorio:<br>';
    while ($file = readdir($dir)) {
        echo $file . '<br>';
    }

    // Cambiar directorio actual a 'files'
    chdir('..');
    echo 'Directorio actual:' . getcwd() . '<br>'; // Comprobar que se ha cambiado de directorio a 'files'

    // Mostramos el contenido de ese directorio
    $dir = opendir('.');
    echo 'Contenido del directorio:<br>';
    while ($file = readdir($dir)) {
        echo $file . '<br>';
    }