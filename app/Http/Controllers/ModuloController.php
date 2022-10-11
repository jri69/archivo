<?php

namespace App\Http\Controllers;

use App\Models\Docente;
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
        $docentes = Docente::all();
        return view('modulo.create', compact('programas', 'docentes'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'nombre' => 'required|string|max:150',
                'sigla' => 'required|string|max:10',
                'version' => 'required|numeric|max:10',
                'edicion' => 'required|numeric|max:10',
                'fecha_inicio' => 'required|date',
                'fecha_final' => 'required|date',
                'id_programa' => 'required|numeric',
                'docente_id' => 'required|numeric',
            ],
            [
                'nombre.required' => 'El campo nombre es obligatorio',
                'nombre.string' => 'El campo nombre debe ser de tipo texto',
                'nombre.max' => 'El campo nombre debe contener maximo 150 caracteres',
                'sigla.required' => 'El campo sigla es obligatorio',
                'sigla.string' => 'El campo sigla debe ser de tipo texto',
                'sigla.max' => 'El campo sigla debe contener maximo 10 caracteres',
                'version.required' => 'El campo version es obligatorio',
                'version.numeric' => 'El campo version debe ser de tipo numerico',
                'version.max' => 'El campo version debe contener maximo 10 caracteres',
                'edicion.required' => 'El campo edicion es obligatorio',
                'edicion.numeric' => 'El campo edicion debe ser de tipo numerico',
                'edicion.max' => 'El campo edicion debe contener maximo 10 caracteres',
                'fecha_inicio.required' => 'El campo fecha de inicio es obligatorio',
                'fecha_inicio.date' => 'El campo fecha de inicio debe ser de tipo fecha',
                'fecha_final.required' => 'El campo fecha final es obligatorio',
                'fecha_final.date' => 'El campo fecha final debe ser de tipo fecha',
                'id_programa.required' => 'El campo programa es obligatorio',
                'id_programa.numeric' => 'El campo programa debe ser de tipo numerico',
                'docente_id.required' => 'El campo docente es obligatorio',
                'docente_id.numeric' => 'El campo docente debe ser de tipo numerico',
            ]
        );
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
            'docente_id' => $request->docente_id,
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
        $docentes = Docente::all();
        return view('modulo.edit', compact('modulo', 'programa', 'docentes'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'nombre' => 'required|string|max:150',
                'sigla' => 'required|string|max:10',
                'version' => 'required|numeric|max:10',
                'edicion' => 'required|numeric|max:10',
                'fecha_inicio' => 'required|date',
                'fecha_final' => 'required|date',
                'id_programa' => 'required|numeric',
                'docente_id' => 'required|numeric',
            ],
            [
                'nombre.required' => 'El campo nombre es obligatorio',
                'nombre.string' => 'El campo nombre debe ser de tipo texto',
                'nombre.max' => 'El campo nombre debe contener maximo 150 caracteres',
                'sigla.required' => 'El campo sigla es obligatorio',
                'sigla.string' => 'El campo sigla debe ser de tipo texto',
                'sigla.max' => 'El campo sigla debe contener maximo 10 caracteres',
                'version.required' => 'El campo version es obligatorio',
                'version.numeric' => 'El campo version debe ser de tipo numerico',
                'version.max' => 'El campo version debe contener maximo 10 caracteres',
                'edicion.required' => 'El campo edicion es obligatorio',
                'edicion.numeric' => 'El campo edicion debe ser de tipo numerico',
                'edicion.max' => 'El campo edicion debe contener maximo 10 caracteres',
                'fecha_inicio.required' => 'El campo fecha de inicio es obligatorio',
                'fecha_inicio.date' => 'El campo fecha de inicio debe ser de tipo fecha',
                'fecha_final.required' => 'El campo fecha final es obligatorio',
                'fecha_final.date' => 'El campo fecha final debe ser de tipo fecha',
                'id_programa.required' => 'El campo programa es obligatorio',
                'id_programa.numeric' => 'El campo programa debe ser de tipo numerico',
                'docente_id.required' => 'El campo docente es obligatorio',
                'docente_id.numeric' => 'El campo docente debe ser de tipo numerico',
            ]
        );
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
