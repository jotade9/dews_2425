<?php
/**
 * Ejemplo 5
 * Descripcion: uso clase libro con encapsulamiento
 */

 # Cargo la clase libro
 include 'class/class.libro.php';

 # Crear un objeto libro  vacio
 $libro1 = new Class_libro();

# Asignar valores al libro
$libro1->setId(1);
$libro1->setTitulo('Cien años de soledad');
$libro1->setPrecio(10.54);
$libro1->setPaginas(25);
$libro1->setAutor('Gabriel García Márquez');
$libro1->setTematica(['Novela', 'Drama', 'Romance']);

 # Mostrar detalles clase libro
 echo 'Id: '. $libro1->getId();
 echo '<br>';
 echo 'Titulo: '. $libro1->getTitulo();
 echo '<br>';
 echo 'Precio: '. $libro1->getPrecio();
 echo '<br>';
 echo 'Páginas: '. $libro1->getPaginas();
 echo '<br>';
 echo 'Autor: '. $libro1->getAutor();
 echo '<br>';
 echo 'Temáticas: '. implode(', ',$libro1->getTematicas());
 echo '<br>';

 # Crear objeto libro con parámetros
 $libro2 = new Class_libro(
    2,
    'La historia interminable',
    23.45,
    34, 
    'Mikel Ende', 
    ['Novela', 'Juvenil', 'Ficcion']
 );
 echo 'Id: '. $libro2->getId();
 echo '<br>';
 echo 'Titulo: '. $libro2->getTitulo();
 echo '<br>';
 echo 'Precio: '. $libro2->getPrecio();
 echo '<br>';
 echo 'Páginas: '. $libro2->getPaginas();
 echo '<br>';
 echo 'Autor: '. $libro2->getAutor();
 echo '<br>';
 echo 'Temáticas: '. implode(', ',$libro2->getTematicas());
 echo '<br>';