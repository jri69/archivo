<?php

namespace App\Http\Controllers\Cartas\Docentes;

use App\Models\Carta;
use App\Models\CartaDirectivo;
use App\Models\Docente;
use App\Models\Modulo;
use App\Models\Programa;
use Codedge\Fpdf\Fpdf\Fpdf;
use Luecano\NumeroALetras\NumeroALetras;

class Planilla_pago extends Fpdf
{
    protected $fpdf;
    public $margin = 30;
    public $width = 250;
    public $space = 5;
    public $vineta = 30;
    public $widths;
    public $aligns;

    public function __construct()
    {
        $this->fpdf = new Fpdf('L', 'mm', 'Letter');
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

    private function tipoPrograma($tipo)
    {
        if ($tipo == 'Maestria') {
            return 'a la <MAESTRIA> en ';
        }
        if ($tipo == 'Diplomado') {
            return 'al <DIPLOMADO> en ';
        }
        if ($tipo == 'Cursos') {
            return 'al <CURSO> de ';
        }
        if ($tipo == 'Doctorado') {
            return 'al <DOCTORADO> en ';
        }
    }

    private function numeroAliteral($number)
    {
        $formatter = new NumeroALetras();
        return $formatter->toMoney($number);
    }

    public function planilla_pago($data)
    {
        $this->fpdf->header('Content-type: application/pdf');
        // obtencion de datos
        $contrato = $data[0];
        $idCarta = $data[1];
        $modulo = Modulo::find($contrato->modulo_id);
        $docente = Docente::find($modulo->docente_id);
        $carta = Carta::find($idCarta);
        $fecha = date('d/m/Y', strtotime($carta->fecha));
        $fechaLiteral = $this->fechaLiteral($fecha);
        $fechaIni = date('d/m/Y', strtotime($modulo->fecha_inicio));
        $fechaFin = date('d/m/Y', strtotime($modulo->fecha_final));
        $programa = Programa::find($modulo->programa_id);
        $modalidad = $programa->modalidad ?  $modalidad = $programa->modalidad : 'Virtual';
        $name_programa = $programa->nombre . " (" . $programa->version . "° versión, " . $programa->edicion . "° edición) ";
        $name_docente = $docente->honorifico . " " . $docente->nombre . " " . $docente->apellido;

        // directivos
        $directivos = CartaDirectivo::where('carta_id', $idCarta)->get();
        $adm = '';
        $dir = '';
        $dec = '';
        foreach ($directivos as $directivo) {
            if ($directivo->directivo->cargo == 'Decano') {
                $dec = $directivo->directivo;
            }
            if ($directivo->directivo->cargo == 'Director') {
                $dir = $directivo->directivo;
            }
            if ($directivo->directivo->cargo == 'Jefe ADM. y Financiero') {
                $adm = $directivo->directivo;
            }
        }

        $this->fpdf->AddPage();
        $this->fpdf->SetMargins(25, $this->margin, 20);
        $this->fpdf->SetAutoPageBreak(true, 20);

        // marco grande
        $this->fpdf->Rect(23, $this->fpdf->GetY(), 240, $this->fpdf->GetY() + 15, 'D');
        // imange
        $this->fpdf->Image('logo.png', 30, $this->fpdf->GetY() + 2, 25, 20);
        // subtitulo
        // titulo
        $this->fpdf->SetFont('Arial', 'B', 12);
        $this->fpdf->Ln(5);
        $this->fpdf->Cell(0, 5, utf8_decode('Universidad Autónoma "Gabriel René Moreno"'), 0, 1, 'C');
        $this->fpdf->Ln(0.5);
        $this->fpdf->Cell(0, 5, utf8_decode('Facultad de Ciencias Exactas y Tecnologia'), 0, 0, 'C');
        $this->fpdf->Cell(0, 5, utf8_decode('RPC-002-01'), 0, 1, 'R');
        $this->fpdf->Cell(0, 5, utf8_decode('Escuela de Ingenieria'), 0, 1, 'C');

        $this->fpdf->Ln(7);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->MultiCell($this->width - 20, 4, utf8_decode($carta->codigo_admi), 0, 'R', 0);
        $this->fpdf->Ln(2);
        $this->fpdf->MultiCell($this->width, 4, utf8_decode("PLANILLA DE PAGO"), 0, 'C', 0);

        $this->fpdf->Ln(7);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode($programa->tipo . " en: " . $name_programa), 0, 'L', 0);
        $this->fpdf->Ln(4);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("Modulo: " . $modulo->nombre), 0, 'L', 0);
        $this->fpdf->Ln(4);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("Duracion: " . $fechaIni . " al " . $fechaFin), 0, 'L', 0);

        $this->fpdf->Ln(4);
        $lent = $this->width / 9;
        $this->widths = array($lent / 4, $lent * 2, $lent + ($lent) / 2, ($lent) / 2 + ($lent) / 3, $lent / 2, $lent / 2, ($lent) / 2 + ($lent) / 3, ($lent) / 2 + ($lent) / 3, $lent);
        $this->Row(array(utf8_decode('N°'), utf8_decode("NOMBRE"), utf8_decode("PERIODO"), utf8_decode("TOTAL GANADO"), utf8_decode("I.U. 12,5%"), utf8_decode("I.T.  3%"), utf8_decode("TOTAL DSCTOS."), utf8_decode("LIQUIDO PAGABLE (Bs.)"), utf8_decode("FIRMA")), 1, "C", "S");
        $this->Row(array(utf8_decode('1'), utf8_decode($name_docente), utf8_decode($fechaIni . " al " . $fechaFin), utf8_decode($contrato->honorario), utf8_decode("0"), utf8_decode("0"), utf8_decode("0"), utf8_decode($contrato->honorario), utf8_decode("")), 0, "C", "N");

        $this->fpdf->Ln(8);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("IMPORTA LA PRESENTE PLANILLA LA SUMA DE Bs." . $contrato->honorario . ".- (" . $this->numeroAliteral($contrato->honorario) . "00/100 Bolivianos)"), 0, 'L', 0);
        $this->fpdf->Ln(4);

        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("LÍQUIDO PAGABLE DE Bs." . $contrato->honorario . ".- (" . $this->numeroAliteral($contrato->honorario) . "00/100 Bolivianos)"), 0, 'C', 0);
        // LINEA RECTA
        $this->fpdf->Ln(4);
        $this->fpdf->Line(15, $this->fpdf->GetY(), 270, $this->fpdf->GetY());

        $this->fpdf->Ln(4);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode('Santa Cruz, ' . $fechaLiteral), 0, 'C', 0);

        // pie de pagina
        $this->fpdf->Ln(20);

        // 3 espacios para 3 firmas
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->Cell($this->width / 3, $this->space, utf8_decode('_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _'), 0, 0, 'C');
        $this->fpdf->Cell($this->width / 3, $this->space, utf8_decode('_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _'), 0, 0, 'C');
        $this->fpdf->Cell($this->width / 3, $this->space, utf8_decode('_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _'), 0, 0, 'C');
        $this->fpdf->Ln(5);
        $this->fpdf->Cell($this->width / 3, $this->space, utf8_decode($adm->honorifico . ' ' . $adm->nombre . ' ' . $adm->apellido), 0, 0, 'C');
        $this->fpdf->Cell($this->width / 3, $this->space, utf8_decode($dec->honorifico . ' ' . $dec->nombre . ' ' . $dec->apellido), 0, 0, 'C');
        $this->fpdf->Cell($this->width / 3, $this->space, utf8_decode($dir->honorifico . ' ' . $dir->nombre . ' ' . $dir->apellido), 0, 0, 'C');
        $this->fpdf->Ln(4);
        $this->fpdf->Cell($this->width / 3, $this->space, utf8_decode($adm->cargo . ' - UAGRM'), 0, 0, 'C');
        $this->fpdf->Cell($this->width / 3, $this->space, utf8_decode($dec->cargo . ' - UAGRM'), 0, 0, 'C');
        $this->fpdf->Cell($this->width / 3, $this->space, utf8_decode($dir->cargo . ' - UAGRM'), 0, 0, 'C');
        $this->fpdf->Ln(4);
        $this->fpdf->Cell($this->width / 3, $this->space, utf8_decode($adm->institucion), 0, 0, 'C');
        $this->fpdf->Cell($this->width / 3, $this->space, utf8_decode($dec->institucion), 0, 0, 'C');
        $this->fpdf->Cell($this->width / 3, $this->space, utf8_decode('E.I.F.C.E.T. - U.A.G.R.M'), 0, 0, 'C');

        $this->fpdf->Output("I", $name_docente . " - Planilla de pago.pdf");
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
                $this->fpdf->SetFont('Arial', 'B', 10);
            } else {
                $this->fpdf->Rect($x - 1, $y, $w + 1, $h);
                $this->fpdf->SetXY($x, $y + 1);
                $this->fpdf->SetFont('Arial', '', 10);
                if ($negrita === "S") {
                    $this->fpdf->SetFont('Arial', 'B', 10);
                }
                if ($negrita === "SI") {
                    $this->fpdf->SetFont('Arial', 'BI', 10);
                }
            }
            if ($i == 8) {
                $this->fpdf->MultiCell($w - 1, $this->space, $data[$i], 0, $a, $pintado);
            } else {
                $this->fpdf->MultiCell($w, $this->space, $data[$i], 0, $a, $pintado);
            }
            //Put the position to the right of the cell
            $this->fpdf->SetXY($x + ($w + 1), $y);
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
