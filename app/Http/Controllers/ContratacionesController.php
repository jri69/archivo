<?php

namespace App\Http\Controllers;

use App\Models\Carta;
use App\Models\Contrato;
use App\Models\ContratoCarta;
use App\Models\Docente;
use App\Models\Modulo;
use App\Models\Programa;
use App\Models\ProgramaModulo;
use Illuminate\Http\Request;

class ContratacionesController extends Controller
{
    // estructura de controller
    public function index()
    {
        return view('contrataciones.index');
    }

    public function create()
    {
        return view('contrataciones.create');
    }

    public function show($id)
    {
        $contrato = Contrato::find($id);
        $cartas = ContratoCarta::where('contrato_id', $id)->get();
        $programa_modulo = ProgramaModulo::where('id_modulo', $contrato->modulo_id)->first();
        $programa = Programa::find($programa_modulo->id_programa);
        return view('contrataciones.show', compact('contrato', 'cartas', 'programa'));
    }

    public function edit($id)
    {
        $contrato = Contrato::find($id);
        return view('contrataciones.edit', compact('contrato'));
    }

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
        $contrato = Contrato::find($id);
        $contrato->update($request->all());
        return redirect()->route('contrataciones.show', $id);
    }

    public function destroy($id)
    {
        $contrato = Contrato::find($id);
        $contrato->delete();
        return redirect()->route('contrataciones.index');
    }
}
