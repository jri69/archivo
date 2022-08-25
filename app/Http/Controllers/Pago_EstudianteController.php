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
        $fecha = Carbon::now();
        $programas = DB::table('programas')->select('id','nombre','costo', 'cantidad_modulos')->where('fecha_finalizacion','>=',$fecha)->get();
        $descuentos = tipo_descuento::all();
        return view('pago_estudiante.create',compact('descuentos','programas','pago'));
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
            'estudiante_id'=>'required',
            'programa_id'=> 'required',
            'cant_modulos'=>'required',
        ]);
        $pago_estudiante = Pago_estudiante::create($request->all());
        return redirect()->route('pago_estudiante.index',$pago_estudiante);
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
        $estudiante = Estudiante::findOrFail($id);        
        $monto = DB::table('pago')->select('monto')->where('pago_estudiante_id','=',$id)->sum('monto');
        $pagos = Pago::join('pago_estudiante', 'pago_estudiante.id','=', 'pago.pago_estudiante_id')->join('tipo_pagos', 'tipo_pagos.id','=', 'pago.tipo_pago_id')->select('pago.*', 'tipo_pagos.*','pago.id')->where('pago_estudiante.id',$id)->get();
        
        $programa = \App\Models\EstudiantePrograma::join("estudiantes", "estudiantes.id","=", "estudiante_programas.id_estudiante")->join("programas", "programas.id","=", "estudiante_programas.id_programa")->join("pago_estudiante", "pago_estudiante.estudiante_id","=", "estudiante_programas.id_estudiante")->where("estudiantes.id",$estudiante->id)->select("pago_estudiante.*","programas.*")->get()->first();
        $pro = DB::table('programas')->where('id','=',$programa->programa_id)->get()->first();
        $descuento = Pago_estudiante::join("estudiantes", "estudiantes.id","=", "pago_estudiante.estudiante_id")->join("tipo_descuento", "tipo_descuento.id","=", "pago_estudiante.tipo_descuento_id")->select("tipo_descuento.*", "pago_estudiante.id as estu")->where("estudiantes.id",$estudiante->id)->get()->first();
        $deuda = ProgramaModulo::join('programas', 'programas.id','programa_modulos.id_programa')->join('modulos', 'modulos.id','=','programa_modulos.id_modulo')->select('modulos.fecha_final','modulos.costo')->where('programas.id',$programa->programa_id)->where('modulos.fecha_final','<=',$fecha)->sum('modulos.costo');
        
        $modulo = ProgramaModulo::join('programas', 'programas.id', 'programa_modulos.id_programa')->join('modulos', 'modulos.id', '=', 'programa_modulos.id_modulo')->select('modulos.fecha_final', 'modulos.costo')->where('programas.id', $programa->programa_id)->get();
        
        $costo_t = $pro->costo - $descuento->monto - $programa->convalidacion;
        $saldo = $costo_t - $monto;
        $cuenta = $descuento->monto + $monto + $programa->convalidacion;
        $deuda = $deuda - $cuenta;
        
        $estado = 'SIN DEUDA';
        if($deuda > 0){
            $estado = 'CON DEUDA';
        };
        
        return view('pago.index',compact('estado','pro','programa','estudiante', 'descuento', 'costo_t','pagos','monto','saldo','cuenta','deuda'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pago_estudiante $estudiante)
    {
        $fecha = Carbon::now();
        $programas = DB::table('programas')->select('id','nombre','costo', 'cantidad_modulos')->where('fecha_finalizacion','>=',$fecha)->get();
        $descuentos = tipo_descuento::all();
        return view('pago_estudiante.edit',compact('estudiante','programas','descuentos'));
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
            'programa_id'=> 'required',
            'cant_modulos'=>'required',
           
        ]);        
        $pago_estu->estudiante_id =  $pago_estu->estudiante_id;
        $pago_estu->programa_id = $request['programa_id'];
        $pago_estu->cant_modulos = $request['cant_modulos'];
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
