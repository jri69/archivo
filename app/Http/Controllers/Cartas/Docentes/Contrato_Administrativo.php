<?php

namespace App\Http\Controllers\Cartas\Docentes;

use App\Models\Carta;
use App\Models\CartaDirectivo;
use App\Models\Docente;
use App\Models\Modulo;
use App\Models\Programa;
use App\Models\ProgramaModulo;
use Codedge\Fpdf\Fpdf\Fpdf;
use DateTime;
use Luecano\NumeroALetras\NumeroALetras;

class Contrato_Administrativo extends Fpdf
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
        $mes = $meses[$fecha[1]];
        $fecha = $fecha[0] . ' de ' . $mes . ' de ' . $fecha[2];
        return $fecha;
    }

    private function tipoPrograma($tipo)
    {
        if ($tipo == 'Maestria') {
            return 'a la MAESTRIA';
        }
        if ($tipo == 'Diplomado') {
            return 'al DIPLOMADO';
        }
        if ($tipo == 'Cursos') {
            return 'al CURSO';
        }
        if ($tipo == 'Doctorado') {
            return 'al DOCTORADO';
        }
    }

    private function numeroAliteral($number)
    {
        $formatter = new NumeroALetras();
        return $formatter->toMoney($number);
    }

    function numberToWords($num)
    {
        $num = (int) $num;
        $ones = array("", "uno", "dos", "tres", "cuatro", "cinco", "seis", "siete", "ocho", "nueve", "diez", "once", "doce", "trece", "catorce", "quince", "dieciséis", "diecisiete", "dieciocho", "diecinueve");
        $tens = array("", "", "veinte", "treinta", "cuarenta", "cincuenta", "sesenta", "setenta", "ochenta", "noventa");
        $hundreds = array("", "ciento", "doscientos", "trescientos", "cuatrocientos", "quinientos", "seiscientos", "setecientos", "ochocientos", "novecientos");
        $thousands = array("", "mil", "dos mil", "tres mil", "cuatro mil", "cinco mil", "seis mil", "siete mil", "ocho mil", "nueve mil");

        if ($num < 20) {
            return $ones[$num];
        }

        if ($num < 100) {
            return $tens[floor($num / 10)] . " " . $ones[$num % 10];
        }

        if ($num < 1000) {
            return $hundreds[floor($num / 100)] . " " . $this->numberToWords($num % 100);
        }

        return $thousands[floor($num / 1000)] . " " . $this->numberToWords($num % 1000);
    }

    public function informe($data)
    {
        $this->fpdf->header('Content-type: application/pdf');
        // obtencion de datos

        // obtencion de datos
        $contrato = $data[0];
        $idCarta = $data[1];
        $modulo = Modulo::find($contrato->modulo_id);
        $docente = Docente::find($modulo->docente_id);
        $carta = Carta::find($idCarta);
        $fecha = date('d/m/Y', strtotime($carta->fecha));
        $fechaLiteral = $this->fechaLiteral($fecha);
        $fechaUnoLiteral = $this->fechaLiteral(date('d/m/Y', strtotime($carta->campo_adicional_uno)));
        $fechaTresLiteral = $this->fechaLiteral(date('d/m/Y', strtotime($carta->campo_adicional_tres)));

        $programa = Programa::find($modulo->programa_id);
        $modalidad = $programa->modalidad ?  $modalidad = $programa->modalidad : 'Virtual';
        $name_programa = $this->tipoPrograma($programa->tipo) .  $programa->nombre . " (" . $programa->version . "° versión, " . $programa->edicion . "° edición) " . $modalidad;
        $name_docente = $docente->honorifico . " " . $docente->nombre . " " . $docente->apellido;

        // directivos
        $directivos = CartaDirectivo::where('carta_id', $idCarta)->get();
        $jefe_admi = '';
        $decano = '';
        $director = '';
        foreach ($directivos as $directivo) {
            if ($directivo->directivo->cargo == 'Jefe ADM. y Financiero') {
                $jefe_admi = $directivo->directivo;
            }
            if ($directivo->directivo->cargo == 'Decano') {
                $decano = $directivo->directivo;
            }
            if ($directivo->directivo->cargo == 'Director') {
                $director = $directivo->directivo;
            }
        }
        $jefe_admi ? $jefe_name = $jefe_admi->honorifico . " " . $jefe_admi->nombre . " " . $jefe_admi->apellido  : $jefe_name = '';
        $decano ? $decano_name = $decano->honorifico . " " . $decano->nombre . " " . $decano->apellido  : $decano_name = '';
        $director ? $director_name = $director->honorifico . " " . $director->nombre . " " . $director->apellido  : $director_name = '';


        $ciudadano = $docente->sexo == 'F' ? 'a la ciudadana' : 'al ciudadano';

        $this->fpdf->AddPage();
        $this->fpdf->SetMargins(22, $this->margin, 22);
        $this->fpdf->SetAutoPageBreak(true, 20);
        $this->fpdf->SetFont('Arial', 'B', 12);
        $this->fpdf->Ln(5);


        /*  CONTRATO ADMINISTRATIVO No.148/2023*/
        $this->fpdf->Cell(0, 5, utf8_decode('CONTRATO ADMINISTRATIVO No.' . $carta->codigo_admi), 0, 1, 'C');
        $this->fpdf->Ln(5);
        $this->fpdf->Cell(0, 5, utf8_decode('(CONTRATACIÓN MENOR)'), 0, 1, 'C');

        $this->fpdf->Ln(5);
        $this->fpdf->SetFont('Arial', '', 10);

        $this->fpdf->MultiCell(0, 5, utf8_decode('CONTRATO ADMINISTRATIVO DE PRESTACIÓN DE SERVICIO, CONTRATACIÓN MENOR DE CONSULTORIA POR PRODUCTO, PARA DESARROLLAR EL MODULO DENOMINADO: "' . $programa->nombre . '" CORRESPONDIENTE ' . $this->tipoPrograma($programa->tipo) . ': "' . $modulo->nombre . '" ' . $modulo->version . 'º VER. ' . $modulo->edicion . 'º ED., MOD. ' . strtoupper($modulo->modalidad) . ': '), 0, 'J');

        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->Ln(5);
        $this->WriteText(
            'Conste por el presente Contrato Administrativo, que celebran por una parte <LA ESCUELA DE INGENIERIA>, dependiente de <"LA FACULTAD DE CIENCIAS EXACTAS y TECNOLOGIA DE LA U.A.G.R.M">, según lo establece la Resolución Rectoral Nº 221/2021 y la Resolución de Decanato Nº 009/2022, Nº 010/2022, Nº 011/2022 y Nº 012/2022, con domicilio en la  Av. Busch, esquina Raúl Bascope en la ciudad de Santa Cruz de la Sierra, provincia Andrés Ibáñez, departamento de Santa Cruz, representada en este acto por el <Decano de la Facultad de Ciencias Exactas y Tecnología> Ph.D. Ing. Orlando Pedraza Mérida, con C.I. Nº 2957733 S.C., designado mediante Resolución C.E.U. Nº 212/2021; <Responsable del Proceso de Contratación> de Apoyo Nacional a la Producción y Empleo, Lic. Rubén Orosco Gómez, mayor de edad, hábil en toda forma de derecho, portador de la C.I. Nº 2980942 S.C., en uso de su legítima atribución que le confiere la Resolución Rectoral Nº 395/2023; y el Director de la Escuela de Ingeniería, M.Sc. Ing. Erick Rojas Balcázar, con C.I. Nº 3161894 S.C., designado mediante Resolución de Decanato Nº 012/2022, quienes para efectos del presente contrato se denominarán la ENTIDAD; y, por otra parte, ' . $ciudadano . ' ' . $name_docente . ', con C.I. ' . $docente->cedula . ' ' . $docente->expedicion . '., que en adelante se denominará el CONSULTOR, quienes celebran y suscriben el presente Contrato Administrativo, al tenor de las siguientes cláusulas: '
        );

        $this->fpdf->Ln(5);
        $this->WriteText(
            '<CLÁUSULA PRIMERA. - (Antecedentes). -> La <ENTIDAD>, mediante la Modalidad de Contratación Menor, proceso realizado bajo las normas y regulaciones de contratación establecidas en el Decreto Supremo Nº 0181, de 28 de junio de 2009, de las Normas Básicas del Sistema de Administración de Bienes y Servicios (NB-SABS) y sus modificaciones, y los Términos de Referencia y/o Alcance de Trabajo, para la Contratación de Servicios de Consultoría por Producto, el Coordinador Académico de la ESCUELA DE INGENIERIA solicita la contratación de un CONSULTOR por PRODUCTO, para desarrollar el <MODULO DENOMINADO: "' . $modulo->nombre . '" CORRESPONDIENTE ' . $this->tipoPrograma($programa->tipo) . ': "' . $programa->nombre . '" ' . $programa->version . 'º VER. ' . $programa->edicion . 'º ED., MOD. ' . strtoupper($modulo->modalidad) . '>; adjuntando los Términos de Referencia y/o alcance del trabajo. Concluido el proceso de evaluación y propuestas, <el Responsable del Proceso de Contratación de Apoyo Nacional a la Producción y Empleo (RPA)>, en base al informe de Calificación, de fecha ' . $fechaUnoLiteral . ' emitido por el Responsable del áreaM.Sc. Daniel Tejerina Claudio, se resuelve mediante el <' . $carta->campo_adicional_dos . '> de fecha ' . $fechaTresLiteral . ', adjudicar la contratación del servicio de Consultoría por Producto ' . $ciudadano . ' <' . $name_docente . '>, al cumplir su propuesta con todos los requisitos solicitados en los Términos de Referencia y/o Alcance de Trabajo.'
        );

        $this->fpdf->Ln(5);
        $this->WriteText(
            '<CLÁUSULA SEGUNDA. - (Legislación Aplicable). -> El presente Contrato se celebra al amparo de las siguientes disposiciones:'
        );
        $this->fpdf->Ln(5);
        $this->WriteText(
            'a)	Constitución Política del Estado'
        );
        $this->fpdf->Ln(5);
        $this->WriteText(
            'b)	Ley Nª 1178, de 20 de julio de 1990, de Administración y Control Gubernamentales.'
        );
        $this->fpdf->Ln(5);
        $this->WriteText(
            'c)	Decreto Supremo Nº 0181, de 28 de junio de 2009, de las Normas Básicas del Sistema de Administración de Bienes y Servicios-NB-SABS y sus modificaciones.'
        );
        $this->fpdf->Ln(5);
        $this->WriteText(
            'd)	Ley del Presupuesto General del Estado aprobado para la gestión y su reglamentación.'
        );
        $this->fpdf->Ln(5);
        $this->WriteText(
            'e)	Otras disposiciones relacionadas.'
        );

        $this->fpdf->Ln(5);
        $this->WriteText(
            '<CLÁUSULA TERCERA. - (Objeto). -> El Objeto del presente contrato es la prestación del servicio de "CONSULTORIA POR PRODUCTO" modalidad CONTRATACIÓN MENOR, para el desarrollo del Modulo denominado: <"' . $modulo->nombre . '" CORRESPONDIENTE ' . $this->tipoPrograma($programa->tipo) . ': "' . $programa->nombre . '" ' . $programa->version . 'º VER. ' . $programa->edicion . 'º ED., MOD. ' . strtoupper($modulo->modalidad) . '>.'
        );
        $this->fpdf->Ln(5);
        $this->WriteText(
            '<CLÁUSULA CUARTA. - (Documentos Integrantes del Contrato). -> Forman partes integrantes del presente contrato, los siguientes documentos:'
        );
        $this->fpdf->Ln(5);
        $this->WriteText(
            'a)	Notificación de Adjudicación, <' . $carta->campo_adicional_dos . '>, del ' . date('d/m/Y', strtotime($carta->campo_adicional_tres))  . '.'
        );
        $this->fpdf->Ln(5);
        $this->WriteText(
            'b)	Informe de Calificación del Proceso de Contratación Menor del ' . date('d/m/Y', strtotime($carta->campo_adicional_uno)) . '.'
        );
        $this->fpdf->Ln(5);
        $this->WriteText(
            'c)	Los Términos de Referencia para Consultoría por Producto.'
        );
        $this->fpdf->Ln(5);
        $this->WriteText(
            'd)	Otros Documentos específicos de acuerdo al objeto de la contratación.'
        );

        $this->fpdf->Ln(5);
        $this->WriteText(
            '<CLÁUSULA QUINTA. - (Obligaciones de las Partes). -> Las partes contratantes se comprometen y obligan a dar cumplimiento a todas y cada una de las cláusulas del presente contrato. A efectos de cumplir con el objetivo del contrato señalado en la tercera Cláusula, ambas partes se obligan a:'
        );
        $this->fpdf->Ln(5);
        $this->WriteText(
            'Por su parte, <EL CONSULTOR> se compromete a cumplir con las siguientes obligaciones:'
        );
        $this->fpdf->Ln(5);
        $this->WriteText(
            '1.	Realizar la prestación del SERVICIO objeto del presente contrato, de acuerdo con lo establecido en los Términos de Referencia, así como las condiciones de su propuesta.'
        );
        $this->fpdf->Ln(5);
        $this->WriteText(
            '2.	Cumplir cada una de las cláusulas del presente contrato.'
        );
        $this->fpdf->Ln(5);
        $this->WriteText(
            'Por su parte, <la ENTIDAD> se compromete a cumplir con las siguientes obligaciones:'
        );
        $this->fpdf->Ln(5);
        $this->WriteText(
            '1.	Apoyar la Consultoría proporcionado la información necesaria.'
        );
        $this->fpdf->Ln(5);
        $this->WriteText(
            '2.	Dar conformidad del servicio prestado en un plazo no mayor de 10 días hábiles computables a partir de la recepción del informe.'
        );
        $this->fpdf->Ln(5);
        $this->WriteText(
            '3.	Procesar el pago de la CONSULTORÍA a partir de la emisión de la conformidad a favor del consultor.'
        );
        $this->fpdf->Ln(5);
        $this->WriteText(
            '4.	Cumplir cada una de las cláusulas del presente contrato.'
        );

        $this->fpdf->Ln(5);
        $this->WriteText(
            '<CLÁUSULA SEXTA. - (Vigencia). -> El contrato, entrará en vigencia desde el ' . date('d/m/Y', strtotime($contrato->fecha_inicio)) . ' al ' . date('d/m/Y', strtotime($contrato->fecha_final)) . ', y hasta que las mismas hayan dado cumplimiento a todas las cláusulas contenidas en el presente contrato.'
        );
        $this->fpdf->Ln(5);
        $this->WriteText(
            '<CLÁUSULA SÉPTIMA. - (Retención por pagos parciales). -> El CONSULTOR acepta expresamente, que la ENTIDAD retendrá el siete por ciento (7%) del pago (cuando corresponda) hasta la presentación del informe final, en sustitución de la Garantía de Cumplimiento de Contrato. Estas retenciones serán reintegradas en el marco de lo establecido en la Cláusula Décima Octava del presente contrato.'
        );
        $this->fpdf->Ln(5);
        $this->WriteText(
            'En caso de que el CONSULTOR, incurriere en algún tipo de incumplimiento contractual, el importe de dicha garantía será pagado en favor de la ENTIDAD, sin necesidad de ningún trámite o acción judicial, a su solo requerimiento.'
        );

        $this->fpdf->Ln(5);
        $this->WriteText(
            '<CLÁUSULA OCTAVA. - (Plazo de Prestación de la Consultoría). -> El plazo para la prestación de la CONSULTORÍA, tendrá una duración de ' . $this->numberToWords($carta->campo_adicional_cuatro) . ' (' . $carta->campo_adicional_cuatro . ') días calendarios, de acuerdo al cronograma señalado en los Términos de Referencia.'
        );
        $this->fpdf->Ln(5);
        $this->WriteText(
            'Duración de la Consultoría: Del ' . date('d/m/Y', strtotime($contrato->fecha_inicio)) . ' al ' . date('d/m/Y', strtotime($contrato->fecha_final)) . ', con una duración de ' . $modulo->hrs_academicas . ' horas académicas, según la programación académica.'
        );
        $this->fpdf->Ln(5);
        $this->WriteText(
            'En el caso de que la finalización de la CONSULTORIA, coincida con un día feriado, la misma será trasladada al siguiente día hábil administrativo.'
        );
        $this->fpdf->Ln(5);
        $this->WriteText(
            '<CLÁUSULA NOVENA. - (Lugar de Prestación del Servicio). -> El CONSULTOR realizara la CONSULTORIA objeto del presente contrato en la <ESCUELA DE INGENIERIA>, ubicadas en la Av. Busch, esquina Raúl Bascope.'
        );


        $this->fpdf->Ln(5);
        $this->WriteText(
            '<CLÁUSULA DÉCIMA. - (Del monto, moneda y forma de pago). -> El monto total de la CONSULTORIA es de Bs.- ' . $contrato->honorario . ' (' . $this->numeroAliteral($contrato->honorario) . '00/100 bolivianos), pago que se efectuara al finalizar la consultoría, con la presentación del informe de actividades y las notas hayan sido procesadas en el sistema digital y por ende el cierre del Acta de notas. Dicho informe será dirigido al Coordinador Académico de la ESCUELA DE INGENIERIA F.C.E.T., quién elaborará su informe de conformidad y solicitará el pago respectivo de los honorarios del <CONSULTOR>, dirigido al RPA de ESCUELA DE INGENIERIA, vía Director de la ESCUELA DE INGENIERIA, el cual mediante proveído instruirá a las instancias correspondientes el pago al <CONSULTOR>, siguiendo los procedimientos Administrativos Correspondientes.'
        );
        $this->fpdf->Ln(5);
        $this->WriteText(
            'La <ENTIDAD> deberá exigir la presentación del comprobante del pago de Contribuciones al Sistema Integral de Pensiones (SIP), antes de efectuar el pago por la prestación del servicio de CONSULTORÍA, o previa presentación de un informe de la Unidad Solicitante de las horas trabajadas durante las jornadas laborales, antes de efectuar el o los pagos, a los efectos de establecer si corresponde de acuerdo al servicio prestado acogerse a la Resolución Administrativa APS/DPC/DJ/No402-2002 de la autoridad de Fiscalización y Control de Pensiones de Seguros.'
        );

        $this->fpdf->Ln(5);
        $this->WriteText(
            '<CLÁUSULA DÉCIMA PRIMERA. - (Estipulación sobre Impuestos). -> Correrá por cuenta del <CONSULTOR>, en el marco de la relación contractual, el pago de todos los impuestos vigentes en el país, a la fecha de la suscripción del presente contrato, caso contrario si el <CONSULTOR> no entrega la factura fiscal o documento equivalente, los impuestos le serán deducidos de sus honorarios de acuerdo a ley.  En caso de que posteriormente el Estado Plurinacional de Bolivia, implantara Impuestos adicionales, disminuyera o incrementara los vigentes, mediante disposición legal expresa, la <CONSULTORA> deberá acogerse a su cumplimiento desde la fecha de vigencia de dicha normativa.'
        );
        $this->fpdf->Ln(5);
        $this->WriteText(
            '<CLÁUSULA DÉCIMA SEGUNDA. - (Facturación). -> Para que se efectúe el pago, al <CONSULTOR> deberá emitir la respectiva factura oficial por el monto del pago a favor de la <ENTIDAD>, caso contrario la <ENTIDAD> deberá retener los montos de obligaciones tributarias pendientes, para su posterior pago al Servicio de Impuestos Nacionales.'
        );

        $this->fpdf->Ln(5);
        $this->WriteText(
            '<CLÁUSULA DÉCIMA TERCERA. - (Modificaciones al Contrato). -> El contrato podrá ser modificado de acuerdo con lo establecido en el Artículo 89 Inc. b) del Decreto Supremo No.0181 y sus modificaciones.'
        );
        $this->fpdf->Ln(5);
        $this->WriteText(
            '<CLÁUSULA DÉCIMA CUARTA. - (Cesión). -> El <CONSULTOR> no podrá transferir parcial ni totalmente las obligaciones contraídas en el presente contrato, siendo de su entera responsabilidad la ejecución y cumplimiento de las obligaciones establecidas en el mismo.'
        );
        $this->fpdf->Ln(5);
        $this->WriteText(
            '<CLÁUSULA DÉCIMA QUINTA. - (Multas). -> El <CONSULTOR> se obliga a cumplir con el cronograma y/o el plazo de entrega establecido en la Cláusula Octava del presente Contrato, caso contrario será multado con el 0.5 % por día de retraso. La suma de las multas no podrá exceder en ningún caso el veinte por ciento (20%) del monto total del contrato sin perjuicio de resolver el mismo.'
        );
        $this->fpdf->Ln(5);
        $this->WriteText(
            '<CLÁUSULA DÉCIMA SÉXTA. - (Confidencialidad). -> Los materiales producidos por la <CONSULTORA>, así como la información que este tuviera acceso, durante o después de la ejecución del presente contrato, tendrá carácter de confidencial, quedando expresamente prohibida su divulgación a terceros, exceptuando en los casos en que la Entidad emita un pronunciamiento escrito estableciendo lo contrario. Así mismo el <CONSULTOR> reconoce que la Entidad es el único propietario de los productos y documentos producidos en la CONSULTORÍA, producto del presente Contrato.'
        );
        $this->fpdf->Ln(5);
        $this->WriteText(
            '<CLÁUSULA DÉCIMA SÉPTIMA. - (Exoneración a la Entidad de Responsabilidades por Daños al Consultor y a Terceros). -> El <CONSULTOR> se obliga a tomar todas las previsiones que pudiesen surgir por daños a sí mismo y a terceros, se exonera de estas responsabilidades a la <ENTIDAD>.'
        );

        $this->fpdf->Ln(5);
        $this->WriteText(
            '<CLÁUSULA DECIMA OCTAVA. - (Terminación del Contrato). -> Se dará por terminado el vínculo contractual por una de las siguientes causales:'
        );
        $this->fpdf->Ln(5);
        $this->WriteText(
            '1. Por cumplimiento del Contrato:'
        );
        $this->fpdf->Ln(5);
        $this->WriteText(
            'Tanto la <ENTIDAD> como el <CONSULTOR> darán por terminado el presente Contrato, una vez que ambas partes hayan dado cumplimiento a todas las condiciones y estipulaciones contenidas en mismo, lo cual se hará constar por escrito.'
        );
        $this->fpdf->Ln(5);
        $this->WriteText(
            '2. Por Resolución del Contrato:'
        );
        $this->fpdf->Ln(5);
        $this->WriteText(
            '2.1 A requerimiento de la <ENTIDAD>, por causa atribuible al <CONSULTOR>:'
        );
        $this->fpdf->Ln(5);
        $this->WriteText(
            'a) Por incumplimiento en la realización de la CONSULTORIA en el plazo establecido.'
        );
        $this->fpdf->Ln(5);
        $this->WriteText(
            'b) Por suspensión en la provisión de la CONSULTORIA sin justificación.'
        );
        $this->fpdf->Ln(5);
        $this->WriteText(
            'c) Por incumplimiento del objeto de contratación de la CONSULTORÍA en lo referente a los términos de referencia.'
        );
        $this->fpdf->Ln(5);
        $this->WriteText(
            '2.2 A requerimiento del <CONSULTOR>, por causas atribuibles a la <ENTIDAD>:'
        );
        $this->fpdf->Ln(5);
        $this->WriteText(
            'a) Si apartándose del objeto del Contrato, la <ENTIDAD> pretende efectuar modificaciones a los términos de Referencia.'
        );
        $this->fpdf->Ln(5);
        $this->WriteText(
            'b) Por instrucciones injustificadas emanadas por la <ENTIDAD> para la suspensión del servicio por más de treinta (30) días calendarios.'
        );
        $this->fpdf->Ln(5);
        $this->WriteText(
            '2.3 Resolución por causas de fuerza mayor o caso fortuito:'
        );
        $this->fpdf->Ln(5);
        $this->WriteText(
            'Si se presentaran situaciones de fuerza mayor o caso fortuito, que imposibilite la ejecución de la prestación del servicio o vayan contra los intereses del Estado, se podrá resolver el contrato.'
        );
        $this->fpdf->Ln(5);
        $this->WriteText(
            '2.4 Por acuerdo entre partes:'
        );
        $this->fpdf->Ln(5);
        $this->WriteText(
            'Procederá cuando ambas partes otorguen su consentimiento con el objetivo de terminar con la Relación contractual, bajo las siguientes condiciones:'
        );
        $this->fpdf->Ln(5);
        $this->WriteText(
            'a)	Que la voluntad el <CONSULTOR>, sea libre y plena.'
        );
        $this->fpdf->Ln(5);
        $this->WriteText(
            'b)	Que la voluntad de la <Entidad>, se otorgue cuando haya inexistencia de causa de resolución imputable al <CONSULTOR>.'
        );
        $this->fpdf->Ln(5);
        $this->WriteText(
            'c)	 Que la voluntad de la <Entidad>, se otorguen cuando existan razones de interés público u otras circunstancias de carácter excepcional que hagan innecesaria o inconveniente la permanencia del contrato.'
        );
        $this->fpdf->Ln(5);
        $this->WriteText(
            'd)	Que exista un beneficio mutuo entre las partes.'
        );
        $this->fpdf->Ln(5);
        $this->WriteText(
            '2.5 Procedimiento de Resoluciones por causas atribuibles a las partes o por fuerza mayor o caso fortuito.'
        );
        $this->fpdf->Ln(5);
        $this->WriteText(
            'De ocurrir una de las causas anteriormente señaladas, cualquiera de las partes deberá notificar a la otra su intención de resolver el CONTRATO, estableciendo en forma clara y específica la causa en la que se funda.'
        );
        $this->fpdf->Ln(5);
        $this->WriteText(
            'La primera notificación de intención de resolución del CONTRATO, deberá ser cursada en el plazo de cinco (5) días hábiles posteriores al hecho generador de la resolución del contrato, especificando la causal de resolución, que deberá ser efectuada mediante carta dirigida a la <ENTIDAD> o el <CONSULTOR> según corresponda.'
        );
        $this->fpdf->Ln(5);
        $this->WriteText(
            'Si la causal argumentada es subsanada, no prosigue la resolución. Empero, si no existe solución a la conclusión en el plazo de 07 (siete) días hábiles, se debe cursar una segunda carta comunicando que la resolución se ha hecho efectiva.'
        );

        $this->fpdf->Ln(5);
        $this->WriteText(
            'Cuando se efectúe la resolución del contrato se procederá a una liquidación de saldos deudores y acreedores de ambas partes, efectuándose los pagos que hubiere lugar, conforme la evaluación del grado de cumplimiento de los términos de referencia.'
        );
        $this->fpdf->Ln(5);
        $this->WriteText(
            '2.6 Procedimiento de Resolución por mutuo acuerdo.'
        );
        $this->fpdf->Ln(5);
        $this->WriteText(
            'Cuando se efectúe la resolución por mutuo acuerdo, ambas partes deberán suscribir un Documento de Resolución de Contrato por mutuo acuerdo, el cual deberá contener la siguiente información: Partes suscribientes, antecedentes, condiciones para la Resolución de Contrato por acuerdo mutuo (establecidas en el numeral 2.4 de la presente cláusula), objeto del documento, alcances de la Resolución, inexistencia de obligación y conformidad de las partes.'
        );
        $this->fpdf->Ln(5);
        $this->WriteText(
            'Cuando se efectúe la resolución por acuerdo mutuo se procederá a una liquidación de saldos de deudores y acreedores de ambas partes, efectuándose los pagos a que hubiera lugar, conforme la evaluación del grado de cumplimiento de los términos de referencia.'
        );
        $this->fpdf->Ln(5);
        $this->WriteText(
            '<CLÁUSULA DÉCIMA NOVENA. - (Solución de Controversias). -> En caso de surgir dudas sobre los derechos y obligaciones de las partes durante la ejecución del presente contrato, las partes acudirán a los términos y condiciones del contrato. Términos de Referencia, propuesta adjudicada, sometidas a la Jurisdicción Coactiva Fiscal.'
        );
        $this->fpdf->Ln(5);
        $this->WriteText(
            '<CLÁÚSULA VIGÉSIMA. - (Consentimiento). -> En señal de conformidad y para su fiel y estricto cumplimiento, las partes suscriben el presente Contrato en cuatro ejemplares de un mismo tenor y valor legal.'
        );


        $this->fpdf->Ln(10);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(0, 5, utf8_decode('Santa Cruz de la Sierra, ' . $fechaLiteral), 0, 1, 'C');

        $this->fpdf->Ln(30);


        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->Cell($this->width / 2, $this->space, utf8_decode('_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _'), 0, 0, 'C');
        $this->fpdf->Cell($this->width / 2, $this->space, utf8_decode('_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _'), 0, 0, 'C');
        $this->fpdf->Ln(5);
        $this->fpdf->Cell($this->width / 2, $this->space, utf8_decode($jefe_name), 0, 0, 'C');
        $this->fpdf->Cell($this->width / 2, $this->space, utf8_decode($name_docente), 0, 0, 'C');
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Ln(4);
        $this->fpdf->Cell($this->width / 2, $this->space, utf8_decode('R.P.A.- F.C.E.T.'), 0, 0, 'C');
        $this->fpdf->Cell($this->width / 2, $this->space, utf8_decode('Consultor.'), 0, 0, 'C');
        $this->fpdf->Ln(40);

        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->Cell($this->width / 2, $this->space, utf8_decode('_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _'), 0, 0, 'C');
        $this->fpdf->Cell($this->width / 2, $this->space, utf8_decode('_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _'), 0, 0, 'C');
        $this->fpdf->Ln(5);
        $this->fpdf->Cell($this->width / 2, $this->space, utf8_decode($decano_name), 0, 0, 'C');
        $this->fpdf->Cell($this->width / 2, $this->space, utf8_decode($director_name), 0, 0, 'C');
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Ln(4);
        $this->fpdf->Cell($this->width / 2, $this->space, utf8_decode('DECANO DE LA FCET-UAGRM'), 0, 0, 'C');
        $this->fpdf->Cell($this->width / 2, $this->space, utf8_decode('DIRECTOR  E.I. - F.C.E.T.'), 0, 0, 'C');
        $this->fpdf->Ln(4);


        $this->fpdf->Output("I", $docente->nombre . " - Contrato Admi.pdf");
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
