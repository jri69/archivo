<?php

namespace App\Http\Controllers;

use App\Models\ActivoFijo;
use App\Models\Area;
use App\Models\User;
use Illuminate\Http\Request;

class ActivoFijoController extends Controller
{
    // Ver los activos fijos
    public function index()
    {
        return view('activo.index');
    }

    // Interface para crear un activo fijo
    public function create()
    {
        $areas = Area::all();
        $users = User::all();
        return view('activo.create', compact('areas', 'users'));
    }

    // Guardar un activo fijo
    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|unique:activo_fijos',
            'estado' => 'required|string|regex:/^[\pL\s\-]+$/u',
            'descripcion' => 'required|string',
            'unidad' => 'required|string|regex:/^[\pL\s\-]+$/u',
            'tipo' => 'required|string|regex:/^[\pL\s\-]+$/u',
            'id_area' => 'required|numeric',
            'id_usuario' => 'required|numeric',
        ], [
            'codigo.required' => 'El código es obligatorio',
            'codigo.unique' => 'El código ya existe',
            'estado.required' => 'El estado es obligatorio',
            'estado.regex' => 'El estado solo puede contener letras',
            'descripcion.required' => 'La descripción es obligatoria',
            'unidad.required' => 'La unidad es obligatoria',
            'unidad.regex' => 'La unidad solo puede contener letras',
            'tipo.required' => 'El tipo es obligatorio',
            'tipo.regex' => 'El tipo solo puede contener letras',
            'id_area.required' => 'El área es obligatoria',
            'id_area.numeric' => 'El área debe ser un número',
            'id_usuario.required' => 'El usuario es obligatorio',
            'id_usuario.numeric' => 'El usuario debe ser un número',
        ]);
        $activo = ActivoFijo::create($request->all());
        return redirect()->route('activo.index', $activo);
    }

    // Interface de edición de un activo fijo
    public function edit(ActivoFijo $activo)
    {
        $activo = ActivoFijo::findOrFail($activo->id);
        $areas = Area::all();
        $users = User::all();
        return view('activo.edit', compact('activo', 'areas', 'users'));
    }

    // Actualizar un activo fijo
    public function update(Request $request, $id)
    {
        $request->validate([
            'codigo' => 'required|unique:activo_fijos,codigo,' . $id,
            'estado' => 'required|string|regex:/^[\pL\s\-]+$/u',
            'descripcion' => 'required|string',
            'unidad' => 'required|string|regex:/^[\pL\s\-]+$/u',
            'tipo' => 'required|string|regex:/^[\pL\s\-]+$/u',
            'id_area' => 'required|numeric',
            'id_usuario' => 'required|numeric', [
                'codigo.required' => 'El código es obligatorio',
                'codigo.unique' => 'El código ya existe',
                'estado.required' => 'El estado es obligatorio',
                'estado.regex' => 'El estado solo puede contener letras',
                'descripcion.required' => 'La descripción es obligatoria',
                'unidad.required' => 'La unidad es obligatoria',
                'unidad.regex' => 'La unidad solo puede contener letras',
                'tipo.required' => 'El tipo es obligatorio',
                'tipo.regex' => 'El tipo solo puede contener letras',
                'id_area.required' => 'El área es obligatoria',
                'id_area.numeric' => 'El área debe ser un número',
                'id_usuario.required' => 'El usuario es obligatorio',
                'id_usuario.numeric' => 'El usuario debe ser un número',
            ]
        ]);
        $activo = ActivoFijo::findOrFail($id);
        $activo->update($request->all());
        return redirect()->route('activo.index');
    }

    // Eliminar un activo fijo
    public function destroy($activo)
    {
        $activo = ActivoFijo::findOrFail($activo);
        $activo->delete();
        return back()->with('mensaje', 'Eliminado Correctamente');
    }
}
