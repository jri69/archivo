<?php

namespace App\Http\Controllers;

use App\Models\Directivo;
use Directory;
use Illuminate\Http\Request;

class DirectivoController extends Controller
{
    // Ver los directivos
    public function index()
    {
        return view('directivos.index');
    }

    // Interface para crear un directivo
    public function create()
    {
        return view('directivos.create');
    }

    // Guardar un directivo
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:150',
            'honorifico' => 'required|string|max:10',
            'cargo' => 'required|string|max:100',
            'institucion' => 'required|string|max:255',
            'activo' => 'required',
            'sexo' => 'required'
        ], [
            'nombre.required' => 'El nombre es requerido',
            'apellido.required' => 'El apellido es requerido',
            'honorifico.required' => 'El honorifico es requerido',
            'cargo.required' => 'El cargo es requerido',
            'institucion.required' => 'La institucion es requerida',
            'activo.required' => 'El estado es requerido'
        ]);
        $ant_directivo = Directivo::where('cargo', $request->cargo)->where('activo', true)->where('institucion', $request->institucion)->first();
        $request->activo == true ? $ant_directivo->activo = false : '';
        $ant_directivo->save();
        Directivo::create($request->all());
        return redirect()->route('directivo.index');
    }

    // Interface de edición de un directivo
    public function edit($id)
    {
        $directivo = Directivo::findOrFail($id);
        return view('directivos.edit', compact('directivo'));
    }

    // Actualizar un directivo
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:150',
            'honorifico' => 'required|string|max:10',
            'cargo' => 'required|string|max:100',
            'institucion' => 'required|string|max:255',
            'activo' => 'required',
            'sexo' => 'required'
        ], [
            'nombre.required' => 'El nombre es requerido',
            'apellido.required' => 'El apellido es requerido',
            'honorifico.required' => 'El honorifico es requerido',
            'cargo.required' => 'El cargo es requerido',
            'institucion.required' => 'La institucion es requerida',
            'activo.required' => 'El estado es requerido'
        ]);
        $directivo = Directivo::findOrFail($id);
        $directivo->update($request->all());
        return redirect()->route('directivo.index');
    }

    // Eliminar un directivo
    public function destroy($id)
    {
        $directivo = Directivo::findOrFail($id);
        $directivo->delete();
        return redirect()->route('directivo.index');
    }
}
