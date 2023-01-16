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
use App\Models\Tribunal;
use Codedge\Fpdf\Fpdf\Fpdf;
use Luecano\NumeroALetras\NumeroALetras;

class Programacion_Fecha_Defensa extends Fpdf
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
        // obtener datos
        $carta = CartaTitulacion::findOrFail($data[1]);
        $titulacion = Titulacion::findOrFail($data[0]);
        $programa = Programa::findOrFail($titulacion->programa_id);
        $estudiante = Estudiante::findOrFail($titulacion->estudiante_id);

        $director = TitulacionDirectivo::where('carta_titulacion_id', $carta->id)->first();
        $director = Directivo::where('id', $director->directivo_id)->where('cargo', 'Director')->first();
        $director->sexo == 'M' ? $presentacion = 'Estimado Sr. director' : $presentacion = 'Estimada Sra. directora';
        $nombrePresidente = $director->honorifico . ' ' . $director->nombre . ' ' . $director->apellido;
        $hora = explode(':', $titulacion->hora_defensa);
        $hora = $hora[0] . ':' . $hora[1] . ' ';

        // dar vuelva la fecha
        $fecha = explode('-', $carta->codigo2);
        $fecha = $fecha[2] . '/' . $fecha[1] . '/' . $fecha[0];
        $cartas = CartaTitulacion::where('titulacion_id', $titulacion->id)->where('tipo_id', 15)->get();

        $this->fpdf->AddPage('L');
        $this->fpdf->SetMargins(25, $this->margin, 20);
        $this->fpdf->SetAutoPageBreak(true, 20);
        $this->fpdf->Ln(20);

        $this->fpdf->SetFont('Arial', 'B', 11);
        $this->fpdf->MultiCell($this->width * 1.5, $this->space, utf8_decode("PROGRAMACIÓN DE DEFENSA DE TESIS DE MAESTRÍA"), 0, 'C', 0);
        $this->fpdf->MultiCell($this->width * 1.5, $this->space, utf8_decode("ESCUELA DE INGENIERÍA"), 0, 'C', 0);
        $this->fpdf->MultiCell($this->width * 1.5, $this->space, utf8_decode("FACULTAD DE CIENCIAS EXACTAS Y TECNOLOGÍA"), 0, 'C', 0);
        $this->fpdf->MultiCell($this->width * 1.5, $this->space, utf8_decode("UAGRM"), 0, 'C', 0);
        $this->fpdf->Ln(10);

        $tamano = $this->width;

        $this->widths = array($tamano * 7 / 12);
        $this->fpdf->SetFont('Arial', '', 12);
        $hmax = $this->height('Salón de actos de la Escuela de Ingeniería, ubicado en la Av. Busch entre (2º anillo y 3º anillo) esq. Raúl Bascopé, aula Nº 8 planta baja
        Ref.: 76661857
        ') * 2;
        $cartas->count() > 3 ? $hmax = $hmax + 10 : $hmax = $hmax;
        $this->widths = array($tamano * 2 / 12);
        $hcmax = $this->height('Posgraduante');

        $this->widths = array($tamano * 1 / 12);
        $x = $this->fpdf->GetX();
        $y = $this->fpdf->GetY();
        $this->row(array(utf8_decode('N°')), 0, 'C', 'N', $hcmax);
        $this->row(array(utf8_decode('                            ')), 0, 'C', 'N', $hmax, '1');

        $this->widths = array($tamano * 3 / 12);
        $this->fpdf->SetXY($x + $tamano * 1 / 12, $y);
        $this->row(array(utf8_decode('Postgraduante')), 0, 'C', 'N', $hcmax);
        $this->fpdf->SetXY($x + $tamano * 1 / 12, $y + $hcmax);
        $this->row(array(utf8_decode($estudiante->nombre)), 0, 'L', 'N', $hmax * 1 / 5);
        $this->fpdf->SetXY($x + $tamano * 1 / 12, $y + $hcmax + $hmax * 1 / 5);
        $this->row(array(utf8_decode("Miembros Tribunal Evaluador: Res. N° " . $carta->codigo1)), 0, 'L', 'N', $hmax * 1.5 / 5);
        $this->fpdf->SetXY($x + $tamano * 1 / 12, $y + $hcmax + $hmax * 1 / 5 + $hmax * 1.5 / 5);
        $this->row(array(utf8_decode(" ")), 0, 'L', 'N', $hmax * 2.5 / 5, '', $cartas);

        $x = $x + ($tamano * 2 / 12) * 2;
        $this->widths = array($tamano * 3 / 12);
        $this->fpdf->SetXY($x, $y);
        $this->row(array(utf8_decode('TemaTFG')), 0, 'C', 'N', $hcmax);
        $this->fpdf->SetXY($x, $y + $hcmax);
        $this->row(array(utf8_decode($titulacion->tesis)), 0, 'L', 'N', $hmax, 'Director TFG                 ' . $nombrePresidente);

        $x = $x + ($tamano * 3 / 12);
        $this->widths = array($tamano * 2 / 12);
        $this->fpdf->SetXY($x, $y);
        $this->row(array(utf8_decode('Programa')), 0, 'C', 'N', $hcmax);
        $this->fpdf->SetXY($x, $y + $hcmax);
        $this->row(array(utf8_decode($programa->tipo . "                  " . $programa->nombre)), 0, 'L', 'N', $hmax, 'Presidente     ' . $nombrePresidente);

        $x = $x + $tamano * 2 / 12;
        $this->widths = array($tamano * 2 / 12);
        $this->fpdf->SetXY($x, $y);
        $this->row(array(utf8_decode('Fecha')), 0, 'C', 'N', $hcmax);
        $this->fpdf->SetXY($x, $y + $hcmax);
        $this->row(array(utf8_decode("                                              ")), 0, 'C', 'N', $hmax, $fecha);

        $x = $x + $tamano * 2 / 12;
        $this->widths = array($tamano * 2 / 12);
        $this->fpdf->SetXY($x, $y);
        $this->row(array(utf8_decode('Hora')), 0, 'C', 'N', $hcmax);
        $this->fpdf->SetXY($x, $y + $hcmax);
        $this->row(array(utf8_decode("                                              ")), 0, 'C', 'N', $hmax, $hora);

        $x = $x + $tamano * 2 / 12;
        $this->widths = array($tamano * 4 / 12);
        $this->fpdf->SetXY($x, $y);
        $this->row(array(utf8_decode('Lugar')), 0, 'C', 'N', $hcmax);
        $this->fpdf->SetXY($x, $y + $hcmax);
        $this->row(array(utf8_decode('Salón de actos de la Escuela de Ingeniería, ubicado en la Av. Busch entre (2º anillo y 3º anillo) esq. Raúl Bascopé, aula Nº 8 planta baja.                                 Ref.: 76661857')), 0, 'L', 'N', $hmax);

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
    function Row($data, $pintado = 0, $alling = 'C', $negrita = "N", $h, $txt = '', $cartas = [])
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
            $this->fpdf->SetFont('Arial', 'B', 10);
        } else {
            $this->fpdf->Rect($x, $y, $w, $h);
            $this->fpdf->SetXY($x, $y + 1);
            $this->fpdf->SetFont('Arial', '', 10);
            if ($negrita === "S") {
                $this->fpdf->SetFont('Arial', 'B', 10);
            }
            if ($negrita === "SI") {
                $this->fpdf->SetFont('Arial', 'BI', 10);
            }
        }
        if ($data[0] == ' ') {
            $this->fpdf->SetXY($x, $y);
            foreach ($cartas as $key => $carta) {
                $jurado = Tribunal::where('carta_titulacion_id', $carta->id)->first();
                $this->fpdf->MultiCell($w, $this->space, $jurado->nombre, 0, $a, $pintado);
                $this->fpdf->SetXY($x, $this->fpdf->GetY() + 0.1);
            }
        } else
            $this->fpdf->MultiCell($w, $this->space, $data[0], 0, $a, $pintado);

        if ($txt != '') {
            $this->fpdf->SetXY($x, $y + $this->height($data[0]) + 15);
            $this->fpdf->MultiCell($w, $this->space, $txt, 0, $a, $pintado);
        }

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
