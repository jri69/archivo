<?php

namespace App\Http\Controllers;

use App\Models\Estudio_modulo;
use App\Models\Modulo;
use App\Models\Tipo_estudio;
use Illuminate\Http\Request;

class TiposEstudiosController extends Controller
{
    public function index()
    {
        $estudios = Tipo_estudio::all();
        return view('tipo_estudio.index', compact('estudios'));
    }

    public function create()
    {
        $modulos = Modulo::all();
        return view('tipo_estudio.create', compact('modulos'));
    }


    public function edit($tipos_estudios)
    {
        return view('tipo_estudio.edit', compact('tipos_estudios'));
    }

    public function show($tipos_estudios)
    {
        $tipo_estudio = Tipo_estudio::find($tipos_estudios);
        $modulos = Estudio_modulo::where('tipo_estudio_id', $tipo_estudio->id)->get();
        return view('tipo_estudio.show', compact('tipo_estudio', 'modulos'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
            'sigla' => 'required',
        ]);
        $tipos_estudios = Tipo_estudio::findOrFail($id);
        $datos = $request->all();
        $tipos_estudios->update($datos);
        return redirect()->route('estudio.index');
    }

    public function destroy($tipos_estudios)
    {
        $estudio = Tipo_estudio::findOrFail($tipos_estudios);
        $estudio->delete();
        return back()->with('mensaje', 'Eliminado Correctamente');
    }
}
