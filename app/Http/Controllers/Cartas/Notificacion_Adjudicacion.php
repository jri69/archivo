<?php

namespace App\Http\Controllers\Cartas;

use Codedge\Fpdf\Fpdf\Fpdf;

class Notificacion_Adjudicacion extends Fpdf
{
    protected $fpdf;
    public $title = "REF: NOTIFICACION ADJUDICACION";
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

    public function informe($data)
    {

        $this->fpdf->AddPage();
        $this->fpdf->SetMargins(25, $this->margin, 20);
        $this->fpdf->SetAutoPageBreak(true, 20);

        $this->fpdf->Ln(15);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->MultiCell($this->width, 4, utf8_decode("Santa Cruz de la sierra 01 de agosto del 2022"), 0, 'L', 0);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("OF. COORD. ACAD. N° 1269/2022"), 0, 'L', 0);        // dinamico

        $this->fpdf->Ln(4);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("Señor. - "), 0, 'L', 0);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("M.Sc. Miguel Angel Villalobos Rivas "), 0, 'L', 0);     //dinamico
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("Presente. -"), 0, 'L', 0);

        $this->fpdf->Ln(10);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode($this->title), 0, 'C', 0);
        $this->fpdf->Ln(4);

        // CONTENIDO
        $contenido = [
            'first' => 'En relación del proceso: Requerido con CITE <ESCUELA DE INGENIERIA OF.COORD. ACA. N.º 1269/2022> de la Escuela de Ingeniería, Contratación Menor de un Consultor Individual por Producto para el <MÓDULO> denominado: "Instrumentación Industrial, Sistema Scada y HMI", en relación al <DIPLOMADO> en  Control y Automatización de Procesos Industriales (1º Versión, 3º Edición) VIRTUAL; a Ejecutarse con Recursos Propios, ya que cuenta con Registro de ejecución de Gastos Preventivo Nº 1332.',
            'second' => 'En Calidad de Responsable para procesos de contratación de bienes y servicios, en ejercicio de las atribuciones que me confiere el inc. F) del art. 34 de D.S. N°181 y el art. <Primero de la Resolución Rectoral N°631/2021> y con base en el informe técnico emitido por el <Coordinador Académico ESCUELA DE INGENIERIA - UAGRM> en la cual concluye recomendar <ADJUDICAR LA CONTRATACION MENOR DE UN CONSULTOR POR PRODUCTO PARA EL MÓDULO DENOMINADO: "GESTIÓN DE SST Y RIESGOS EN LA CONSTRUCCIÓN CIVIL", EN RELACIÓN A LA "MAESTRÍA EN ADMINISTRACION DE EMPRESAS E INGENIERIA CON MENCION EN: GERENCIA INDUSTRIAL, PROYECTOS DE INGENIERIA, CONSTRUCCIONES CIVILES (1º Versión, 2º Edición)">. a ejecutarse con Recursos Propios por el monto de Bs. 6.000,00. - tiempo de ejecución 64 horas académicas. Por cumplir los requisitos, <APRUEBO> el mencionado informe y <ADJUDICO> esta contratación a la persona citada por el motivo mencionado que será formalizada mediante contrato según condiciones establecidas en los términos de referencia.',
            'third' => "Para formalizar la contratación, agradeceré pasar por el Dpto. legal de la ESCUELA DE INGENIERIA FCET, Ubicado en la Av. Bush esq. Raul Bascopé, al lado de los módulos de la UAGRM, a efectos de coordinar con esa instancia, la presentación de los requisitos legales, para suscripción del contrato correspondiente.",
        ];
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode('De mi mayor consideración:'), 0, 'J', 0);
        $this->fpdf->Ln(4);
        $this->WriteText($contenido['first']);
        $this->fpdf->Ln(8);
        $this->WriteText($contenido['second']);
        $this->fpdf->Ln(8);
        // $this->fpdf->MultiCell($this->width, $this->space, utf8_decode($contenido['third']), 0, 'J', 0);
        $this->WriteText($contenido['third']);
        $this->fpdf->Ln(8);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode('Sin otro particular, saludo a usted con las consideraciones del caso.'), 0, 'L', 0);
        $this->fpdf->Ln(4);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode('Atentamente.'), 0, 'L', 0);
        // pie de pagina
        $this->fpdf->Ln(35);

        // FONT BOLD
        $this->fpdf->SetFont('Arial', '', 10);
        // $this->fpdf->MultiCell($this->width, 4, utf8_decode("<C.c.:> Archivo ESCUELA DE INGENIERIA"), 0, 'L', 0);
        $this->WriteText('<C.c.:> Archivo ESCUELA DE INGENIERIA');
        $this->fpdf->Output("I", "Notificacion Adjudicacion.pdf");
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
