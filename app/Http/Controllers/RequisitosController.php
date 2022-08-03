<?php

namespace App\Http\Controllers;

use App\Models\Requisito;
use Illuminate\Http\Request;

class RequisitosController extends Controller
{
    public function index()
    {
        $requisitos = Requisito::all();
        return view('requisitos.index', compact('requisitos'));
    }

    public function create()
    {
        return view('requisitos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'importancia' => 'required',
        ]);
        $requisito = Requisito::create($request->all());
        return redirect()->route('requisito.index', $requisito);
    }

    public function edit(Requisito $requisito)
    {
        return view('requisitos.edit', compact('requisito'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
            'importancia' => 'required',
        ]);
        $modulo = Requisito::findOrFail($id);
        $datos = $request->all();
        $modulo->update($datos);
        return redirect()->route('requisito.index');
    }

    public function destroy($requisito)
    {
        $requisito = Requisito::findOrFail($requisito);
        $requisito->delete();
        return back()->with('mensaje', 'Eliminado Correctamente');
    }
}
