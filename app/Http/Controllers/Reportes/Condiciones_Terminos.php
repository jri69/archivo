<?php

namespace App\Http\Controllers\Reportes;

use Codedge\Fpdf\Fpdf\Fpdf;

class Condiciones_Terminos extends Fpdf
{
    protected $fpdf;
    public $title = "CONDICIONES Y TÉRMINOS PARA CONTRATACION DE CONSULTORES POR PRODUCTO PARA EL DESARROLLO DE MODULOS DE PROGRAMAS ACADEMICOS DE POST GRADO y/o CAPACITACIONES CONTINUA DE LA ESCUELA DE INGENIERIA - FCET - UAGRM";
    public $margin = 30;
    public $width = 165;
    public $space = 4;
    public $vineta = 30;
    public $widths;
    public $aligns;

    public function __construct()
    {
        $this->fpdf = new Fpdf('P', 'mm', 'Letter');
    }

    public function Condiciones_Terminos()
    {
        $this->fpdf->AddPage();
        $this->fpdf->SetMargins(25, $this->margin, 20);
        $this->fpdf->SetAutoPageBreak(true, 20);

        $this->fpdf->Ln(17);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode($this->title), 0, 'C', 0);
        $this->fpdf->Ln(5);
        // CONTENIDO
        $this->antecedentes();
        $this->fpdf->Ln(5);
        $this->objetivosContratacion();
        $this->fpdf->Ln(5);
        $this->marcoReferencia();
        $this->fpdf->Ln(5);
        $this->fpdf->AddPage();
        $this->actividadesCondiciones();
        $this->fpdf->Ln(5);
        $this->perfilRequerido();
        $this->fpdf->Ln(5);
        $this->informacionReferencia([
            'programa' => "Diplomado en Control y Automatización de Procesos Industriales (1º Versión, 3º Edición) Virtual.  ",
            'modulo' => "Instrumentación Industrial, Sistema Scada y HMI.",
            'honorario' => "6000 Bs (Total Ganado).",
            'horas' => "60 Hrs",
            'fecha_modulo' => "15/08/2022 al 28/08/2022.",
            'horario' => "Lunes a Viernes de 18:30 a 22:00, Sábados y Domingos de 10:00 a 12:30 horas"
        ]);
        $this->fpdf->Ln(5);
        $this->lugar();
        $this->fpdf->Ln(5);
        $this->asistenciaPuntualidad();
        $this->fpdf->Ln(5);
        $this->fpdf->AddPage();
        $this->supervicionDireccion();
        $this->fpdf->Ln(5);
        $this->informesFinales();
        $this->fpdf->Ln(5);
        $this->contratoFormaPago();
        $this->fpdf->Ln(5);
        $this->propuesta();
        $this->fpdf->Ln(5);
        $this->modalidadContratacion();
        $this->fpdf->Ln(5);
        $this->fpdf->AddPage();

        $this->cuadroEvaluativo();
        $this->fpdf->Ln(2);
        $this->cuadroC2();
        $this->fpdf->AddPage();
        $this->cuadroTotal();
        $this->fpdf->Ln(5);
        $this->multas();
        $this->fpdf->Ln(5);
        $this->garantia();
        $this->fpdf->Ln(5);
        $this->pagoImpuestos();

        // pie de pagina
        $this->fpdf->Ln(12);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("Santa Cruz de la sierra 01 de agosto del 2022"), 0, 'C', 0);
        $this->fpdf->Ln(35);

        // FONT BOLD
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _"), 0, 'C', 0);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("M.Sc. Ing. Daniel Tejerina Claudio"), 0, 'C', 0);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("Coordinador Académico"), 0, 'C', 0);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("ESCUELA DE INGENIERÍA"), 0, 'C', 0);

        $this->fpdf->Output("I", "Terminos de referencia.pdf");
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
        $this->fpdf->MultiCell($w - $blt_width, $h, $txt, $border, $align, $fill);

        //Restore x
        $this->fpdf->SetX($bak_x);
    }

    public function antecedentes()
    {
        // declarar un objeto json
        $contenido = [
            "First" => "Por mandato de la antigua Constitución política del Estado boliviano, en su artículo 189 y en la Actual Constitución Política del Estado Plurinacional de Bolivia en su artículo 90 Numeral I y II, la Universidad Autónoma Gabriel René Moreno en el CAPÍTULO SEGUNDO, en su artículo 13 y 17 del nuevo Estatuto Orgánico reconoce e identifica las actividades que deben desempeñar los institutos de capacitación.",
            "Second" => "La UAGRM, mediante la Resolución Rectoral N° 105/97 de fecha 31 de julio de 1997 en su artículo 1° resuelve, instruir a los señores decanos la inmediata creación de la unidad de postgrado facultativa.",
            "Third" => "La UAGRM, mediante la Resolución Rectoral N° 416 -2006 de fecha 29 de Diciembre en su artículo 1° resuelve, homologar en todos sus términos y partes la resolución vicerrectoral N° 457/06 de 22/12/2006, y autorizar al instituto de excelencia en los negocios del gas, energía e hidrocarburos (INEGAS), la estructuración y ejecución de programas de actualización, capacitación continua, post grado a nivel de diplomado, especialidad, maestría y doctorado.",
            "Fourth" => "Posteriormente la UAGRM, mediante Resolución Rectoral N°129-2018, en su artículo 1° consolida al instituto para la Excelencia en los Negocios del gas, Energía e Hidrocarburos, dentro de la estructura administrativa, dependiente de rectorado de la UAGRM y, en su artículo 6° instruye a la Escuela de Post Grado de la UAGRM para que a través del órgano correspondiente, incorpore los programas académicos para las áreas del conocimiento de la cadena productiva del gas, energía e hidrocarburos, emitiendo la Escuela de Post Grado de la UAGRM, el titulo correspondiente a los postgraduantes y egresados que cumplan con las exigencias académicas.",
            "Fifth" => "La resolución rectoral N°221/2021 y Comunicación Interna N°447/2021 de 08 de junio de 2021 la cual resuelve transferir la institución para la excelencia en los negocios del gas, energía e hidrocarburos (INEGAS) a la facultad de ciencias exactas y tecnología (FCET).",
            "Sixth" => "Finalmente, las Resoluciones de Decanatura 009/2022, 010/2022 y 011/2022, aprueban, respectivamente, la transferencia, el organigrama y el cambio de nombre de la Unidad de Postgrado a Escuela de Ingeniería.",
        ];

        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("1.- ANTECEDENTES: "), 0, 'L', 0);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->Ln(4);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode($contenido['First']), 0, 'J', 0);
        $this->fpdf->Ln(4);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode($contenido['Second']), 0, 'J', 0);
        $this->fpdf->Ln(4);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode($contenido['Third']), 0, 'J', 0);
        $this->fpdf->Ln(4);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode($contenido['Fourth']), 0, 'J', 0);
        $this->fpdf->Ln(4);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode($contenido['Fifth']), 0, 'J', 0);
        $this->fpdf->Ln(4);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode($contenido['Sixth']), 0, 'J', 0);
    }

    public function objetivosContratacion()
    {
        $contenido = [
            "First" => "Cumplir rol de facilitador en el proceso de enseñanza y aprendizaje en los módulos académicos de postgrado u/o capacitación continua de la Escuela de Ingeniería de FCET; así mismo formar profesionales con competencias teóricas, analíticas y prácticas.",
        ];
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("2.- OBJETIVO DE LA CONTRATACIÓN: "), 0, 'L', 0);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->Ln(4);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode($contenido['First']), 0, 'J', 0);
    }

    public function marcoReferencia()
    {
        $contenido = [
            "First" => "El Consultor para el establecimiento y cumplimiento de su contrato, deberá tener presente y cumplir el presente documento y los siguientes instrumentos normativos: ",
            "Second" => "El Reglamento General del Sistema de Postgrado de la Universidad Autónoma Gabriel René Moreno.",
            "Third" => "El Decreto Supremo 181.",
            "Fourth" => "Ley Financial."
        ];
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("3.- MARCO DE REFERENCIA: "), 0, 'L', 0);

        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->Ln(4);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode($contenido['First']), 0, 'J', 0);

        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->Ln(2);
        $this->fpdf->SetX($this->vineta);
        $this->MultiCellBlt($this->width - 10, 4, 1., utf8_decode($contenido['Second']));

        $this->fpdf->Ln(2);
        $this->fpdf->SetX($this->vineta);
        $this->MultiCellBlt($this->width - 10, 4, 2., utf8_decode($contenido['Third']));

        $this->fpdf->Ln(2);
        $this->fpdf->SetX($this->vineta);
        $this->MultiCellBlt($this->width - 10, 4, 3., utf8_decode($contenido['Fourth']));
    }

    public function actividadesCondiciones()
    {
        $contenido = [
            "First" => "El Consultor, además de las condiciones establecidas en el Contrato y los señalados en el marco de referencia, deberá cumplir con las siguientes actividades y condiciones específicas para el desarrollo de la docencia en el Módulo para el cual será contratado.",
            "Second" => "Las actividades específicas son:",
            "Third" => "Ejecutar el programa analítico de la materia a impartir bajo el diseño curricular por competencias.",
            "Fourth" => "Capacitar alumnos mediante diferentes metodologías (según propuesta).",
            "Fifth" => "Compatibilizar los programas establecidos y los sugeridos por el docente (Actualizaciones)",
            "Sixth" => "Revisión de programas para establecer su pertinencia.",
            "Seventh" => "Análisis de la Bibliografía utilizada y ofertada en el medio.",
        ];
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("4.- ACTIVIDADES Y CONDICIONES ESPECÍFICAS QUE DEBEN SER CUMPLIDAS POR EL CONSULTOR. "), 0, 'L', 0);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->Ln(4);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode($contenido['First']), 0, 'J', 0);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Ln(4);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode($contenido['Second']), 0, 'J', 0);

        $this->fpdf->Ln(2);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->SetX($this->vineta);
        $this->MultiCellBlt($this->width - 10, 4, chr(149), utf8_decode($contenido['Third']));

        $this->fpdf->SetX($this->vineta);
        $this->MultiCellBlt($this->width - 10, 4, chr(149), utf8_decode($contenido['Fourth']));

        $this->fpdf->SetX($this->vineta);
        $this->MultiCellBlt($this->width - 10, 4, chr(149), utf8_decode($contenido['Fifth']));

        $this->fpdf->SetX($this->vineta);
        $this->MultiCellBlt($this->width - 10, 4, chr(149), utf8_decode($contenido['Sixth']));

        $this->fpdf->SetX($this->vineta);
        $this->MultiCellBlt($this->width - 10, 4, chr(149), utf8_decode($contenido['Seventh']));
    }


    public function perfilRequerido()
    {
        $contenido = [
            "First" => "Formación: a Nivel Licenciatura Ing. Industrial o ramas afines.",
            "Second" => "Titulo de maestría.",
            "Third" => "Experiencia General: 3 años de experiencia laboral certificada.",
            "Fourth" => "Formación continua: Certificado de asistencia a seminario, cursos cortos, seminarios taller y otros. ",
            "Fifth" => "Nacionalidad: Boliviana; Extranjero con residencia en el país y/o permiso de trabajo.",
        ];

        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("5.- PERFIL REQUERIDO DEL CONSULTOR"), 0, 'L', 0);
        $this->fpdf->Ln(2);

        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->SetX($this->vineta);
        $this->MultiCellBlt($this->width - 10, 4, chr(149), utf8_decode($contenido['First']));

        $this->fpdf->SetX($this->vineta);
        $this->MultiCellBlt($this->width - 10, 4, chr(149), utf8_decode($contenido['Second']));

        $this->fpdf->SetX($this->vineta);
        $this->MultiCellBlt($this->width - 10, 4, chr(149), utf8_decode($contenido['Third']));

        $this->fpdf->SetX($this->vineta);
        $this->MultiCellBlt($this->width - 10, 4, chr(149), utf8_decode($contenido['Fourth']));

        $this->fpdf->SetX($this->vineta);
        $this->MultiCellBlt($this->width - 10, 4, chr(149), utf8_decode($contenido['Fifth']));
    }

    public function informacionReferencia($data)
    {
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("6.- INFORMACIÓN DE REFERENCIA DEL CONTRATO PARA EL CONSULTOR."), 0, 'L', 0);
        $this->fpdf->Ln(2);

        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->SetX($this->vineta);
        $this->MultiCellBlt($this->width - 10, 4, chr(149), utf8_decode("PROGRAMAS : " . $data['programa']));

        $this->fpdf->SetX($this->vineta);
        $this->MultiCellBlt($this->width - 10, 4, chr(149), utf8_decode("MODULO : " . $data['modulo']));

        $this->fpdf->SetX($this->vineta);
        $this->MultiCellBlt($this->width - 10, 4, chr(149), utf8_decode("HORAS ACADÉMICAS : " . $data["horas"]));

        $this->fpdf->SetX($this->vineta);
        $this->MultiCellBlt($this->width - 10, 4, chr(149), utf8_decode("HONORARIOS : "  . $data['honorario']));

        $this->fpdf->SetX($this->vineta);
        $this->MultiCellBlt($this->width - 10, 4, chr(149), utf8_decode("FECHA DEL MODULO : " . $data['fecha_modulo']));

        $this->fpdf->SetX($this->vineta);
        $this->MultiCellBlt($this->width - 10, 4, chr(149), utf8_decode("HORARIO : " . $data['horario']));

        $this->fpdf->SetX($this->vineta);
        $this->MultiCellBlt($this->width - 10, 4, chr(149), utf8_decode("Validez de la propuesta: 30 días calendario"));
    }

    public function lugar()
    {
        $contenido = [
            "First" => "El lugar de la consultoría será realizado en la Escuela de ingeniería, ubicada en la Av. Busch esq. Raúl Bascope, entre 2do y 3er anillo en la ciudad de SANTA CRUZ DE LA SIERRA. (MODALIDAD PRESENCIAL) o mediante la plataforma virtual: UPCET: Todos los cursos (ei-uagrm.edu.bo) (MODALIDAD VIRTUAL). ",
        ];
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("7.- LUGAR "), 0, 'L', 0);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->Ln(4);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode($contenido['First']), 0, 'J', 0);
    }

    public function asistenciaPuntualidad()
    {
        $contenido = [
            "First" => "Deberá cumplir estrictamente el horario señalado en el punto 6 y presentarse en el aula diez minutos antes del inicio de clases, para ver si están los materiales y equipos necesarios; en caso de no tenerlos, podrá dirigirse a Apoyo Académico o Seguimiento Académico para darle una solución inmediata (MODALIDAD PRESENCIAL) o presentar el material digital en los formatos correspondientes requeridos por la Escuela de Ingeniería, antes del inicio de las clases, para poder cumplir con los procesos de edición, configuración, articulación y cargar a su aula virtual. en caso de no tener completos los materiales de estudio, imposibilitaría el inicio del módulo (MODALIDAD VIRTUAL). ",
        ];
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("8.- ASISTENCIA Y PUNTUALIDAD DEL CONSULTOR."), 0, 'L', 0);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->Ln(4);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode($contenido['First']), 0, 'J', 0);
    }

    public function supervicionDireccion()
    {
        $contenido = [
            "First" => "El Consultor desempeñará sus funciones bajo la supervisión de la COORDINACION ACADEMICA de la Escuela de Ingeniería. ",
        ];
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("9.- SUPERVISIÓN ORGANIZACIÓN Y DIRECCIÓN DEL PROYECTO."), 0, 'L', 0);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->Ln(4);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode($contenido['First']), 0, 'J', 0);
    }

    public function informesFinales()
    {
        $contenido = [
            "First" => "Para efectos del cierre del módulo deberá entregar en los siguientes SIETE DÍAS HÁBILES DE LA FINALIZACIÓN DEL MISMO, lo siguiente:",
            'Second' => "Informe Académico del consultor (informe de conclusión).",
            'Third' => "Planilla de notas en el formulario que le será entregado oportunamente por la Escuela de Ingeniería            ",
        ];
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("10.- INFORMES FINALES"), 0, 'L', 0);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->Ln(4);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode($contenido['First']), 0, 'J', 0);

        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->SetX($this->vineta);
        $this->MultiCellBlt($this->width - 10, 4, "-", utf8_decode($contenido['Second']));

        $this->fpdf->SetX($this->vineta);
        $this->MultiCellBlt($this->width - 10, 4, "-", utf8_decode($contenido['Third']));
    }

    public function contratoFormaPago()
    {
        $contenido = [
            "First" => "El pago del honorario se efectuará previa PRESENTACIÓN DEL INFORME ACADÉMICO Y ACTA DE NOTA por parte del consultor finalizado el modulo por el cual fue contratado. Dicho informe y acta de nota será entregado al COORDINADOR ACADEMICO de la escuela de ingeniería. Quien elaborará un informe de conformidad y al mismo tiempo solicitará el pago respectivo, dirigido al DIRECTOR DE LA ESCUELA DE INGENIERIA, el mismo instruirá a las instancias correspondientes el pago del consultor, mediante una solicitud firmado por su autoridad, siguiendo los procedimientos administrativos correspondientes. ",
        ];
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("11.- CONTRATO Y FORMA DE PAGO"), 0, 'L', 0);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->Ln(4);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode($contenido['First']), 0, 'J', 0);
    }

    public function propuesta()
    {
        $contenido = [
            "First" => "El Consultor ofertante debe presentar:",
            "Second" => "Carta dirigida a la unidad solicitante con Ref.: Propuesta consultor.",
            "Third" => "Propuesta técnica (programa de asignatura) para la realización de la Consultoría, indicando: Objetivo, Metodología y evaluación, con el formato de programa de asignatura.",
            "Fourth" => "Curriculum Vitae.",
            "Fifth" => "Título nivel licenciatura (título de profesional).",
            "Sixth" => "Título de Maestría si corresponde.",
            "Seventh" => "Fotocopia de Carnet de Identidad.",
        ];
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("12.- PROPUESTA"), 0, 'L', 0);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->Ln(4);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode($contenido['First']), 0, 'J', 0);

        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->SetX($this->vineta);
        $this->MultiCellBlt($this->width - 10, 4, chr(149), utf8_decode($contenido['Second']));

        $this->fpdf->SetX($this->vineta);
        $this->MultiCellBlt($this->width - 10, 4, chr(149), utf8_decode($contenido['Third']));

        $this->fpdf->SetX($this->vineta);
        $this->MultiCellBlt($this->width - 10, 4, chr(149), utf8_decode($contenido['Fourth']));

        $this->fpdf->SetX($this->vineta);
        $this->MultiCellBlt($this->width - 10, 4, chr(149), utf8_decode($contenido['Fifth']));

        $this->fpdf->SetX($this->vineta);
        $this->MultiCellBlt($this->width - 10, 4, chr(149), utf8_decode($contenido['Sixth']));

        $this->fpdf->SetX($this->vineta);
        $this->MultiCellBlt($this->width - 10, 4, chr(149), utf8_decode($contenido['Seventh']));
    }

    public function modalidadContratacion()
    {
        $contenido = [
            "First" => "El consultor será contratado bajo la modalidad de Servicios de Consultoría Individual por Producto bajo la modalidad de Contratación Menor.",
            "Second" => "La evaluación de la selección se hará por el método de selección basado en el Presupuesto fijo.",
            "Third" => "El consultor, durante el periodo de contratación, tendrá como sede las instalaciones de la Escuela de Ingeniería en la Av. Busch, esq. Raúl Bascope. ",
        ];
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("13.- MODALIDAD DE CONTRATACIÓN Y EVALUACIÓN DE PROPUESTAS"), 0, 'L', 0);
        $this->fpdf->Ln(4);

        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->SetX($this->vineta);
        $this->MultiCellBlt($this->width - 10, 4, chr(149), utf8_decode($contenido['First']));

        $this->fpdf->SetX($this->vineta);
        $this->MultiCellBlt($this->width - 10, 4, chr(149), utf8_decode($contenido['Second']));

        $this->fpdf->SetX($this->vineta);
        $this->MultiCellBlt($this->width - 10, 4, chr(149), utf8_decode($contenido['Third']));
    }

    public function cuadroEvaluativo()
    {
        $contenido = [
            "First" => "CUADRO DE CALIFICACION",
            "Second" => "La propuesta que no alcance los 50 puntos en la evolución de la misma, será descalificada",
            "Third" => "1.- PUNTAJE DE EVALUACION CUMPLE/ NO CUMPLE",
            "Fourth" => "1.1	FORMACION: a Nivel Licenciatura Ing. Industrial o ramas afines.; Titulo de maestría.",
            "Fifth" => "1.2 CURSOS DE FORMACION CONTINUA: Certificado de asistencia a cursos, seminarios, talleres, simposios, conferencia u otros.",
            "Sixth" => "1.3 EXPERIENCIA GENERAL: 3 años mínimo de experiencia laboral certificada.",
            "Seventh" => "1.4 NACIONALIDAD: Boliviana; Extranjero con residencia en el país y/o permiso de trabajo.",

        ];
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("14.- CUADRO DE EVALUACION Y CALIFICACION AL CONSULTOR."), 0, 'L', 0);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Ln(4);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode($contenido['First']), 0, 'C', 0);

        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->Ln(4);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode($contenido['Second']), 0, 'C', 0);
        $this->fpdf->Ln(4);

        // Table
        $this->widths = array($this->width);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->row(array(utf8_decode('FORMULARIO C1')), 1);
        $this->row(array(utf8_decode('FORMACION Y EXPERIENCIA')), 1);
        $this->row(array(utf8_decode('CONDICIONES MINIMA REQUERIDAS')), 1);
        $this->widths = array($this->width / 2, ($this->width / 2) / 3, ($this->width / 2) / 3, ($this->width / 2) / 3);
        $this->row(array(utf8_decode($contenido['Third']), utf8_decode('PUNTAJE'), utf8_decode('CUMPLE'), utf8_decode('NO CUMPLE'),));
        $this->row(array(utf8_decode($contenido['Fourth']), utf8_decode('15'), utf8_decode('SI'), utf8_decode(' ')));
        $this->row(array(utf8_decode($contenido['Fifth']), utf8_decode('15'), utf8_decode('SI'), utf8_decode(' ')));
        $this->row(array(utf8_decode($contenido['Sixth']), utf8_decode('15'), utf8_decode('SI'), utf8_decode(' ')));
        $this->row(array(utf8_decode($contenido['Seventh']), utf8_decode('15'), utf8_decode('SI'), utf8_decode(' ')));

        $this->widths = array($this->width / 2, ($this->width / 2) / 3, ($this->width / 2) * 2 / 3);
        $this->row(array(utf8_decode('TOTAL'), utf8_decode('15'), utf8_decode('')));
        $this->widths = array($this->width / 2, $this->width / 2);
        $this->row(array(utf8_decode('METODOLOGIA: CUMPLE/ NO CUMPLE'), utf8_decode('por asignar')));
    }

    public function cuadroC2()
    {
        $contenido = [
            "First" => "1",
            "Second" => "2",
            "Third" => "3",
        ];
        $t = $this->width / 2;

        $this->widths = array($this->width);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->widths = array(($this->width / 2) / 3 + ($this->width / 2), ($this->width / 2) / 3, ($this->width / 2) / 3);
        $this->row(array(utf8_decode('                                             FORMULARIO C2                                                  PUNTAJE DE LAS CONDICIONES ADICIONALES'), utf8_decode('Puntaje ASIGNADO'), utf8_decode('Condiciones adicionales propuesta.')), 1);

        $this->widths = array($this->width);
        $this->row(array(utf8_decode('EXPERIENCIA ESPECIFICA')), 0, "C", "S");
        $this->widths = array(($t / 3) / 2, $t + ($t / 3) / 2, $t / 3 + $t / 3);
        $this->row(array(utf8_decode($contenido['First']), utf8_decode('(Experiencia laboral)'), utf8_decode('')), 0, "L", "S");
        $this->widths = array(($t / 3) / 2, $t + ($t / 3) / 2, $t / 3, $t / 3);
        $this->row(array(utf8_decode($contenido['First']), utf8_decode('* Menor a 1 año (5 puntos)'), utf8_decode('SI'), utf8_decode(' ')), 0, "L");
        $this->row(array(utf8_decode($contenido['First']), utf8_decode('* entre 1 a 2 años (8 puntos)'), utf8_decode('SI'), utf8_decode(' ')), 0, "L");
        $this->row(array(utf8_decode($contenido['First']), utf8_decode('* Mayor o igual a 3 años (10 puntos)'), utf8_decode('SI'), utf8_decode(' ')), 0, "L");

        $this->widths = array($this->width);
        $this->row(array(utf8_decode('CURSOS DE FORMACION CONTINUA')), 0, "C", "S");
        $this->widths = array(($t / 3) / 2, $t + ($t / 3) / 2, $t / 3 + $t / 3);
        $this->row(array(utf8_decode($contenido['Second']), utf8_decode('(Seminarios, Cursos, Talleres, Simposios u otros)'), utf8_decode('')), 0, "L", "S");
        $this->widths = array(($t / 3) / 2, $t + ($t / 3) / 2, $t / 3, $t / 3);
        $this->row(array(utf8_decode($contenido['Second']), utf8_decode('* Tiene mayor o igual a 2 certificados (1 puntos)'), utf8_decode('SI'), utf8_decode(' ')), 0, "L");
        $this->row(array(utf8_decode($contenido['Second']), utf8_decode('* Tiene mayor o igual a 4 certificados (3 puntos)'), utf8_decode('SI'), utf8_decode(' ')), 0, "L");
        $this->row(array(utf8_decode($contenido['Second']), utf8_decode('* Tiene mayor o igual a 6 certificados (5 puntos)'), utf8_decode('SI'), utf8_decode(' ')), 0, "L");

        $this->widths = array($this->width);
        $this->row(array(utf8_decode('PROPUESTA TECNICA')), 0, "C", "S");
        $this->widths = array(($t / 3) / 2, $t + ($t / 3) / 2, $t / 3, $t / 3);
        $this->row(array(utf8_decode($contenido['Third']), utf8_decode('*Objetivo y desarrollo de las actividades (20 puntos)'), utf8_decode('20'), utf8_decode(' ')), 0, "L");
        $this->widths = array(($this->width / 2) / 3 + ($this->width / 2), ($this->width / 2) / 3, ($this->width / 2) / 3);
        $this->row(array(utf8_decode('TOTAL'), utf8_decode('15'), utf8_decode('')), 0, "L");
    }

    public function cuadroTotal()
    {
        $contenido = [
            "First" => "1.- PUNTAJE DE EVALUACION CUMPLE/ NO CUMPLE",
            "Second" => "2.- PUNTAJE DE LAS CONDICIONES ADICIONALES",
        ];
        $this->widths = array($this->width / 3, $this->width / 3, $this->width / 3);
        $this->row(array(utf8_decode('RESUMEN DEL FORUMARIO C1 Y C2'), utf8_decode('PUNTAJE TOTAL'), utf8_decode('PUNTAJE OBTENIDO')), 1);
        $this->row(array(utf8_decode($contenido['First']), utf8_decode('15'), utf8_decode('')));
        $this->row(array(utf8_decode($contenido['Second']), utf8_decode('15'), utf8_decode('')));
        $this->row(array(utf8_decode("TOTAL PUNTAJE"), utf8_decode('15'), utf8_decode('')));
    }

    public function multas()
    {
        $contenido = [
            "First" => "El consultor se obliga a cumplir con el cronograma y el plazo de entrega establecido para cada materia y/o Módulos, caso contrario será multado con el 0,5 % por día de retraso. ",
        ];
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("15. MULTAS POR INCUMPLIMIENTO"), 0, 'L', 0);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->Ln(4);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode($contenido['First']), 0, 'J', 0);
    }

    public function garantia()
    {
        $contenido = [
            "First" => "Para el proponente adjudicado, en caso de que aplique, de acuerdo al Art. 21 inciso b) del Decreto Supremo 0181, se procederá a la retención del 7% sobre el monto del pago parcial como “Garantía de Cumplimiento de Contrato”, debiendo ser devuelto al finalizar el servicio.",
        ];
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("16. GARANTIA DE CUMPLIMIENTO DE CONTRATO"), 0, 'L', 0);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->Ln(4);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode($contenido['First']), 0, 'J', 0);
    }

    public function pagoImpuestos()
    {
        $contenido = [
            "First" => "En caso de no emitir factura o su equivalente (Régimen simplificado) por parte del Consultor, se realizará las retenciones correspondientes por concepto de IUE (12,5%) e IT (3%).",
        ];
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode("17. PAGO DE IMPUESTOS "), 0, 'L', 0);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->Ln(4);
        $this->fpdf->MultiCell($this->width, $this->space, utf8_decode($contenido['First']), 0, 'J', 0);
    }
    // ------------------------------------------------------------------
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
                if ($i == 0) {
                    $h = $h - 2;
                }
                $this->fpdf->Rect($x, $y, $w, $h, 'F');
                $this->fpdf->SetXY($x, $y + 1);
                $this->fpdf->SetTextColor(255, 255, 255);
                $this->fpdf->SetFont('Arial', 'B', 10);
            } else {
                $this->fpdf->Rect($x, $y, $w, $h);
                $this->fpdf->SetXY($x, $y + 1);
                $this->fpdf->SetFont('Arial', '', 10);
                if ($i == 0) {
                    $a = 'L';
                }
                if ($negrita == "S") {
                    $this->fpdf->SetFont('Arial', 'B', 10);
                }
            }
            $this->fpdf->MultiCell($w, $this->space, $data[$i], 0, $a, $pintado);
            //Put the position to the right of the cell
            $this->fpdf->SetXY($x + $w, $y);
            // letra color negro
            $this->fpdf->SetTextColor(0, 0, 0);
        }
        //Go to the next line
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
            $w = $this->fpdf->w - $this->fpdf->rMargin - $this->fpdfx;
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
}
