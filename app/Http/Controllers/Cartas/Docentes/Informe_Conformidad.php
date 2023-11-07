<?php

namespace App\Http\Controllers\Cartas\Docentes;

use App\Models\Carta;
use App\Models\CartaDirectivo;
use App\Models\Directivo;
use App\Models\Docente;
use App\Models\Modulo;
use App\Models\Programa;
use App\Models\ProgramaModulo;
use Codedge\Fpdf\Fpdf\Fpdf;

class Informe_Conformidad extends Fpdf
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

    public function informe($data)
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
        $gestion = date('Y', strtotime($carta->fecha));
        $facturacion = $docente->facturacion == 'Si' ? "SI" : "NO";
        $fechaIni = date('d/m/Y', strtotime($contrato->fecha_inicio));
        $fechaFin = date('d/m/Y', strtotime($contrato->fecha_final));
        $title = "REF: INFORME DE CONFORMIDAD DEL MODULO: " . strtoupper($modulo->nombre);
        $programa = Programa::find($modulo->programa_id);
        $modalidad = $programa->modalidad ?  $modalidad = $programa->modalidad : 'Virtual';
        $cartas = Carta::where('contrato_id', $contrato->id)->where('tipo_id', 1)->first();
        $fecha_carta_literal = $this->fechaLiteral(date('d/m/Y', strtotime($cartas->fecha)));

        // directivos
        $directivos = CartaDirectivo::where('carta_id', $idCarta)->get();
        $director = '';
        $coordinador = '';
        foreach ($directivos as $directivo) {
            if ($directivo->directivo->cargo == 'Director') {
                $director = $directivo->directivo;
            }
            if ($directivo->directivo->cargo == 'Coordinador Académico') {
                $coordinador = $directivo->directivo;
            }
        }
        $docente_nombre = $docente->nombre . ' ' . $docente->apellido;

        // validaciones
        $director ? $director = $director->honorifico . ' ' . $director->nombre . ' ' . $director->apellido : $director = 'DIRECTOR';
        $coordinador ? $coordinador = $coordinador->honorifico . ' ' . $coordinador->nombre . ' ' . $coordinador->apellido : $coordinador = 'COORDINADOR ACADÉMICO';

        $this->fpdf->AddPage();
        $this->fpdf->SetMargins(25, $this->margin, 20);
        $this->fpdf->SetAutoPageBreak(true, 20);

        $this->fpdf->Ln(25);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->MultiCell($this->width, 4, utf8_decode("COMUNICACIÓN INTERNA"), 0, 'C', 0);
        $this->fpdf->MultiCell($this->width, 4, utf8_decode("OF. COORD. ACAD. N°" . $carta->codigo_admi), 0, 'C', 0);

        $this->fpdf->Ln(4);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("Santa Cruz, " . $fechaLiteral), 0, 'R', 0);
        $this->fpdf->Ln(4);

        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("Señor. - "), 0, 'L', 0);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode($director), 0, 'L', 0);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("DIRECTOR DE LA ESCUELA DE INGENIERIA - F.C.E.T. "), 0, 'L', 0);

        $this->fpdf->Ln(8);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode($title), 0, 'C', 0);
        $this->fpdf->Ln(7);

        // CONTENIDO
        $contenido = [
            'first' => 'De acuerdo al Contrato Administrativo <N° ' . $carta->codigo_admi . '> suscrito en la Escuela de Ingeniería, dependiente de la Facultad de Ciencias Exactas y Tecnología de la UAGRM y el <consultor ' . $docente->honorifico . ' ' . $docente_nombre . '>, cuyo objetivo fue el de desarrollar como facilitador (a) en el <MÓDULO>: ' . $modulo->nombre . ' (' . $modulo->version . 'º Versión, ' . $modulo->edicion . 'º Edición) ' . $modalidad . '; ejecutado en fecha <' . $fechaIni . ' a ' . $fechaFin . '.>',
            'second' => 'Que, revisado el informe académico, acta de nota y el Programa de asignatura impartido por <el consultor>, cumplió con todas nuestras exigencias tanto académicas como de calidad. Expresando por tanto mi CONFORMIDAD por el servicio prestado en la presente gestión ' . $gestion . '. En cumplimiento de los procedimientos institucionales y la ejecución satisfactoria del servicio, solicito la cancelación de los honorarios de <Bs. ' . $contrato->honorario . '> del consultor, que fueron presupuestado en el <OF. COORD. ACAD. N° ' . $cartas->codigo_admi . '> en fecha <' . $fecha_carta_literal . '>; con N° de preventiva ' . $contrato->nro_preventiva  . '.',
            'third' => 'Informándole que el consultor ' . $facturacion . ' PRESENTA FACTURA, debiendo realizarse las deducciones de impuesto de ley correspondientes'
        ];
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->MultiCell($this->width, $this->space + 2, utf8_decode('Distinguido Sr. Director:'), 0, 'J', 0);
        $this->WriteText($contenido['first']);
        $this->fpdf->Ln(8);
        $this->WriteText($contenido['second']);
        $this->fpdf->Ln(8);
        $this->WriteText($contenido['third']);
        $this->fpdf->Ln(8);
        $this->fpdf->MultiCell($this->width, $this->space + 2, utf8_decode('Sin otro particular, me despido de usted con las consideraciones más distinguidas.'), 0, 'L', 0);
        $this->fpdf->MultiCell($this->width, $this->space + 2, utf8_decode('Atte:'), 0, 'L', 0);

        // pie de pagina
        $this->fpdf->Ln(30);

        // FONT BOLD
        $this->fpdf->MultiCell($this->width, 4, utf8_decode("_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _"), 0, 'C', 0);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->MultiCell($this->width, 4, utf8_decode($coordinador), 0, 'C', 0);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->MultiCell($this->width, 4, utf8_decode("Coordinador Académico"), 0, 'C', 0);
        $this->fpdf->MultiCell($this->width, 4, utf8_decode("ESCUELA DE INGENIERIA - UAGRM"), 0, 'C', 0);

        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->Ln(8);
        $this->WriteText('KES');
        $this->fpdf->Ln(4);
        $this->WriteText('<C.c.:> Archivo');

        $this->fpdf->Output("I", $docente_nombre . " - Informe Conformidad.pdf");
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
