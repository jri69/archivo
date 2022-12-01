<?php

namespace App\Http\Controllers;

use App\Models\Prospecto;
use Illuminate\Http\Request;

class MarketingController extends Controller
{
    // Ver los administrativos
    public function index()
    {
        return view('marketing.index');
    }

    // Interface para crear un administrativo
    public function create()
    {
        return view('marketing.create');
    }

    // Guardar un administrativo
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'interes' => 'required|string',
        ], [
            'nombre.required' => 'El nombre es requerido',
            'interes.required' => 'El interes es requerido',
        ]);
        $request->merge(['estado' => 'Prospecto']);
        Prospecto::create($request->all());
        return redirect()->route('marketing.index');
    }

    // Interface de edición de un administrativo
    public function edit($id)
    {
        $prospecto = Prospecto::findOrFail($id);
        return view('marketing.edit', compact('prospecto'));
    }

    // Actualizar un administrativo
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string',
            'interes' => 'required|string',
        ], [
            'nombre.required' => 'El nombre es requerido',
            'interes.required' => 'El interes es requerido',
        ]);
        $propsecto = Prospecto::findOrFail($id);
        $propsecto->update($request->all());
        return redirect()->route('marketing.index');
    }

    // Eliminar un administrativo
    public function destroy($id)
    {
        $prospecto = Prospecto::findOrFail($id);
        $prospecto->delete();
        return redirect()->route('marketing.index');
    }
}
