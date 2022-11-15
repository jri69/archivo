<?php

namespace App\Http\Controllers\Cartas;

use App\Models\Carta;
use App\Models\CartaDirectivo;
use App\Models\Docente;
use App\Models\Modulo;
use App\Models\Programa;
use App\Models\ProgramaModulo;
use Codedge\Fpdf\Fpdf\Fpdf;

class Sol_Contrataciones extends Fpdf
{
    protected $fpdf;
    public $title = "Ref.: SOLICITUD DE CONTRATACION PARA CONSULTOR E INFORME PRESUPUESTARIO";
    public $margin = 30;
    public $width = 165;
    public $space = 7;
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

    public function contrataciones($data)
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
        $directivos = CartaDirectivo::where('carta_id', $idCarta)->get();
        $modalidad = $modulo->modalidad ? $modulo->modalidad : 'Virtual';
        $title = 'Ref.: SOLICITUD DE CONTRATACION PARA CONSULTOR E INFORME PRESUPUESTARIO';
        $id_programa = ProgramaModulo::where('id_modulo', $modulo->id)->first()->id_programa;
        $programa = Programa::find($id_programa);
        $name_programa = $this->tipoPrograma($programa->tipo) .  $programa->nombre . " (" . $programa->version . "° versión, " . $programa->edicion . "° edición) " . $modalidad;
        $director = '';
        $decano = '';
        $responsable = '';
        $coordinador = '';
        foreach ($directivos as $directivo) {
            if ($directivo->directivo->cargo == 'Director') {
                $director = $directivo->directivo;
            }
            if ($directivo->directivo->cargo == 'Decano') {
                $decano = $directivo->directivo;
            }
            if ($directivo->directivo->cargo == 'Responsable del proceso de contratación') {
                $responsable = $directivo->directivo;
            }
            if ($directivo->directivo->cargo == 'Coordinador Académico') {
                $coordinador = $directivo->directivo;
            }
        }

        // validaciones
        $director ? $director = $director->honorifico . " " . $director->nombre . " " . $director->apellido . " - <" . $director->cargo . ' ' . $director->institucion . '>' : $director = '';

        $decano ? $decano = $decano->honorifico . " " . $decano->nombre . " " . $decano->apellido . " - <" . $decano->cargo . ' ' . $decano->institucion . '>' : $decano = '';

        $responsable ? $responsable = $responsable->honorifico . " " . $responsable->nombre . " " . $responsable->apellido . " - <" . $responsable->cargo . '>' : $responsable = '';

        $coordinador ? $coordinador_name = $coordinador->honorifico . " " . $coordinador->nombre . " " . $coordinador->apellido . " - <" . $coordinador->cargo . '>' : $coordinador_name = '';

        $this->fpdf->AddPage();
        $this->fpdf->SetMargins(25, $this->margin, 20);
        $this->fpdf->SetAutoPageBreak(true, 20);

        $this->fpdf->Ln(15);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->MultiCell($this->width, 4, utf8_decode("Santa Cruz de la sierra, " . $fechaLiteral), 0, 'R', 0);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("OF. COORD. ACAD. N° " . $carta->codigo_admi), 0, 'R', 0);

        $this->fpdf->Ln(8);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->WriteText("A:        " . $decano);
        $this->fpdf->Ln(5);
        $this->WriteText("           " . $responsable);
        $this->fpdf->Ln(5);
        $this->WriteText("Via:     " . $director);
        $this->fpdf->Ln(5);
        $this->WriteText("De:      " . $coordinador_name);


        $this->fpdf->Ln(8);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode($title), 0, 'C', 0);
        $this->fpdf->Ln(3);

        // CONTENIDO
        $contenido = [
            'first' => 'Mediante la presente solicito contratación de consultor e informe presupuestario para el <MÓDULO> denominado: "' . $modulo->nombre . '", en relación ' . $name_programa . '. a realizarse en fecha <' . $fechaIni . ' al ' . $fechaFin . '>. Se adjunta TDR.',
        ];
        $this->fpdf->SetFont('Arial', '', 10);
        // $this->fpdf->MultiCell($this->width, $this->space, utf8_decode($contenido['first']), 0, 'J', 0);
        $this->WriteText($contenido['first']);
        $this->fpdf->Ln(8);

        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode('Los fondos están contemplados en el presupuesto de ingresos propios de esta dirección en:'), 0, 'L', 0);

        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->MultiCell($this->width, $this->space - 1, utf8_decode('Apertura programática: 14.00.13'), 0, 'L', 0);
        $this->fpdf->MultiCell($this->width, $this->space - 1, utf8_decode('Partida Presupuestaria: 25210'), 0, 'L', 0);
        $this->fpdf->MultiCell($this->width, $this->space - 1, utf8_decode('Fuente de Financiamiento:202-230 (Recurso Propio)'), 0, 'L', 0);
        $this->fpdf->MultiCell($this->width, $this->space - 1, utf8_decode('Plazo del servicio: 60 Horas Académicas.'), 0, 'L', 0);
        $this->fpdf->MultiCell($this->width, $this->space - 1, utf8_decode('Forma de Adjudicación: Total a pagar.'), 0, 'L', 0);
        $this->fpdf->MultiCell($this->width, $this->space - 1, utf8_decode('Método de selección y adjudicación: Presupuesto Fijo.'), 0, 'L', 0);
        $this->fpdf->MultiCell($this->width, $this->space - 1, utf8_decode('Lugar del servicio: Escuela de Ingeniería - F.C.E.T.'), 0, 'L', 0);
        $this->fpdf->MultiCell($this->width, $this->space - 1, utf8_decode('Contratación: Mediante Contrato.'), 0, 'L', 0);
        $this->fpdf->MultiCell($this->width, $this->space - 1, utf8_decode('Costo Total: Bs.- ' . $contrato->honorario . '.'), 0, 'L', 0);
        $this->fpdf->MultiCell($this->width, $this->space - 1, utf8_decode('Sin otro particular, me despido de usted con las consideraciones más distinguidas'), 0, 'L', 0);
        $this->fpdf->Ln(5);

        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode('Atentamente. -'), 0, 'L', 0);


        // pie de pagina
        $this->fpdf->Ln(25);

        // FONT BOLD
        $this->fpdf->MultiCell($this->width, 4, utf8_decode("_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _"), 0, 'C', 0);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->MultiCell($this->width, 4, utf8_decode($coordinador->honorifico . " " . $coordinador->nombre . " " . $coordinador->apellido), 0, 'C', 0);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->MultiCell($this->width, 4, utf8_decode("Coordinador Académico"), 0, 'C', 0);
        $this->fpdf->MultiCell($this->width, 4, utf8_decode("ESCUELA DE INGENIERIA - F.C.E.T"), 0, 'C', 0);

        $this->fpdf->Ln(5);
        $this->fpdf->SetFont('Arial', '', 8);
        $this->WriteText('<C.c/> Coordinación académica');
        $this->fpdf->Ln(4);
        $this->WriteText('<C.c/> Decanato');
        $this->fpdf->Output("I", $docente->nombre . " - Solicitud Contratacion.pdf");
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
