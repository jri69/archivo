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
class Pago_EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$id = DB::table('estudiantes')->select('id')->get()->first();
        //return $id;
        /*$estudiantes = Pago_estudiante::join("estudiantes", "estudiantes.id","=", "pago_estudiante.estudiante_id")->select("estudiantes.*")->where($id->id,"<>", "pago_estudiante.estudiante_id")->get();*/
        $estudiantes = Pago_estudiante::all();
        /*$per = DB::table('estudiantes')->select("nombre","correo","cedula","telefono")->where("id","=",$estudiantes)->get()->first();*/
        return view('pago_estudiante.index',compact('estudiantes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$id = Pago_estudiante::where('estudiante_id')->get();
        /*$estudiante = DB::table('estudiantes')->select('id')->get();
        $pago = DB::table('estudiantes')->select('id','nombre')->where('id','<>', $id)->get();*/
        
                       
        /*$pago = Estudiante::join('pago_estudiante','pago_estudiante.estudiante_id','!=', 'estudiantes.id')->select('estudiantes.id')->get();*/
        //$pago = Estudiante::where('id','<>','1')->select('id')->get();
        //$estudiantes = Estudiante::all();
        
        //cuando la cantidad de estudiantes es igual a 1
        $id = Pago_estudiante::all();
        $id = $id->pluck('estudiante_id')->toArray();
        $estu = Estudiante::all();
        $pago = $estu->except($id);
        //$pago = DB::table('estudiantes')->select('id','nombre')->where('id','=',$result)->get();
        //return $pago;
        $fecha = Carbon::now();
        //return \Carbon\Carbon::parse($fecha)->format('d-m-Y');  
        $programas = DB::table('programas')->select('id','nombre','costo', 'cantidad_modulos')->where('fecha_finalizacion','>=',$fecha)->get();   
        //return $programas; 
        //
        //$programas = Programa::all();
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
        //return $request->all();
        $request->validate([
            'estudiante_id'=>'required',
            'programa_id'=> 'required',
            'cant_modulos'=>'required',
            'tipo_descuento_id'=>'required',
            'convalidacion'=>'required'
        ]);

        //return $request->all();
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
        /*$pago = Pago_estudiante::join('pago', 'pago.pago_estudiante_id', "=", 'pago_estudiante.id')->join('estudiantes', 'estudiantes.id','=', 'pago_estudiante.estudiante_id')->join('pago', 'pago.tipo_pago_id','=',$tipo)->select('pago.*','tipo_pagos.*')->where('pago_estudiante.id',$estudiante->id)->get();*/
        //$monto = Pago::where('pago_estudiante_id','=',$id)->get();
        $monto = DB::table('pago')->select('monto')->where('pago_estudiante_id','=',$id)->sum('monto');
        //$categorias = Categoria::sum('cantidad')->groupBy('categoria')->get();
        
        $pagos = Pago::join('pago_estudiante', 'pago_estudiante.id','=', 'pago.pago_estudiante_id')->join('tipo_pagos', 'tipo_pagos.id','=', 'pago.tipo_pago_id')->select('pago.*', 'tipo_pagos.*')->where('pago_estudiante.id',$id)->get();
        //return $monto;
        $programa = \App\Models\EstudiantePrograma::join("estudiantes", "estudiantes.id","=", "estudiante_programas.id_estudiante")->join("programas", "programas.id","=", "estudiante_programas.id_programa")->join("pago_estudiante", "pago_estudiante.estudiante_id","=", "estudiante_programas.id_estudiante")->select("pago_estudiante.*","estudiantes.*","programas.*", "estudiantes.nombre as nombre","programas.nombre as programa")->where("estudiantes.id",$estudiante->id)->get()->first();
        $descuento = Pago_estudiante::join("estudiantes", "estudiantes.id","=", "pago_estudiante.estudiante_id")->join("tipo_descuento", "tipo_descuento.id","=", "pago_estudiante.tipo_descuento_id")->select("tipo_descuento.*", "pago_estudiante.id as estu")->where("estudiantes.id",$estudiante->id)->get()->first();
        $deuda = ProgramaModulo::join('programas', 'programas.id','programa_modulos.id_programa')->join('modulos', 'modulos.id','=','programa_modulos.id_modulo')->select('modulos.fecha_final','modulos.costo')->where('programas.id',$programa->programa_id)->where('modulos.fecha_final','<=',$fecha)->sum('modulos.costo');
        //return $deuda;
        $modulo = ProgramaModulo::join('programas', 'programas.id', 'programa_modulos.id_programa')->join('modulos', 'modulos.id', '=', 'programa_modulos.id_modulo')->select('modulos.fecha_final', 'modulos.costo')->where('programas.id', $programa->programa_id)->get();
        //return $saldo;
        $costo_t = $programa->costo - $descuento->monto - $programa->convalidacion;
        $saldo = $costo_t - $monto;
        $cuenta = $descuento->monto + $monto;
        //return $programa;
        //return $costo_t;
        return view('pago.index',compact('programa','estudiante', 'descuento', 'costo_t','pagos','monto','saldo','cuenta','deuda'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('pago_estudiante.edit');
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
        //
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
