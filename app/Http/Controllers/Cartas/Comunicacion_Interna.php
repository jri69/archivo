<?php

namespace App\Http\Controllers\Cartas;

use Codedge\Fpdf\Fpdf\Fpdf;

class Comunicacion_Interna extends Fpdf
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

        $this->fpdf->SetFont('Arial', 'B', 9);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("OF. COORD. ADM XXXXX"), 0, 'R', 0);

        $this->fpdf->Ln(2);
        $this->widths = array(14, $this->width - 14);
        $this->Row(array(utf8_decode('A:'), utf8_decode('Abog. Rene Menacho - ASESOR LEGAL F.C.E.T. - UAGRM.')), 1, "L", "N");
        $this->Row(array(utf8_decode('VIA:'), utf8_decode('M.Sc. Ing. Erick Rojas Balcazar - DIRECTOR DE LA ESCUELA DE INGENIERIA F.C.E.T.')), 1, "L", "N");
        $this->Row(array(utf8_decode('DE:'), utf8_decode('Lic. María Rene Muguertegui de Méndez - RESPONSABLE DEL PROCESO DE CONTRATACIÓN')), 1, "L", "N");
        $this->Row(array(utf8_decode('REF:'), utf8_decode('SOLICITUD DE REVISIÓN DE DOCUMENTACIÓN Y ELABORACIÓN DE CONTRATO A FAVOR DEL M.SC. MIGUEL ANGEL VILLALOBOS RIVAS, ADJUDICACIÓN CONTRATACIÓN MENOR PARA EL MÓDULO DENOMINADO: "INSTRUMENTACIÓN INDUSTRIAL, SISTEMA SCADA Y HMI", EN RELACIÓN AL DIPLOMADO EN CONTROL Y AUTOMATIZACION DE PROCESOS INDUSTRIALES (1º VERSIÓN, 3º EDICIÓN) VIRTUAL. A EJECUTARSE CON RECURSOS PROPIOS, POR UN MONTO DE BS. 6,000.00 (SEIS MIL CON 00/100 BOLIVIANOS). A REALIZARSE EN UN PLAZO DE 60 HORAS ACADÉMICAS.-')), 1, "L", "SI");

        $this->fpdf->Ln(5);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode('Santa Cruz, 11 de agosto del 2022'), 0, 'R', 0);
        $this->fpdf->Ln(5);

        // CONTENIDO
        $contenido = [
            'first' => "Según el oficio OF.COORD. ACA. N.º 1269/2022 del Coordinador Académico de la ESCUELA DE INGENIERIA - UAGRM, remito a usted la integridad del proceso de Contratación para el MÓDULO DENOMINADO: 'INSTRUMENTACIÓN INDUSTRIAL, SISTEMA SCADA Y HMI', EN RELACIÓN AL DIPLOMADO EN CONTROL Y AUTOMATIZACION DE PROCESOS INDUSTRIALES (1º VERSIÓN, 3º EDICIÓN) VIRTUAL. (UNA CARPETA), A EFECTOS DE LA RECEPCIÓN y verificación de la documentación requerida para la elaboración y firma del contrato, teniendo un plazo hasta el 13/08/22.",
            'second' => "Proceda a ejecutar las siguientes acciones: En sujeción al D.S. 181 art. 37.- (ASESORIA LEGAL). En cada proceso de contratación, tiene como principales funciones:",
        ];
        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("De mi mayor consideración:"), 0, 'L', 0);
        $this->fpdf->Ln(4);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode($contenido['first']), 0, 'J', 0);
        $this->fpdf->Ln(4);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode($contenido['second']), 0, 'J', 0);

        $this->fpdf->SetX($this->vineta);
        $this->MultiCellBlt($this->width - 10, 4, 'a)', utf8_decode('Atender y asesorar en la revisión de documentos y asuntos legales que sean sometidos a su consideración durante el proceso de contratación.'));

        $this->fpdf->SetX($this->vineta);
        $this->MultiCellBlt($this->width - 10, 4, 'b)', utf8_decode('Elaborar todos los informes legales requeridos en el proceso de contratación.'));

        $this->fpdf->SetX($this->vineta);
        $this->MultiCellBlt($this->width - 10, 4, 'c)', utf8_decode('Elaborar los contratos para los procesos de contratación.'));

        $this->fpdf->SetX($this->vineta);
        $this->MultiCellBlt($this->width - 10, 4, 'd)', utf8_decode('Firmar o visar el contrato de forma previa a su suscripción, como responsable de su elaboración.'));

        $this->fpdf->SetX($this->vineta);
        $this->MultiCellBlt($this->width - 10, 4, 'e)', utf8_decode('Revisar la legalidad de la documentación presentada por el proponente adjudicado para la suscripción del contrato.'));

        $this->fpdf->SetX($this->vineta);
        $this->MultiCellBlt($this->width - 10, 4, 'f)', utf8_decode('Atender y asesorar en procedimientos, plazos y resolución de Recursos Administrativos de impugnación.'));

        $this->fpdf->SetX($this->vineta);
        $this->MultiCellBlt($this->width - 10, 4, 'g)', utf8_decode('Elaborar y visar todas las Resoluciones establecidas en las presentes NB-SABS.'));

        $this->fpdf->SetX($this->vineta);
        $this->MultiCellBlt($this->width - 10, 4, 'h)', utf8_decode('Elaborar el informe.'));

        $this->fpdf->Ln(1);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode('Con este motivo, saludo a usted atentamente'), 0, 'L', 0);

        // pie de pagina
        $this->fpdf->Ln(15);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->MultiCell($this->width, 4, utf8_decode("Adjunto: Lo indicado "), 0, 'L', 0);
        $this->fpdf->MultiCell($this->width, 4, utf8_decode("C.c.  Archivo-Dirección E.I."), 0, 'L', 0);

        // FONT BOLD
        $this->fpdf->Output("I", "Comunicacion Interna.pdf");
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
