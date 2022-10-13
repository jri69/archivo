<?php

namespace App\Http\Controllers\Cartas;

use Codedge\Fpdf\Fpdf\Fpdf;

class Informe_Conformidad extends Fpdf
{
    protected $fpdf;
    public $title = "REF: INFORME DE CONFORMIDAD DEL MODULO: NOMBRE DEL MODULO";
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

        $this->fpdf->Ln(25);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->MultiCell($this->width, 4, utf8_decode("COMUNICACIÓN INTERNA"), 0, 'C', 0);
        $this->fpdf->MultiCell($this->width, 4, utf8_decode("OF. COORD. ACAD. N° 1370/2022"), 0, 'C', 0);

        $this->fpdf->Ln(4);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("Santa Cruz, 09 de septiembre de 2022"), 0, 'R', 0);
        $this->fpdf->Ln(4);

        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("Señor. - "), 0, 'L', 0);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("M.Sc. Ing. Daniel Tejerina Claudio"), 0, 'L', 0);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("DIRECTOR DE LA ESCUELA DE INGENIERIA - F.C.E.T. "), 0, 'L', 0);

        $this->fpdf->Ln(8);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode($this->title), 0, 'C', 0);
        $this->fpdf->Ln(7);

        // CONTENIDO
        $contenido = [
            'first' => 'De acuerdo al Contrato Administrativo <N° 86/2022> suscrito en la Escuela de Ingeniería, dependiente de la Facultad de Ciencias Exactas y Tecnología de la UAGRM y el <consultor M.Sc. Dyguel Alejandro Hoentsch Vargas>, cuyo objetivo fue el de desarrollar como facilitador (a) en el <MÓDULO>: Gestión de SST y riesgos en la construcción civil, de la <MAESTRÍA> en Administración de Empresas e Ingeniería con mención en: Gerencia Industrial, Proyectos de Ingeniería, Construcciones Civiles (1º Versión, 2º Edición) virtual; ejecutado en fecha <24/06/2022 a 07/07/2022.>',
            'second' => 'Que, revisado el informe académico, acta de nota y el Programa de asignatura impartido por <el consultor>, cumplió con todas nuestras exigencias tanto académicas como de calidad. Expresando por tanto mi CONFORMIDAD por el servicio prestado en la presente gestión 2022. En cumplimiento de los procedimientos institucionales y la ejecución satisfactoria del servicio, solicito la cancelación de los honorarios de <Bs. 6000> del consultor, que fueron presupuestado en el <OF. COORD. ACAD. N° 1017/2022> en fecha <07 de junio del 2022>; con N° de preventiva 1085.',
            'third' => 'Informándole que el consultor SI PRESENTA FACTURA, debiendo realizarse las deducciones de impuesto de ley correspondientes'
        ];
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->MultiCell($this->width, $this->space + 2, utf8_decode('Distinguido Sr. Director:'), 0, 'J', 0);
        // $this->fpdf->MultiCell($this->width, $this->space + 2, utf8_decode($contenido['first']), 0, 'J', 0);
        $this->WriteText($contenido['first']);
        $this->fpdf->Ln(8);
        // $this->fpdf->MultiCell($this->width, $this->space + 2, utf8_decode($contenido['second']), 0, 'J', 0);
        $this->WriteText($contenido['second']);
        $this->fpdf->Ln(8);
        $this->WriteText($contenido['third']);
        $this->fpdf->Ln(8);
        $this->fpdf->MultiCell($this->width, $this->space + 2, utf8_decode('Sin otro particular, me despido de usted con las consideraciones más distinguidas.'), 0, 'L', 0);
        $this->fpdf->MultiCell($this->width, $this->space + 2, utf8_decode('Atte:'), 0, 'L', 0);

        // pie de pagina
        $this->fpdf->Ln(30);

        // FONT BOLD
        $this->fpdf->MultiCell($this->width, 4, utf8_decode("_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _"), 0, 'C', 0);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->MultiCell($this->width, 4, utf8_decode("M.Sc. Miguel Angel Villalobos Rivas"), 0, 'C', 0);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->MultiCell($this->width, 4, utf8_decode("Coordinador Académico"), 0, 'C', 0);
        $this->fpdf->MultiCell($this->width, 4, utf8_decode("ESCUELA DE INGENIERIA - UAGRM"), 0, 'C', 0);

        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->Ln(8);
        $this->WriteText('KES');
        $this->fpdf->Ln(4);
        $this->WriteText('<C.c.:> Archivo');

        $this->fpdf->Output("I", "Informe Conformidad.pdf");
    }

    function WriteText($text)
    {
        $intPosIni = 0;
        $intPosFim = 0;
        if (strpos($text, '<') !== false && strpos($text, '[') !== false) {
            if (strpos($text, '<') < strpos($text, '[')) {
                $this->fpdf->Write(5, utf8_decode(substr($text, 0, strpos($text, '<'))));
                $intPosIni = strpos($text, '<');
                $intPosFim = strpos($text, '>');
                $this->fpdf->SetFont('', 'B');
                $this->fpdf->Write(5, utf8_decode(substr($text, $intPosIni + 1, $intPosFim - $intPosIni - 1)));
                $this->fpdf->SetFont('', '');
                $this->WriteText(substr($text, $intPosFim + 1, strlen($text)));
            } else {
                $this->fpdf->Write(5, utf8_decode(substr($text, 0, strpos($text, '['))));
                $intPosIni = strpos($text, '[');
                $intPosFim = strpos($text, ']');
                // $w = $this->fpdf->GetStringWidth('a') * ($intPosFim - $intPosIni - 1);
                $w = $this->width;
                $this->fpdf->Cell($w, $this->FontSize + 0.75, substr($text, $intPosIni + 1, $intPosFim - $intPosIni - 1), 1, 0, 'J');
                $this->WriteText(substr($text, $intPosFim + 1, strlen($text)));
            }
        } else {
            if (strpos($text, '<') !== false) {
                $this->fpdf->Write(5, utf8_decode(substr($text, 0, strpos($text, '<'))));
                $intPosIni = strpos($text, '<');
                $intPosFim = strpos($text, '>');
                $this->fpdf->SetFont('', 'B');
                $this->WriteText(substr($text, $intPosIni + 1, $intPosFim - $intPosIni - 1));
                $this->fpdf->SetFont('', '');
                $this->WriteText(substr($text, $intPosFim + 1, strlen($text)));
            } elseif (strpos($text, '[') !== false) {
                $this->fpdf->Write(5, utf8_decode(substr($text, 0, strpos($text, '['))));
                $intPosIni = strpos($text, '[');
                $intPosFim = strpos($text, ']');
                // $w = $this->fpdf->GetStringWidth('a') * ($intPosFim - $intPosIni - 1);
                $w = $this->width;
                $this->fpdf->Cell($w, $this->FontSize + 0.75, substr($text, $intPosIni + 1, $intPosFim - $intPosIni - 1), 1, 0, 'J');
                $this->WriteText(substr($text, $intPosFim + 1, strlen($text)));
            } else {
                $this->fpdf->Write(5, utf8_decode($text));
            }
        }
    }
}
