<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContratacionController extends Controller
{
    // ver las contratacion
    public function index()
    {
        return view('contratacion.index');
    }

    // Interface para crear una contratación
    public function create()
    {
        return view('contratacion.create');
    }

    // Ver datos del contrato
    public function show($id)
    {
        // $contrato = Contrato::findOrFail($id);
        // $cartas = ContratoCarta::where('contrato_id', $id)->get();
        // $programa_modulo = ProgramaModulo::where('id_modulo', $contrato->modulo_id)->first();
        // $programa = Programa::findOrFail($programa_modulo->id_programa);
        // return view('contratacion.show', compact('contrato', 'cartas', 'programa'));
    }

    // Interface de edición de una contratación
    public function edit($id)
    {
        // $contrato = Contrato::findOrFail($id);
        // return view('contratacion.edit', compact('contrato'));
    }

    // Actualizar una contratación
    public function update(Request $request, $id)
    {
        $request->validate([
            'fecha_inicio' => 'required',
            'fecha_final' => 'required',
            'honorario' => 'required',
            'horarios' => 'required',
        ], [
            'fecha_inicio.required' => 'La fecha de inicio es requerida',
            'fecha_fin.required' => 'La fecha de fin es requerida',
            'honorarios.required' => 'Los honorarios son requeridos',
            'horarios.required' => 'Los horarios son requeridos',
        ]);
        // $contrato = Contcrato::findOrFail($id);
        // $contrato->update($request->all());
        // return redirect()->route('contratacion.show', $id);
    }

    // Eliminar una contratación
    public function destroy($id)
    {
        // $contrato = Contrato::findOrFail($id);
        // $contrato->delete();
        // return redirect()->route('contratacion.index');
    }
}
