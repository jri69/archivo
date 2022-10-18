<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\EstudiantePrograma;
use App\Models\Pago;
use App\Models\Pago_estudiante;
use App\Models\Programa;
use App\Models\ProgramaModulo;
use App\Models\tipo_descuento;
use App\Models\Tipo_pago;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Else_;

class Pago_EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pago_estudiante.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id = Pago_estudiante::all();
        $id = $id->pluck('estudiante_id')->toArray();
        $estu = Estudiante::all();
        $pago = $estu->except($id);
        /*$pago = $pago->pluck('id')->toArray();
        $estudiante = Estudiante::whereIn('id',$pago)->get();
        //$estu = Pago_estudiante::select('estudiante_id');
        $prueba = DB::table('estudiantes')->whereIn('id',$id)->get();
        $es = Estudiante::whereIn('id',$id)->get();
        return $es;*/
        //return $pago;
        $fecha = Carbon::now();
        //$programas = Programa::all();
        $programas = DB::table('programas')->select('id', 'nombre', 'costo', 'cantidad_modulos')->where('fecha_finalizacion', '>=', $fecha)->get();
        $descuentos = tipo_descuento::all();
        //return $programas;
        return view('pago_estudiante.create', compact('descuentos', 'programas', 'pago'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'estudiante_id' => 'required',
            'programa_id' => 'required',

        ]);
        Pago_estudiante::create($request->all());
        return view('pago_estudiante.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $fecha = Carbon::now();
        $prueba = Pago_estudiante::find($id);
        //$programa = Pago_estudiante::join('programas','programas.id','=','pago_estudiante.programa_id')->select('programas.*','pago_estudiante.*')->get();
        //return $programa;
        $estudiante = Estudiante::findOrFail($id);
        //$monto = DB::table('pago')->select('monto')->where('pago_estudiante_id', '=', $id)->sum('monto');
        $monto = DB::table('pago')->join('pago_estudiante', 'pago_estudiante.id', '=', 'pago.pago_estudiante_id')->select('monto')->where('pago_estudiante.estudiante_id', '=', $id)->sum('monto');
        //return $monto;
        $pagos = Pago::join('pago_estudiante', 'pago_estudiante.id', '=', 'pago.pago_estudiante_id')->join('tipo_pagos', 'tipo_pagos.id', '=', 'pago.tipo_pago_id')->select('pago.*', 'tipo_pagos.*', 'pago.id')->where('pago_estudiante.estudiante_id', $id)->get();
        //return $pagos;
        $programa = \App\Models\EstudiantePrograma::join("estudiantes", "estudiantes.id", "=", "estudiante_programas.id_estudiante")->join("programas", "programas.id", "=", "estudiante_programas.id_programa")->join("pago_estudiante", "pago_estudiante.estudiante_id", "=", "estudiante_programas.id_estudiante")->where("estudiante_programas.id_estudiante", $estudiante->id)->select("pago_estudiante.*", "programas.*")->get();
        return $programa;
        $pro = DB::table('programas')->where('id', '=', $programa->programa_id)->get()->first();

        $descuento = Pago_estudiante::join("estudiantes", "estudiantes.id", "=", "pago_estudiante.estudiante_id")->join("tipo_descuento", "tipo_descuento.id", "=", "pago_estudiante.tipo_descuento_id")->select("tipo_descuento.*", "pago_estudiante.id as estu")->where("estudiantes.id", $estudiante->id)->get()->first();

        $pago_id = Pago_estudiante::join("estudiantes", "estudiantes.id", "=", "pago_estudiante.estudiante_id")->select("pago_estudiante.id as id")->where("estudiantes.id", $estudiante->id)->get()->first();

        $deuda = ProgramaModulo::join('programas', 'programas.id', 'programa_modulos.id_programa')->join('modulos', 'modulos.id', '=', 'programa_modulos.id_modulo')->select('modulos.fecha_final', 'modulos.costo')->where('programas.id', $programa->programa_id)->where('modulos.fecha_final', '<=', $fecha)->sum('modulos.costo');

        $modulo = ProgramaModulo::join('programas', 'programas.id', 'programa_modulos.id_programa')->join('modulos', 'modulos.id', '=', 'programa_modulos.id_modulo')->select('modulos.fecha_final', 'modulos.costo')->where('programas.id', $programa->programa_id)->get();
        //return $pago_id;
        if ($descuento == []) {

            $costo_t = $pro->costo - $programa->convalidacion;
            $cuenta =  $monto + $programa->convalidacion;
            $porcentaje = 0;
        } else {

            $porcentaje = ($pro->costo * $descuento->monto) / 100;
            $costo_t = $pro->costo - $porcentaje - $programa->convalidacion;
            $cuenta = $porcentaje + $monto + $programa->convalidacion;
        }
        return $pro;
        $saldo = $costo_t - $monto;
        $deuda = $deuda - $cuenta;
        $estado = 'SIN DEUDA';
        if ($deuda > 0) {
            $estado = 'CON DEUDA';
        };

        return view('pago.index', compact('estado', 'pro', 'programa', 'estudiante', 'descuento', 'costo_t', 'pagos', 'monto', 'saldo', 'cuenta', 'deuda', 'porcentaje', 'pago_id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $estudiante = Pago_estudiante::where('pago_estudiante.estudiante_id', '=', $id)->first();
        //return $estudiante;
        $fecha = Carbon::now();
        $programas = DB::table('programas')->select('id', 'nombre', 'costo', 'cantidad_modulos')->where('fecha_finalizacion', '>=', $fecha)->get();
        $descuentos = tipo_descuento::all();
        return view('pago_estudiante.edit', compact('estudiante', 'programas', 'descuentos'));
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
        $pago_estu = Pago_estudiante::findOrFail($id);
        $request->validate([
            'estudiante_id' => 'required',
            'programa_id' => 'required',

        ]);
        $pago_estu->estudiante_id =  $pago_estu->estudiante_id;
        $pago_estu->programa_id = $request['programa_id'];
        $pago_estu->tipo_descuento_id = $request['tipo_descuento_id'];
        $pago_estu->convalidacion = $request['convalidacion'];
        $pago_estu->save();

        return redirect()->route('pago_estudiante.index');
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
}
