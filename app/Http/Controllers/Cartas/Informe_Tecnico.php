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
        $this->widths = array(14, $this->width - 14);
        $this->Row(array(utf8_decode('De:'), utf8_decode('M.Sc. Daniel Tejerina Claudio - Coordinador Académico ESCUELA DE INGENIERIA - UAGRM')), 1, "L", "N");
        $this->Row(array(utf8_decode('A:'), utf8_decode('Ph.D. Ing. Orlando Pedraza Mérida - DECANO DE LA FACULTAD DE CIENCIAS EXACTAS Y TECNOLOGIA.')), 1, "L", "N");

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

    function Row($data, $pintado = 0, $alling = 'C', $negrita = "N")
    {
        //Calculate the height of the row
        $nb = 0;
        for ($i = 0; $i < count($data); $i++)
            $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
        $h = 5 * $nb + 2;
        //Issue a page break first if needed
        //Draw the cells of the row
        for ($i = 0; $i < count($data); $i++) {
            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : $alling;
            //Save the current position
            $x = $this->fpdf->GetX();
            $y = $this->fpdf->GetY();
            if ($pintado == 1) {
                $this->fpdf->SetFillColor(224, 235, 255);
                $this->fpdf->Rect($x - 1, $y, $w + 1, $h, 'DF');
                $this->fpdf->SetXY($x, $y + 1);
                // celeste clarito
                $this->fpdf->SetFont('Arial', 'B', 10);
            } else {

                $this->fpdf->Rect($x, $y, $w, $h);
                $this->fpdf->SetXY($x, $y + 1);
                $this->fpdf->SetFont('Arial', '', 10);
                if ($i == 0) {
                    $a = 'L';
                }
                if ($negrita === "S") {
                    $this->fpdf->SetFont('Arial', 'B', 10);
                }
                if ($negrita === "SI") {
                    $this->fpdf->SetFont('Arial', 'BI', 10);
                }
            }
            $this->fpdf->MultiCell($w, $this->space, $data[$i], 0, $a, $pintado);
            $pintado = 0;
            //Put the position to the right of the cell
            $this->fpdf->SetXY($x + $w, $y);
            // letra color negro
            $this->fpdf->SetTextColor(0, 0, 0);
        }
        $this->fpdf->Ln($h);
    }

    function CheckPageBreak($h)
    {
        //If the height h would cause an overflow, add a new page immediately
        if ($this->fpdf->GetY() + $h > $this->PageBreakTrigger)
            $this->fpdf->AddPage($this->CurOrientation);
    }

    function NbLines($w, $txt)
    {
        //Computes the number of lines a MultiCell of width w will take
        $cw = &$this->fpdf->CurrentFont['cw'];
        if ($w == 0)
            $w = $this->fpdf->w - $this->fpdf->rMargin - $this->fpdfx;
        $wmax = ($w - 2 * $this->fpdf->cMargin) * 1000 / $this->fpdf->FontSize;
        $s = str_replace("\r", '', $txt);
        $nb = strlen($s);
        if ($nb > 0 and $s[$nb - 1] == "\n")
            $nb--;
        $sep = -1;
        $i = 0;
        $j = 0;
        $l = 0;
        $nl = 1;
        while ($i < $nb) {
            $c = $s[$i];
            if ($c == "\n") {
                $i++;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
                continue;
            }
            if ($c == ' ')
                $sep = $i;
            $l += $cw[$c];
            if ($l > $wmax) {
                if ($sep == -1) {
                    if ($i == $j)
                        $i++;
                } else
                    $i = $sep + 1;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
            } else
                $i++;
        }
        return $nl;
    }
}