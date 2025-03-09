<?php
require('fpdf186/fpdf.php');

class FPDF_UTF8 extends FPDF
{
    function Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='')
    {
        $txt = iconv('UTF-8', 'ISO-8859-1', $txt);
        parent::Cell($w, $h, $txt, $border, $ln, $align, $fill, $link);
    }

    function MultiCell($w, $h, $txt, $border=0, $align='J', $fill=false)
    {
        $txt = iconv('UTF-8', 'ISO-8859-1', $txt);
        parent::MultiCell($w, $h, $txt, $border, $align, $fill);
    }

    function Write($h, $txt, $link='')
    {
        $txt = iconv('UTF-8', 'ISO-8859-1', $txt);
        parent::Write($h, $txt, $link);
    }

    function Text($x, $y, $txt)
    {
        $txt = iconv('UTF-8', 'ISO-8859-1', $txt);
        parent::Text($x, $y, $txt);
    }
}