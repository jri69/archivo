<?php

namespace App\Http\Controllers;

use App\Models\Programa;
use App\Models\Tipo_estudio;
use Illuminate\Http\Request;

class ProgramaController extends Controller
{
    public function index()
    {
        $programas = Programa::all();
        return view('programa.index', compact('programas'));
    }

    public function create()
    {
        $estudios = Tipo_estudio::all();
        return view('programa.create', compact('estudios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha_inicio' => 'required',
            'costo' => 'required',
        ]);
        $programa = Programa::create($request->all());
        return redirect()->route('programa.index', $programa);
    }

    public function edit(programa $programa)
    {
        return view('programa.edit', compact('programa'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'fecha_inicio' => 'required',
            'costo' => 'required',
        ]);
        $programa = Programa::findOrFail($id);
        $datos = $request->all();
        $programa->update($datos);
        return redirect()->route('programa.index');
    }

    public function destroy($modulo)
    {
        $programa = Programa::findOrFail($modulo);
        $programa->delete();
        return back()->with('mensaje', 'Eliminado Correctamente');
    }
}
