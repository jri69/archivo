<?php

namespace App\Http\Controllers\Cartas\Titulacion;

use App\Models\Carta;
use App\Models\CartaDirectivo;
use App\Models\CartaTitulacion;
use App\Models\Docente;
use App\Models\Estudiante;
use App\Models\Modulo;
use App\Models\Programa;
use App\Models\ProgramaModulo;
use App\Models\Titulacion;
use Codedge\Fpdf\Fpdf\Fpdf;
use Luecano\NumeroALetras\NumeroALetras;

class Designacion_Director_Trabajo_Grado extends Fpdf

{
    protected $fpdf;
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
        $fecha = explode('-', $fecha);
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
        return $fecha[2] . ' de ' . $meses[$fecha[1]] . ' de ' . $fecha[0];
    }

    private function numeroAliteral($number)
    {
        $formatter = new NumeroALetras();
        return $formatter->toMoney($number);
    }

    private function tipoPrograma($tipo)
    {
        if ($tipo == 'Maestria') {
            return 'de maestria en ';
        }
        if ($tipo == 'Diplomado') {
            return 'de diplomado en ';
        }
        if ($tipo == 'Cursos') {
            return 'de curso de ';
        }
        if ($tipo == 'Doctorado') {
            return 'de doctorado en ';
        }
        if ($tipo == 'Especialidad') {
            return 'de especialidad en';
        }
    }


    public function informe($data)
    {
        // obtener datos
        $carta = CartaTitulacion::findOrFail($data[1]);
        $titulacion = Titulacion::findOrFail($data[0]);
        $programa = Programa::findOrFail($titulacion->programa_id);
        $estudiante = Estudiante::findOrFail($titulacion->estudiante_id);
        $fechaLiteral = $this->fechaLiteral($carta->fecha);

        // aumentar honorifico a estudiante y sexo
        $sexo = $estudiante->sexo == 'F' ? 'de la' : 'del';
        $nombre_estudiante = $sexo . ' <' . $estudiante->honorifico . ' ' . $estudiante->nombre . '>';
        $nombre_programa = $this->tipoPrograma($programa->tipo) . ' ' . $programa->nombre;

        $this->fpdf->AddPage();
        $this->fpdf->SetMargins(25, $this->margin, 20);
        $this->fpdf->SetAutoPageBreak(true, 20);
        $this->fpdf->Ln(20);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("Santa Cruz, " . $fechaLiteral), 0, 'L', 0);
        $this->fpdf->SetFont('Arial', 'B', 9);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("Oficio de Coordinación de Investigación Nº " . $carta->codigo_admi), 0, 'L', 0);
        $this->fpdf->Ln(8);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("Señor:"), 0, 'L', 0);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode($titulacion->director), 0, 'L', 0);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("Presente.-"), 0, 'L', 0);

        $this->fpdf->SetFont('Arial', 'B', 9);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("Ref.:  designación de Director de Trabajo de Grado "), 0, 'C', 0);
        $this->fpdf->Ln(2);

        // CONTENIDO
        $contenido = [
            'first' => "Por sus conocimientos y antecedentes profesionales, nos es muy grato dirigirnos a su persona para designarlo Director de Trabajo de Grado de la Tesis Magistral: <" . $titulacion->tesis . ">.",
            'second' => "El mencionado Trabajo de Grado ha sido elaborado por " . $nombre_estudiante . ", cumpliendo de esta forma con la primera etapa regular de un proceso académico indispensable que culminara con la presentación y defensa de su Tesis Magistral, para así poder alcanzar al Grado Académico de Maestro en <" . $titulacion->grado_academico . ">.",
            'third' => "El espíritu de los puntos señalados está basado en la genuina aspiración que tiene la Escuela de Ingeniería de elevar el nivel científico-académico de los Trabajos Finales de Grado, de forma que verdaderamente ameriten ser catalogados como Tesis de Grado Magistrales."
        ];
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("Distinguido Ing.:"), 0, 'L', 0);
        $this->fpdf->Ln(5);
        $this->fpdf->SetFont('Arial', '', 9);
        $this->WriteText($contenido['first']);
        $this->fpdf->Ln(6);
        $this->WriteText($contenido['second']);
        $this->fpdf->Ln(8);
        $this->WriteText("El informe del Trabajo Final de Tesis de Grado debe contener un análisis de los siguientes aspectos:");
        $this->fpdf->Ln(6);
        $this->WriteText("a)  Tema");
        $this->fpdf->Ln(6);
        $this->WriteText("b) Fundamentación teórica");
        $this->fpdf->Ln(6);
        $this->WriteText("c) Uso metodológico");
        $this->fpdf->Ln(6);
        $this->WriteText("d) Resultados");
        $this->fpdf->Ln(8);
        $this->WriteText($contenido['third']);
        $this->fpdf->Ln(8);
        $this->WriteText("Agradeciéndole de antemano su gentil colaboración, nos es grato reiterarle nuestros cordiales saludos.");
        $this->fpdf->Ln(8);
        $this->WriteText("Atentamente,");
        $this->fpdf->Ln(8);

        // pie de pagina
        $this->fpdf->Ln(60);
        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->MultiCell($this->width, 4, utf8_decode("Cc./Arch."), 0, 'L', 0);
        // FONT BOLD
        $this->fpdf->Output("I", "Designacion_Director_Trabajo_Grado.pdf");
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
