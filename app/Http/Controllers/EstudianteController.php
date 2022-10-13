<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\EstudiantePrograma;
use App\Models\Modulo;
use App\Models\NotasPrograma;
use App\Models\Programa;
use App\Models\Requisito;
use App\Models\RequisitoArchivo;
use App\Models\RequisitoEstudiante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EstudianteController extends Controller
{
    public function index()
    {
        return view('estudiante.index');
    }

    public function create()
    {
        return view('estudiante.create');
    }

    public function edit($id_estudiante)
    {
        return view('estudiante.edit', compact('id_estudiante'));
    }

    public function destroy($modulo)
    {
        $estudiante = Estudiante::findOrFail($modulo);
        $estudiante->delete();
        return back()->with('mensaje', 'Eliminado Correctamente');
    }

    public function show($idEstudiante)
    {
        $estudiante = Estudiante::findOrFail($idEstudiante);
        $documentos = RequisitoEstudiante::where('id_estudiante', $idEstudiante)->get();
        $Idprogramas = EstudiantePrograma::where('id_estudiante', $idEstudiante)->get();
        $programas = Programa::whereIn('id', $Idprogramas->pluck('id_programa')->toArray())->get();
        return view('estudiante.show', compact('estudiante', 'documentos', 'programas'));
    }

    public function newprogram($estudiante)
    {
        $estudiante = Estudiante::findOrFail($estudiante);
        $programaEstudiante = EstudiantePrograma::where('id_estudiante', $estudiante->id)->get();
        $idProgramas = $programaEstudiante->pluck('id_programa')->toArray();
        $programas = Programa::whereNotIn('id', $idProgramas)
            ->where('fecha_finalizacion', '>=', now())
            ->get();
        return view('estudiante.newprogram', compact('estudiante', 'programas'));
    }

    public function storenewprogram(Request $request, $estudiante)
    {
        EstudiantePrograma::create([
            'id_estudiante' => $estudiante,
            'id_programa' => $request->id_programa,
        ]);
        return redirect()->route('estudiante.show', $estudiante);
    }

    public function showNotas($estudiante, $programa)
    {
        $estudiante = Estudiante::findOrFail($estudiante);
        $programa = Programa::findOrFail($programa);
        $notas = NotasPrograma::where('id_estudiante', $estudiante->id)
            ->where('id_programa', $programa->id)->get();
        return view('estudiante.notas', compact('estudiante', 'programa', 'notas'));
    }

    public function deleteFile($id)
    {
        $archivo = RequisitoEstudiante::findOrFail($id);
        Storage::delete($archivo->dir);
        $archivo->delete();
        return back()->with('mensaje', 'Eliminado Correctamente');
    }
}
