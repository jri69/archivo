<?php

namespace App\Http\Controllers\Cartas\Titulacion;

use App\Models\Carta;
use App\Models\CartaDirectivo;
use App\Models\Docente;
use App\Models\Modulo;
use App\Models\Programa;
use App\Models\ProgramaModulo;
use Codedge\Fpdf\Fpdf\Fpdf;
use Luecano\NumeroALetras\NumeroALetras;

class Informe_Lineas_Investigacion extends Fpdf
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

    private function numeroAliteral($number)
    {
        $formatter = new NumeroALetras();
        return $formatter->toMoney($number);
    }


    public function informe($data)
    {
        /*         // obtencion de datos
        $contrato = $data[0];
        $idCarta = $data[1];
        $modulo = Modulo::find($contrato->modulo_id);
        $docente = Docente::find($modulo->docente_id);
        $carta = Carta::find($idCarta);
        $fecha = date('d/m/Y', strtotime($carta->fecha));
        $fechaLiteral = $this->fechaLiteral($fecha);
        $directivos = CartaDirectivo::where('carta_id', $idCarta)->get();
        $programa = Programa::find($modulo->programa_id);
        $modalidad = $programa->modalidad ?  $modalidad = $programa->modalidad : 'Virtual';
        $honorarioLiteral = $this->numeroAliteral($contrato->honorario);
        $carta = Carta::where('contrato_id', $contrato->id)->where('tipo_id', 1)->first();

        $director = '';
        $asesor = '';
        $responsable = '';
        foreach ($directivos as $directivo) {
            if ($directivo->directivo->cargo == 'Director') {
                $director = $directivo->directivo;
            }
            if ($directivo->directivo->cargo == 'Asesor Legal') {
                $asesor = $directivo->directivo;
            }
            if ($directivo->directivo->cargo == 'Responsable del proceso de contratación') {
                $responsable = $directivo->directivo;
            }
        }

        // validaciones
        $director ? $director = $director->honorifico . " " . $director->nombre . " " . $director->apellido . " - " . $director->cargo . ' ' . $director->institucion : $director = '';

        $asesor ? $asesor = $asesor->honorifico . " " . $asesor->nombre . " " . $asesor->apellido . " - " . $asesor->cargo . ' ' . $asesor->institucion : $asesor = '';

        $responsable ? $responsable = $responsable->honorifico . " " . $responsable->nombre . " " . $responsable->apellido . " - " . $responsable->cargo : $responsable = '';

        $name_docente = $docente->honorifico . " " . $docente->nombre . " " . $docente->apellido;

        // convertir texto a mayuscula
        $name_docente = mb_strtoupper($name_docente, 'UTF-8');
         */

        $this->fpdf->AddPage();
        $this->fpdf->SetMargins(25, $this->margin, 20);
        $this->fpdf->SetAutoPageBreak(true, 20);
        $this->fpdf->Ln(20);

        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("Santa Cruz, 15 de diciembre del 2022"), 0, 'L', 0);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("Oficio de Dirección Nº 0961/2022"), 0, 'L', 0);
        $this->fpdf->Ln(8);

        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("Señora:"), 0, 'L', 0);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("Ph. D. Marbel R. Galeán Barriga"), 0, 'L', 0);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("DIRECTORA GENERAL DE POSTGRADO"), 0, 'L', 0);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("U.A.G.R.M."), 0, 'L', 0);

        $this->fpdf->Ln(4);
        $this->fpdf->SetFont('Arial', 'B', 9);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("Ref.: Informe de las líneas de investigación"), 0, 'C', 0);
        $this->fpdf->Ln(4);

        // CONTENIDO
        $contenido = [
            'first' => "Por medio de la presente, nos es muy grato dirigirnos a su persona para hacerle llegar las líneas de investigación del Trabajo de Grado titulado: “Patologías en el rubro de los servicios petroleros”, correspondiente a la maestría en “Sistemas integrados de gestión de seguridad, medio ambiente y calidad”, (2º Versión – 2º Edición) de la postgraduante Ing. María Alejandra Medina.",
        ];
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("Distinguida Sra.:"), 0, 'L', 0);
        $this->fpdf->Ln(2);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->WriteText($contenido['first']);

        // new page horizonal
        $this->fpdf->AddPage('L');

        $tamano = $this->width;
        /*         $this->widths = array($tamano * 2 / 12, $tamano * 2 / 12, $tamano * 2 / 12, $tamano * 2 / 12, $tamano * 2 / 12, $tamano * 7 / 12);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->row(array(utf8_decode('Programa'), utf8_decode('Postgraduante'), utf8_decode('Líneas de investigación'), utf8_decode('Ejes temáticos'), utf8_decode('Trabajo final de grado'), utf8_decode('Aportes que genera el TFG')), 0, 'C', 'N'); */

        $this->widths = array($tamano * 7 / 12);
        $this->fpdf->SetFont('Arial', '', 10);
        $hmax = $this->height('La importancia de esta investigación permitirá contar con una metodología y herramienta muy útil para que en los proyectos cuenten con registros y estadísticas de las patologías que se producen y les permitan diagnosticar, identificar oportunamente los daños producidos por estas patologías.
        La metodología utilizada en el presente trabajo puede ser aplicada y adaptada no sólo para proyectos de construcción pertenecientes al rubro de los servicios petrolero, sino también a otros rubros o sectores por el sector salud, por los departamentos de Higiene y Seguridad Ocupacional y aquellas industrias que implementen o cuenten un sistema de gestión de la seguridad y salud en el trabajo, cuyo fin sea de planificar acciones preventivas e implementar medidas de control encaminadas a la eliminación o disminución del riesgo de que se produzcan enfermedades u patologías resguardando la salud de los trabajadores en cumplimiento de la normativa vigente en materia de salud y seguridad en el trabajo.
        ');
        $this->widths = array($tamano * 2 / 12);
        $hcmax = $this->height('Líneas de investigación');

        $this->widths = array($tamano * 2 / 12);
        $x = $this->fpdf->GetX();
        $y = $this->fpdf->GetY();
        $this->row(array(utf8_decode('Programa')), 0, 'C', 'N', $hcmax);
        $this->row(array(utf8_decode('“Sistemas integrados de gestión de seguridad, medio ambiente y calidad”, (2º Versión - 2º Edición)')), 0, 'L', 'N', $hmax);

        $this->widths = array($tamano * 2 / 12);
        $this->fpdf->SetXY($x + $tamano * 2 / 12, $y);
        $this->row(array(utf8_decode('Postgraduante')), 0, 'C', 'N', $hcmax);
        $this->fpdf->SetXY($x + $tamano * 2 / 12, $y + $hcmax);
        $this->row(array(utf8_decode('María Alejandra Medina')), 0, 'L', 'N', $hmax / 2);
        $this->fpdf->SetXY($x + $tamano * 2 / 12, $y + $hcmax + $hmax / 2);
        $this->row(array(utf8_decode('No es docente')), 0, 'L', 'N', $hmax / 2);

        $x = $x + ($tamano * 2 / 12) * 2;
        $this->widths = array($tamano * 2 / 12);
        $this->fpdf->SetXY($x, $y);
        $this->row(array(utf8_decode('Líneas de investigación')), 0, 'C', 'N', $hcmax);
        $this->fpdf->SetXY($x, $y + $hcmax);
        $this->row(array(utf8_decode('UAGRM 2.  Administración pública, privada y desarrollo empresarial ')), 0, 'L', 'N', $hmax / 2);
        $this->fpdf->SetXY($x, $y + $hcmax + $hmax / 2);
        $this->row(array(utf8_decode('UPCET “Seguridad y riesgos industriales” ')), 0, 'L', 'N', $hmax / 2);

        $x = $x + $tamano * 2 / 12;
        $this->widths = array($tamano * 2 / 12);
        $this->fpdf->SetXY($x, $y);
        $this->row(array(utf8_decode('Ejes temáticos')), 0, 'C', 'N', $hcmax);
        $this->fpdf->SetXY($x, $y + $hcmax);
        $this->row(array(utf8_decode('11.  Gestión de programas y proyectos')), 0, 'L', 'N', $hmax);

        $x = $x + $tamano * 2 / 12;
        $this->widths = array($tamano * 2 / 12);
        $this->fpdf->SetXY($x, $y);
        $this->row(array(utf8_decode('Trabajo final de grado')), 0, 'C', 'N', $hcmax);
        $this->fpdf->SetXY($x, $y + $hcmax);
        $this->row(array(utf8_decode('“Patologías en el rubro de los servicios petroleros ”')), 0, 'L', 'N', $hmax);

        $x = $x + $tamano * 2 / 12;
        $this->widths = array($tamano * 7 / 12);
        $this->fpdf->SetXY($x, $y);
        $this->row(array(utf8_decode('Aportes que genera el TFG')), 0, 'C', 'N', $hcmax);
        $this->fpdf->SetXY($x, $y + $hcmax);
        $this->row(array(utf8_decode('La importancia de esta investigación permitirá contar con una metodología y herramienta muy útil para que en los proyectos cuenten con registros y estadísticas de las patologías que se producen y les permitan diagnosticar, identificar oportunamente los daños producidos por estas patologías.        La metodología utilizada en el presente trabajo puede ser aplicada y adaptada no sólo para proyectos de construcción pertenecientes al rubro de los servicios petrolero, sino también a otros rubros o sectores por el sector salud, por los departamentos de Higiene y Seguridad Ocupacional y aquellas industrias que implementen o cuenten un sistema de gestión de la seguridad y salud en el trabajo, cuyo fin sea de planificar acciones preventivas e implementar medidas de control encaminadas a la eliminación o disminución del riesgo de que se produzcan enfermedades u patologías resguardando la salud de los trabajadores en cumplimiento de la normativa vigente en materia de salud y seguridad en el trabajo.
        ')), 0, 'L', 'N', $hmax);

        $this->fpdf->Ln(5);
        $this->WriteText("Agradeciendo su atención, la saludo con las consideraciones más distinguidas.");
        $this->fpdf->Ln(6);
        $this->WriteText("Atentamente,");
        // pie de pagina
        $this->fpdf->Ln(30);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->MultiCell($this->width, 4, utf8_decode("Cc. Archivo"), 0, 'L', 0);
        // FONT BOLD
        $this->fpdf->Output("I", "Informe_Lineas_Investigacion.pdf");
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

    function height($data)
    {
        // $nb = 0;
        // for ($i = 0; $i < count($data); $i++)
        //     $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
        // return $h = 5 * $nb + 2;
        return $this->NbLines($this->widths[0], $data) * 5 + 2;
    }
    function Row($data, $pintado = 0, $alling = 'C', $negrita = "N", $h)
    {
        $w = $this->widths[0];
        $a = isset($this->aligns[0]) ? $this->aligns[0] : $alling;
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
            if ($negrita === "S") {
                $this->fpdf->SetFont('Arial', 'B', 10);
            }
            if ($negrita === "SI") {
                $this->fpdf->SetFont('Arial', 'BI', 10);
            }
        }
        $this->fpdf->MultiCell($w, $this->space, $data[0], 0, $a, $pintado);
        $this->fpdf->SetXY($x + $w, $y);
        $this->fpdf->SetTextColor(0, 0, 0);
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
