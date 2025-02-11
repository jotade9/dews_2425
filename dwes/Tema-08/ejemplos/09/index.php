<?php

    /*
        Operaciones básicas con archivos:
        - copiar
        - eliminar
        - renombrar
        - mover

        Operaciones básicas con directorios:
        - renombrar
    */

    # ------------------ Copiar ------------------
    // Copiar el archivo 'archivo.txt' a la carpeta files/txt
    copy('files/archivo.txt', 'files/txt/archivo.txt');

    // Copiar el archivo 'archivo2.txt' a la carpeta files/txt
    copy('files/archivo2.txt', 'files/txt/archivo2.txt');

    // Nueva versión del archivo 'archivo.txt' en la carpeta files/txt
    copy('files/archivo.txt', 'files/txt/archivo_v2.txt');

    // Copiar el archivo 'archivo2.txt' a la carpeta files/txt con otro nombre
    copy('files/archivo2.txt', 'files/txt/archivo2_v2.txt');

    // Copiar un archivo a una carpeta donde ya existe un archivo con el mismo nombre
    copy('files/archivo.txt', 'files/txt/archivo_v2.txt');

    # ------------------ Renombrar ------------------
    // Cambiar el nombre a un archivo
    rename('files/txt/archivo.txt', 'files/txt/archivo_renombrado.txt');

    // Cambiar el nombre al directorio 'files/txt'
    rename('files/txt', 'files/txt_renombrado');

    # ------------------ Mover ------------------ 
    // Mover el archivo 'archivo3.txt' a la carpeta files/txt
    rename('files/archivo3.txt', 'files/txt/archivo3.txt');

    # ------------------ Eliminar ------------------
    // Eliminar el archivo 'archivo.txt' de la carpeta files/txt
    unlink('files/txt/archivo.txt');
