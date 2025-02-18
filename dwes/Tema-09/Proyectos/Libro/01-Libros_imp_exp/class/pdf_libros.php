<?php
class Pdf_libros extends FPDF
{
    public function Header()
    {   
        // Select courier normal tamaño 9
        $this->SetFont('Courier', '', 9);

        // imprimir logo empresa
        $this->image('images/logo_empresa.jpg', 10, 5, 20);

        // Celda
        $this->Cell(0, 10, iconv('UTF-8', 'ISO-8859-1', 'lista de Libros - 2DAW - Curso 24/25'), 'B', 1, 'C');

        // Line break
        $this->Ln(10);
    }

    public function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Select courier normal tamaño 10
        $this->SetFont('Courier', '', 10);
        // Número de página
        $this->Cell(0, 10, iconv('UTF-8', 'ISO-8859-1', 'Página ').$this->PageNo().'/{nb}', 'T', 0, 'C');
    }

    public function titulo()
    {
        // Establecemos la fuente y el tamaño
        $this->SetFont('Courier', 'B', 12);

        // Color de fondo
        $this->SetFillColor(200, 220, 255);

        // Escribimos el título
        $this->Cell(0, 10, iconv('UTF-8', 'ISO-8859-1', 'Lista de Libros'), 0, 1, 'C', 1);

        // Imprimir imagen
        $this->image('images/coche_chino.jpeg', 65, 43, 60);

        // Dejar un espacio de 4 líneas
        $this->Ln(43);
    }
    public function cabecera()
    {
        // sombreado de fondo para el encabezado
        $this->SetFillColor(240, 120, 10);

        // Escribimos los nombres de las columnas
        $this->Cell(10, 10, iconv('UTF-8', 'ISO-8859-1', 'ID'), 1, 0, 'C', 1);
        $this->Cell(50, 10, iconv('UTF-8', 'ISO-8859-1', 'Título'), 1, 0, 'C', 1);
        $this->Cell(50, 10, iconv('UTF-8', 'ISO-8859-1', 'Autor'), 1, 0, 'C', 1);
        $this->Cell(50, 10, iconv('UTF-8', 'ISO-8859-1', 'Editorial'), 1, 0, 'C', 1);
        $this->Cell(30, 10, iconv('UTF-8', 'ISO-8859-1', 'Páginas'), 1, 0, 'C', 1);
        $this->Cell(30, 10, iconv('UTF-8', 'ISO-8859-1', 'Precio'), 1, 1, 'C', 1);
        
    }
}