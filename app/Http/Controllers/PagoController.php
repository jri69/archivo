<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\Modulo;
use App\Models\Pago;
use App\Models\Pago_estudiante;
use App\Models\ProgramaModulo;
use App\Models\Tipo_pago;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Support\Facades\DB;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $fpdf;

    public function index(Estudiante $estudiante)
    {

        $estudiante = Estudiante::findOrFail($estudiante);
        return view('pago.index', compact('estudiante'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {

        $pagos = Tipo_pago::all();
        return view('pago.create', compact('pagos', 'id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $request->validate([
            'monto' => 'required',
            'fecha' => 'required',
            'comprobante' => 'required',
            'compro_file' => 'required',
            'tipo_pago_id' => 'required',
        ]);

        if ($request->hasFile('compro_file')) {
            $file = $request->file('compro_file')->store('public/comprobantes');
            $archivo = Storage::url($file);
        }

        Pago::create([
            'pago_estudiante_id' => $id,
            'monto' => $request->monto,
            'fecha' => $request->fecha,
            'comprobante' => $request->comprobante,
            'compro_file' => $archivo,
            'tipo_pago_id' => $request->tipo_pago_id,
            'observaciones' => $request->observaciones
        ]);

        return redirect()->route('pago_estudiante.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pago $pago)
    {
        $pagos = Tipo_pago::all();
        return view('pago.edit', compact('pago', 'pagos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'monto' => 'required',
            'fecha' => 'required',
            'comprobante' => 'required',
            'compro_file' => 'required',
            'tipo_pago_id' => 'required',
        ]);
        if ($request->hasFile('compro_file')) {
            $file = $request->file('compro_file')->store('public/comprobantes');
            $archivo = Storage::url($file);
        }
        $pago = Pago::findOrFail($id);
        $pago->pago_estudiante_id = $pago->pago_estudiante_id;
        $pago->monto = $request['monto'];
        $pago->fecha = $request['fecha'];
        $pago->comprobante = $request['comprobante'];
        $pago->tipo_pago_id = $request['tipo_pago_id'];
        $pago->compro_file = $archivo;
        $pago->observaciones = $request['observaciones'];

        $pago->save();
        $id = Pago_estudiante::findOrFail($id);
        return redirect()->route('pago_estudiante.show', $id->estudiante_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function pdf($id)
    {
        $fecha = Carbon::now();
        $estudiante = Estudiante::findOrFail($id);
        //$monto = DB::table('pago')->select('monto')->where('pago_estudiante_id', '=', $id)->sum('monto');
        $monto = DB::table('pago')->join('pago_estudiante', 'pago_estudiante.id', '=', 'pago.pago_estudiante_id')->select('monto')->where('pago_estudiante.estudiante_id', '=', $id)->sum('monto');
        //return $monto;
        $pagos = Pago::join('pago_estudiante', 'pago_estudiante.id', '=', 'pago.pago_estudiante_id')->join('tipo_pagos', 'tipo_pagos.id', '=', 'pago.tipo_pago_id')->select('pago.*', 'tipo_pagos.*', 'pago.id')->where('pago_estudiante.estudiante_id', $id)->get();
        //return $pagos;
        $programa = \App\Models\EstudiantePrograma::join("estudiantes", "estudiantes.id", "=", "estudiante_programas.id_estudiante")->join("programas", "programas.id", "=", "estudiante_programas.id_programa")->join("pago_estudiante", "pago_estudiante.estudiante_id", "=", "estudiante_programas.id_estudiante")->where("estudiantes.id", $estudiante->id)->select("pago_estudiante.*", "programas.*")->get()->first();

        $descuento = Pago_estudiante::join("estudiantes", "estudiantes.id", "=", "pago_estudiante.estudiante_id")->join("tipo_descuento", "tipo_descuento.id", "=", "pago_estudiante.tipo_descuento_id")->select("tipo_descuento.*", "pago_estudiante.id as estu")->where("estudiantes.id", $estudiante->id)->get()->first();

        $pago_id = Pago_estudiante::join("estudiantes", "estudiantes.id", "=", "pago_estudiante.estudiante_id")->select("pago_estudiante.id as id")->where("estudiantes.id", $estudiante->id)->get()->first();

        /*         $deuda = ProgramaModulo::join('programas', 'programas.id', 'programa_modulos.id_programa')->join('modulos', 'modulos.id', '=', 'programa_modulos.id_modulo')->select('modulos.fecha_final', 'modulos.costo')->where('programas.id', $programa->id)->where('modulos.fecha_final', '<=', $fecha)->sum('modulos.costo');

        $modulo = ProgramaModulo::join('programas', 'programas.id', 'programa_modulos.id_programa')->join('modulos', 'modulos.id', '=', 'programa_modulos.id_modulo')->select('modulos.fecha_final', 'modulos.costo')->where('programas.id', $programa->id)->get(); */

        $deuda = Modulo::where('programa_id', $programa->programa_id)->where('fecha_final', '<=', $fecha)->sum('costo');
        $modulo = Modulo::where('programa_id', $programa->programa_id)->get();

        //return $pago_id;
        if ($descuento == []) {

            $costo_t = $programa->costo - $programa->convalidacion;
            $cuenta =  $monto + $programa->convalidacion;
            $porcentaje = 0;
        } else {

            $porcentaje = ($programa->costo * $descuento->monto) / 100;
            $costo_t = $programa->costo - $porcentaje - $programa->convalidacion;
            $cuenta = $porcentaje + $monto + $programa->convalidacion;
        }

        $saldo = $costo_t - $monto;
        $deuda = $deuda - $cuenta;
        $estado = 'SIN DEUDA';
        if ($deuda > 0) {
            $estado = 'CON DEUDA';
        };


        $fpdf = new Fpdf('P', 'mm', 'letter');
        $fpdf->AddPage();
        $fpdf->SetFont('Arial', 'B', 10);
        $fpdf->Image(public_path() . '/material/img/logo2.jpg', 10, 10, 45, 0);
        //$this->Image('/public/material/img/logo.jpg', 0, 0, 0, 0, 'jpg');
        $fpdf->Cell(188, 6, 'UNIVERSIDAD AUTONOMA GABRIEL RENE MORENO', 0, 1, 'C');
        $fpdf->Cell(188, 6, 'FACULTAD DE CIENCIAS EXACTA Y TEGNOLOGIA', 0, 1, 'C');
        $fpdf->Cell(188, 6, 'ESCUELA DE INGENIERIA', 0, 1, 'C');
        $fpdf->Ln();
        //cuerpo del reporte
        $fpdf->SetFont('Arial', 'B', 10);
        $fpdf->Cell(188, 10, 'REPORTE DE PAGOS POR MAESTRANTE', 1, 1, 'C');
        $fpdf->SetFont('Arial', '', 10);
        $fpdf->Cell(80, 6, 'NOMBRE DEL MAESTRANTE:', 1, 0);
        $fpdf->Cell(108, 6, utf8_decode($estudiante->nombre), 1, 1);
        $fpdf->Cell(80, 6, 'ESTADO:', 1, 0);
        $fpdf->Cell(108, 6, $estado, 1, 1);
        $fpdf->SetFont('Arial', 'B', 10);
        $fpdf->Cell(188, 10, 'DATOS DEL PROGRAMA', 0, 1, 'C');
        $fpdf->SetFont('Arial', '', 10);
        $fpdf->Cell(80, 6, 'NOMBRE DEL PROGRAMA:', 1, 0);
        $fpdf->MultiCell(108, 6, utf8_decode($programa->nombre), 1, 1);
        $fpdf->Cell(80, 6, 'VERSION:', 1, 0);
        $fpdf->Cell(108, 6, $programa->version, 1, 1);
        $fpdf->Cell(80, 6, 'EDICION:', 1, 0);
        $fpdf->Cell(108, 6, $programa->edicion, 1, 1);
        $fpdf->Cell(80, 6, 'FECHA DE INICIO:', 1, 0);
        $fpdf->Cell(108, 6, \Carbon\Carbon::parse($programa->fecha_inicio)->format('d-m-Y'), 1, 1);
        $fpdf->Cell(80, 6, 'FECHA DE FINALIZACION:', 1, 0);
        $fpdf->Cell(108, 6, \Carbon\Carbon::parse($programa->fecha_finalizacion)->format('d-m-Y'), 1, 1);
        $fpdf->Cell(80, 6, 'CANTIDAD DE MODULO:', 1, 0);
        $fpdf->Cell(108, 6, $programa->cantidad_modulos, 1, 1);
        $fpdf->Cell(80, 6, 'COSTO TOTAL DEL PROGRAMA:', 1, 0);
        $fpdf->Cell(108, 6, $programa->costo, 1, 1);
        $fpdf->Cell(80, 6, 'CONVALIDACION:', 1, 0);
        $fpdf->Cell(108, 6, $programa->convalidacion, 1, 1);
        $fpdf->Cell(80, 6, 'DESCUENTO:', 1, 0);
        $fpdf->Cell(108, 6, $porcentaje, 1, 1);
        $fpdf->Cell(80, 6, 'COSTO TOTAL DEL PROGRAMA:', 1, 0);
        $fpdf->Cell(108, 6, $costo_t, 1, 1);
        $fpdf->SetFont('Arial', 'B', 10);
        //DATOS ECONOMICOS
        $fpdf->Cell(188, 10, 'DATOS ECONOMICOS', 0, 1, 'C');
        $fpdf->SetFont('Arial', '', 8);
        $fpdf->Cell(37, 6, 'MONTO PAGADO', 1, 0);
        $fpdf->Cell(55, 6, 'MONTO ADEUDADO HASTA LA FECHA', 1, 0);
        $fpdf->Cell(50, 6, 'MONTO PAGADO HASTA LA FECHA', 1, 0);
        $fpdf->Cell(46, 6, 'SALDO TOTAL DEL PROGRAMA', 1, 1);
        $fpdf->Cell(37, 6, $monto, 1, 0);
        $fpdf->Cell(55, 6, $deuda, 1, 0);
        $fpdf->Cell(50, 6, $cuenta, 1, 0);
        $fpdf->Cell(46, 6, $saldo, 1, 1);
        //DETALLES DE LOS PAGOS
        $fpdf->SetFont('Arial', 'B', 10);
        $fpdf->Cell(188, 10, 'DETALLES DE LOS PAGOS', 0, 1, 'C');
        $fpdf->SetFont('Arial', '', 8);
        $i = 1;
        $fpdf->Cell(10, 6, 'Nro.', 1, 0);
        $fpdf->Cell(44, 6, 'METODO DE PAGO.', 1, 0);
        $fpdf->Cell(44, 6, 'COMPROBANTE.', 1, 0);
        $fpdf->Cell(45, 6, 'FECHA DE PAGO.', 1, 0);
        $fpdf->Cell(45, 6, 'MONTO PAGADO.', 1, 1);

        //rellenado de los pagos
        $pagado = 0;
        $i = 1;
        foreach ($pagos as $pago) {

            $fpdf->Cell(10, 6, $i, 1, 0);
            $fpdf->Cell(44, 6, utf8_decode($pago->nombre), 1, 0);
            $fpdf->Cell(44, 6, $pago->comprobante, 1, 0);
            $fpdf->Cell(45, 6, \Carbon\Carbon::parse($pago->fecha)->format('d-m-Y'), 1, 0);
            $fpdf->Cell(45, 6, $pago->monto, 1, 1);
            $pagado = $pagado + $pago->monto;
            $i = $i + 1;
        }
        $fpdf->Cell(98, 6, '', 0, 0);
        $fpdf->Cell(45, 6, 'TOTAL PAGADO.', 1, 0);
        $fpdf->Cell(45, 6, $pagado, 1, 1);
        $fpdf->Output("I", "Reporte de Pagos.pdf");
    }
}