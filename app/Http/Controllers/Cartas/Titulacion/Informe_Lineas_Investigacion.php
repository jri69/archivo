<?php

namespace App\Http\Controllers\Cartas\Titulacion;

use App\Models\Carta;
use App\Models\CartaDirectivo;
use App\Models\CartaTitulacion;
use App\Models\Directivo;
use App\Models\Docente;
use App\Models\Estudiante;
use App\Models\Modulo;
use App\Models\Programa;
use App\Models\ProgramaModulo;
use App\Models\Titulacion;
use App\Models\TitulacionDirectivo;
use Codedge\Fpdf\Fpdf\Fpdf;
use Luecano\NumeroALetras\NumeroALetras;

class Informe_Lineas_Investigacion extends Fpdf
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
            return 'de la maestria en ';
        }
        if ($tipo == 'Diplomado') {
            return 'del diplomado en ';
        }
        if ($tipo == 'Cursos') {
            return 'del curso en ';
        }
        if ($tipo == 'Doctorado') {
            return 'del doctorado en ';
        }
        if ($tipo == 'Especialidad') {
            return 'de la especialidad en';
        }
    }


    public function informe($data)
    {
        $this->fpdf->header('Content-type: application/pdf');
        // obtener datos
        $carta = CartaTitulacion::findOrFail($data[1]);
        $titulacion = Titulacion::findOrFail($data[0]);
        $programa = Programa::findOrFail($titulacion->programa_id);
        $estudiante = Estudiante::findOrFail($titulacion->estudiante_id);
        $fechaLiteral = $this->fechaLiteral($carta->fecha);

        // aumentar honorifico a estudiante y sexo
        $sexo = $estudiante->sexo == 'F' ? 'de la postgraduante' : 'del postgraduante';
        $nombre_estudiante = $sexo . ' <' . $estudiante->honorifico . ' ' . $estudiante->nombre . '>';
        $nombre_programa = $this->tipoPrograma($programa->tipo) . ' <' . $programa->nombre . '>';

        $directora = TitulacionDirectivo::where('carta_titulacion_id', $carta->id)->first();
        $directora = Directivo::where('id', $directora->directivo_id)->where('cargo', 'Directora general de postgrado')->first();
        $directora->sexo == 'M' ? $presentacion = 'Estimado Sr. director' : $presentacion = 'Estimada Sra. directora';
        $nombre_dra = $directora->honorifico . ' ' . $directora->nombre . ' ' . $directora->apellido;
        $presentacion = $directora->sexo == 'M' ? 'Sr.' : 'Sra.';

        $this->fpdf->AddPage();
        $this->fpdf->SetMargins(25, $this->margin, 20);
        $this->fpdf->SetAutoPageBreak(true, 20);
        $this->fpdf->Ln(20);

        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("Santa Cruz, " . $fechaLiteral), 0, 'L', 0);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("Oficio de Dirección Nº " . $carta->codigo_admi), 0, 'L', 0);
        $this->fpdf->Ln(8);

        $this->fpdf->SetFont('Arial', '', 11);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode($directora->sexo == 'M' ? 'Señor:' : 'Señora:'), 0, 'L', 0);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode($nombre_dra), 0, 'L', 0);
        $this->fpdf->SetFont('Arial', 'B', 11);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("DIRECTORA GENERAL DE POSTGRADO"), 0, 'L', 0);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("U.A.G.R.M"), 0, 'L', 0);

        $this->fpdf->Ln(8);
        $this->fpdf->SetFont('Arial', 'B', 11);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("Ref.: Informe de las líneas de investigación"), 0, 'C', 0);
        $this->fpdf->Ln(8);

        // CONTENIDO
        $contenido = [
            'first' => "Por medio de la presente, nos es muy grato dirigirnos a su persona para hacerle llegar las líneas de investigación del Trabajo de Grado titulado: <" . $titulacion->tesis . ">, correspondiente a " . $nombre_programa . ", Plan " . $programa->codigo . ", " . $nombre_estudiante . ".",
        ];
        $this->fpdf->SetFont('Arial', '', 11);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("Distinguida " . $presentacion . ":"), 0, 'L', 0);
        $this->fpdf->Ln(2);
        $this->fpdf->SetFont('Arial', '', 11);
        $this->WriteText($contenido['first']);

        // new page horizonal
        $this->fpdf->AddPage('L');

        $tamano = $this->width;

        $this->widths = array($tamano * 7 / 12);
        $this->fpdf->SetFont('Arial', '', 12);
        $hmax = $this->height($titulacion->aporte) * 2;
        $this->widths = array($tamano * 2 / 12);
        $hcmax = $this->height($titulacion->lineas_academicas) + 5;

        $this->widths = array($tamano * 2 / 12);
        $x = $this->fpdf->GetX();
        $y = $this->fpdf->GetY();
        $this->row(array(utf8_decode('Programa')), 0, 'C', 'N', $hcmax);
        $this->row(array(utf8_decode($programa->nombre . ', Plan ' . $programa->codigo)), 0, 'L', 'N', $hmax);

        $this->widths = array($tamano * 2 / 12);
        $this->fpdf->SetXY($x + $tamano * 2 / 12, $y);
        $this->row(array(utf8_decode('Postgraduante')), 0, 'C', 'N', $hcmax);
        $this->fpdf->SetXY($x + $tamano * 2 / 12, $y + $hcmax);
        $this->row(array(utf8_decode($estudiante->nombre)), 0, 'L', 'N', $hmax / 2);
        $this->fpdf->SetXY($x + $tamano * 2 / 12, $y + $hcmax + $hmax / 2);
        $this->row(array(utf8_decode($carta->is_docente)), 0, 'L', 'N', $hmax / 2);

        $x = $x + ($tamano * 2 / 12) * 2;
        $this->widths = array($tamano * 2 / 12);
        $this->fpdf->SetXY($x, $y);
        $this->row(array(utf8_decode('Líneas de investigación')), 0, 'C', 'N', $hcmax);
        $this->fpdf->SetXY($x, $y + $hcmax);
        $this->row(array(utf8_decode('   UAGRM  ' . $titulacion->lineas_academicas)), 0, 'L', 'N', $hmax / 2);
        $this->fpdf->SetXY($x, $y + $hcmax + $hmax / 2);
        $this->row(array(utf8_decode('Escuela de Ingenieria      ' . $carta->otro)), 0, 'L', 'N', $hmax / 2);

        $x = $x + $tamano * 2 / 12;
        $this->widths = array($tamano * 2 / 12);
        $this->fpdf->SetXY($x, $y);
        $this->row(array(utf8_decode('Ejes temáticos')), 0, 'C', 'N', $hcmax);
        $this->fpdf->SetXY($x, $y + $hcmax);
        $this->row(array(utf8_decode($titulacion->eje_tematico)), 0, 'L', 'N', $hmax);

        $x = $x + $tamano * 2 / 12;
        $this->widths = array($tamano * 2 / 12);
        $this->fpdf->SetXY($x, $y);
        $this->row(array(utf8_decode('Trabajo final de grado')), 0, 'C', 'N', $hcmax);
        $this->fpdf->SetXY($x, $y + $hcmax);
        $this->row(array(utf8_decode($titulacion->tesis)), 0, 'L', 'N', $hmax);

        $x = $x + $tamano * 2 / 12;
        $this->widths = array($tamano * 7 / 12);
        $this->fpdf->SetXY($x, $y);
        $this->row(array(utf8_decode('Aportes que genera el TFG')), 0, 'C', 'N', $hcmax);
        $this->fpdf->SetXY($x, $y + $hcmax);
        $this->row(array(utf8_decode($titulacion->aporte)), 0, 'L', 'N', $hmax);

        $this->fpdf->Ln(8);
        $this->WriteText("Agradeciendo su atención, la saludo con las consideraciones más distinguidas.");
        $this->fpdf->Ln(6);
        $this->WriteText("Atentamente,");
        // pie de pagina
        $this->fpdf->Ln(30);
        $this->fpdf->SetFont('Arial', 'I', 8);
        $this->fpdf->MultiCell($this->width, 4, utf8_decode("Cc. Archivo"), 0, 'L', 0);
        // FONT BOLD
        $this->fpdf->Output("I", "Informe_Lineas_Investigacion.pdf");
        exit;
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

    function height($data)
    {
        // $nb = 0;
        // for ($i = 0; $i < count($data); $i++)
        //     $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
        // return $h = 5 * $nb + 2;
        return $this->NbLines($this->widths[0], $data) * 5 + 2;
    }
    function Row($data, $pintado = 0, $alling = 'C', $negrita = "N", $h)
    {
        $w = $this->widths[0];
        $a = isset($this->aligns[0]) ? $this->aligns[0] : $alling;
        //Save the current position
        $x = $this->fpdf->GetX();
        $y = $this->fpdf->GetY();
        if ($pintado == 1) {
            $this->fpdf->SetFillColor(224, 235, 255);
            $this->fpdf->Rect($x - 1, $y, $w + 1, $h, 'DF');
            $this->fpdf->SetXY($x, $y + 1);
            // celeste clarito
            $this->fpdf->SetFont('Arial', 'B', 11);
        } else {
            $this->fpdf->Rect($x, $y, $w, $h);
            $this->fpdf->SetXY($x, $y + 1);
            $this->fpdf->SetFont('Arial', '', 11);
            if ($negrita === "S") {
                $this->fpdf->SetFont('Arial', 'B', 11);
            }
            if ($negrita === "SI") {
                $this->fpdf->SetFont('Arial', 'BI', 11);
            }
        }
        $this->fpdf->MultiCell($w, $this->space, $data[0], 0, $a, $pintado);
        $this->fpdf->SetXY($x + $w, $y);
        $this->fpdf->SetTextColor(0, 0, 0);
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
