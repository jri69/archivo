<?php

namespace App\Http\Controllers\Reportes;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Reportes\Condiciones_Terminos;
use App\Http\Controllers\Reportes\Sol_Contrataciones;
use App\Http\Controllers\Reportes\Requerimiento_Propuesta;
use App\Http\Controllers\Reportes\Propuesta_Consultor;
use App\Http\Controllers\Reportes\Informe_Tecnico;
use App\Http\Controllers\Reportes\Notificacion_Adjudicacion;
use App\Http\Controllers\Reportes\Comunicacion_Interna;

class ReporteController extends Controller
{
    protected $fpdf;

    public function pdf()
    {
        // $this->Condiciones_Terminos([]);
        // $this->Sol_Contrataciones([]);
        // $this->Requerimiento_Propuesta([]);
        // $this->Propuesta_Consultor([]);
        // $this->Informe_Tecnico([]);
        // $this->Notificacion_Adjudicacion([]);
        $this->Comunicacion_Interna([]);
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
}
