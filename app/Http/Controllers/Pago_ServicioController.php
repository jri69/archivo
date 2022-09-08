<?php

namespace App\Http\Controllers;

use App\Models\Pago_Servicio;
use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Pago_ServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagos = Pago_Servicio::all();
        //return $pagos;
        return view('pago_servicio.index',compact('pagos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $servicios = Servicio::all();
        return view('pago_servicio.create',compact('servicios'));
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
            'servicio_id'=>'required',
            'monto'=>'required',
            'fecha'=>'required',
            'comprobante'=>'required'
        ]);

        if($request->hasFile('comprobante')){
            $file = $request->file('comprobante')->store('public/servicios');
            $archivo = Storage::url($file);
        }

        Pago_Servicio::create([
            'servicio_id'=> $request['servicio_id'],
            'monto'=>$request['monto'],
            'fecha'=>$request['fecha'],
            'comprobante'=>$archivo
        ]);
        return redirect()->route('pago_servicio.index');

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
    public function edit(Pago_Servicio $pago)
    {
        //return $pago;
        $servicios = Servicio::all();
        return view('pago_servicio.edit',compact('pago','servicios'));
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
            'servicio_id'=>'required',
            'monto'=>'required',
            'fecha'=>'required',
            'comprobante'=>'required'
        ]);
        $servicio = Pago_Servicio::findOrFail($id);
        $servicio->update($request->all());
        return redirect()->route('pago_servicio.index');
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
