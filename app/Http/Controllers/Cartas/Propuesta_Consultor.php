<?php

namespace App\Http\Controllers\Cartas;

use App\Models\Carta;
use App\Models\CartaDirectivo;
use App\Models\Docente;
use App\Models\Modulo;
use App\Models\Programa;
use App\Models\ProgramaModulo;
use Codedge\Fpdf\Fpdf\Fpdf;

class Propuesta_Consultor extends Fpdf
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

    public function propuesta($data)
    {
        // obtencion de datos
        $contrato = $data[0];
        $idCarta = $data[1];
        $modulo = Modulo::find($contrato->modulo_id);
        $docente = Docente::find($modulo->docente_id);
        $carta = Carta::find($idCarta);
        $fecha = date('d/m/Y', strtotime($carta->fecha));
        $fechaLiteral = $this->fechaLiteral($fecha);
        $title = 'REF.- PROPUESTA CONSULTOR';
        $programa = Programa::find($modulo->programa_id);
        $modalidad = $programa->modalidad ?  $modalidad = $programa->modalidad : 'Virtual';
        $name_programa = $this->tipoPrograma($programa->tipo) .  $programa->nombre . " (" . $programa->version . "° versión, " . $programa->edicion . "° edición) " . $modalidad;
        $name_docente = $docente->honorifico . " " . $docente->nombre . " " . $docente->apellido;

        // directivos
        $directivos = CartaDirectivo::where('carta_id', $idCarta)->get();
        $coordinador = '';
        foreach ($directivos as $directivo) {
            if ($directivo->directivo->cargo == 'Coordinador Académico') {
                $coordinador = $directivo->directivo;
            }
        }
        $docente_nombre = $docente->nombre . ' ' . $docente->apellido;

        // validaciones
        $coordinador ? $coordinador = $coordinador->honorifico . ' ' . $coordinador->nombre . ' ' . $coordinador->apellido : $coordinador = 'COORDINADOR ACADÉMICO';

        $this->fpdf->AddPage();
        $this->fpdf->SetMargins(25, $this->margin, 20);
        $this->fpdf->SetAutoPageBreak(true, 20);

        $this->fpdf->Ln(25);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->MultiCell($this->width, 4, utf8_decode("Santa Cruz de la Sierra, " . $fechaLiteral), 0, 'L', 0);

        $this->fpdf->Ln(4);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("Señor. - "), 0, 'L', 0);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode($coordinador), 0, 'L', 0);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("Coordinador Académico"), 0, 'L', 0);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("ESCUELA DE INGENIERIA - UAGRM"), 0, 'L', 0);

        $this->fpdf->Ln(8);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode('Presente.-'), 0, 'L', 0);
        $this->fpdf->Ln(7);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode($title), 0, 'L', 0);
        $this->fpdf->Ln(7);

        // CONTENIDO
        $contenido = [
            'first' => 'Mediante la presente hago llegar mi ACEPTACION al requerimiento de propuesta para ser consultor en el <MÓDULO> denominado: "' . $modulo->nombre . '", en relación ' . $name_programa . '.',
            'second' => 'Por tanto, adjunto carnet de identidad., programa de asignatura, currículum vitae y demás documentación solicitada por su institución.',
        ];
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->MultiCell($this->width, $this->space + 2, utf8_decode('Estimado Ingeniero:'), 0, 'J', 0);
        $this->WriteText($contenido['first']);
        $this->fpdf->Ln(8);
        $this->WriteText($contenido['second']);
        $this->fpdf->Ln(4);
        $this->fpdf->MultiCell($this->width, $this->space + 2, utf8_decode('Con este grato motivo, saludo a usted cordialmente.'), 0, 'L', 0);

        // pie de pagina
        $this->fpdf->Ln(55);

        // FONT BOLD
        $this->fpdf->MultiCell($this->width, 4, utf8_decode("_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _"), 0, 'C', 0);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->MultiCell($this->width, 4, utf8_decode($name_docente), 0, 'C', 0);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->MultiCell($this->width, 4, utf8_decode("CONSULTOR."), 0, 'C', 0);

        $this->fpdf->Output("I", $name_docente . " - Propuesta Consultor.pdf");
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
