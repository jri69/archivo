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
use App\Http\Controllers\Cartas\Docentes\Contrato_Administrativo;
use App\Http\Controllers\Cartas\Docentes\Informe_Conformidad;
use App\Http\Controllers\Cartas\Docentes\Informe_Legal;
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
use App\Http\Controllers\Cartas\Titulacion\Invitacion_Tribunal;
use App\Http\Controllers\Cartas\Titulacion\Elaboracion_Borrador_Tesis;
use App\Http\Controllers\Cartas\Titulacion\Empastado;
use App\Http\Controllers\Cartas\Titulacion\Solicitud_Fecha_Defensa;
use App\Http\Controllers\Cartas\Titulacion\Invitacion_Tribunal_Borrador;
use App\Http\Controllers\Cartas\Titulacion\Programacion_Fecha_Defensa;
use App\Http\Controllers\Cartas\Titulacion\Conformidad_De_Trabajo;
use App\Http\Controllers\Cartas\Titulacion\Informe_Lineas_Investigacion;
use App\Http\Controllers\Cartas\Titulacion\Solicitud_De_Pago;

use App\Models\Contrato;

class ReporteController extends Controller
{
    protected $fpdf;

    // Docentes
    private $SC = 'Solicitud de contratacion';
    private $CTC = 'Condiciones y términos para la contratación';
    private $RP = 'Requerimiento de propuesta';
    private $PC = 'Propuesta del consultor';
    private $IL = 'Informe legal';
    private $IT = 'Informe técnico';
    private $NA = 'Notificación de adjudicación';
    private $CA = 'Contrato administrativo';
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
    private $EBT = 19;
    private $ICR2 = 20;
    private $CAC_ICR2 = 21;
    private $CAC_TRB = 22;
    private $CD_TB = 23;
    private $IO = 24;
    private $SH = 25;
    private $ITB = 26;
    private $PD = 27;
    private $EP = 28;
    private $LI = 29;
    private $SFD = 30;
    private $PFD = 31;
    private $CDT = 32;
    private $SDP = 33;

    public function pdf($id, $tipo, $idCarta)
    {
        $contrato = Contrato::find($id);
        switch ($tipo) {
                // Contrato Docente
            case $this->SC:
                $this->Sol_Contrataciones([$contrato, $idCarta]);
                break;
            case $this->RP:
                $this->Requerimiento_Propuesta([$contrato, $idCarta]);
                break;
            case $this->PC:
                $this->Propuesta_Consultor([$contrato, $idCarta]);
                break;
            case $this->IL:
                $this->Informe_Legal([$contrato, $idCarta]);
                break;
            case $this->IT:
                $this->Informe_Tecnico([$contrato, $idCarta]);
                break;
            case $this->NA:
                $this->Notificacion_Adjudicacion([$contrato, $idCarta]);
                break;
            case $this->CA:
                $this->Contrato_Administrativo([$contrato, $idCarta]);
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
                // Titulacion
            case $this->ICR:
                $this->Informe_Cumplimiento_Requisitos([$id, $idCarta]);
                break;
            case $this->DDTG:
                $this->Designacion_Director_Trabajo_Grado([$id, $idCarta]);
                break;
            case $this->CAC_DT:
                $this->Comite_Academico_Cientifico([$id, $idCarta]);
                break;
            case $this->CAC_ICR:
                $this->Cac_Informe_Cumplimiento_Requisitos([$id, $idCarta]);
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
            case $this->EBT:
                $this->Elaboracion_Borrador_Tesis([$id, $idCarta]);
                break;
            case $this->ICR2:
                $this->Informe_Cumplimiento_Requisitos2([$id, $idCarta]);
                break;
            case $this->CAC_ICR2:
                $this->Cac_Informe_Cumplimiento_Requisitos2([$id, $idCarta]);
                break;
            case $this->CAC_TRB:
                $this->Cac_Tribunal([$id, $idCarta]);
                break;
            case $this->CD_TB:
                $this->Cd_Tribunal([$id, $idCarta]);
                break;
            case $this->IO:
                $this->Informe_Originalidad([$id, $idCarta]);
                break;
            case $this->SH:
                $this->Solicitud_Homologacion([$id, $idCarta]);
                break;
            case $this->ITB:
                $this->Invitacion_Tribunal_Borrador([$id, $idCarta, $tipo]);
                break;
            case $this->PD:
                $this->Pre_Defensa([$id, $idCarta]);
                break;
            case $this->EP:
                $this->Empastado([$id, $idCarta]);
                break;
            case $this->LI:
                $this->Informe_Lineas_Investigacion([$id, $idCarta]);
                break;
            case $this->SFD:
                $this->Solicitud_Fecha_Defensa([$id, $idCarta]);
                break;
            case $this->PFD:
                $this->Programacion_Fecha_Defensa([$id, $idCarta]);
                break;
            case $this->CDT:
                $this->Conformidad_De_Trabajo([$id, $idCarta]);
                break;
            case $this->SDP:
                $this->Solicitud_De_Pago([$id, $idCarta]);
                break;
            default:
                return  redirect()->route('error');
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

    public function Informe_Legal($data)
    {
        $il = new Informe_Legal();
        return $il->informe($data);
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

    public function Contrato_Administrativo($data)
    {
        $ca = new Contrato_Administrativo();
        return $ca->informe($data);
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

    public function Elaboracion_Borrador_Tesis($data)
    {
        $ebt = new Elaboracion_Borrador_Tesis($data);
        return $ebt->informe($data);
    }

    public function Solicitud_Fecha_Defensa($data)
    {
        $sfd = new Solicitud_Fecha_Defensa($data);
        return $sfd->informe($data);
    }

    public function Invitacion_Tribunal_Borrador($data)
    {
        $iad = new Invitacion_Tribunal_Borrador($data);
        return $iad->informe($data);
    }

    public function Programacion_Fecha_Defensa($data)
    {
        $pfd = new Programacion_Fecha_Defensa($data);
        return $pfd->informe($data);
    }

    public function Conformidad_De_Trabajo($data)
    {
        $itd = new Conformidad_De_Trabajo($data);
        return $itd->informe($data);
    }

    public function Solicitud_De_Pago($data)
    {
        $iad = new Solicitud_De_Pago($data);
        return $iad->informe($data);
    }
}
