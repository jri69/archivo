<?php

namespace App\Http\Controllers\Cartas;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Cartas\Condiciones_Terminos;
use App\Http\Controllers\Cartas\Sol_Contrataciones;
use App\Http\Controllers\Cartas\Requerimiento_Propuesta;
use App\Http\Controllers\Cartas\Propuesta_Consultor;
use App\Http\Controllers\Cartas\Informe_Tecnico;
use App\Http\Controllers\Cartas\Notificacion_Adjudicacion;
use App\Http\Controllers\Cartas\Comunicacion_Interna;
use App\Http\Controllers\Cartas\Informe_Conformidad;
use App\Http\Controllers\Cartas\Planilla_pago;
use App\Models\Contrato;

class ReporteController extends Controller
{
    protected $fpdf;

    public function test()
    {
        $sc = new Planilla_pago();
        return $sc->planilla_pago([]);
    }

    public function pdf($id, $tipo, $idCarta)
    {
        $contrato = Contrato::find($id);
        switch ($tipo) {
            case 'Solicitud de contratacion':
                $this->Sol_Contrataciones([$contrato, $idCarta]);
                break;
            case 'Requerimiento de propuesta':
                $this->Requerimiento_Propuesta([$contrato, $idCarta]);
                break;
            case 'Propuesta del consultor':
                $this->Propuesta_Consultor([$contrato, $idCarta]);
                break;
            case 'Informe técnico':
                $this->Informe_Tecnico([$contrato, $idCarta]);
                break;
            case 'Notificación de adjudicación':
                $this->Notificacion_Adjudicacion([$contrato, $idCarta]);
                break;
            case 'Comunicación interna':
                $this->Comunicacion_Interna([$contrato, $idCarta]);
                break;
            case 'Informe de conformidad':
                $this->Informe_Conformidad([$contrato, $idCarta]);
                break;
            case 'Condiciones y términos para la contratación':
                $this->Condiciones_Terminos([$contrato, $idCarta]);
                break;
            case 'Planilla de pago':
                $this->Planilla_pago([$contrato, $idCarta]);
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
}
