<?php

namespace App\Http\Controllers;

use App\Models\Modulo;
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
        return view('modulo.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'sigla' => 'required',
            'version' => 'required',
            'edicion' => 'required',
        ]);
        $modulo = Modulo::create($request->all());
        return redirect()->route('modulo.index', $modulo);
    }

    public function edit(Modulo $modulo)
    {
        return view('modulo.edit', compact('modulo'));
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
