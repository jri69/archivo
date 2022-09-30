<?php

namespace App\Http\Controllers\Cartas;

use Codedge\Fpdf\Fpdf\Fpdf;

class Propuesta_Consultor extends Fpdf
{
    protected $fpdf;
    public $title = "REF.- PROPUESTA CONSULTOR";
    public $margin = 30;
    public $width = 165;
    public $space = 5;
    public $vineta = 30;
    public $widths;
    public $aligns;

    public function __construct()
    {
        $this->fpdf = new Fpdf('P', 'mm', 'Letter');
    }

    public function propuesta($data)
    {
        $this->fpdf->AddPage();
        $this->fpdf->SetMargins(25, $this->margin, 20);
        $this->fpdf->SetAutoPageBreak(true, 20);

        $this->fpdf->Ln(25);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->MultiCell($this->width, 4, utf8_decode("Santa Cruz de la sierra 01 de agosto del 2022"), 0, 'L', 0);

        $this->fpdf->Ln(4);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("Señor. - "), 0, 'L', 0);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("M.Sc. Ing. Daniel Tejerina Claudio"), 0, 'L', 0);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("Coordinador Académico"), 0, 'L', 0);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("ESCUELA DE INGENIERIA - UAGRM"), 0, 'L', 0);

        $this->fpdf->Ln(8);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode('Presente.-'), 0, 'L', 0);
        $this->fpdf->Ln(7);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode($this->title), 0, 'L', 0);
        $this->fpdf->Ln(7);

        // CONTENIDO
        $contenido = [
            'first' => "Mediante la presente hago llegar mi ACEPTACION al requerimiento de propuesta para ser consultor en el MÓDULO denominado: 'Instrumentación Industrial, Sistema Scada y HMI', en relación al DIPLOMADO en Control y Automatización de Procesos Industriales (1º Versión, 3º Edición). VIRTUAL.",
            'second' => "Por tanto, adjunto carnet de identidad., programa de asignatura, currículum vitae y demás documentación solicitada por su institución.",
        ];
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->MultiCell($this->width, $this->space + 2, utf8_decode('Estimado Ingeniero:'), 0, 'J', 0);
        $this->fpdf->MultiCell($this->width, $this->space + 2, utf8_decode($contenido['first']), 0, 'J', 0);
        $this->fpdf->Ln(4);
        $this->fpdf->MultiCell($this->width, $this->space + 2, utf8_decode($contenido['second']), 0, 'J', 0);
        $this->fpdf->MultiCell($this->width, $this->space + 2, utf8_decode('Con este grato motivo, saludo a usted cordialmente.'), 0, 'L', 0);

        // pie de pagina
        $this->fpdf->Ln(55);

        // FONT BOLD
        $this->fpdf->MultiCell($this->width, 4, utf8_decode("_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _"), 0, 'C', 0);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->MultiCell($this->width, 4, utf8_decode("M.Sc. Miguel Angel Villalobos Rivas"), 0, 'C', 0);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->MultiCell($this->width, 4, utf8_decode("CONSULTOR."), 0, 'C', 0);

        $this->fpdf->Output("I", "Propuesta Consultor.pdf");
    }
}
