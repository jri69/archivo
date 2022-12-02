<?php

namespace App\Http\Controllers;

use App\Models\EstudianteModulo;
use App\Models\EstudiantePrograma;
use App\Models\Modulo;
use App\Models\NotasPrograma;
use App\Models\Programa;
use App\Models\ProgramaCalendar;

class ProgramaController extends Controller
{
    // Ver los programas
    public function index()
    {
        return view('programa.index');
    }

    // Interface para crear un programa
    public function create()
    {
        return view('programa.create');
    }

    // Interface para editar un programa
    public function edit($programa)
    {
        return view('programa.edit', compact('programa'));
    }

    // Ver detalles de un programa
    public function show($programa)
    {
        $programa = Programa::findOrFail($programa);
        $modulos = $programa->modulos;
        $cant_estudiantes = EstudiantePrograma::where('id_programa', $programa->id)->count();
        $cant_modulos = Modulo::where('programa_id', $programa->id)->count();
        if ($cant_modulos != $programa->cantidad_modulos) {
            $programa->cantidad_modulos = $cant_modulos;
            $programa->save();
        }
        return view('programa.show', compact('programa', 'modulos', 'cant_estudiantes'));
    }

    // Eliminar un programa
    public function destroy($modulo)
    {
        $calendar = ProgramaCalendar::where('programa_id', $modulo)->get();
        foreach ($calendar as  $cale) {
            $cale->delete();
        }
        $programa = Programa::findOrFail($modulo);
        $programa->delete();
        return back()->with('mensaje', 'Eliminado Correctamente');
    }

    // Ver detalles del modulo del programa
    public function modulo($programa, $modulo)
    {
        $programa = Programa::findOrFail($programa);
        $modulo = Modulo::findOrFail($modulo);
        $estudiante_programa = NotasPrograma::where('id_modulo', $modulo->id)
            ->where('id_programa', $programa->id)
            ->get();
        $inscritos = EstudianteModulo::where('id_modulo', $modulo->id)->get();
        $inscritos = count($inscritos);
        return view('programa.modulo', compact('programa', 'modulo', 'estudiante_programa', 'inscritos'));
    }

    // Actualizar los estudiantes inscritos en el modulo de programa
    public function actInscritos($programa, $modulo)
    {
        return view('programa.inscribir', compact('modulo', 'programa'));
    }

    // Actualizar las notas de los estudiantes
    public function notas($programa, $modulo)
    {
        $programa = Programa::findOrFail($programa);
        $modulo = Modulo::findOrFail($modulo);
        $estudiante_programa = NotasPrograma::where('id_modulo', $modulo->id)
            ->where('id_programa', $programa->id)->get();
        return view('programa.notas', compact('programa', 'modulo', 'estudiante_programa'));
    }

    // Iniciar el modulo
    public function init($programa, $modulo)
    {
        $programa = Programa::findOrFail($programa);
        $modulo = Modulo::findOrFail($modulo);
        $modulo->estado = 'Iniciado';
        $modulo->save();
        $estudiante_programa = NotasPrograma::where('id_modulo', $modulo->id)
            ->where('id_programa', $programa->id)
            ->get();
        return view('programa.modulo', compact('programa', 'modulo', 'estudiante_programa'));
    }
}
