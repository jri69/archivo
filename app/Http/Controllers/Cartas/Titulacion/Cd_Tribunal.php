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

class Cd_Tribunal extends Fpdf
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

        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("RES. CONS.D.P. N° 0371/2022"), 0, 'L', 0);
        $this->fpdf->Ln(5);

        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("CONSEJO DIRECTIVO DE POSTGRADO"), 0, 'C', 0);
        $this->fpdf->Ln(2);

        // CONTENIDO
        $contenido = [
            'first' => "El informe emitido por el Coordinador de Investigación oficio Nº 0583/2022 y Resolución del Comité Académico Científico Nº 0784/2022, la Resolución del Comité Académico Científico Nº 0785/2022.",

            'second' => "Que el oficio de Coordinación de Investigación Nº 0583/2022 informa el cumplimiento de requisitos presentado por el Ing. Noel Jesús Medina Yucra, quien ha aprobado todos los módulos y concluido la elaboración del Trabajo Final de Grado “Volúmenes de residuos sólidos según proveniencia”; correspondiente a la maestría en: “Sistemas integrados de gestión de seguridad, medio ambiente y calidad” (1ºVersión-3º Edición), que se cursó en esta Escuela de Ingeniería de la Facultad de Ciencias Exactas y Tecnología, habiendo presentado el Trabajo Final de Grado en tres ejemplares aprobado con Resolución del Comité Académico Científico Nº 0784/2022  y la  Resolución del Comité Académico Científico Nº 0785/2022, el mismo que está amparado en el CONSUPO Nº 004/2021, en el Artículo 10º y CONSUPO 005/2022.",

            'third' => "La Dirección General de Postgrado, emitió la Resolución Nº 1478/2022 mediante la solicitud de oficio de Dirección General de la Escuela de Ingeniería la Resolución de Consejo Directivo de Postgrado, nombrando al Director de Tesis a la M. Sc. Ing. Alexandra Guerrero Ramirez, como tutor de tesis del Ing. Noel Jesús Medina Yucra, con el trabajo final de grado “Volúmenes de residuos sólidos según proveniencia” correspondiente a la maestría en “Sistemas integrados de gestión de seguridad, medio ambiente y calidad” (1ºVersión-3º Edición).",

            'four' => " Que el Reglamento General del Sistema de POSTGRADO de la Universidad Autónoma “Gabriel René Moreno”, establece en su Sección III Consejo Directivo de POSTGRADO en el Artículo Nº 37, Inciso h) Nominar mediante resolución a los tutores de tesis o de trabajos de grado y a los tribunales de evaluación, en los diferentes niveles post-graduales, en base a la propuesta presentada por el Comité Académico Científico.",

            'five' => "Que el Comité Académico Científico aprobó la designación de los tribunales de Tesis del Ing. Noel Jesús Medina Yucra, mediante la Resolución Comité Académico Científico Nº 0785/2022.",

            'six' => "Que el Comité Académico Científico aprobó el informe de Coordinación de Investigación, mediante  el oficio Nº 583/2022, emitido por el Coordinador de Investigación de la Escuela de Ingeniería con Resolución del Comité Académico Científico N° 0784/2022, del Postgraduante: Ing. Noel Jesús Medina Yucra del programa de maestría en: “Sistemas integrados de gestión de seguridad, medio ambiente y calidad” (1ºVersión-3º Edición)  ; en el que el Coordinador de Investigación emite el informe de las líneas de investigación: “Gestión ambiental”.",

            'seven' => "El Consejo Directivo de Postgrado, en uso de sus legítimas atribuciones, de acuerdo al Reglamento General del Sistema de Postgrado de la Universidad Autónoma Gabriel René Moreno, Capitulo IV, Sección III, El Consejo Directivo de Postgrado Artículo 36º el Consejo Directivo de Postgrado es la máxima instancia en las decisiones académico-científico y de carácter administrativo, en el ámbito de su facultad. ",

            'eight' => "Art. 1º Disponer la defensa ante Tribunal, del Trabajo de Grado “Volúmenes de residuos sólidos según proveniencia”. Elaborado por el Ing. Noel Jesús Medina Yucra, correspondiente a la maestría en: “Sistemas integrados de gestión de seguridad, medio ambiente y calidad” (1ºVersión-3º Edición).",

            'nine' => "Art. 3° Homologar la decisión del Comité Académico Científico N° 0784/2022, de aprobar el informe emitido por el Coordinador de Investigación de la Escuela de Ingeniería de la Facultad de Ciencias Exactas y Tecnología; donde el Director de tesis de grado M. Sc. Ing. Alexandra Guerrero Ramirez, ha emitido su informe de aprobación del Trabajo Final de Grado del Postgraduante: Ing. Noel Jesús Medina Yucra con el tema de tesis “Volúmenes de residuos sólidos según proveniencia” de la maestría en “Sistemas integrados de gestión de seguridad, medio ambiente y calidad” (1ºVersión-3º Edición).",

            'ten' => "Art. 4° Homologar la decisión del Comité Académico Científico N° 0785/2022, de aprobar la designación de los tribunales de Defensa de la Postgraduante: Ing. Noel Jesús Medina Yucra.",
        ];
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("VISTOS:"), 0, 'L', 0);
        $this->fpdf->Ln(2);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->WriteText($contenido['first']);
        $this->fpdf->Ln(6);
        $this->WriteText($contenido['second']);
        $this->fpdf->Ln(6);
        $this->WriteText($contenido['third']);
        $this->fpdf->Ln(8);

        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->WriteText("CONSIDERANDO:");
        $this->fpdf->Ln(6);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->WriteText($contenido['four']);
        $this->fpdf->Ln(6);
        $this->WriteText($contenido['five']);
        $this->fpdf->Ln(6);
        $this->WriteText($contenido['six']);
        $this->fpdf->Ln(8);

        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->WriteText("POR LO TANTO:");
        $this->fpdf->Ln(6);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->WriteText($contenido['seven']);
        $this->fpdf->Ln(8);

        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->WriteText("RESUELVE:");
        $this->fpdf->Ln(6);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->WriteText($contenido['eight']);
        // pasar a la siguente pagina
        $this->WriteText('Art. 2º Designar los siguientes profesores para integrar el mencionado Tribunal de Defensa:');

        $first = $this->width * 3 / 8;
        $second = $this->width * 5 / 8;

        $this->fpdf->Ln(8);
        $this->fpdf->Cell($first, $this->space, utf8_decode('Postgraduante'), 0, 0, 'L');
        $this->fpdf->MultiCell($second, $this->space, utf8_decode('Siriam Katty Arce Rios'), 0, 'L');
        $this->fpdf->Ln(1);
        $this->fpdf->Cell($first, $this->space, utf8_decode('D.T.F.G.:'), 0, 0, 'L');
        $this->fpdf->MultiCell($second, $this->space, utf8_decode('M. Sc. Ing. Luis Enrique Claure Vargas'), 0, 'L');
        $this->fpdf->Ln(1);
        $this->fpdf->Cell($first, $this->space, utf8_decode('Maestría'), 0, 0, 'L');
        $this->fpdf->MultiCell($second, $this->space, utf8_decode('Ingeniería del gas natural y petroquímica Plan 4095-0'), 0, 'L');
        $this->fpdf->Ln(1);
        $this->fpdf->Cell($first, $this->space, utf8_decode('Título del T.F.G.:'), 0, 0, 'L');
        $this->fpdf->MultiCell($second, $this->space, utf8_decode('“Análisis y propuesta de nuevas tecnologías para exploración de bloques con indicios de hidrocarburos en Bolivia”'), 0, 'L');
        $this->fpdf->Ln(1);
        $this->fpdf->Cell($first, $this->space, utf8_decode('Composición del Tribunal: '), 0, 0, 'L');
        $this->fpdf->MultiCell($second, $this->space, utf8_decode('•	M. Sc. Ing. Yan Carla Antelo Vaca Diez'), 0, 'L');
        $this->fpdf->Cell($first, $this->space, utf8_decode(''), 0, 0, 'L');
        $this->fpdf->MultiCell($second, $this->space, utf8_decode('•	M. Sc. Ing. Yenny Lizeth Paz Suárez'), 0, 'L');
        $this->fpdf->Cell($first, $this->space, utf8_decode(''), 0, 0, 'L');
        $this->fpdf->MultiCell($second, $this->space, utf8_decode('•	M. Sc. Ing. Maria Sandy Vargas Zabala'), 0, 'L');
        $this->fpdf->Ln(6);

        $this->WriteText($contenido['nine']);
        $this->fpdf->Ln(8);
        $this->WriteText($contenido['ten']);
        $this->fpdf->Ln(8);

        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("REGÍSTRESE, COMUNÍQUESE Y ARCHÍVESE"), 0, 'C', 0);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("Santa Cruz de la Sierra, 09 de septiembre del 2022"), 0, 'C', 0);
        $this->fpdf->Ln(6);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode(" Por el Consejo Directivo de Postgrado"), 0, 'L', 0);
        $this->fpdf->Ln(20);

        $this->fpdf->Cell($this->width / 2, $this->space, utf8_decode('_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _'), 0, 0, 'C');
        $this->fpdf->Cell($this->width / 2, $this->space, utf8_decode('_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _'), 0, 0, 'C');
        $this->fpdf->Ln(5);
        $this->fpdf->Cell($this->width / 2, $this->space, utf8_decode('M. Sc. Ing. Daniel Tejerina Claudio'), 0, 0, 'C');
        $this->fpdf->Cell($this->width / 2, $this->space, utf8_decode('M. Sc. Ing. Fernando Miguel Navarro Canaviri'), 0, 0, 'C');
        $this->fpdf->Ln(4);
        $this->fpdf->Cell($this->width / 2, $this->space, utf8_decode('COORDINADOR ACADÉMICO'), 0, 0, 'C');
        $this->fpdf->Cell($this->width / 2, $this->space, utf8_decode('COORDINADOR DE INVESTIGACIÓN'), 0, 0, 'C');
        $this->fpdf->Ln(4);
        $this->fpdf->Cell($this->width / 2, $this->space, utf8_decode('ESCUELA DE INGENIERÍA'), 0, 0, 'C');
        $this->fpdf->Cell($this->width / 2, $this->space, utf8_decode('ESCUELA DE INGENIERÍA'), 0, 0, 'C');
        $this->fpdf->Ln(4);
        $this->fpdf->Cell($this->width / 2, $this->space, utf8_decode('F.C.E.T  -  U.A.G.R.M.'), 0, 0, 'C');
        $this->fpdf->Cell($this->width / 2, $this->space, utf8_decode('F.C.E.T  -  U.A.G.R.M.'), 0, 0, 'C');

        // pie de pagina
        $this->fpdf->Ln(30);
        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->MultiCell($this->width, 4, utf8_decode("Cc. Archivo"), 0, 'L', 0);
        // FONT BOLD
        $this->fpdf->Output("I", "Cd_Tribunal.pdf");
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
