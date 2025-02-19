<?php
/**
 * Ejemplo
 * 
 * Hola mundo fpdf
 */

 // Incluimmso la librería fdpf
require('fpdf/fpdf.php');

// Creamo un objeto de la clase FDPF
$pdf = new FPDF();

// Añadimos una página
$pdf->AddPage();

// Establecemos la fuente y el tamaño
$pdf->SetFont('Courier','B',16);



// alternativa
$pdf->Cell(40,10,iconv('UTF-8', 'iso-8859-1', '¡Hola, Mundo!'));

// Cerramos pdf
$pdf->Output();