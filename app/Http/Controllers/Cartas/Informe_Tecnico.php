<?php

namespace App\Http\Controllers\Cartas;

use Codedge\Fpdf\Fpdf\Fpdf;

class Informe_Tecnico extends Fpdf
{
    protected $fpdf;
    public $title = "INFORME TECNICO";
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

    public function informe($data)
    {
        $this->fpdf->AddPage();
        $this->fpdf->SetMargins(25, $this->margin, 20);
        $this->fpdf->SetAutoPageBreak(true, 20);

        $this->fpdf->Ln(20);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode($this->title), 0, 'C', 0);


        $this->fpdf->Ln(4);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->SetX($this->vineta - 4);
        $this->MultiCellBlt($this->width - 10, 4, 'De:', utf8_decode('M.Sc. Daniel Tejerina Claudio - Coordinador Académico ESCUELA DE INGENIERIA - UAGRM'));

        $this->fpdf->SetX($this->vineta - 4);
        $this->MultiCellBlt($this->width - 10, 4, 'A: ', utf8_decode('Ph.D. Ing. Orlando Pedraza Mérida - DECANO DE LA FACULTAD DE CIENCIAS EXACTAS Y TECNOLOGIA.'));

        $this->fpdf->Ln(5);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode('Distinguida Lic. Orosco:'), 0, 'L', 0);
        $this->fpdf->Ln(5);

        // CONTENIDO
        $contenido = [
            'first' => "En cumplimiento a las normas establecidas, informo a usted que el proceso de calificación para la contratación del consultor por producto para el MÓDULO denominado: 'Instrumentación Industrial, Sistema Scada y HMI', en relación al DIPLOMADO en Control y Automatización de Procesos Industriales (1º Versión, 3º Edición) VIRTUAL. Se concluyó con el proceso bajo el siguiente detalle: ",
            'second' => "Por todo lo expuesto anteriormente expreso la conformidad respecto a la recepción de todos los temas arriba citados e informar que CUMPLE con los requerido por la capacitación según los términos de referencia; así también se RECOMIENDA LA ADJUDICACION.",
        ];
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode($contenido['first']), 0, 'J', 0);
        $this->fpdf->Ln(4);

        $this->fpdf->SetX($this->vineta);
        $this->MultiCellBlt($this->width - 10, 4, chr(149), utf8_decode('Solicitud de contratación para consultor e informe presupuestario mediante comunicación ESCUELA DE INGENIERIA OF.COORD. ACA. N.º 1269/2022.'));

        $this->fpdf->SetX($this->vineta);
        $this->MultiCellBlt($this->width - 10, 4, chr(149), utf8_decode('CONSULTOR	: M.Sc. Miguel Angel Villalobos Rivas.'));

        $this->fpdf->SetX($this->vineta);
        $this->MultiCellBlt($this->width - 10, 4, chr(149), utf8_decode('CEDULA DE IDENTIDAD: 2378154 S.C.'));

        $this->fpdf->SetX($this->vineta);
        $this->MultiCellBlt($this->width - 10, 4, chr(149), utf8_decode('PROGRAMAS 	:  DIPLOMADO EN CONTROL Y AUTOMATIZACION DE PROCESOS INDUSTRIALES (1º Versión, 3º Edición) VIRTUAL.'));

        $this->fpdf->SetX($this->vineta);
        $this->MultiCellBlt($this->width - 10, 4, chr(149), utf8_decode('MODULO   : "Instrumentación Industrial, Sistema Scada y HMI".'));

        $this->fpdf->SetX($this->vineta);
        $this->MultiCellBlt($this->width - 10, 4, chr(149), utf8_decode('HONORARIO	: 6000Bs (Total Ganado).'));

        $this->fpdf->SetX($this->vineta);
        $this->MultiCellBlt($this->width - 10, 4, chr(149), utf8_decode('HORAS ACADEMICAS: 60 hrs.'));

        $this->fpdf->SetX($this->vineta);
        $this->MultiCellBlt($this->width - 10, 4, ' ', utf8_decode('DURACION DEL MODULO:  15/08/2022 al 28/08/2022.'));

        $this->fpdf->SetX($this->vineta);
        $this->MultiCellBlt($this->width - 10, 4, chr(149), utf8_decode('HORARIOS   :  Lunes a Viernes de 18:30 a 22:00 , Sábados y Domingos de 10:00 a 12:30 horas'));

        $this->fpdf->Ln(4);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode('EL CONSULTOR NO PRESENTA FACTURA.'), 0, 'L', 0);
        $this->fpdf->Ln(4);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode($contenido['second']), 0, 'J', 0);
        $this->fpdf->Ln(4);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode('Santa Cruz 11 de agosto del 2022.'), 0, 'L', 0);

        // pie de pagina
        $this->fpdf->Ln(40);

        // FONT BOLD
        $this->fpdf->MultiCell($this->width, 4, utf8_decode("_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _"), 0, 'C', 0);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->MultiCell($this->width, 4, utf8_decode("M.Sc. Daniel Tejerina Claudio"), 0, 'C', 0);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->MultiCell($this->width, 4, utf8_decode("Coordinador Académico"), 0, 'C', 0);
        $this->fpdf->MultiCell($this->width, 4, utf8_decode("ESCUELA DE INGENIERIA - UAGRM"), 0, 'C', 0);
        $this->fpdf->Output("I", "Informe Tecnico.pdf");
    }

    function MultiCellBlt($w, $h, $blt, $txt, $border = 0, $align = 'J', $fill = false)
    {
        //Get bullet width including margins
        $blt_width = $this->fpdf->GetStringWidth($blt) + 2 * 2;

        //Save x
        $bak_x = $this->fpdf->GetX();

        //Output bullet
        $this->fpdf->Cell($blt_width, $h, $blt, 0, '', $fill);

        //Output text
        $this->fpdf->MultiCell($w - $blt_width, $this->space, $txt, $border, $align, $fill);

        //Restore x
        $this->fpdf->SetX($bak_x);
    }
}
