<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use App\Models\EstudianteModulo;
use App\Models\Modulo;
use App\Models\NotasPrograma;
use App\Models\ProcesoModulo;
use App\Models\ProcesoRealizado;
use App\Models\Programa;
use App\Models\ProgramaCalendar;
use Carbon\Carbon;
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
        $programas = Programa::orWhere('fecha_finalizacion', '>=', $date)
            ->orWhere('has_editable', 'Si')
            ->get();
        $docentes = Docente::orderBy('nombre', 'desc')->get();
        return view('modulo.create', compact('programas', 'docentes'));
    }

    // Guardar un módulo
    public function store(Request $request)
    {
        $request->validate(
            [
                'codigo' => 'required|string',
                'nombre' => 'required|string',
                'sigla' => 'required|string',
                'version' => 'required|numeric',
                'edicion' => 'required|numeric',
                'fecha_inicio' => 'required|date',
                'fecha_final' => 'required|date',
                'programa_id' => 'required|numeric',
                'docente_id' => 'required|numeric',
                'modalidad' => 'required|string',
                'hrs_academicas' => 'required|numeric',
            ],
            [
                'codigo.required' => 'El código es requerido',
                'nombre.required' => 'El nombre es requerido',
                'sigla.required' => 'La sigla es requerida',
                'version.required' => 'La versión es requerida',
                'edicion.required' => 'La edición es requerida',
                'fecha_inicio.required' => 'La fecha de inicio es requerida',
                'fecha_final.required' => 'La fecha final es requerida',
                'programa_id.required' => 'El programa es requerido',
                'docente_id.required' => 'El docente es requerido',
                'modalidad.required' => 'La modalidad es requerida',
                'hrs_academicas.required' => 'Las horas académicas son requeridas',
            ]
        );
        $modulos = Modulo::where('programa_id', $request->programa_id)->get();
        $cantidad = count($modulos) + 1;
        $programa = Programa::findOrFail($request->programa_id);
        $costoXmodulo = $programa->costo / $cantidad;
        foreach ($modulos as $modulo) {
            $mod = Modulo::findOrFail($modulo->id);
            $mod->costo = $costoXmodulo;
            $mod->save();
        }
        $request->request->add(['costo' => $costoXmodulo]);
        $modulo = Modulo::create($request->all());
        $programa->cantidad_modulos += 1;
        $programa->save();
        ProgramaCalendar::create([
            'nombre' => $modulo->nombre,
            'start' => $modulo->fecha_inicio,
            'end' => $modulo->fecha_inicio,
            'title' => $modulo->sigla . ' - ' . $modulo->version . '.' . $modulo->edicion,
            'tipo' => 'Modulo',
            'tipo_fecha' => 'inicio',
            'modulo_id' => $modulo->id,
            'docente' => $modulo->docente->honorifico . " " . $modulo->docente->nombre . " " . $modulo->docente->apellido,
            'modalidad' => $modulo->modalidad,
        ]);
        ProgramaCalendar::create([
            'nombre' => $modulo->nombre,
            'start' => $modulo->fecha_final,
            'end' => $modulo->fecha_final,
            'title' => $modulo->sigla . ' - ' . $modulo->version . '.' . $modulo->edicion,
            'tipo' => 'Modulo',
            'tipo_fecha' => 'final',
            'modulo_id' => $modulo->id,
            'docente' => $modulo->docente->honorifico . " " . $modulo->docente->nombre . " " . $modulo->docente->apellido,
            'modalidad' => $modulo->modalidad,
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
                'codigo' => 'required|string',
                'nombre' => 'required|string',
                'sigla' => 'required|string',
                'version' => 'required|numeric',
                'edicion' => 'required|numeric',
                'fecha_inicio' => 'required|date',
                'fecha_final' => 'required|date',
                'modalidad' => 'required|string',
                'hrs_academicas' => 'required|numeric',
                'cal_docente' => 'numeric',
            ],
            [
                'codigo.required' => 'El código es requerido',
                'nombre.required' => 'El nombre es requerido',
                'sigla.required' => 'La sigla es requerida',
                'version.required' => 'La versión es requerida',
                'edicion.required' => 'La edición es requerida',
                'fecha_inicio.required' => 'La fecha de inicio es requerida',
                'fecha_final.required' => 'La fecha final es requerida',
                'modalidad.required' => 'La modalidad es requerida',
                'hrs_academicas.required' => 'Las horas académicas son requeridas',
                'cal_docente.numeric' => 'La calificación debe ser un número',
            ]
        );
        $modulo = Modulo::findOrFail($id);
        $programa = Programa::findOrFail($modulo->programa_id);
        $datos = $request->all();
        $modulo->update($datos);
        $calendarInicio = ProgramaCalendar::where('modulo_id', $id)->where('tipo_fecha', 'inicio')->first();
        $calendarFin = ProgramaCalendar::where('modulo_id', $id)->where('tipo_fecha', 'final')->first();
        $calendarInicio->update([
            'nombre' => $modulo->nombre,
            'start' => $modulo->fecha_inicio,
            'end' => $modulo->fecha_inicio,
            'title' => $modulo->sigla . ' - ' . $modulo->version . '.' . $modulo->edicion,
            'docente' => $modulo->docente->honorifico . " " . $modulo->docente->nombre . " " . $modulo->docente->apellido,
            'modalidad' => $modulo->modalidad,
        ]);
        $calendarFin->update([
            'nombre' => $modulo->nombre,
            'start' => $modulo->fecha_final,
            'end' => $modulo->fecha_final,
            'title' => $modulo->sigla . ' - ' . $modulo->version . '.' . $modulo->edicion,
            'docente' => $modulo->docente->honorifico . " " . $modulo->docente->nombre . " " . $modulo->docente->apellido,
            'modalidad' => $modulo->modalidad,
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

    // Mostrar un módulo
    public function show($id)
    {
        $modulo = Modulo::findOrFail($id);
        $programa = Programa::findOrFail($modulo->programa_id);
        $estudiantesModulo = NotasPrograma::Join('estudiantes', 'estudiantes.id', '=', 'notas_programas.id_estudiante')
            ->select('estudiantes.*', 'notas_programas.*')
            ->where('notas_programas.id_modulo', $modulo->id)
            ->get();
        $cant_estudiantes = $estudiantesModulo->count();

        $procesos = ProcesoModulo::OrderBy('orden', 'asc')->get();
        $procesoModulo = ProcesoRealizado::where('modulo_id', $modulo->id)->get();
        $listaProceso = [];
        foreach ($procesos as $proceso) {
            $realizado = false;
            $fecha = null;
            foreach ($procesoModulo as $procesoRealizado) {
                if ($proceso->id == $procesoRealizado->proceso_modulo_id) {
                    $realizado = true;
                    $fecha = $procesoRealizado->fecha;
                    $procesoModulo->forget($procesoModulo->search($procesoRealizado));
                    break;
                }
            }
            $listaProceso[] = [
                'id' => $proceso->id,
                'nombre' => $proceso->nombre,
                'estado' => $realizado,
                'fecha' => $fecha
            ];
        }
        return view('modulo.show', compact('modulo', 'programa', 'estudiantesModulo', 'cant_estudiantes', 'listaProceso'));
    }
    public function proceso($modulo, $proceso)
    {
        ProcesoRealizado::create([
            'modulo_id' => $modulo,
            'proceso_modulo_id' => $proceso,
            'fecha' => Carbon::now()
        ]);
        return redirect()->route('modulo.show', $modulo);
    }
}
