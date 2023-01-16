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
use App\Models\TitulacionDirectivo;
use App\Models\Tribunal;
use Codedge\Fpdf\Fpdf\Fpdf;
use Luecano\NumeroALetras\NumeroALetras;

class Cac_Tribunal extends Fpdf
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
        return $fecha[0] . ' de ' . $meses[$fecha[1]] . ' de ' . $fecha[2];
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
            return 'del curso de ';
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
        $fechaLiteral = $this->fechaLiteral($carta->fecha);
        $jurados = Tribunal::where('carta_titulacion_id', $carta->id)->get();

        // aumentar honorifico a estudiante y sexo
        $sexo = $estudiante->sexo == 'F' ? 'de la' : 'del';
        $nombre_estudiante = $sexo . ' <' . $estudiante->honorifico . ' ' . $estudiante->nombre . '>';
        $nombre_estudiante2 = $sexo . ' ' . $estudiante->honorifico . ' ' . $estudiante->nombre . '';
        $nombre_programa = $this->tipoPrograma($programa->tipo) . ' <' . $programa->nombre . '>';

        $fecha = explode('-', $titulacion->fecha_ini);
        $fecha_ini = $fecha[2] . '/' . $fecha[1] . '/' . $fecha[0];
        $fecha = explode('-', $titulacion->fecha_fin);
        $fecha_fin = $fecha[2] . '/' . $fecha[1] . '/' . $fecha[0];

        // obtener directivos
        $directivos = TitulacionDirectivo::where('carta_titulacion_id', $carta->id)->get();
        $director = '';
        $coordinador = '';
        $investigacion = '';

        foreach ($directivos as $directivo) {
            if ($directivo->directivo->cargo == 'Director') {
                $director = $directivo->directivo->honorifico . ' ' . $directivo->directivo->nombre . " " . $directivo->directivo->apellido;
            }
            if ($directivo->directivo->cargo == 'Coordinador Académico') {
                $coordinador = $directivo->directivo->honorifico . ' ' . $directivo->directivo->nombre . " " . $directivo->directivo->apellido;
            }
            if ($directivo->directivo->cargo == 'Coordinador de investigación') {
                $investigacion = $directivo->directivo->honorifico . ' ' . $directivo->directivo->nombre . " " . $directivo->directivo->apellido;
            }
        }

        $this->fpdf->AddPage();
        $this->fpdf->SetMargins(25, $this->margin, 20);
        $this->fpdf->SetAutoPageBreak(true, 20);
        $this->fpdf->Ln(15);

        $this->fpdf->SetFont('Arial', 'B', 9);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("RES. COM-AC-C. Nº " . $carta->codigo_admi), 0, 'L', 0);
        $this->fpdf->Ln(5);

        $this->fpdf->SetFont('Arial', 'B', 9);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("COMITÉ ACADÉMICO CIENTÍFICO"), 0, 'C', 0);
        $this->fpdf->Ln(2);

        // CONTENIDO
        $contenido = [
            'first' => "Que de acuerdo a la Resolución del Comité Académico Científico Nº " . $carta->codigo2 . " da conformidad que " . $nombre_estudiante . ", ha aprobado todos los módulos y concluido la elaboración del Trabajo de Grado <" . $titulacion->tesis . ">; correspondiente " . $nombre_programa . ", Plan " . $programa->codigo . ", que se cursó en la Escuela de Ingeniería de la Facultad de Ciencias Exactas y Tecnología, habiendo presentado los tres ejemplares que se disponen en el Reglamento General del Sistema de Postgrado.",
            'second' => "Que el <" . $titulacion->director . ">, nombrado oficialmente Tutor " . $nombre_estudiante . ", ha emitido una opinión favorable acerca del trabajo presentado por el aspirante, en documento cuya copia se adjunta a la presente.",
            'third' => "Que " . $nombre_estudiante . ", cumple con el <" . $carta->articulo . ">.",
            'four' => "Que los profesionales abajo mencionados, miembros propuestos para integrar el Tribunal de Defensa del " . $nombre_estudiante . ", ha aprobado todos los módulos y concluido la elaboración del Trabajo de Grado correspondiente a la maestría, reúnen los requisitos establecidos en el Artículo 96 del Reglamento General del Sistema de Postgrado de la U.A.G.R.M.",
            'five' => "El Comité Académico-Científico de la Escuela de Ingeniería de la Facultad de Ciencias Exactas y Tecnología, en uso de sus legítimas atribuciones que le confiere el Reglamento General del Sistema de Postgrado con cargo a homologación ante el Consejo Directivo de Postgrado:",
            'six' => "Art. 1º Proponer la designación de los siguientes profesores para integrar el Tribunal de Defensa " . $nombre_estudiante . ", ha aprobado todos los módulos y concluido la elaboración del Trabajo de Grado <" . $titulacion->tesis . ">, correspondiente " . $nombre_programa . ", Plan " . $programa->codigo . ".",
        ];
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("VISTO Y CONSIDERADO:"), 0, 'L', 0);
        $this->fpdf->Ln(1);
        $this->fpdf->SetFont('Arial', '', 9);
        $this->WriteText($contenido['first']);
        $this->fpdf->Ln(6);
        $this->WriteText($contenido['second']);
        $this->fpdf->Ln(6);
        $this->WriteText($contenido['third']);
        $this->fpdf->Ln(6);
        $this->WriteText($contenido['four']);
        $this->fpdf->Ln(5);

        $this->fpdf->SetFont('Arial', '', 10);
        $this->WriteText("POR LO TANTO:");
        $this->fpdf->Ln(5);
        $this->fpdf->SetFont('Arial', '', 9);
        $this->WriteText($contenido['five']);
        $this->fpdf->Ln(5);

        $this->fpdf->SetFont('Arial', '', 10);
        $this->WriteText("RESUELVE:");
        $this->fpdf->Ln(5);
        $this->fpdf->SetFont('Arial', '', 9);
        $this->WriteText($contenido['six']);
        $this->fpdf->Ln(6);
        foreach ($jurados as $key => $value) {
            $this->fpdf->SetX($this->vineta);
            $this->MultiCellBlt($this->width - 10, 4, chr(149), utf8_decode($value->nombre));
            $this->fpdf->Ln(4);
        }
        $this->fpdf->Ln(4);

        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("REGÍSTRESE, COMUNÍQUESE Y ARCHÍVESE"), 0, 'C', 0);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("Santa Cruz de la Sierra, " . $fechaLiteral), 0, 'C', 0);
        $this->fpdf->Ln(8);

        // 3 espacios para 3 firmas
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->Cell($this->width, $this->space, utf8_decode('_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _'), 0, 0, 'C');
        $this->fpdf->Ln(4);
        $this->fpdf->Cell($this->width, $this->space, utf8_decode($director), 0, 0, 'C');
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Ln(4);
        $this->fpdf->Cell($this->width, $this->space, utf8_decode('DIRECTOR GENERAL'), 0, 0, 'C');
        $this->fpdf->Ln(4);
        $this->fpdf->Cell($this->width, $this->space, utf8_decode('ESCUELA DE INGENIERÍA'), 0, 0, 'C');
        $this->fpdf->Ln(15);
        $this->fpdf->SetFont('Arial', '', 10);

        $this->fpdf->Cell($this->width / 2, $this->space, utf8_decode('_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _'), 0, 0, 'C');
        $this->fpdf->Cell($this->width / 2, $this->space, utf8_decode('_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _'), 0, 0, 'C');
        $this->fpdf->Ln(5);
        $this->fpdf->Cell($this->width / 2, $this->space, utf8_decode($coordinador), 0, 0, 'C');
        $this->fpdf->Cell($this->width / 2, $this->space, utf8_decode($investigacion), 0, 0, 'C');
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Ln(4);
        $this->fpdf->Cell($this->width / 2, $this->space, utf8_decode('COORDINADOR ACADÉMICO'), 0, 0, 'C');
        $this->fpdf->Cell($this->width / 2, $this->space, utf8_decode('COORDINADOR DE INVESTIGACIÓN'), 0, 0, 'C');
        $this->fpdf->Ln(4);
        $this->fpdf->Cell($this->width / 2, $this->space, utf8_decode('ESCUELA DE INGENIERÍA'), 0, 0, 'C');
        $this->fpdf->Cell($this->width / 2, $this->space, utf8_decode('ESCUELA DE INGENIERÍA'), 0, 0, 'C');

        // pie de pagina
        $this->fpdf->Ln(8);
        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->MultiCell($this->width, 4, utf8_decode("Cc. Archivo"), 0, 'L', 0);
        // FONT BOLD
        $this->fpdf->Output("I", "Cac_Tribunal.pdf");
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
