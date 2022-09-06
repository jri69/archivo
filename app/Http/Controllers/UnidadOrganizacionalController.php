<?php

namespace App\Http\Controllers;

use App\Models\UnidadOrganizacional;
use Illuminate\Http\Request;

class UnidadOrganizacionalController extends Controller
{

    public function index()
    {
        $unidades = UnidadOrganizacional::all();
        return view('unidad_organizacional.index', compact('unidades'));
    }

    public function create()
    {
        return view('unidad_organizacional.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
        ]);

        UnidadOrganizacional::create($request->all());

        return redirect()->route('unidad.index')
            ->with('success', 'Unidad Organizacional creada con éxito.');
    }

    public function edit($id)
    {
        $unidad = UnidadOrganizacional::find($id);
        return view('unidad_organizacional.edit', compact('unidad'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
        ]);

        $unidad = UnidadOrganizacional::find($id);
        $unidad->update($request->all());

        return redirect()->route('unidad.index')
            ->with('success', 'Unidad Organizacional actualizada con éxito.');
    }

    public function destroy($id)
    {
        $unidad = UnidadOrganizacional::find($id);
        $unidad->delete();
        return redirect()->route('unidad.index')
            ->with('success', 'Unidad Organizacional eliminada con éxito.');
    }
}
