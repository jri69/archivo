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
use Codedge\Fpdf\Fpdf\Fpdf;
use Luecano\NumeroALetras\NumeroALetras;

class Consejo_Directivo_Postgrado extends Fpdf
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
            return 'la MAESTRIA en ';
        }
        if ($tipo == 'Diplomado') {
            return 'el DIPLOMADO en ';
        }
        if ($tipo == 'Cursos') {
            return 'el CURSO de ';
        }
        if ($tipo == 'Doctorado') {
            return 'el DOCTORADO en ';
        }
        if ($tipo == 'Especialidad') {
            return 'la especialidad en';
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
        $nombre_programa = $this->tipoPrograma($programa->tipo) . ' <' . $programa->nombre . '>';

        // obtener directivos
        $directivos = TitulacionDirectivo::where('carta_titulacion_id', $carta->id)->get();
        $director = '';
        $presidente = '';

        foreach ($directivos as $directivo) {
            if ($directivo->directivo->cargo == 'Director') {
                $director = $directivo->directivo->honorifico . ' ' . $directivo->directivo->nombre . " " . $directivo->directivo->apellido;
            }
            if ($directivo->directivo->cargo == 'Presidente') {
                $presidente = $directivo->directivo->honorifico . ' ' . $directivo->directivo->nombre . " " . $directivo->directivo->apellido;
            }
        }

        $this->fpdf->AddPage();
        $this->fpdf->SetMargins(25, $this->margin, 20);
        $this->fpdf->SetAutoPageBreak(true, 20);
        $this->fpdf->Ln(20);

        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("RES. CONS.D.P. N° " . $carta->codigo_admi), 0, 'L', 0);
        $this->fpdf->Ln(8);

        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("CONSEJO DIRECTIVO DE POSTGRADO"), 0, 'C', 0);
        $this->fpdf->Ln(8);

        // CONTENIDO
        $contenido = [
            'first' => "El informe emitido por el Coordinador de Coordinación Académica oficio Nº <" . $carta->codigo1 . "> y Resolución del Comité Académico Científico Nº <" . $carta->codigo2 . "> y Resolución del Comité Académico Científico <" . $carta->codigo3 . ">.",

            'second' => "Que el oficio de Coordinación Académica Nº <" . $carta->codigo1 . "> informa el cumplimiento de requisitos presentado por " . $nombre_estudiante . " quien ha aprobado todos los módulos y concluido la elaboración del Perfil de tesis de grado <" . $titulacion->tesis . ">. Correspondiente a " . $nombre_programa . ", Plan " . $programa->codigo . ", que se cursó en esta Escuela de Ingeniería de la Facultad de Ciencias Exactas y Tecnología, habiendo presentado el perfil de tesis en dos ejemplares aprobado con Resolución del Comité Académico Científico Nº <" . $carta->codigo2 . "> y la Resolución del Comité Académico Científico Nº <" . $carta->codigo3 . ">, el mismo que está amparado en el " . $carta->consupo . ".",

            'third' => "Que el Reglamento General del Sistema de POSTGRADO de la Universidad Autónoma 'Gabriel René Moreno', establece en su Sección III Consejo Directivo de POSTGRADO en el Artículo Nº 37, Inciso h) Nominar mediante resolución a los tutores de tesis o de trabajos de grado y a los tribunales de evaluación, en los diferentes niveles post-graduales, en base a la propuesta presentada por el Comité Académico Científico.",

            'four' => "Que el Comité Académico Científico aprobó la designación <" . $titulacion->director . "> como Tutor de Tesis " . $nombre_estudiante . ", mediante la Resolución Comité Académico Científico Nº " . $carta->codigo3 . ".",

            'five' => "Que el Comité Académico Científico aprobó el informe de Coordinación Académica, mediante la Resolución N° " . $carta->codigo2 . " del Postgraduante: " . $nombre_estudiante . " del programa " . $nombre_programa . ", Plan " . $programa->codigo . "; en el que el Coordinador de Investigación emite el informe de las líneas de investigación: <" . $titulacion->lineas_academicas . ">.",

            'six' => "El Consejo Directivo de Postgrado, en uso de sus legítimas atribuciones, de acuerdo al Reglamento General del Sistema de Postgrado de la Universidad Autónoma Gabriel René Moreno, Capitulo IV, Sección III, El Consejo Directivo de Postgrado Artículo 36º el Consejo Directivo de Postgrado es la máxima instancia en las decisiones académico-científico y de carácter administrativo, en el ámbito de su facultad.",

            'seven' => "Art. 1º Aprobar el Perfil de tesis <" . $titulacion->tesis . ">. Elaborado por " . $nombre_estudiante . ", correspondiente a " . $nombre_programa . ", Plan " . $programa->codigo . ".",

            'eight' => "Art. 3° Homologar la decisión del Comité Académico Científico N° " . $carta->codigo3 . ", de aprobar la designación del Tutor de tesis <" . $titulacion->director . "> del Postgraduante: <" . $estudiante->nombre . ">.",

            'nine' => "Art. 4° Homologar la decisión del Comité Académico Científico N° " . $carta->codigo2 . " , de aprobar el informe de cumplimiento de requisitos del Postgraduante: <" . $estudiante->nombre . "> del programa de " . $nombre_programa . ", Plan " . $programa->codigo . " en el que el Coordinador de Investigación de la Escuela de Ingeniería incluye en su informe las líneas de investigación: <" . $titulacion->lineas_academicas . ">.",
        ];
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("VISTO:"), 0, 'L', 0);
        $this->fpdf->Ln(2);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->WriteText($contenido['first']);
        $this->fpdf->Ln(6);
        $this->WriteText($contenido['second']);
        $this->fpdf->Ln(8);

        $this->fpdf->SetFont('Arial', '', 10);
        $this->WriteText("CONSIDERANDO:");
        $this->fpdf->Ln(6);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->WriteText($contenido['third']);
        $this->fpdf->Ln(6);
        $this->WriteText($contenido['four']);
        $this->fpdf->Ln(6);
        $this->WriteText($contenido['five']);
        $this->fpdf->Ln(8);

        $this->fpdf->SetFont('Arial', '', 10);
        $this->WriteText("POR LO TANTO:");
        $this->fpdf->Ln(6);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->WriteText($contenido['six']);
        $this->fpdf->Ln(8);

        $this->fpdf->SetFont('Arial', '', 10);
        $this->WriteText("RESUELVE:");
        $this->fpdf->Ln(6);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->WriteText($contenido['seven']);
        // pasar a la siguente pagina
        $this->fpdf->AddPage();
        $this->WriteText('Art. 2º Designar al profesor como Director de trabajo de grado:');

        $first = $this->width * 1 / 4;
        $second = $this->width * 3 / 4;

        $this->fpdf->Ln(9);
        $this->fpdf->Cell($first, $this->space, utf8_decode('Postgraduante'), 0, 0, 'L');
        $this->fpdf->MultiCell($second, $this->space, utf8_decode($estudiante->nombre), 0, 'L');
        $this->fpdf->Ln(2);
        $this->fpdf->Cell($first, $this->space, utf8_decode('D.T.F.G.:'), 0, 0, 'L');
        $this->fpdf->MultiCell($second, $this->space, utf8_decode('M. Sc. Ing. Luis Enrique Claure Vargas'), 0, 'L');
        $this->fpdf->Ln(2);
        $this->fpdf->Cell($first, $this->space, utf8_decode('Maestría'), 0, 0, 'L');
        $this->fpdf->MultiCell($second, $this->space, utf8_decode($programa->nombre . ' Plan ' . $programa->codigo), 0, 'L');
        $this->fpdf->Ln(2);
        $this->fpdf->Cell($first, $this->space, utf8_decode('Título del T.F.G.:'), 0, 0, 'L');
        $this->fpdf->MultiCell($second, $this->space, utf8_decode($titulacion->tesis), 0, 'L');
        $this->fpdf->Ln(2);
        $this->fpdf->Cell($first, $this->space, utf8_decode('Líneas de investigación: '), 0, 0, 'L');
        $this->fpdf->MultiCell($second, $this->space, utf8_decode($titulacion->lineas_academicas), 0, 'L');
        $this->fpdf->Ln(9);

        $this->WriteText($contenido['eight']);
        $this->fpdf->Ln(8);
        $this->WriteText($contenido['nine']);
        $this->fpdf->Ln(10);

        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("REGÍSTRESE, COMUNÍQUESE Y ARCHÍVESE"), 0, 'C', 0);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("Santa Cruz de la Sierra, " . $fechaLiteral), 0, 'C', 0);
        $this->fpdf->Ln(10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode(" Por el Consejo Directivo de Postgrado"), 0, 'L', 0);
        $this->fpdf->Ln(20);

        $this->fpdf->Cell($this->width / 2, $this->space, utf8_decode('_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _'), 0, 0, 'C');
        $this->fpdf->Cell($this->width / 2, $this->space, utf8_decode('_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _'), 0, 0, 'C');
        $this->fpdf->Ln(5);
        $this->fpdf->Cell($this->width / 2, $this->space, utf8_decode($director), 0, 0, 'C');
        $this->fpdf->Cell($this->width / 2, $this->space, utf8_decode($presidente), 0, 0, 'C');
        $this->fpdf->Ln(4);
        $this->fpdf->Cell($this->width / 2, $this->space, utf8_decode('DIRECTOR'), 0, 0, 'C');
        $this->fpdf->Cell($this->width / 2, $this->space, utf8_decode('PRESIDENTE'), 0, 0, 'C');
        $this->fpdf->Ln(4);
        $this->fpdf->Cell($this->width / 2, $this->space, utf8_decode('ESCUELA DE INGENIERÍA'), 0, 0, 'C');
        $this->fpdf->Cell($this->width / 2, $this->space, utf8_decode('CONSEJO DIRECTIVO DE POSTGRADO'), 0, 0, 'C');
        $this->fpdf->Ln(4);
        $this->fpdf->Cell($this->width / 2, $this->space, utf8_decode('F.C.E.T - U.A.G.R.M.'), 0, 0, 'C');
        $this->fpdf->Cell($this->width / 2, $this->space, utf8_decode('F.C.E.T - U.A.G.R.M.'), 0, 0, 'C');

        // pie de pagina
        $this->fpdf->Ln(30);
        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->MultiCell($this->width, 4, utf8_decode("Cc. Archivo"), 0, 'L', 0);
        // FONT BOLD
        $this->fpdf->Output("I", "Consejo_Directivo_Postgrado.pdf");
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
