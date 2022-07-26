<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Cargo;
use App\Models\User;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuario = Usuario::all();
        return view('usuario.index',compact('usuario'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $areas = Area::all();
        $cargos = Cargo::all();
        return view('usuario.create',compact('areas','cargos'));
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
            'nombre' =>'required',
            'apellido'=>'required',
            'area_id'=>'required',
            'cargo_id'=>'required',
            'ci'=>'required'
        ]);

        $usuario = Usuario::create([
            'nombre'=> $request['nombre'],
            'apellido'=> $request['apellido'],
            'area_id'=> $request['area_id'],
            'cargo_id'=> $request['cargo_id'],
            'ci'=> $request['ci']
            ]);

        User::create([
            'name'=>$request['apellido'],
            'email'=>$request['email'],
            'password'=>Hash::make($request['password'])
        ]);

        return redirect()->route('usuario.index',$usuario);
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
    public function edit(Usuario $usuario)
    {
        
        return view('usuario.edit',compact('usuario'));
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
