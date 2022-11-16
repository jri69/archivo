<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use App\Models\Modulo;
use App\Models\Programa;
use App\Models\ProgramaModulo;
use Illuminate\Http\Request;

class ModuloController extends Controller
{
    // Ver los módulos
    public function index()
    {
        return view('modulo.index');
    }

    // Interface para crear un módulo
    public function create()
    {
        $date = date('Y-m-d');
        $programas = Programa::where('fecha_finalizacion', '>=', $date)->get();
        $docentes = Docente::orderBy('nombre', 'desc')->get();
        return view('modulo.create', compact('programas', 'docentes'));
    }

    // Guardar un módulo
    public function store(Request $request)
    {
        $request->validate(
            [
                'nombre' => 'required|string',
                'sigla' => 'required|string',
                'version' => 'required|numeric',
                'edicion' => 'required|numeric',
                'fecha_inicio' => 'required|date',
                'fecha_final' => 'required|date',
                'id_programa' => 'required|numeric',
                'docente_id' => 'required|numeric',
                'modalidad' => 'required|string',
            ],
            [
                'nombre.required' => 'El nombre es requerido',
                'sigla.required' => 'La sigla es requerida',
                'version.required' => 'La versión es requerida',
                'edicion.required' => 'La edición es requerida',
                'fecha_inicio.required' => 'La fecha de inicio es requerida',
                'fecha_final.required' => 'La fecha final es requerida',
                'id_programa.required' => 'El programa es requerido',
                'docente_id.required' => 'El docente es requerido',
                'modalidad.required' => 'La modalidad es requerida',
            ]
        );
        $modulos = ProgramaModulo::where('id_programa', $request->id_programa)->get();
        $cantidad = count($modulos) + 1;
        $programa = Programa::findOrFail($request->id_programa);
        $costoXmodulo = $programa->costo / $cantidad;
        foreach ($modulos as $modulo) {
            $mod = Modulo::findOrFail($modulo->id_modulo);
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
            'docente_id' => $request->docente_id,
            'modalidad' => $request->modalidad,
        ]);
        ProgramaModulo::create([
            'id_programa' => $request->id_programa,
            'id_modulo' => $modulo->id
        ]);
        return redirect()->route('modulo.index', $modulo);
    }

    // Interface para editar un módulo
    public function edit(Modulo $modulo)
    {
        $programa = ProgramaModulo::where('id_modulo', $modulo->id)->first();
        $docentes = Docente::all();
        return view('modulo.edit', compact('modulo', 'programa', 'docentes'));
    }

    // Actualizar un módulo
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'nombre' => 'required|string',
                'sigla' => 'required|string',
                'version' => 'required|numeric',
                'edicion' => 'required|numeric',
                'fecha_inicio' => 'required|date',
                'fecha_final' => 'required|date',
                'modalidad' => 'required|string',
            ],
            [
                'nombre.required' => 'El nombre es requerido',
                'sigla.required' => 'La sigla es requerida',
                'version.required' => 'La versión es requerida',
                'edicion.required' => 'La edición es requerida',
                'fecha_inicio.required' => 'La fecha de inicio es requerida',
                'fecha_final.required' => 'La fecha final es requerida',
                'id_programa.required' => 'El programa es requerido',
                'docente_id.required' => 'El docente es requerido',
                'modalidad.required' => 'La modalidad es requerida',
            ]
        );
        $modulo = Modulo::findOrFail($id);
        $datos = $request->all();
        $modulo->update($datos);
        return redirect()->route('modulo.index');
    }

    // Eliminar un módulo
    public function destroy($modulo)
    {
        $modulo = Modulo::findOrFail($modulo);
        $modulo->delete();
        return back()->with('mensaje', 'Eliminado Correctamente');
    }
}
