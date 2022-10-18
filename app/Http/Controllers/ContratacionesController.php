<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use App\Models\ContratoCarta;
use App\Models\Docente;
use App\Models\Programa;
use App\Models\ProgramaModulo;
use Illuminate\Http\Request;

class ContratacionesController extends Controller
{
    // ver las contrataciones
    public function index()
    {
        return view('contrataciones.index');
    }

    // Interface para crear una contratación
    public function create($docente)
    {
        $docente = Docente::findOrFail($docente);
        return view('contrataciones.create', compact('docente'));
    }

    // Ver datos del contrato
    public function show($id)
    {
        $contrato = Contrato::findOrFail($id);
        $cartas = ContratoCarta::where('contrato_id', $id)->get();
        $programa_modulo = ProgramaModulo::where('id_modulo', $contrato->modulo_id)->first();
        $programa = Programa::findOrFail($programa_modulo->id_programa);
        return view('contrataciones.show', compact('contrato', 'cartas', 'programa'));
    }

    // Interface de edición de una contratación
    public function edit($id)
    {
        $contrato = Contrato::findOrFail($id);
        return view('contrataciones.edit', compact('contrato'));
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
        $contrato = Contrato::findOrFail($id);
        $contrato->update($request->all());
        return redirect()->route('contrataciones.show', $id);
    }

    // Eliminar una contratación
    public function destroy($id)
    {
        $contrato = Contrato::findOrFail($id);
        $contrato->delete();
        return redirect()->route('contrataciones.index');
    }
}
