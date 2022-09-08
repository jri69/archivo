<?php

namespace App\Http\Controllers\Reportes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf;
use App\Http\Controllers\Reportes\Condiciones_Terminos;

class ReporteController extends Controller
{
    protected $fpdf;
    public $ct;

    public function __construct()
    {
        $this->ct = new Condiciones_Terminos();
    }

    public function pdf()
    {

        return $this->ct->Condiciones_Terminos();
    }
}
