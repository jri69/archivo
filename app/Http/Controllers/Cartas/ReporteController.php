<?php

namespace App\Http\Controllers\Cartas;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Cartas\Docentes\Condiciones_Terminos;
use App\Http\Controllers\Cartas\Docentes\Sol_Contrataciones;
use App\Http\Controllers\Cartas\Docentes\Requerimiento_Propuesta;
use App\Http\Controllers\Cartas\Docentes\Propuesta_Consultor;
use App\Http\Controllers\Cartas\Docentes\Informe_Tecnico;
use App\Http\Controllers\Cartas\Docentes\Notificacion_Adjudicacion;
use App\Http\Controllers\Cartas\Docentes\Comunicacion_Interna;
use App\Http\Controllers\Cartas\Docentes\Informe_Conformidad;
use App\Http\Controllers\Cartas\Docentes\Planilla_pago;

use App\Http\Controllers\Cartas\Titulacion\Cac_Informe_Cumplimiento_Requisitos;
use App\Http\Controllers\Cartas\Titulacion\Designacion_Director_Trabajo_Grado;
use App\Http\Controllers\Cartas\Titulacion\Comite_Academico_Cientifico;
use App\Http\Controllers\Cartas\Titulacion\Informe_Cumplimiento_Requisitos;
use App\Http\Controllers\Cartas\Titulacion\Consejo_Directivo_Postgrado;
use App\Http\Controllers\Cartas\Titulacion\Informe_Cumplimiento_Requisitos2;
use App\Http\Controllers\Cartas\Titulacion\Cac_Informe_Cumplimiento_Requisitos2;
use App\Http\Controllers\Cartas\Titulacion\Cac_Tribunal;
use App\Http\Controllers\Cartas\Titulacion\Cd_Tribunal;
use App\Http\Controllers\Cartas\Titulacion\Pre_Defensa;
use App\Http\Controllers\Cartas\Titulacion\Informe_Acreditacion_DT;
use App\Http\Controllers\Cartas\Titulacion\Informe_Originalidad;
use App\Http\Controllers\Cartas\Titulacion\Solicitud_Homologacion;
use App\Http\Controllers\Cartas\Titulacion\Invitacion_Tribunal;;

use App\Http\Controllers\Cartas\Titulacion\Empastado;;

use App\Http\Controllers\Cartas\Titulacion\Informe_Lineas_Investigacion;

use App\Models\Contrato;

class ReporteController extends Controller
{
    protected $fpdf;

    // Docentes
    private $SC = 'Solicitud de contratacion';
    private $CTC = 'Condiciones y términos para la contratación';
    private $RP = 'Requerimiento de propuesta';
    private $PC = 'Propuesta del consultor';
    private $IT = 'Informe técnico';
    private $NA = 'Notificación de adjudicación';
    private $CI = 'Comunicación interna';
    private $IC = 'Informe de conformidad';
    private $PP = 'Planilla de pago';

    // Titulacion
    private $ICR = 10;
    private $DDTG = 11;
    private $CAC_DT = 12;
    private $CAC_ICR = 13;
    private $CDDT = 14;
    private $ITR = 15;
    private $IADT = 16;
    private $IDO = 17;
    private $SHRCDO = 18;

    // private $DDTG = 'Designación de director de trabajo de grado';
    private $CACA = 'CAC tutor';
    // private $ICR = 'Informe de cumplimiento de requisitos';
    private $CDP = 'Consejo directivo de postgrado';
    private $ICR2 = 'Informe de cumplimiento de requisitos 2';
    private $CACICR2 = 'CAC Informe de cumplimiento de requisitos 2';
    private $CACT = 'CAC tribunal';
    private $CDT = 'CD tribunal';
    private $PD = 'Predefensa';
    private $EM = 'Empastado';
    private $ILI = 'Informe de lineas de investigación';


    public function test()
    {
        $sc = new Planilla_pago();
        return $sc->planilla_pago([]);
    }

    public function pdf($id, $tipo, $idCarta)
    {
        $contrato = Contrato::find($id);
        switch ($tipo) {
            case $this->SC:
                $this->Sol_Contrataciones([$contrato, $idCarta]);
                break;
            case $this->RP:
                $this->Requerimiento_Propuesta([$contrato, $idCarta]);
                break;
            case $this->PC:
                $this->Propuesta_Consultor([$contrato, $idCarta]);
                break;
            case $this->IT:
                $this->Informe_Tecnico([$contrato, $idCarta]);
                break;
            case $this->NA:
                $this->Notificacion_Adjudicacion([$contrato, $idCarta]);
                break;
            case $this->CI:
                $this->Comunicacion_Interna([$contrato, $idCarta]);
                break;
            case $this->IC:
                $this->Informe_Conformidad([$contrato, $idCarta]);
                break;
            case $this->CTC:
                $this->Condiciones_Terminos([$contrato, $idCarta]);
                break;
            case $this->PP:
                $this->Planilla_pago([$contrato, $idCarta]);
                break;

            case $this->ICR:
                $this->Informe_Cumplimiento_Requisitos([$id, $idCarta]); //
                break;
            case $this->DDTG:
                $this->Designacion_Director_Trabajo_Grado([$id, $idCarta]); //
                break;
            case $this->CAC_DT:
                $this->Comite_Academico_Cientifico([$id, $idCarta]); //
                break;
            case $this->CAC_ICR:
                $this->Cac_Informe_Cumplimiento_Requisitos([$id, $idCarta]); //
                break;
            case $this->CDDT:
                $this->Consejo_Directivo_Postgrado([$id, $idCarta]);
                break;
            case $this->ITR:
                $this->Invitacion_Tribunal([$id, $idCarta, $tipo]);
                break;
            case $this->IADT:
                $this->Informe_Acreditacion_DT([$id, $idCarta]);
                break;
            case $this->IDO:
                $this->Informe_Originalidad([$id, $idCarta]);
                break;
            case $this->SHRCDO:
                $this->Solicitud_Homologacion([$id, $idCarta]);
                break;
            default:
                return 'No se encontro el tipo de carta';
                break;
        }
    }

    public function Condiciones_Terminos($data)
    {
        $ct = new Condiciones_Terminos();
        return $ct->Condiciones_Terminos($data);
    }

    public function Sol_Contrataciones($data)
    {
        $sc = new Sol_Contrataciones();
        return $sc->contrataciones($data);
    }

    public function Requerimiento_Propuesta($data)
    {
        $rp = new Requerimiento_Propuesta();
        return $rp->propuesta($data);
    }

    public function Propuesta_Consultor($data)
    {
        $pc = new Propuesta_Consultor();
        return $pc->propuesta($data);
    }

    public function Informe_Tecnico($data)
    {
        $it = new Informe_Tecnico();
        return $it->informe($data);
    }

    public function Notificacion_Adjudicacion($data)
    {
        $na = new Notificacion_Adjudicacion();
        return $na->informe($data);
    }

    public function Comunicacion_Interna($data)
    {
        $ci = new Comunicacion_Interna();
        return $ci->informe($data);
    }

    public function Informe_Conformidad($data)
    {
        $ic = new Informe_Conformidad();
        return $ic->informe($data);
    }

    public function Planilla_pago($data)
    {
        $pp = new Planilla_pago();
        return $pp->planilla_pago($data);
    }

    public function Informe_Cumplimiento_Requisitos($data)
    {
        $icr = new Informe_Cumplimiento_Requisitos($data);
        return $icr->informe($data);
    }

    public function Cac_Informe_Cumplimiento_Requisitos($data)
    {
        $icr = new Cac_Informe_Cumplimiento_Requisitos($data);
        return $icr->informe($data);
    }

    public function Designacion_Director_Trabajo_Grado($data)
    {
        $ddtg = new Designacion_Director_Trabajo_Grado($data);
        return $ddtg->informe($data);
    }

    public function Comite_Academico_Cientifico($data)
    {
        $cac = new Comite_Academico_Cientifico($data);
        return $cac->informe($data);
    }



    public function Consejo_Directivo_Postgrado($data)
    {
        $cdp = new Consejo_Directivo_Postgrado($data);
        return $cdp->informe($data);
    }

    public function Informe_Cumplimiento_Requisitos2($data)
    {
        $icr = new Informe_Cumplimiento_Requisitos2($data);
        return $icr->informe($data);
    }

    public function Cac_Informe_Cumplimiento_Requisitos2($data)
    {
        $icr = new Cac_Informe_Cumplimiento_Requisitos2($data);
        return $icr->informe($data);
    }

    public function Cac_Tribunal($data)
    {
        $ct = new Cac_Tribunal($data);
        return $ct->informe($data);
    }

    public function Cd_Tribunal($data)
    {
        $ct = new Cd_Tribunal($data);
        return $ct->informe($data);
    }

    public function Pre_Defensa($data)
    {
        $pd = new Pre_Defensa($data);
        return $pd->informe($data);
    }

    public function Empastado($data)
    {
        $em = new Empastado($data);
        return $em->informe($data);
    }

    public function Informe_Lineas_Investigacion($data)
    {
        $ili = new Informe_Lineas_Investigacion($data);
        return $ili->informe($data);
    }

    public function Invitacion_Tribunal($data)
    {
        $it = new Invitacion_Tribunal();
        return $it->informe($data);
    }

    public function Informe_Acreditacion_DT($data)
    {
        $iad = new Informe_Acreditacion_DT($data);
        return $iad->informe($data);
    }

    public function Informe_Originalidad($data)
    {
        $io = new Informe_Originalidad($data);
        return $io->informe($data);
    }

    public function Solicitud_Homologacion($data)
    {
        $sh = new Solicitud_Homologacion($data);
        return $sh->informe($data);
    }
}
