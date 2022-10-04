<?php

namespace App\Http\Controllers;

use App\Models\Quarter_Partida;
use App\Models\Third_Partida;
use Illuminate\Http\Request;

class QuarterPartidaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Quarter_Partida::orderBy('id','asc')->paginate('10');
        return view('c_partida.index',compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $partidas = Third_Partida::all();
        return view('c_partida.create',compact('partidas'));
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
    public function edit(Quarter_Partida $partida)
    {
        $items = Third_Partida::all();
        return view('c_partida.edit',compact('partidas','items'));
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
            'third_partida_id'=>'required',
            'codigo'=>'required',
            'nombre' => 'required'
        ]);
        $datos = Quarter_Partida::find($id);
        $datos->update($request->all());
        return redirect()->route('c_partida.index');
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
