<?php

namespace App\Http\Controllers;

use App\Models\UnidadOrganizacional;
use Illuminate\Http\Request;

class UnidadOrganizacionalController extends Controller
{
    // Ver las unidades organizacionales
    public function index()
    {
        $unidades = UnidadOrganizacional::all();
        return view('unidad_organizacional.index', compact('unidades'));
    }

    // Interface para crear una unidad organizacional
    public function create()
    {
        return view('unidad_organizacional.create');
    }

    // Guardar una unidad organizacional
    public function store(Request $request)
    {
        $request->validate(
            [
                'nombre' => 'required|max:255',
            ],
            [
                'nombre.required' => 'El campo nombre es obligatorio',
                'nombre.max' => 'El campo nombre debe contener maximo 255 caracteres',
            ]
        );
        UnidadOrganizacional::create($request->all());
        return redirect()->route('unidad.index');
    }

    // Interface para editar una unidad organizacional
    public function edit($id)
    {
        $unidad = UnidadOrganizacional::findOrFail($id);
        return view('unidad_organizacional.edit', compact('unidad'));
    }

    // Actualizar una unidad organizacional
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'nombre' => 'required|max:255',
            ],
            [
                'nombre.required' => 'El campo nombre es obligatorio',
                'nombre.max' => 'El campo nombre debe contener maximo 255 caracteres',
            ]
        );
        $unidad = UnidadOrganizacional::findOrFail($id);
        $unidad->update($request->all());
        return redirect()->route('unidad.index');
    }

    // Eliminar una unidad organizacional
    public function destroy($id)
    {
        $unidad = UnidadOrganizacional::findOrFail($id);
        $unidad->delete();
        return redirect()->route('unidad.index');
    }
}
