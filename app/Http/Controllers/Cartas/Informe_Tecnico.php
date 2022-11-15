<?php

namespace App\Http\Controllers\Cartas;

use App\Models\Carta;
use App\Models\CartaDirectivo;
use App\Models\Docente;
use App\Models\Modulo;
use App\Models\Programa;
use App\Models\ProgramaModulo;
use Codedge\Fpdf\Fpdf\Fpdf;

class Informe_Tecnico extends Fpdf
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
        $facturacion = $docente->facturacion == 'Si' ? "SI" : "NO";
        $fechaIni = date('d/m/Y', strtotime($contrato->fecha_inicio));
        $fechaFin = date('d/m/Y', strtotime($contrato->fecha_final));
        $title = 'INFORME TECNICO';
        $modalidad = $modulo->modalidad ? $modulo->modalidad : 'Virtual';
        $id_programa = ProgramaModulo::where('id_modulo', $modulo->id)->first()->id_programa;
        $programa = Programa::find($id_programa);
        $name_programa = $this->tipoPrograma($programa->tipo) .  $programa->nombre . " (" . $programa->version . "° versión, " . $programa->edicion . "° edición) " . $modalidad;
        $name_docente = $docente->honorifico . " " . $docente->nombre . " " . $docente->apellido;


        // carta
        $carta = Carta::where('contrato_id', $contrato->id)->where('tipo_id', 1)->first();
        // directivos
        $directivos = CartaDirectivo::where('carta_id', $idCarta)->get();
        $responsable = '';
        $coordinador = '';
        foreach ($directivos as $directivo) {
            if ($directivo->directivo->cargo == 'Responsable del proceso de contratación') {
                $responsable = $directivo->directivo;
            }
            if ($directivo->directivo->cargo == 'Coordinador Académico') {
                $coordinador = $directivo->directivo;
            }
        }

        $responsable ? $responsable_name = $responsable->honorifico . " " . $responsable->nombre . " " . $responsable->apellido . " - " . $responsable->cargo . ' ' . $responsable->institucion : $responsable_name = '';
        $coordinador ? $coordinador_name = $coordinador->honorifico . ' ' . $coordinador->nombre . ' ' . $coordinador->apellido  . ' - ' . $coordinador->cargo . ' ' . $coordinador->institucion : $coordinador_name = '';

        $this->fpdf->AddPage();
        $this->fpdf->SetMargins(25, $this->margin, 20);
        $this->fpdf->SetAutoPageBreak(true, 20);

        $this->fpdf->Ln(20);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode($title), 0, 'C', 0);

        $this->fpdf->Ln(4);
        $this->widths = array(14, $this->width - 14);
        $this->Row(array(utf8_decode('De:'), utf8_decode($coordinador_name)), 1, "L", "N");
        $this->Row(array(utf8_decode('A:'), utf8_decode($responsable_name)), 1, "L", "N");

        $this->fpdf->Ln(5);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode('Distinguido ' . $responsable->honorifico . ' ' . $responsable->nombre), 0, 'L', 0);
        $this->fpdf->Ln(5);

        // CONTENIDO
        $contenido = [
            'first' => 'En cumplimiento a las normas establecidas, informo a usted que el proceso de calificación para la contratación del consultor por producto para el <MÓDULO> denominado: "' . $modulo->nombre . '", en relación ' . $name_programa . '. Se concluyó con el proceso bajo el siguiente detalle: ',
            'second' => 'Por todo lo expuesto anteriormente expreso la conformidad respecto a la recepción de todos los temas arriba citados e informar que <CUMPLE> con los requerido por la capacitación según los términos de referencia; así también se <RECOMIENDA LA ADJUDICACION>.',
        ];
        $this->fpdf->SetFont('Arial', '', 10);
        // $this->fpdf->MultiCell($this->width, $this->space, utf8_decode($contenido['first']), 0, 'J', 0);
        $this->WriteText($contenido['first']);
        $this->fpdf->Ln(8);

        $this->fpdf->SetX($this->vineta);
        $this->MultiCellBlt($this->width - 10, 4, chr(149), utf8_decode('Solicitud de contratación para consultor e informe presupuestario mediante comunicación ESCUELA DE INGENIERIA OF.COORD. ACA. N.º ' . $carta->codigo_admi . '.'));

        $this->fpdf->SetX($this->vineta);
        $this->MultiCellBlt($this->width - 10, 4, chr(149), utf8_decode('CONSULTOR	: ' . $name_docente));

        $this->fpdf->SetX($this->vineta);
        $this->MultiCellBlt($this->width - 10, 4, chr(149), utf8_decode('CEDULA DE IDENTIDAD: ' . $docente->cedula . ' ' . $docente->expedido));

        $this->fpdf->SetX($this->vineta);
        $this->MultiCellBlt($this->width - 10, 4, chr(149), utf8_decode('PROGRAMAS 	: ' . $programa->tipo . ' en ' . $programa->nombre . " (" . $programa->version . "° versión, " . $programa->edicion . "° edición) " . $modalidad));

        $this->fpdf->SetX($this->vineta);
        $this->MultiCellBlt($this->width - 10, 4, chr(149), utf8_decode('MODULO   : "' . $modulo->nombre . '".'));

        $this->fpdf->SetX($this->vineta);
        $this->MultiCellBlt($this->width - 10, 4, chr(149), utf8_decode('HONORARIO	: ' . $contrato->honorario . 'Bs (Total Ganado).'));

        $this->fpdf->SetX($this->vineta);
        $this->MultiCellBlt($this->width - 10, 4, chr(149), utf8_decode('HORAS ACADEMICAS: 60 hrs.'));

        $this->fpdf->SetX($this->vineta);
        $this->MultiCellBlt($this->width - 10, 4, ' ', utf8_decode('DURACION DEL MODULO: ' . $fechaIni . ' al ' . $fechaFin . '.'));

        $this->fpdf->SetX($this->vineta);
        $this->MultiCellBlt($this->width - 10, 4, chr(149), utf8_decode('HORARIOS   : ' . $contrato->horario . '.'));

        $this->fpdf->Ln(4);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode('EL CONSULTOR ' . $facturacion . ' PRESENTA FACTURA.'), 0, 'L', 0);
        $this->fpdf->Ln(4);
        $this->fpdf->SetFont('Arial', '', 10);
        // $this->fpdf->MultiCell($this->width, $this->space, utf8_decode($contenido['second']), 0, 'J', 0);
        $this->WriteText($contenido['second']);
        $this->fpdf->Ln(8);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode('Santa Cruz, ' . $fechaLiteral), 0, 'L', 0);

        // pie de pagina
        $this->fpdf->Ln(30);

        // FONT BOLD
        $this->fpdf->MultiCell($this->width, 4, utf8_decode("_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _"), 0, 'C', 0);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->MultiCell($this->width, 4, utf8_decode($coordinador->honorifico . ' ' . $coordinador->nombre . ' ' . $coordinador->apellido), 0, 'C', 0);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->MultiCell($this->width, 4, utf8_decode("Coordinador Académico"), 0, 'C', 0);
        $this->fpdf->MultiCell($this->width, 4, utf8_decode("ESCUELA DE INGENIERIA - UAGRM"), 0, 'C', 0);
        $this->fpdf->Output("I", $docente->nombre . " - Informe Tecnico.pdf");
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
