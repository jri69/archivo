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
            'nombre' => 'required|string',
            'sigla' => 'required|string',
            'version' => 'required|numeric',
            'edicion' => 'required|numeric',
            'fecha_inicio' => 'required|date',
            'fecha_final' => 'required|date',
            'id_programa' => 'required|numeric',
        ]);
        $modulos = ProgramaModulo::where('id_programa', $request->id_programa)->get();
        $cantidad = count($modulos) + 1;
        $programa = Programa::find($request->id_programa);
        $costoXmodulo = $programa->costo / $cantidad;
        foreach ($modulos as $modulo) {
            $mod = Modulo::find($modulo->id_modulo);
            $mod->costo = $costoXmodulo;
            $mod->save();
        }
        $modulo = Modulo::create([
            'nombre' => $request->nombre,
            'sigla' => $request->sigla,
            'version' => $request->version,
            'edicion' => $request->edicion,
            'costo' => $costoXmodulo,
            'estado' => $request->estado,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_final' => $request->fecha_final,
            'id_programa' => $request->id_programa,
        ]);
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
            'nombre' => 'required|string',
            'sigla' => 'required|string',
            'version' => 'required|numeric',
            'edicion' => 'required|numeric',
            'fecha_inicio' => 'required|date',
            'fecha_final' => 'required|date',
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
