<?php

namespace App\Http\Controllers\Reportes;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Reportes\Condiciones_Terminos;
use App\Http\Controllers\Reportes\Sol_Contrataciones;
use App\Http\Controllers\Reportes\Requerimiento_Propuesta;
use App\Http\Controllers\Reportes\Propuesta_Consultor;
use App\Http\Controllers\Reportes\Informe_Tecnico;
use App\Http\Controllers\Reportes\Notificicacion_Adjudicacion;

class ReporteController extends Controller
{
    protected $fpdf;
    public $ct;
    public $sc;
    public $rp;
    public $pc;
    public $it;
    public $nc;

    public function __construct()
    {
        $this->ct = new Condiciones_Terminos();
        $this->sc = new Sol_Contrataciones();
        $this->rp = new Requerimiento_Propuesta();
        $this->pc = new Propuesta_Consultor();
        $this->it = new Informe_Tecnico();
        $this->nc = new Notificicacion_Adjudicacion();
    }

    public function pdf()
    {
        return $this->nc->informe();
    }
}
