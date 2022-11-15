<?php

namespace App\Http\Controllers\Cartas;

use App\Models\Carta;
use App\Models\CartaDirectivo;
use App\Models\Docente;
use App\Models\Modulo;
use App\Models\Programa;
use App\Models\ProgramaModulo;
use Codedge\Fpdf\Fpdf\Fpdf;

class Requerimiento_Propuesta extends Fpdf
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
        $fechaIni = date('d/m/Y', strtotime($contrato->fecha_inicio));
        $fechaFin = date('d/m/Y', strtotime($contrato->fecha_final));
        $title = 'REF.- REQUERIMIENTO DE PROPUESTA';
        $modalidad = $modulo->modalidad ? $modulo->modalidad : 'Virtual';
        $id_programa = ProgramaModulo::where('id_modulo', $modulo->id)->first()->id_programa;
        $programa = Programa::find($id_programa);
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

        $this->fpdf->Ln(15);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->MultiCell($this->width, 4, utf8_decode("Santa Cruz de la Sierra, " . $fechaLiteral), 0, 'L', 0);  //dinamico
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("OF. COORD. ACAD. N° " . $carta->codigo_admi), 0, 'L', 0);    //dinamico

        $this->fpdf->Ln(4);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("Señor. - "), 0, 'L', 0);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode($name_docente), 0, 'L', 0);     //dinamico
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("CONSULTOR."), 0, 'L', 0);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("Presente. -"), 0, 'L', 0);

        $this->fpdf->Ln(8);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode($title), 0, 'L', 0);
        $this->fpdf->Ln(7);

        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode($docente->honorifico . ' ' . $docente->apellido), 0, 'L', 0);    //dinamico
        $this->fpdf->Ln(8);

        // CONTENIDO
        $contenido = [
            'first' => 'Tengo a bien remitir a su persona el requerimiento de propuesta en calidad de consultor en el <MÓDULO> denominado: "' . $modulo->nombre . '", en relación ' . $name_programa . '. A realizarse en fecha <' . $fechaIni . ' al ' . $fechaFin . '>. Teniendo una carga horaria de 60 (sesenta) horas Académicas, el programa antes mencionado depende de la coordinación académica.',
            'second' => 'En caso de estar interesado, por favor hacer llegar el <CURRÍCULUM VITAE, CÉDULA DE IDENTIDAD, PROGRAMA DE ASIGNATURA (PROPUESTA)> y dar la conformidad de aceptación por escrito hasta el 11 de agosto de 2022.',
        ];
        $this->fpdf->SetFont('Arial', '', 10);
        $this->WriteText($contenido['first']);
        $this->fpdf->Ln(8);
        $this->WriteText($contenido['second']);
        $this->fpdf->Ln(8);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode('Sin otro particular, saludo a usted atentamente.'), 0, 'L', 0);

        // pie de pagina
        $this->fpdf->Ln(50);

        // FONT BOLD
        $this->fpdf->MultiCell($this->width, 4, utf8_decode("_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _"), 0, 'C', 0);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->MultiCell($this->width, 4, utf8_decode($coordinador), 0, 'C', 0);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->MultiCell($this->width, 4, utf8_decode("Coordinador Académico"), 0, 'C', 0);
        $this->fpdf->MultiCell($this->width, 4, utf8_decode("ESCUELA DE INGENIERIA - UAGRM"), 0, 'C', 0);

        $this->fpdf->Output("I", $name_docente . " - Requerimiento Propuesta.pdf");
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
