<?php
/**
 * Operaciones basicas de archivos 
 * 
 * copiar,
 * renombrar,
 * borrar,
 * mover,
 */

//copiar
//copiar el archivo archivo.txt a la carpeta txt
copy('files/archivo.txt','files/txt/archivo.txt');

//copiar el archivo archivo2.txt a la carpeta txt 
copy('files/archivo2.txt','files/txt/archivo2.txt');

//renombrar 
copy('files/archivo.txt','files/archivo_renombrado.txt');

//copiar el archivo archivo2.txt a la carpeta txt con otro nombre
copy('files/archivo2.txt','files/txt/archivo2_renombrado.txt');