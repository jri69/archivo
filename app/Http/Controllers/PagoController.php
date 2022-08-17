<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\Pago;
use App\Models\Tipo_pago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Estudiante $estudiante)
    {
        
        $estudiante = Estudiante::findOrFail($estudiante);
        //return $estudiante;
        return view('pago.index',compact('estudiante'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        
        $pagos = Tipo_pago::all();
        return view('pago.create',compact('pagos','id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        //return $id;
        $request->validate([            
            'monto'=>'required',
            'fecha'=>'required',
            'comprobante'=>'required',
            'compro_file'=>'required',
            'tipo_pago_id'=>'required',            
        ]);

        if($request->hasFile('compro_file')){
            $file = $request->file('compro_file')->store('public/comprobantes');
            $archivo = Storage::url($file);
        }

        Pago::create([
            'pago_estudiante_id'=>$id,
            'monto'=> $request->monto,
            'fecha'=>$request->fecha,
            'comprobante'=>$request->comprobante,
            'compro_file'=>$archivo,
            'tipo_pago_id'=>$request->tipo_pago_id,
            'observaciones'=>$request->observaciones
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
    public function edit($id)
    {
        //
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
