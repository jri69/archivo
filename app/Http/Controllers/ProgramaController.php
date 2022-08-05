<?php

namespace App\Http\Controllers;

use App\Models\EstudiantePrograma;
use App\Models\Estudio_modulo;
use App\Models\Modulo;
use App\Models\NotasPrograma;
use App\Models\Programa;
use App\Models\Tipo_estudio;
use Illuminate\Http\Request;

class ProgramaController extends Controller
{
    public function index()
    {
        $programas = Programa::all();
        return view('programa.index', compact('programas'));
    }

    public function create()
    {
        return view('programa.create');
    }

    public function edit($programa)
    {
        return view('programa.edit', compact('programa'));
    }

    public function show($programa)
    {
        $programa = Programa::findOrFail($programa);
        $modulos = $programa->modulos;
        $cant_estudiantes = EstudiantePrograma::where('id_programa', $programa->id)->count();
        return view('programa.show', compact('programa', 'modulos', 'cant_estudiantes'));
    }

    public function destroy($modulo)
    {
        $programa = Programa::findOrFail($modulo);
        $programa->delete();
        return back()->with('mensaje', 'Eliminado Correctamente');
    }

    public function modulo($programa, $modulo)
    {
        $programa = Programa::findOrFail($programa);
        $modulo = Modulo::findOrFail($modulo);
        $estudiante_programa = EstudiantePrograma::where('id_programa', $programa->id)->get();
        return view('programa.modulo', compact('programa', 'modulo', 'estudiante_programa'));
    }

    public function actInscritos($programa, $modulo)
    {
        $programa = Programa::findOrFail($programa);
        $modulo = Modulo::findOrFail($modulo);
        $estudiante_programa = EstudiantePrograma::where('id_programa', $programa->id)->get();

        //sincronizar estudiantes inscritos en notas con estudiantes inscritos en programa
        foreach ($estudiante_programa as $estudiante) {
            $nota = NotasPrograma::where('id_estudiante_programa', $estudiante->id_programa)
                ->where('id_modulo', $modulo->id)->first();
            if ($nota == null) {
                NotasPrograma::create([
                    'nota' => 0,
                    'observaciones' => '',
                    'id_estudiante_programa' => $estudiante->id_programa,
                    'id_modulo' => $modulo->id
                ]);
            }
        }
        return redirect()->route('programa.modulo', [$programa->id, $modulo->id]);
    }
}
