<?php  

require_once 'libs/database.php';
require_once 'libs/controller.php';
require_once 'libs/model.php';
require_once 'libs/view.php';

require_once 'libs/app.php';
require_once 'config/config.php';
require_once 'config/privileges.php';
require_once 'class/libro.class.php';

// Incluimos la libreria fpdf
require_once 'fpdf186/fpdf.php';

// Incluimos la clase Pdf_libros
require_once 'class/pdf_libros.php';

// Creo objeto pdf_libros
$pdf = new Pdf_libros('P', 'mm', 'A4');

// Imprimir número pagina actual
$pdf->AliasNbPages();

// Añadir página
$pdf->AddPage();

// Añado el título
$pdf->titulo();

// Cabecera del listado
$pdf->cabecera();

// Cuerpo listado
$pdf->SetFont('Courier', '', 10);
//Fondo pautado para las líneas pares
$pdf->SetFillColor(205, 205, 205);

$fondo = false;
// Escribir los datos de los libros
foreach ($libros as $libro) {
    $pdf->SetFillColor($fondo ? 255 : 205, $fondo ? 255 : 205, $fondo ? 255 : 205);
    $pdf->Cell(10, 10, $libro['id'], 1, 0, 'C', 1);
    $pdf->Cell(50, 10, iconv('UTF-8', 'ISO-8859-1', $libro['titulo']), 1, 0, 'C', 1);
    $pdf->Cell(50, 10, iconv('UTF-8', 'ISO-8859-1', $libro['autor']), 1, 0, 'C', 1);
    $pdf->Cell(50, 10, iconv('UTF-8', 'ISO-8859-1', $libro['editorial']), 1, 0, 'C', 1);
    $pdf->Cell(30, 10, $libro['paginas'], 1, 0, 'C', 1);
    $pdf->Cell(30, 10, $libro['precio'], 1, 1, 'C', 1);
    $fondo = !$fondo;
}

// Cerramos pdf
$pdf->Output('I', 'listado_libros.pdf');

$app = new App();


