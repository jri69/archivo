<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use App\Models\Modulo;
use App\Models\Programa;
use App\Models\ProgramaCalendar;
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
        $modulos = Modulo::where('programa_id', $request->id_programa)->get();
        $cantidad = count($modulos) + 1;
        $programa = Programa::findOrFail($request->id_programa);
        $costoXmodulo = $programa->costo / $cantidad;
        foreach ($modulos as $modulo) {
            $mod = Modulo::findOrFail($modulo->id);
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
            'programa_id' => $request->id_programa,
        ]);
        ProgramaCalendar::create([
            'title' => $modulo->nombre . ' - ' . $programa->sigla,
            'start' => $modulo->fecha_inicio,
            'end' => $modulo->fecha_inicio,
            'sigla' => $modulo->sigla . ' - ' . $modulo->version . '.' . $modulo->edicion,
            'tipo' => 'Modulo',
            'tipo_fecha' => 'inicio',
            'modulo_id' => $modulo->id,
        ]);
        ProgramaCalendar::create([
            'title' => $modulo->nombre  . ' - ' . $programa->sigla,
            'start' => $modulo->fecha_final,
            'end' => $modulo->fecha_final,
            'sigla' => $modulo->sigla . ' - ' . $modulo->version . '.' . $modulo->edicion,
            'tipo' => 'Modulo',
            'tipo_fecha' => 'final',
            'modulo_id' => $modulo->id,
        ]);
        return redirect()->route('modulo.index', $modulo);
    }

    // Interface para editar un módulo
    public function edit(Modulo $modulo)
    {
        $programa = Modulo::findOrFail($modulo->programa_id);
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
        $programa = Programa::findOrFail($modulo->programa_id);
        $datos = $request->all();
        $modulo->update($datos);
        $calendarInicio = ProgramaCalendar::where('modulo_id', $id)->where('tipo_fecha', 'inicio')->first();
        $calendarFin = ProgramaCalendar::where('modulo_id', $id)->where('tipo_fecha', 'final')->first();
        $calendarInicio->update([
            'title' => $modulo->nombre  . ' - ' . $programa->sigla,
            'start' => $modulo->fecha_inicio,
            'end' => $modulo->fecha_inicio,
            'sigla' => $modulo->sigla . ' - ' . $modulo->version . '.' . $modulo->edicion,
        ]);
        $calendarFin->update([
            'title' => $modulo->nombre  . ' - ' . $programa->sigla,
            'start' => $modulo->fecha_final,
            'end' => $modulo->fecha_final,
            'sigla' => $modulo->sigla . ' - ' . $modulo->version . '.' . $modulo->edicion,
        ]);
        return redirect()->route('modulo.index');
    }

    // Eliminar un módulo
    public function destroy($modulo)
    {
        $modulo = Modulo::findOrFail($modulo);
        $modulos = Modulo::where('programa_id', $modulo->programa_id)->get();
        $calendarModulo = ProgramaCalendar::where('modulo_id', $modulo->id)->get();
        if ($modulos->count() > 1) {
            $cantidad = count($modulos) - 1;
            $programa = Programa::findOrFail($modulo->programa_id);
            $costoXmodulo = $programa->costo / $cantidad;
            foreach ($modulos as $modu) {
                $mod = Modulo::findOrFail($modu->id);
                $mod->costo = $costoXmodulo;
                $mod->save();
            }
            foreach ($calendarModulo as  $calendar) {
                $calendar->delete();
            }
        }
        $modulo->delete();
        return redirect()->route('modulo.index');
    }
}
