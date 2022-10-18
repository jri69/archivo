<?php

namespace App\Http\Controllers;

use App\Models\Fifth_Partida;
use App\Models\Partida;
use App\Models\Quarter_Partida;
use App\Models\SubPartida;
use App\Models\Third_Partida;
use Illuminate\Http\Request;

class DetalleFacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        return view('detalle_factura.index', compact('id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $primero = Partida::all();
        $segundo = SubPartida::all();
        $tercero = Third_Partida::all();
        $cuarto = Quarter_Partida::all();
        $quinto = Fifth_Partida::all();
        return view('detalle_factura.create', compact('id', 'primero', 'segundo', 'tercero', 'cuarto', 'quinto'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        return view('detalle_factura.edit');
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
