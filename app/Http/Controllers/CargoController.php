<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use Illuminate\Http\Request;

class CargoController extends Controller
{
    // Ver los cargos
    public function index()
    {
        $cargos = Cargo::orderBy('id', 'asc')->paginate(10);
        return view('cargo.index', compact('cargos'));
    }

    // Interface para crear un cargo
    public function create()
    {
        return view('cargo.create');
    }

    // Guardar un cargo
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required'
        ]);
        $cargo = Cargo::create($request->all());
        return redirect()->route('cargo.index', $cargo);
    }

    // Interface de edición de un cargo
    public function edit(Cargo $cargo)
    {
        return view('cargo.edit', compact('cargo'));
    }

    // Actualizar un cargo
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required'
        ]);
        $cargo = Cargo::findOrFail($id);
        $cargo->update($request->all());
        return redirect()->route('cargo.index');
    }

    // Eliminar un cargo
    public function destroy(Cargo $cargo)
    {
        $cargo->delete();
        return back()->with('mensaje', 'Eliminado Correctamente');
    }
}
