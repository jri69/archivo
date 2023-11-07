<?php

namespace App\Http\Controllers\Cartas\Titulacion;

use App\Http\Controllers\CartaTitulacion;
use App\Models\CartaTitulacion as ModelsCartaTitulacion;
use App\Models\Directivo;
use App\Models\Estudiante;
use App\Models\Programa;
use App\Models\Titulacion;
use App\Models\TitulacionDirectivo;
use Codedge\Fpdf\Fpdf\Fpdf;
use Luecano\NumeroALetras\NumeroALetras;

class Informe_Originalidad extends Fpdf
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
        $this->fpdf->header('Content-type: application/pdf');
        // obtener datos
        $carta = ModelsCartaTitulacion::findOrFail($data[1]);
        $titulacion = Titulacion::findOrFail($data[0]);
        $programa = Programa::findOrFail($titulacion->programa_id);
        $estudiante = Estudiante::findOrFail($titulacion->estudiante_id);
        $fechaLiteral = $this->fechaLiteral($carta->fecha);

        // aumentar honorifico a estudiante y sexo
        $sexo = $estudiante->sexo == 'M' ? 'el' : 'la';
        $nombre_estudiante = $sexo . ' <' . $estudiante->honorifico . ' ' . $estudiante->nombre . '>';
        $nombre_programa = $this->tipoPrograma($programa->tipo) . ' <' . $programa->nombre . '>';
        $presentacion = '';


        // directora
        $directora = TitulacionDirectivo::where('carta_titulacion_id', $carta->id)->first();
        $directora = Directivo::where('id', $directora->directivo_id)->where('cargo', 'Directora general de postgrado')->first();
        $directora->sexo == 'M' ? $presentacion = 'Estimado Sr. director' : $presentacion = 'Estimada Sra. directora';

        // profesiones
        $profesiones = explode(',', $carta->profesion);
        $nombre_dra = $directora->honorifico . ' ' . $directora->nombre . ' ' . $directora->apellido;

        $this->fpdf->AddPage();
        $this->fpdf->SetMargins(25, $this->margin, 20);
        $this->fpdf->SetAutoPageBreak(true, 20);
        $this->fpdf->Ln(20);

        $this->fpdf->SetFont('Arial', '', 11);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("Santa Cruz, " . $fechaLiteral), 0, 'L', 0);
        $this->fpdf->SetFont('Arial', 'B', 11);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("Oficio de Coordinación de Investigación Nº " . $carta->codigo_admi), 0, 'L', 0);
        $this->fpdf->Ln(8);

        $this->fpdf->SetFont('Arial', '', 11);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode($directora->sexo == 'M' ? 'Señor:' : 'Señora:'), 0, 'L', 0);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode($nombre_dra), 0, 'L', 0);
        $this->fpdf->SetFont('Arial', 'B', 11);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("DIRECTORA GENERAL DE POSTGRADO"), 0, 'L', 0);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("U.A.G.R.M"), 0, 'L', 0);
        $this->fpdf->SetFont('Arial', '', 11);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("Presente"), 0, 'L', 0);

        $this->fpdf->Ln(6);
        $this->fpdf->SetFont('Arial', 'B', 11);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("Ref.: INFORME DE ORIGINALIDAD Y AUTENTICIDAD"), 0, 'C', 0);
        $this->fpdf->Ln(6);

        // CONTENIDO
        $contenido = [
            'first' => "Envío a su persona los ANTECEDENTES DEL TRÁMITE del postgraduante <" . $estudiante->honorifico . ' ' . $estudiante->nombre . ">, correspondiente a " . $nombre_programa . ", Plan " . $programa->codigo . ".",
            'second' => "El " . $carta->documento . " de tesis escrita por " . $nombre_estudiante . ", con el tema de perfil de tesis <" . $titulacion->tesis . ">, de " . $nombre_programa . ", Plan " . $programa->codigo . "."
        ];
        $this->fpdf->SetFont('Arial', '', 11);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode($presentacion), 0, 'L', 0);
        $this->fpdf->Ln(2);
        $this->fpdf->SetFont('Arial', '', 11);
        $this->WriteText($contenido['first']);
        $this->fpdf->Ln(10);

        $this->fpdf->SetFont('Arial', 'B', 11);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode('1. Hechos y Datos:'), 0, 'L', 0);
        $this->fpdf->Ln(2);
        $this->fpdf->SetFont('Arial', '', 11);
        $this->WriteText($contenido['second']);
        $this->fpdf->Ln(6);
        $this->WriteText('Se utilizó la herramienta Dupli Checker, dando un resultado del ' . $titulacion->originalidad . '% de originalidad.');
        $this->fpdf->Ln(10);

        $this->fpdf->SetFont('Arial', 'B', 11);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode('2. Información:'), 0, 'L', 0);
        $this->fpdf->Ln(2);
        $this->fpdf->SetFont('Arial', '', 11);
        $this->WriteText('<Datos del Postgraduante>: ' . $estudiante->nombre);
        $this->fpdf->Ln(6);
        $this->WriteText('<Datos del Tutor>: ' . $titulacion->director);
        $this->fpdf->Ln(6);
        $this->WriteText('<Tema y Datos del Trabajo Final de Grado>: ' . $titulacion->tesis);
        $this->fpdf->Ln(6);
        $this->WriteText('<Nombre del Programa>: ' . $programa->nombre . ' Plan ' . $programa->codigo);
        $this->fpdf->Ln(6);
        $this->WriteText('<Líneas de Investigación>: ' . $titulacion->lineas_academicas);
        $this->fpdf->Ln(6);
        $this->WriteText('<Aportes Científico que genera la investigación:> ');
        $this->fpdf->Ln(6);
        $this->WriteText($titulacion->aporte_academico);
        $this->fpdf->Ln(10);

        $this->fpdf->SetFont('Arial', 'B', 11);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode('3. Análisis y resultado de la herramienta digital usada para la verificación de Similitud y/o plagio'), 0, 'L', 0);
        $this->fpdf->Ln(2);
        $this->fpdf->SetFont('Arial', '', 11);
        $this->WriteText('La Escuela de Ingeniería de la Facultad de Ciencias Exactas y Tecnología definió que se aprobará el TFG con un 75% de autenticidad y originalidad y un 25 % de similitud.');
        $this->fpdf->Ln(10);

        // otra pagina
        $this->fpdf->AddPage();
        $this->fpdf->SetFont('Arial', 'B', 11);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode('RESULTADO'), 0, 'L', 0);
        $this->fpdf->Ln(2);
        $this->fpdf->SetFont('Arial', '', 11);
        $this->WriteText('Nombre de la herramienta digital Utilizada: <Dupli Checker>');
        $this->fpdf->Ln(6);
        $this->WriteText("Resultado <" . $titulacion->originalidad . ">% Originalidad y autenticidad y una similitud del <" . $titulacion->similitud . ">%.");
        $this->fpdf->Ln(10);

        $this->fpdf->SetFont('Arial', 'B', 11);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode('FIRMA'), 0, 'L', 0);
        $this->fpdf->Ln(6);

        // dos cuadros seguidos
        // $this->widths = array($this->width / 2, $this->width / 2);
        // $this->Row(array(utf8_decode(''), utf8_decode('')), 0, "L", "N");
        $h = 55;
        $w = $this->width / 2;
        $x = $this->fpdf->GetX();
        $y = $this->fpdf->GetY();
        $this->fpdf->Rect($x, $y, $w, $h);
        $this->fpdf->SetXY($x, $y + 1);
        $this->fpdf->SetFont('Arial', 'B', 11);
        $this->fpdf->MultiCell($w, $this->space, utf8_decode('Coordinador de Investigación Escuela de Ingeniería '), 0, 'C', 0);
        $this->fpdf->SetXY($x, $y + 20);
        $this->fpdf->SetFont('Arial', '', 11);
        $this->fpdf->MultiCell($w, $this->space, utf8_decode('Firma '), 0, 'L', 0);
        $this->fpdf->SetXY($x, $y + 35);
        $this->fpdf->MultiCell($w, $this->space, utf8_decode('Nombre Completo  '), 0, 'L', 0);
        //Put the position to the right of the cell
        $this->fpdf->SetXY($x + $w, $y);

        $x = $this->fpdf->GetX();
        $y = $this->fpdf->GetY();
        $this->fpdf->Rect($x, $y, $w, $h);
        $this->fpdf->SetXY($x, $y + 1);
        $this->fpdf->SetFont('Arial', 'B', 11);
        $this->fpdf->MultiCell($w, $this->space, utf8_decode('Director Escuela de Ingeniería'), 0, 'C', 0);
        $this->fpdf->SetXY($x, $y + 20);
        $this->fpdf->SetFont('Arial', '', 11);
        $this->fpdf->MultiCell($w, $this->space, utf8_decode('Firma '), 0, 'L', 0);
        $this->fpdf->SetXY($x, $y + 35);
        $this->fpdf->MultiCell($w, $this->space, utf8_decode('Nombre Completo  '), 0, 'L', 0);
        //Put the position to the right of the cell
        $this->fpdf->SetXY($x + $w, $y);

        $this->fpdf->Ln(150);
        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->MultiCell($this->width, 4, utf8_decode("Cc./Archivo."), 0, 'L', 0);
        // FONT BOLD


        $this->fpdf->Output("I", "Informe_Acreditacion_DT.pdf");
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
                $this->fpdf->SetFont('Arial', 'B', 11);
            } else {

                $this->fpdf->Rect($x, $y, $w, $h);
                $this->fpdf->SetXY($x, $y + 1);
                $this->fpdf->SetFont('Arial', '', 11);
                if ($i == 0) {
                    $a = 'L';
                }
                if ($negrita === "S") {
                    $this->fpdf->SetFont('Arial', 'B', 11);
                }
                if ($negrita === "SI") {
                    $this->fpdf->SetFont('Arial', 'BI', 11);
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
        $wmax = ($w - 2 * $this->fpdf->cMargin) * 1100 / $this->fpdf->FontSize;
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
