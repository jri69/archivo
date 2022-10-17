<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    // Ver las áreas
    public function index()
    {
        $areas = Area::orderBy('nombre', 'asc')->paginate(10);
        return view('area.index', compact('areas'));
    }

    // Interface para crear un área
    public function create()
    {
        return view('area.create');
    }

    // Guardar un área
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required'
        ]);
        $area = Area::create($request->all());
        return redirect()->route('area.index', $area);
    }

    // Interface de edición de un área
    public function edit(Area $area)
    {
        return view('area.edit', compact('area'));
    }

    // Actualizar un área
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required'
        ]);
        $area = Area::findOrFail($id);
        $datos = $request->all();
        $area->update($datos);
        return redirect()->route('area.index');
    }

    // Eliminar un área
    public function destroy(Area $area)
    {
        $area->delete();
        return back()->with('mensaje', 'Eliminado Correctamente');
    }
}
