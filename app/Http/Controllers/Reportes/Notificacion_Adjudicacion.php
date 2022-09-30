<?php

namespace App\Http\Controllers\Reportes;

use Codedge\Fpdf\Fpdf\Fpdf;

class Notificicacion_Adjudicacion extends Fpdf
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

    public function informe()
    {
        $this->fpdf->AddPage();
        $this->fpdf->SetMargins(25, $this->margin, 20);
        $this->fpdf->SetAutoPageBreak(true, 20);

        $this->fpdf->Ln(15);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->MultiCell($this->width, 4, utf8_decode("Santa Cruz de la sierra 01 de agosto del 2022"), 0, 'L', 0);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("OF. COORD. ACAD. N° 1269/2022"), 0, 'L', 0);

        $this->fpdf->Ln(4);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("Señor. - "), 0, 'L', 0);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("M.Sc. Miguel Angel Villalobos Rivas "), 0, 'L', 0);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("Presente. -"), 0, 'L', 0);

        $this->fpdf->Ln(20);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode($this->title), 0, 'C', 0);

        // CONTENIDO
        $contenido = [
            'first' => "En relación del proceso: Requerido con CITE OF.COORD. ACA. N.º 1269/2022 de la Escuela de Ingeniería, Contratación Menor de un Consultor Individual por Producto para el MÓDULO denominado: “Instrumentación Industrial, Sistema Scada y HMI”, en relación al DIPLOMADO en Control y Automatización de Procesos Industriales (1º Versión, 3º Edición) VIRTUAL; a Ejecutarse con Recursos Propios, ya que cuenta con Registro de ejecución de Gastos Preventivo Nº 1332.",
            'second' => "En Calidad de Decano de la Facultad de Ciencias Exactas y Tecnología, designado mediante resolución C.E.U. N° 212/2021 y con base en el informe técnico emitido por el Coordinador Académico ESCUELA DE INGENIERIA – UAGRM en la cual concluye recomendar ADJUDICAR LA CONTRATACION MENOR DE UN CONSULTOR POR PRODUCTO PARA EL MÓDULO DENOMINADO: “INSTRUMENTACIÓN INDUSTRIAL, SISTEMA SCADA Y HMI”, EN RELACIÓN AL “DIPLOMADO EN CONTROL Y AUTOMATIZACION DE PROCESOS INDUSTRIALES (1º Versión, 3º Edición)”. a ejecutarse con Recursos Propios por el monto de Bs. 6.000,00. - tiempo de ejecución 60 horas académicas. Por cumplir los requisitos, APRUEBO el mencionado informe y ADJUDICO esta contratación a la persona citada por el motivo mencionado que será formalizada mediante contrato según condiciones establecidas en los términos de referencia.",
            'third' => "Para formalizar la contratación, agradeceré pasar por el Dpto. legal de la ESCUELA DE INGENIERIA F.C.E.T., Ubicado en la Av. Bush esq. Raul Bascopé, al lado de los módulos de la UAGRM, a efectos de coordinar con esa instancia, la presentación de los requisitos legales, para suscripción del contrato correspondiente.",
        ];
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode('De mi mayor consideración:'), 0, 'J', 0);
        $this->fpdf->Ln(4);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode($contenido['first']), 0, 'J', 0);
        $this->fpdf->Ln(4);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode($contenido['second']), 0, 'L', 0);
        $this->fpdf->Ln(4);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode($contenido['third']), 0, 'J', 0);
        $this->fpdf->Ln(4);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode('Sin otro particular, saludo a usted con las consideraciones del caso.'), 0, 'L', 0);
        $this->fpdf->Ln(4);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode('Atentamente,'), 0, 'L', 0);
        // pie de pagina
        $this->fpdf->Ln(35);

        // FONT BOLD
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->MultiCell($this->width, 4, utf8_decode("C.c.: Archivo ESCUELA DE INGENIERIA"), 0, 'L', 0);
        $this->fpdf->Output("I", "Notificacion Adjudicacion.pdf");
    }
}
