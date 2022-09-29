<?php

namespace App\Http\Controllers\Reportes;

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

    public function contrataciones($data)
    {
        $this->fpdf->AddPage();
        $this->fpdf->SetMargins(25, $this->margin, 20);
        $this->fpdf->SetAutoPageBreak(true, 20);

        $this->fpdf->Ln(15);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->MultiCell($this->width, 4, utf8_decode("Santa Cruz de la sierra 01 de agosto del 2022"), 0, 'R', 0);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("OF. COORD. ACAD. N° 1269/2022"), 0, 'R', 0);

        $this->fpdf->Ln(8);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("A:        Ph.D. Ing. Orlando Pedraza Mérida - Decano de la F.C.E.T."), 0, 'L', 0);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("           Lic. María Rene Muguertegui de Méndez - Responsable de Procesos de Contratación-JAF"), 0, 'L', 0);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("Via:     M.Sc. Ing. Erick Rojas Balcazar - Director Escuela de Ingeniería de la F.C.E.T."), 0, 'L', 0);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("De:      M.Sc. Ing. Daniel Tejerina Claudio - Coordinador Académico - Escuela de Ingeniería."), 0, 'L', 0);

        $this->fpdf->Ln(8);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode($this->title), 0, 'C', 0);
        $this->fpdf->Ln(3);

        // CONTENIDO
        $contenido = [
            'first' => "Mediante la presente solicito contratación de consultor e informe presupuestario para el MÓDULO denominado: 'Instrumentación Industrial, Sistema Scada y HMI', en relación al DIPLOMADO en Control y Automatización de Procesos Industriales (1º Versión, 3º Edición). VIRTUAL. a realizarse en fecha 15/08/2022 al 28/08/2022. Se adjunta TDR.",
        ];
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode($contenido['first']), 0, 'J', 0);
        $this->fpdf->Ln(4);

        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode('Los fondos están contemplados en el presupuesto de ingresos propios de esta dirección en:'), 0, 'L', 0);

        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode('Apertura programática: 14.00.13'), 0, 'L', 0);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode('Partida Presupuestaria: 25210'), 0, 'L', 0);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode('Fuente de Financiamiento:202-230 (Recurso Propio)'), 0, 'L', 0);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode('Plazo del servicio: 60 Horas Académicas.'), 0, 'L', 0);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode('Forma de Adjudicación: Total a pagar.'), 0, 'L', 0);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode('Método de selección y adjudicación: Presupuesto Fijo.'), 0, 'L', 0);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode('Lugar del servicio: Escuela de Ingeniería - F.C.E.T.'), 0, 'L', 0);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode('Contratación: Mediante Contrato.'), 0, 'L', 0);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode('Costo Total: Bs.- 6000.'), 0, 'L', 0);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode('Sin otro particular, me despido de usted con las consideraciones más distinguidas'), 0, 'L', 0);
        $this->fpdf->Ln(5);

        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode('Atentamente. -'), 0, 'L', 0);


        // pie de pagina
        $this->fpdf->Ln(15);

        // FONT BOLD
        $this->fpdf->MultiCell($this->width, 4, utf8_decode("_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _"), 0, 'C', 0);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->MultiCell($this->width, 4, utf8_decode("M.Sc. Ing. Daniel Tejerina Claudio"), 0, 'C', 0);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->MultiCell($this->width, 4, utf8_decode("Coordinador Académico"), 0, 'C', 0);
        $this->fpdf->MultiCell($this->width, 4, utf8_decode("ESCUELA DE INGENIERIA - F.C.E.T"), 0, 'C', 0);

        $this->fpdf->Ln(2);
        $this->fpdf->SetFont('Arial', '', 8);
        $this->fpdf->MultiCell($this->width, 4, utf8_decode('C.c./ Coordinación académica'), 0, 'L', 0);
        $this->fpdf->MultiCell($this->width, 4, utf8_decode('C.c/ Decanato'), 0, 'L', 0);

        $this->fpdf->Output("I", "Solicitud Contratacion.pdf");
    }
}
