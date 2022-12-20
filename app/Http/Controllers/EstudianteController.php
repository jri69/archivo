<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\EstudiantePrograma;
use App\Models\NotasPrograma;
use App\Models\Programa;
use App\Models\RequisitoEstudiante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EstudianteController extends Controller
{
    // Ver los estudiantes
    public function index()
    {
        return view('estudiante.index');
    }

    // Interface para crear un estudiante
    public function create()
    {
        return view('estudiante.create');
    }

    // Interface para editar un estudiante
    public function edit($id_estudiante)
    {
        return view('estudiante.edit', compact('id_estudiante'));
    }

    // Eliminar un estudiante
    public function destroy($modulo)
    {
        $estudiante = Estudiante::findOrFail($modulo);
        $requisitos = RequisitoEstudiante::where('id_estudiante', $modulo)->get();
        foreach ($requisitos as $requisito) {
            $dir = substr($requisito->dir, 8);
            Storage::disk('public')->delete($dir);
            $requisito->delete();
        }
        $estudiante->delete();
        return back()->with('mensaje', 'Eliminado Correctamente');
    }

    // Ver detalles de un estudiante
    public function show($idEstudiante)
    {
        $estudiante = Estudiante::findOrFail($idEstudiante);
        $documentos = RequisitoEstudiante::where('id_estudiante', $idEstudiante)->get();
        $Idprogramas = EstudiantePrograma::where('id_estudiante', $idEstudiante)->get();
        $programas = Programa::whereIn('id', $Idprogramas->pluck('id_programa')->toArray())->get();
        return view('estudiante.show', compact('estudiante', 'documentos', 'programas'));
    }

    // Añadir al estudiante a un nuevo programa
    public function newprogram($estudiante)
    {
        $estudiante = Estudiante::findOrFail($estudiante);
        return view('estudiante.newprogram', compact('estudiante'));
    }

    // Ver las notas de los módulos de un programa
    public function showNotas($estudiante, $programa)
    {
        $estudiante = Estudiante::findOrFail($estudiante);
        $programa = Programa::findOrFail($programa);
        $notas = NotasPrograma::where('id_estudiante', $estudiante->id)
            ->where('id_programa', $programa->id)->get();
        return view('estudiante.notas', compact('estudiante', 'programa', 'notas'));
    }

    // Eliminar un documento de un estudiante
    public function deleteFile($id)
    {
        $archivo = RequisitoEstudiante::findOrFail($id);
        $dir = substr($archivo->dir, 8);
        Storage::disk('public')->delete($dir);
        // Storage::delete($archivo->dir);
        $archivo->delete();
        return back()->with('mensaje', 'Eliminado Correctamente');
    }

    // Cambiar el estado de un estudiante
    public function estado($id)
    {
        $estudiante = Estudiante::findOrFail($id);
        $estudiante->estado == 'Inactivo' ? $estudiante->estado = 'Activo' :
            $estudiante->estado = 'Inactivo';
        $estudiante->fecha_inactividad = date('Y-m-d');
        $estudiante->save();
        return back()->with('mensaje', 'Estado cambiado correctamente');
    }
}
