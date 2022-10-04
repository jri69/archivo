<?php

namespace App\Http\Controllers;

use App\Models\SubPartida;
use App\Models\Third_Partida;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ThirdPartidaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Third_Partida::orderBy('id','asc')->paginate('10');
        return view('t_partida.index',compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$partidas = DB::table('sub_partidas')->select('id','nombre')->orderBy('id','asc')->get();
        //return $partidas; 
        return View('t_partida.create');
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
    public function edit(Third_Partida $partida)
    {
        $items = SubPartida::all();
        return view('t_partida.edit',compact('partida','items'));
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
            'second_partida_id'=>'required',
            'codigo'=>'required',
            'nombre' => 'required'
        ]);
        $datos = Third_Partida::find($id);
        $datos->update($request->all());
        return redirect()->route('t_partida.index');
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
