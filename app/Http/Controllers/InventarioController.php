<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use Illuminate\Http\Request;

class InventarioController extends Controller
{
    public function index()
    {
        return view('inventario.index');
    }

    public function create()
    {
        return view('inventario.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|regex:/^[\pL\s\-]+$/u',
            'estado' => 'required|string|regex:/^[\pL\s\-]+$/u',
            'tipo' => 'required|string|regex:/^[\pL\s\-]+$/u',
            'modelo' => 'required|string',
            'cantidad' => 'required|numeric',
        ]);
        $producto = Inventario::create($request->all());
        return redirect()->route('inventario.index', $producto);
    }

    public function edit(Inventario $inventario)
    {

        return view('inventario.edit', compact('inventario'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|regex:/^[\pL\s\-]+$/u',
            'estado' => 'required|string|regex:/^[\pL\s\-]+$/u',
            'tipo' => 'required|string|regex:/^[\pL\s\-]+$/u',
            'modelo' => 'required|string',
            'cantidad' => 'required|numeric',
        ]);
        $producto = Inventario::findOrFail($id);
        $producto->update($request->all());
        return redirect()->route('inventario.index');
    }

    public function destroy($requisito)
    {
        $requisito = Inventario::findOrFail($requisito);
        $requisito->delete();
        return back()->with('mensaje', 'Eliminado Correctamente');
    }
}
