<?php

namespace App\Http\Controllers;

use App\Models\EstudiantePrograma;
use App\Models\Modulo;
use App\Models\NotasPrograma;
use App\Models\Programa;
use App\Models\ProgramaModulo;
use Illuminate\Http\Request;

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
        $cant_modulos = ProgramaModulo::where('id_programa', $programa->id)->count();
        if ($cant_modulos != $programa->cantidad_modulos) {
            $programa->cantidad_modulos = $cant_modulos;
            $programa->save();
        }
        return view('programa.show', compact('programa', 'modulos', 'cant_estudiantes'));
    }

    // Eliminar un programa
    public function destroy($modulo)
    {
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
        return view('programa.modulo', compact('programa', 'modulo', 'estudiante_programa'));
    }

    // Actualizar los estudiantes inscritos en el programa
    public function actInscritos($programa, $modulo)
    {
        $programa = Programa::findOrFail($programa);
        $modulo = Modulo::findOrFail($modulo);
        $estudiante_programa = EstudiantePrograma::where('id_programa', $programa->id)->get();
        //sincronizar estudiantes inscritos en notas con estudiantes inscritos en programa
        foreach ($estudiante_programa as $estudiante) {
            $nota = NotasPrograma::where('id_modulo', $modulo->id)
                ->where('id_programa', $programa->id)
                ->where('id_estudiante', $estudiante->id_estudiante)->first();
            if ($nota == null) {
                NotasPrograma::create([
                    'nota' => 0,
                    'observaciones' => '',
                    'id_estudiante' => $estudiante->id_estudiante,
                    'id_programa' => $programa->id,
                    'id_modulo' => $modulo->id
                ]);
            }
        }
        return redirect()->route('programa.modulo', [$programa->id, $modulo->id]);
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
