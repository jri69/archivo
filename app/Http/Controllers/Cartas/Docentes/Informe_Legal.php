<?php

namespace App\Http\Controllers\Cartas\Docentes;

use App\Models\Carta;
use App\Models\CartaDirectivo;
use App\Models\Docente;
use App\Models\Modulo;
use App\Models\Programa;
use App\Models\ProgramaModulo;
use Codedge\Fpdf\Fpdf\Fpdf;
use Luecano\NumeroALetras\NumeroALetras;

class Informe_Legal extends Fpdf
{
    protected $fpdf;
    public $margin = 20;
    public $width = 165;
    public $space = 5;
    public $vineta = 30;
    public $widths;
    public $aligns;

    public function __construct()
    {
        $this->fpdf = new Fpdf('P', 'mm', 'Legal');
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
            return 'A LA MAESTRIA ';
        }
        if ($tipo == 'Diplomado') {
            return 'AL DIPLOMADO ';
        }
        if ($tipo == 'Cursos') {
            return 'AL CURSO ';
        }
        if ($tipo == 'Doctorado') {
            return 'AL DOCTORADO ';
        }
    }
    private function numeroAliteral($number)
    {
        $formatter = new NumeroALetras();
        return $formatter->toMoney($number);
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

        $programa = Programa::find($modulo->programa_id);
        $modalidad = $programa->modalidad ?  $modalidad = $programa->modalidad : 'Virtual';
        $name_programa = $this->tipoPrograma($programa->tipo) .  $programa->nombre . " (" . $programa->version . "° versión, " . $programa->edicion . "° edición) " . $modalidad;
        $name_docente = $docente->honorifico . " " . $docente->nombre . " " . $docente->apellido;

        // directivos
        $directivos = CartaDirectivo::where('carta_id', $idCarta)->get();
        $comision = '';
        $asesor = '';
        $virtual = '';
        $coordinador = '';
        foreach ($directivos as $directivo) {
            if ($directivo->directivo->cargo == 'Asesor Legal') {
                $asesor = $directivo->directivo;
            }
            if ($directivo->directivo->cargo == 'Comisión de calificación') {
                $comision = $directivo->directivo;
            }
            if ($directivo->directivo->cargo == 'Encargado de plataforma virtual') {
                $virtual = $directivo->directivo;
            }
            if ($directivo->directivo->cargo == 'Coordinador Académico') {
                $coordinador = $directivo->directivo;
            }
        }
        $comision ? $responsable_name = $comision->honorifico . " " . $comision->nombre . " " . $comision->apellido . " - " . $comision->cargo . ' ' . $comision->institucion : $responsable_name = '';
        $asesor ? $asesor_name = $asesor->honorifico . ' ' . $asesor->nombre . ' ' . $asesor->apellido  . ' - ' . $asesor->cargo . ' ' . $asesor->institucion : $coordinador_name = '';
        $virtual ? $virtual_name = $virtual->honorifico . ' ' . $virtual->nombre . ' ' . $virtual->apellido : $virtual_name = '';
        $coordinador ? $coordinador_name = $coordinador->honorifico . ' ' . $coordinador->nombre . ' ' . $coordinador->apellido : $coordinador_name = '';

        $this->fpdf->AddPage();
        $this->fpdf->SetMargins(22, $this->margin, 22);
        $this->fpdf->SetAutoPageBreak(true, 20);
        $this->fpdf->SetFont('Arial', 'B', 12);
        $this->fpdf->Ln(5);

        // aplicar opacidad
        $x = 23;
        $this->fpdf->Rect($x, $this->fpdf->GetY(), 165 / 3, $this->fpdf->GetY() + 10, 'D');
        $this->fpdf->Image('carta.png', 23, $this->fpdf->GetY() + 2, 50, 20);

        // color gris un poco mas oscuro
        $this->fpdf->SetTextColor(128, 128, 128);
        $x = $x + 165 / 3;
        $y = $this->fpdf->GetY();
        $this->fpdf->Rect($x, $y, 165 / 3, ($this->fpdf->GetY() + 10) / 2, 'D');
        $this->fpdf->Ln(5);
        $this->fpdf->Cell(0, 5, utf8_decode('REGISTRO'), 0, 0, 'C');
        $this->fpdf->Rect($x, ($y + $y) - 2.5, 165 / 3, ($this->fpdf->GetY() + 5) / 2, 'D');

        $this->fpdf->SetFont('Arial', 'B', 9);
        $x = $x + 165 / 3;
        $this->fpdf->Rect($x, $y, 165 / 3, $this->fpdf->GetY() + 5, 'D');
        $this->fpdf->Cell(0, 5, utf8_decode('Código:  GE-PO-01-03                    '), 0, 1, 'R');
        $this->fpdf->Cell(0, 5, utf8_decode('Rev. 1                                  '), 0, 1, 'R');
        $this->fpdf->Cell(0, 5, utf8_decode('Fecha: 17-03-15                         '), 0, 1, 'R');
        $this->fpdf->SetFont('Arial', 'B', 12);
        $this->fpdf->Cell(0, 5, utf8_decode('ASESORIA LEGAL'), 0, 1, 'C');


        $this->fpdf->Ln(8);

        // letra color negro
        $this->fpdf->SetTextColor(0, 0, 0);
        $this->fpdf->SetFont('Arial', 'B', 12);
        $this->fpdf->Cell(0, 5, utf8_decode('ASESORIA LEGAL INF.  ' . $carta->codigo_admi), 0, 1, 'L');
        $this->fpdf->SetFont('Arial', '', 12);
        $this->fpdf->Cell(0, 5, utf8_decode('Santa Cruz, ' . $fechaLiteral), 0, 1, 'L');


        $this->fpdf->Ln(10);
        $this->fpdf->SetFont('Arial', 'B', 12);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("INFORME LEGAL"), 0, 'C', 0);


        $this->fpdf->SetFont('Arial', '', 12);
        $this->fpdf->Ln(5);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("A          :       " . $coordinador_name), 0, 'L', 0);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("             :       " . $virtual_name), 0, 'L', 0);
        $this->fpdf->SetFont('Arial', 'B', 12);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("                    COMISIÓN DE CALIFICACIÓN E.I. - UAGRM"), 0, 'L', 0);


        $this->fpdf->SetFont('Arial', '', 12);
        $this->fpdf->Ln(5);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("DE        :       " . $asesor->honorifico . ' ' . $asesor->nombre . ' ' . $asesor->apellido), 0, 'L', 0);
        $this->fpdf->SetFont('Arial', 'B', 12);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("                     ASESOR LEGAL F.C.E.T."), 0, 'L', 0);


        $this->fpdf->Ln(5);
        $this->fpdf->SetFont('Arial', 'B', 12);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("REF.      :       Revisión de documentos presentado para contratación de un consultor individual por producto, para el desarrollo del Módulo Denominado: \"" . $modulo->nombre . "\" CORRESPONDIENTE " . $this->tipoPrograma($programa->tipo) . ": \"" . $programa->nombre . "\" " . $programa->version . "º VER. " . $programa->edicion . "º ED., MOD. " . $programa->modalidad . "; a ejecutarse con Recursos Propios."), "B", 'J', 0);


        $this->fpdf->Ln(5);
        $this->fpdf->SetFont('Arial', '', 12);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("De mi mayor consideración:"), 0, 'J', 0);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("En cumplimiento a lo establecido en los incisos a) y b) del Artículo 37 de las NB-SABS- D.S. No.0181 de 28 de junio del 2009, tengo a bien emitir el presente informe legal:"), 0, 'J', 0);

        /* I.	ANTECEDENTES. -  */
        $this->fpdf->Ln(5);
        $this->fpdf->SetFont('Arial', 'B', 12);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("I.      ANTECEDENTES.-"), 0, 'L', 0);

        $contenido = [
            'first' => "Recibida la documentación en fecha " . $fechaLiteral . ", y revisado los antecedentes se tiene que el <Coordinador Académico de la ESCUELA DE INGENIERIA> mediante " . $carta->campo_adicional_uno . " solicita la contratación de un <CONSULTOR por PRODUCTO, para desarrollar el Modulo Denominado: \"" . $modulo->nombre . "\" CORRESPONDIENTE " . $this->tipoPrograma($programa->tipo) . ": \"" . $programa->nombre . "\" " . $programa->version . "º VER. " . $programa->edicion . "º ED., MOD. " . $programa->modalidad . ">; Adjuntando los Términos de Referencia y/o alcance del trabajo. A ser dictados en las instalaciones y/o plataforma de la ESCUELA DE INGENIERIA.",
            'second' => "Proveído a cargo <del Lic. Rubén Orozco Gómez - Jefe Administrativo y Finanzas de la F.C.E.T>, de fecha " . date('d/m/Y', strtotime($carta->campo_adicional_dos)) . ", en el cual describe, \"CONTABILIDAD, informar saldo presupuesto preventivo\".",
            'third' => "El <Registro de Ejecución de " . $carta->campo_adicional_tres . ">.",
            'fourth' => "El monto a ser cancelado por la Consultoría Bs. " . $programa->costo . ".- (" . $this->numeroAliteral($programa->costo) . " 00/100 bolivianos).",
            'fifth' => "La Comunicación Interna " . $carta->campo_adicional_cuatro . ", donde el R.P.A. Lic. Rubén Orozco Gómez <Aprueba y Autoriza> la Contratación."
        ];

        $this->fpdf->Ln(5);
        $this->fpdf->SetFont('Arial', '', 12);
        $this->WriteText($contenido['first']);
        $this->fpdf->Ln(8);
        $this->WriteText($contenido['second']);
        $this->fpdf->Ln(8);
        $this->WriteText($contenido['third']);
        $this->fpdf->Ln(8);
        $this->fpdf->SetFont('Arial', 'I', 12);
        $this->WriteText($contenido['fourth']);
        $this->fpdf->Ln(8);
        $this->fpdf->SetFont('Arial', '', 12);
        $this->WriteText($contenido['fifth']);

        $this->fpdf->Ln(10);
        $this->fpdf->SetFont('Arial', 'B', 12);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("II.     TERMINOS DE REFERENCIA. -"), 0, 'L', 0);

        $this->fpdf->Ln(5);
        $this->fpdf->SetFont('Arial', '', 12);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("Los términos de referencia establecen lo siguiente:"), 0, 'J', 0);
        $this->fpdf->SetFont('Arial', 'B', 12);
        $this->fpdf->Ln(5);
        $this->WriteText("<Precio Referencial:>    Bs. " . $programa->costo . ".- (" . $this->numeroAliteral($programa->costo) . " 00/100 bolivianos).");
        $this->fpdf->Ln(5);
        $this->WriteText("<Modalidad de Adjudicación:> " . $carta->campo_adicional_cinco);
        $this->fpdf->Ln(5);
        $this->WriteText("<Forma de Adjudicación:> " . $carta->campo_adicional_seis . ".");
        $this->fpdf->Ln(5);
        $this->WriteText("<Tiempo del contrato:> Del " . date('d/m/Y', strtotime($modulo->fecha_inicio)) . " al " . date('d/m/Y', strtotime($modulo->fecha_final)) . ".");
        $this->fpdf->Ln(5);
        $this->WriteText("<Plazo del Servicio:> " . $modulo->hrs_academicas . " Horas Académicas.");
        $this->fpdf->Ln(5);
        $this->WriteText("<Formalización:> Contrato Menor.");
        $this->fpdf->Ln(5);
        $this->WriteText("<Tipo de Proceso:> Servicio de consultoría individual por Producto.");

        $this->fpdf->Ln(10);
        $this->fpdf->SetFont('Arial', 'B', 12);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("2.    PROPUESTA.-"), 0, 'L', 0);
        $this->fpdf->SetFont('Arial', '', 12);
        $this->fpdf->Ln(5);
        $this->WriteText("Habiéndose invitado al proponente:");
        $this->fpdf->Ln(5);
        $this->fpdf->SetFont('Arial', 'B', 12);
        $this->fpdf->Ln(5);
        $t = $this->width / 4;
        $this->widths = array($t + 8, $t - 8, $t, $t);
        $this->row(array(utf8_decode('PROPONENTES'), utf8_decode('PRECIO EN BS.'), utf8_decode('TIPO DE PROP.'), utf8_decode('VALIDEZ')), 0);
        $this->fpdf->SetFont('Arial', '', 9);
        $this->row(array(utf8_decode($docente->nombre .
            ' ' . $docente->apellido), utf8_decode($programa->costo), utf8_decode('PERSONA NATURAL'), utf8_decode('30 días CALENDARIOS')), 0);


        $this->fpdf->Ln(10);
        $this->fpdf->SetFont('Arial', 'B', 12);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("3. ANALISIS Y RECOMENDACIÓN DE LAS PROPUESTAS:"), 0, 'L', 0);

        $this->fpdf->SetFont('Arial', '', 12);
        $this->WriteText("3.1.- Revisada la documentación del proponente " . $name_docente . ", con C.I. " . $docente->ci . ", aceptando la propuesta económica equivalente a Bs. " . $programa->costo . ".- (" . $this->numeroAliteral($programa->costo) . " 00/100 bolivianos), se verificó que:");

        $this->fpdf->Ln(5);
        $this->fpdf->SetFont('Arial', '', 12);
        $this->WriteText("Presenta la documentación solicitada por los términos de referencias:");
        $this->fpdf->Ln(5);
        $this->fpdf->SetFont('Arial', 'B', 12);
        $this->WriteText("      *	Fotocopia simple de Cédula de Identidad");
        $this->fpdf->Ln(5);
        $this->WriteText("      *	Curriculum Vitae");
        $this->fpdf->Ln(5);
        $this->WriteText("      *	Título en Provisión Nacional");
        $this->fpdf->Ln(5);
        $this->WriteText("      *	Propuesta Técnica");

        $this->fpdf->Ln(10);
        $this->fpdf->SetFont('Arial', 'B', 12);
        $this->WriteText("RECOMENDACIÓN.-");
        $this->fpdf->Ln(5);
        $this->fpdf->SetFont('Arial', '', 12);
        $this->WriteText("Para fines consiguientes se informa que se procedió a la verificación de la documentación presentada por la proponente, evidenciándose que no existen observaciones, por lo que se recomienda que la propuesta continúe su curso de acuerdo a norma.");

        $this->fpdf->Ln(10);
        $this->fpdf->SetFont('Arial', 'B', 12);
        $this->WriteText("4. CONSIDERACIONES LEGALES.-");
        $this->fpdf->Ln(5);
        $this->fpdf->SetFont('Arial', 'B', 12);
        $this->WriteText("- Que el Decreto Supremo 181, en su Artículo 52.- Establece:");
        $this->fpdf->Ln(5);
        $this->fpdf->SetFont('Arial', 'B', 12);
        $this->WriteText("(Definición de Modalidad de Contratación Menor).");
        $this->fpdf->Ln(5);
        $this->fpdf->SetFont('Arial', '', 12);
        $this->WriteText("Modalidad para la contratación de bienes y servicios, que se aplicará cuando el monto de contratación sea igual o menor a Bs.50.000.- (CINCUENTA MIL 00/100 BOLIVIANOS).");
        $this->fpdf->Ln(5);
        $this->fpdf->SetFont('Arial', 'B', 12);
        $this->WriteText("- Que el Decreto Supremo 181, en su Artículo 53.- Establece:");
        $this->fpdf->Ln(5);
        $this->fpdf->SetFont('Arial', 'B', 12);
        $this->WriteText("(Responsable de Ejecutar la Contratación Menor).");
        $this->fpdf->Ln(5);
        $this->fpdf->SetFont('Arial', '', 12);
        $this->WriteText("De acuerdo al inciso a) del Parágrafo II del Artículo 34, el responsable de ejecutar las contrataciones menores es el RPA.");

        $this->fpdf->Ln(10);
        $this->fpdf->SetFont('Arial', 'B', 12);
        $this->WriteText("5. CONCLUSIÓN.-");
        $this->fpdf->Ln(5);
        $this->fpdf->SetFont('Arial', '', 12);
        $this->WriteText("De acuerdo a la revisión de los documentos administrativos y legales de la propuesta, se informa que el proponente " . $name_docente . ", con la presentación de los documentos legales solicitados por los términos de referencia. Debiendo el área contable de la Escuela de Ingeniería revisar que el presente proceso de contratación, cuente con todos los documentos mencionados en el TDR. Asimismo, se verificó la documentación del proponente en la Página WEB del SICOES y el mismo NO se encuentra en la lista de proveedores incumplidos.");


        /*      Adj. Legajo completo.*/
        $this->fpdf->Ln(50);
        $this->fpdf->SetFont('Arial', 'B', 8);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("Adj. Legajo completo."), 0, 'R', 0);


        $this->fpdf->Output("I", $docente->nombre . " - Informe Legal.pdf");
        exit;
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
        $this->fpdf->MultiCell($w - $blt_width, $this->space, $txt, $border, $align, $fill);

        //Restore x
        $this->fpdf->SetX($bak_x);
    }

    function Row($data, $pintado = 0, $alling = 'C', $negrita = "N")
    {
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
                // if ($i == 0) {
                //     $a = 'L';
                // }
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
