<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\EstudiantePrograma;
use App\Models\Pago_estudiante;
use App\Models\Programa;
use App\Models\tipo_descuento;
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
        $estudiantes = Estudiante::all();
        $programas = Programa::all();
        $descuentos = tipo_descuento::all();
        return view('pago_estudiante.create',compact('descuentos','estudiantes','programas'));
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
        $estudiante = Estudiante::findOrFail($id);
        $programa = \App\Models\EstudiantePrograma::join("estudiantes", "estudiantes.id","=", "estudiante_programas.id_estudiante")->join("programas", "programas.id","=", "estudiante_programas.id_programa")->join("pago_estudiante", "pago_estudiante.estudiante_id","=", "estudiante_programas.id_estudiante")->select("pago_estudiante.*","estudiantes.*","programas.*", "estudiantes.nombre as nombre","programas.nombre as programa")->where("estudiantes.id",$estudiante->id)->get()->first();
        $descuento = Pago_estudiante::join("estudiantes", "estudiantes.id","=", "pago_estudiante.estudiante_id")->join("tipo_descuento", "tipo_descuento.id","=", "pago_estudiante.tipo_descuento_id")->select("tipo_descuento.*", "pago_estudiante.id as estu")->where("estudiantes.id",$estudiante->id)->get()->first();
        //return $descuento;
        $costo_t = $programa->costo - $descuento->monto - $programa->convalidacion;
        //return $costo_t;
        return view('pago.index',compact('programa','estudiante', 'descuento', 'costo_t'));
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
