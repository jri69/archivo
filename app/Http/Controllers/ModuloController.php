<?php

namespace App\Http\Controllers;

use App\Models\Modulo;
use App\Models\Programa;
use App\Models\ProgramaModulo;
use Illuminate\Http\Request;

class ModuloController extends Controller
{

    public function index()
    {
        $modulos = Modulo::all();
        return view('modulo.index', compact('modulos'));
    }

    public function create()
    {
        $programas = Programa::all();
        return view('modulo.create', compact('programas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'sigla' => 'required',
            'version' => 'required',
            'edicion' => 'required',
            'id_programa' => 'required'
        ]);
        $modulo = Modulo::create($request->all());
        ProgramaModulo::create([
            'id_programa' => $request->id_programa,
            'id_modulo' => $modulo->id
        ]);
        return redirect()->route('modulo.index', $modulo);
    }

    public function edit(Modulo $modulo)
    {
        $programa = ProgramaModulo::where('id_modulo', $modulo->id)->first();
        return view('modulo.edit', compact('modulo', 'programa'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
            'sigla' => 'required',
            'version' => 'required',
            'edicion' => 'required',
        ]);
        $modulo = Modulo::findOrFail($id);
        $datos = $request->all();
        $modulo->update($datos);
        return redirect()->route('modulo.index');
    }

    public function destroy($modulo)
    {
        $modulo = Modulo::findOrFail($modulo);
        $modulo->delete();
        return back()->with('mensaje', 'Eliminado Correctamente');
    }
}
