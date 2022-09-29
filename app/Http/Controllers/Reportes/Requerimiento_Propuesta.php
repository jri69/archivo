<?php

namespace App\Http\Controllers\Reportes;

use Codedge\Fpdf\Fpdf\Fpdf;

class Requerimiento_Propuesta extends Fpdf
{
    protected $fpdf;
    public $title = "REF.- REQUERIMIENTO DE PROPUESTA";
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

    public function propuesta()
    {
        $this->fpdf->AddPage();
        $this->fpdf->SetMargins(25, $this->margin, 20);
        $this->fpdf->SetAutoPageBreak(true, 20);

        $this->fpdf->Ln(15);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->MultiCell($this->width, 4, utf8_decode("Santa Cruz de la sierra 01 de agosto del 2022"), 0, 'L', 0);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("OF. COORD. ACAD. N° 1269/2022"), 0, 'L', 0);

        $this->fpdf->Ln(4);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("Señor. - "), 0, 'L', 0);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("M.Sc. Miguel Angel Villalobos Rivas "), 0, 'L', 0);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("CONSULTOR."), 0, 'L', 0);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("Presente. -"), 0, 'L', 0);

        $this->fpdf->Ln(8);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode($this->title), 0, 'C', 0);
        $this->fpdf->Ln(7);

        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("M.Sc. Villalobos."), 0, 'L', 0);
        $this->fpdf->Ln(8);

        // CONTENIDO
        $contenido = [
            'first' => "Tengo a bien remitir a su persona el requerimiento de propuesta en calidad de consultor en el MÓDULO denominado: “Instrumentación Industrial, Sistema Scada y HMI”, en relación al DIPLOMADO en Control y Automatización de Procesos Industriales (1º Versión, 3º Edición). VIRTUAL. A realizarse en fecha 15/08/2022 al 28/08/2022. Teniendo una carga horaria de 60 (sesenta) horas Académicas, el programa antes mencionado depende de la coordinación académica.",
            'second' => "En caso de estar interesado, por favor hacer llegar el CURRÍCULUM VITAE, CÉDULA DE IDENTIDAD, PROGRAMA DE ASIGNATURA (PROPUESTA) y dar la conformidad de aceptación por escrito hasta el 11 de agosto de 2022.",
        ];
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode($contenido['first']), 0, 'J', 0);
        $this->fpdf->Ln(4);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode($contenido['second']), 0, 'J', 0);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode('Sin otro particular, saludo a usted atentamente.'), 0, 'L', 0);

        // pie de pagina
        $this->fpdf->Ln(50);

        // FONT BOLD
        $this->fpdf->MultiCell($this->width, 4, utf8_decode("_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _"), 0, 'C', 0);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->MultiCell($this->width, 4, utf8_decode("M.Sc. Ing. Daniel Tejerina Claudio"), 0, 'C', 0);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->MultiCell($this->width, 4, utf8_decode("Coordinador Académico"), 0, 'C', 0);
        $this->fpdf->MultiCell($this->width, 4, utf8_decode("ESCUELA DE INGENIERIA - UAGRM"), 0, 'C', 0);

        $this->fpdf->Output("I", "Requerimiento Propuesta.pdf");
    }
}
