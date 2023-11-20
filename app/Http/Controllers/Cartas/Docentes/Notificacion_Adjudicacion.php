<?php

namespace App\Http\Controllers\Cartas\Docentes;

use App\Models\Carta;
use App\Models\Docente;
use App\Models\Modulo;
use App\Models\Programa;
use App\Models\ProgramaModulo;
use Codedge\Fpdf\Fpdf\Fpdf;

class Notificacion_Adjudicacion extends Fpdf
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
            return 'a la MAESTRIA en ';
        }
        if ($tipo == 'Diplomado') {
            return 'al DIPLOMADO en ';
        }
        if ($tipo == 'Cursos') {
            return 'al CURSO de ';
        }
        if ($tipo == 'Doctorado') {
            return 'al DOCTORADO en ';
        }
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
        $title = "REF: NOTIFICACION ADJUDICACION";
        $name_docente = $docente->honorifico . " " . $docente->nombre . " " . $docente->apellido;
        $programa = Programa::find($modulo->programa_id);
        $modalidad = $programa->modalidad ?  $modalidad = $programa->modalidad : 'Virtual';
        $name_programa = $this->tipoPrograma($programa->tipo) .  $programa->nombre . " (" . $programa->version . "° versión, " . $programa->edicion . "° edición) " . $modalidad;
        $carta = Carta::where('contrato_id', $contrato->id)->where('tipo_id', 1)->first();


        $this->fpdf->AddPage();
        $this->fpdf->SetMargins(25, $this->margin, 20);
        $this->fpdf->SetAutoPageBreak(true, 20);

        $this->fpdf->Ln(15);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->MultiCell($this->width, 4, utf8_decode("Santa Cruz de la sierra, " . $fechaLiteral), 0, 'L', 0);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("OF. COORD. ACAD. N° " . $carta->codigo_admi), 0, 'L', 0);        // dinamico

        $this->fpdf->Ln(4);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("Señor. - "), 0, 'L', 0);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode($name_docente), 0, 'L', 0);     //dinamico
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("Presente. -"), 0, 'L', 0);

        $this->fpdf->Ln(10);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode($title), 0, 'C', 0);
        $this->fpdf->Ln(4);

        // CONTENIDO
        $contenido = [
            'first' => 'En relación del proceso: Requerido con CITE <ESCUELA DE INGENIERIA OF.COORD. ACA. N.º ' .  $carta->codigo_admi . '> de la Escuela de Ingeniería, Contratación Menor de un Consultor Individual por Producto para el <MÓDULO> denominado: "' . $modulo->nombre . '", en relación' . $name_programa . '; a Ejecutarse con Recursos Propios, ya que cuenta con Registro de ejecución de Gastos Preventivo Nº ' . $contrato->nro_preventiva . '.',

            'second' => 'En Calidad de Responsable para procesos de contratación de bienes y servicios, en ejercicio de las atribuciones que me confiere el inc. F) del art. 34 de D.S. N°181 y el art. <Primero de la Resolución Rectoral N°631/2021> y con base en el informe técnico emitido por el <Coordinador Académico ESCUELA DE INGENIERIA - UAGRM> en la cual concluye recomendar <ADJUDICAR LA CONTRATACION MENOR DE UN CONSULTOR POR PRODUCTO PARA EL MÓDULO DENOMINADO: "' . $modulo->nombre . '", en relación ' . $name_programa . '>. a ejecutarse con Recursos Propios por el monto de Bs.' . $contrato->honorario . '. - tiempo de ejecución 64 horas académicas. Por cumplir los requisitos, <APRUEBO> el mencionado informe y <ADJUDICO> esta contratación a la persona citada por el motivo mencionado que será formalizada mediante contrato según condiciones establecidas en los términos de referencia.',

            'third' => "Para formalizar la contratación, agradeceré pasar por el Dpto. legal de la ESCUELA DE INGENIERIA FCET, Ubicado en la Av. Bush esq. Raul Bascopé, al lado de los módulos de la UAGRM, a efectos de coordinar con esa instancia, la presentación de los requisitos legales, para suscripción del contrato correspondiente.",
        ];
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode('De mi mayor consideración:'), 0, 'J', 0);
        $this->fpdf->Ln(4);
        $this->WriteText($contenido['first']);
        $this->fpdf->Ln(8);
        $this->WriteText($contenido['second']);
        $this->fpdf->Ln(8);
        $this->WriteText($contenido['third']);
        $this->fpdf->Ln(8);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode('Sin otro particular, saludo a usted con las consideraciones del caso.'), 0, 'L', 0);
        $this->fpdf->Ln(4);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode('Atentamente.'), 0, 'L', 0);
        // pie de pagina
        $this->fpdf->Ln(35);

        // FONT BOLD
        $this->fpdf->SetFont('Arial', '', 10);
        $this->WriteText('<C.c.:> Archivo ESCUELA DE INGENIERIA');
        $this->fpdf->Output("I", $name_docente . " - Notificacion Adjudicacion.pdf");
        exit;
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
