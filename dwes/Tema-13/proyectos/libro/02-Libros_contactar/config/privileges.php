<?php
/* 
    Descripción:
        Archivo que contiene los privilegios de la aplicación

    Perfiles:
        
1: Administrador
2: Editor
    
3: Registrado

Controladores:
1: libro

    Privilegios:
        
1: main
2: nuevo
3: editar
4: eliminar
5: mostrar
6: ordenar
7: filtrar

    Los perfiles se asignarán mediante un array asociativo, 
    donde la clave se corresponderá con el controlador 
    y la clave secundaria con el método.

    $GLOBALS['libro']['main'] = [1, 2, 3];


*/

$GLOBALS['libro']['main'] = [1, 2, 3];
$GLOBALS['libro']['nuevo'] = [1, 2];
$GLOBALS['libro']['editar'] = [1, 2];
$GLOBALS['libro']['eliminar'] = [1];
$GLOBALS['libro']['mostrar'] = [1, 2, 3];
$GLOBALS['libro']['ordenar'] = [1, 2, 3];
$GLOBALS['libro']['filtrar'] = [1, 2, 3];
$GLOBALS['libro']['importar'] = [1];
$GLOBALS['libro']['exportar'] = [1];
$GLOBALS['libro']['pdf'] = [1, 2];

$GLOBALS['autor']['main'] = [1, 2, 3];
$GLOBALS['autor']['nuevo'] = [1, 2];
$GLOBALS['autor']['editar'] = [1, 2];
$GLOBALS['autor']['eliminar'] = [1];
$GLOBALS['autor']['mostrar'] = [1, 2, 3];
$GLOBALS['autor']['ordenar'] = [1, 2, 3];
$GLOBALS['autor']['filtrar'] = [1, 2, 3];
$GLOBALS['autor']['importar'] = [1];
$GLOBALS['autor']['exportar'] = [1];
$GLOBALS['autor']['pdf'] = [1, 2];