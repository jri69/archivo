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
        // $this->Comunicacion_Interna([]);
        $this->Informe_Conformidad([]);
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
}
