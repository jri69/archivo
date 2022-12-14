<?php

namespace App\Http\Controllers;

use App\Models\Carta;
use App\Models\Contrato;
use App\Models\ContratoCarta;
use App\Models\Docente;
use App\Models\Modulo;
use App\Models\Programa;
use App\Models\TipoCarta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $tipos = TipoCarta::Where('tipo', 'Docente')->get();
        $cartas = Carta::where('contrato_id', $id)->get();
        $modulo = Modulo::findOrFail($contrato->modulo_id);
        $programa = Programa::findOrFail($modulo->programa_id);
        // unir los tipos con las cartas
        $tipos_cartas = [];
        foreach ($tipos as $key => $tipo) {
            // $carta = $cartas->where('tipo_carta_id', $tipo->id)->first();
            $carta = $cartas->where('tipo_id', $tipo->id)->first();
            $tipos_cartas[$key] = [
                'tipo' => $tipo,
                'carta' => $carta
            ];
        }
        return view('contrataciones.show', compact('contrato', 'tipos_cartas', 'programa'));
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
            'nro_preventiva' => 'required',
            'pagado' => 'required'
        ], [
            'fecha_inicio.required' => 'La fecha de inicio es requerida',
            'fecha_fin.required' => 'La fecha de fin es requerida',
            'honorarios.required' => 'Los honorarios son requeridos',
            'horarios.required' => 'Los horarios son requeridos',
            'nro_preventiva.required' => 'El número de preventiva es requerido',
            'pagado.required' => 'El campo pagado es requerido'
        ]);
        $contrato = Contrato::findOrFail($id);
        $contrato->update($request->all());
        if ($request->hasFile('archivo')) {
            $archivo = $request->file('archivo');
            $nombre = $archivo->getClientOriginalName();
            if ($nombre != $contrato->comprobante) {
                Storage::disk('public')->delete($contrato->dir_comprobante, $contrato->comprobante);
                $dir = 'storage/' . Storage::disk('public')->put('contrataciones_comprobantes', $archivo);
                $contrato->dir_comprobante = $dir;
                $contrato->comprobante = $nombre;
                $contrato->save();
            }
        }
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
