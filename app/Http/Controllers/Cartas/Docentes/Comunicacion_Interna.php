<?php

namespace App\Http\Controllers\Cartas\Docentes;

use App\Models\Carta;
use App\Models\CartaDirectivo;
use App\Models\Docente;
use App\Models\Modulo;
use App\Models\Programa;
use App\Models\ProgramaModulo;
use Codedge\Fpdf\Fpdf\Fpdf;
use Luecano\NumeroALetras\NumeroALetras;

class Comunicacion_Interna extends Fpdf
{
    protected $fpdf;
    public $title = "Comunicacion Interna";
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

    private function fechaLiteral($fecha)
    {
        $fecha = explode('/', $fecha);
        $meses = [
            '01' => 'Enero',
            '02' => 'Febrero',
            '03' => 'Marzo',
            '04' => 'Abril',
            '05' => 'Mayo',
            '06' => 'Junio',
            '07' => 'Julio',
            '08' => 'Agosto',
            '09' => 'Septiembre',
            '10' => 'Octubre',
            '11' => 'Noviembre',
            '12' => 'Diciembre',
        ];
        return $fecha[0] . ' de ' . $meses[$fecha[1]] . ' de ' . $fecha[2];
    }

    private function numeroAliteral($number)
    {
        $formatter = new NumeroALetras();
        return $formatter->toMoney($number);
    }

    private function encoding($text)
    {
        return mb_convert_encoding($text, "UTF-8", "ISO-8859-1");
    }

    public function informe($data)
    {
        // obtencion de datos
        $contrato = $data[0];
        $idCarta = $data[1];
        $modulo = Modulo::find($contrato->modulo_id);
        $docente = Docente::find($modulo->docente_id);
        $carta = Carta::find($idCarta);
        $fecha = date('d/m/Y', strtotime($carta->fecha));
        $fechaLiteral = $this->fechaLiteral($fecha);
        $directivos = CartaDirectivo::where('carta_id', $idCarta)->get();
        $programa = Programa::find($modulo->programa_id);
        $modalidad = $programa->modalidad ?  $modalidad = $programa->modalidad : 'Virtual';
        $honorarioLiteral = $this->numeroAliteral($contrato->honorario);
        $carta = Carta::where('contrato_id', $contrato->id)->where('tipo_id', 1)->first();

        $director = '';
        $asesor = '';
        $responsable = '';
        foreach ($directivos as $directivo) {
            if ($directivo->directivo->cargo == 'Director') {
                $director = $directivo->directivo;
            }
            if ($directivo->directivo->cargo == 'Asesor Legal') {
                $asesor = $directivo->directivo;
            }
            if ($directivo->directivo->cargo == 'Responsable del proceso de contratación') {
                $responsable = $directivo->directivo;
            }
        }

        // validaciones
        $director ? $director = $director->honorifico . " " . $director->nombre . " " . $director->apellido . " - " . $director->cargo . ' ' . $director->institucion : $director = '';

        $asesor ? $asesor = $asesor->honorifico . " " . $asesor->nombre . " " . $asesor->apellido . " - " . $asesor->cargo . ' ' . $asesor->institucion : $asesor = '';

        $responsable ? $responsable = $responsable->honorifico . " " . $responsable->nombre . " " . $responsable->apellido . " - " . $responsable->cargo : $responsable = '';

        $name_docente = $docente->honorifico . " " . $docente->nombre . " " . $docente->apellido;

        // convertir texto a mayuscula
        $name_docente = mb_strtoupper($name_docente, 'UTF-8');


        $this->fpdf->AddPage();
        $this->fpdf->SetMargins(25, $this->margin, 20);
        $this->fpdf->SetAutoPageBreak(true, 20);
        $this->fpdf->Ln(20);

        $this->fpdf->SetFont('Arial', 'B', 9);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("OF. COORD. ADM No. " . $carta->codigo_admi), 0, 'R', 0);

        $this->fpdf->Ln(2);
        $this->widths = array(14, $this->width - 14);
        $this->Row(array(utf8_decode('A:'), utf8_decode($asesor)), 1, "L", "N");
        $this->Row(array(utf8_decode('VIA:'), utf8_decode($director)), 1, "L", "N");
        $this->Row(array(utf8_decode('DE:'), utf8_decode($responsable)), 1, "L", "N");
        $this->Row(array(utf8_decode('REF:'), utf8_decode('SOLICITUD DE REVISIÓN DE DOCUMENTACIÓN Y ELABORACIÓN DE CONTRATO A FAVOR DEL ' . mb_strtoupper($name_docente) . ', ADJUDICACIÓN CONTRATACIÓN MENOR PARA EL MÓDULO DENOMINADO: "' . mb_strtoupper($modulo->nombre) . '" (' . $modulo->version . 'º VERSIÓN, ' . $modulo->edicion . 'º EDICIÓN) ' . mb_strtoupper($modalidad) . '. A EJECUTARSE CON RECURSOS PROPIOS, POR UN MONTO DE BS.' . $contrato->honorario . ' (' . $honorarioLiteral . ' CON 00/100 BOLIVIANOS). A REALIZARSE EN UN PLAZO DE 60 HORAS ACADÉMICAS.-')), 1, "L", "SI");

        $this->fpdf->Ln(5);
        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode('Santa Cruz, ' . $fechaLiteral), 0, 'R', 0);
        $this->fpdf->Ln(5);

        // CONTENIDO
        $contenido = [
            'first' => 'Según el oficio OF.COORD. ACA. N.º ' . $carta->codigo_admi . ' del Coordinador Académico de la ESCUELA DE INGENIERIA - UAGRM, remito a usted la integridad del proceso de Contratación para el <MÓDULO> DENOMINADO: "' . $modulo->nombre . ' (' . $modulo->version . 'º VERSIÓN, ' . $modulo->edicion . 'º EDICIÓN)  ' . $modalidad . '. (UNA CARPETA), A EFECTOS DE LA RECEPCIÓN y verificación de la documentación requerida para la elaboración y firma del contrato, teniendo un plazo hasta el ' . $carta->fecha_plazo . '.',
            'second' => 'Proceda a ejecutar las siguientes acciones: En sujeción al D.S. 181 art. 37.- (ASESORIA LEGAL). En cada proceso de contratación, tiene como principales funciones:',
        ];
        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("De mi mayor consideración:"), 0, 'L', 0);
        $this->fpdf->Ln(4);
        // $this->fpdf->MultiCell($this->width, $this->space, utf8_decode($contenido['first']), 0, 'J', 0);
        $this->WriteText($contenido['first']);
        $this->fpdf->Ln(8);
        // $this->fpdf->MultiCell($this->width, $this->space, utf8_decode($contenido['second']), 0, 'J', 0);
        $this->WriteText($contenido['second']);
        $this->fpdf->Ln(4);
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
        $this->fpdf->Ln(25);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->MultiCell($this->width, 4, utf8_decode("Adjunto: Lo indicado "), 0, 'L', 0);
        $this->fpdf->MultiCell($this->width, 4, utf8_decode("C.c.  Archivo-Dirección E.I."), 0, 'L', 0);

        // FONT BOLD
        $this->fpdf->Output("I", $name_docente . " - Comunicacion Interna.pdf");
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
        $this->fpdf->MultiCell($w - $blt_width, $this->space - 1, $txt, $border, $align, $fill);

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
            $w = $this->fpdf->w - $this->fpdf->rMargin - $this->fpdf->x;
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
                $this->fpdf->Cell($w, $this->FontSize + 0.75, substr($text, $intPosIni + 1, $intPosFim - $intPosIni - 1), 1, 0, '');
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
                $this->fpdf->Cell($w, $this->FontSize + 0.75, substr($text, $intPosIni + 1, $intPosFim - $intPosIni - 1), 1, 0, '');
                $this->WriteText(substr($text, $intPosFim + 1, strlen($text)));
            } else {
                $this->fpdf->Write(5, utf8_decode($text));
            }
        }
    }
}
