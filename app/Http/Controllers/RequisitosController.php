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
        $request->validate(
            [
                'nombre' => 'required|string|regex:/^[\pL\s\-]+$/u|max:255',
                'importancia' => 'required|string|regex:/^[\pL\s\-]+$/u|max:255',
            ],
            [
                'nombre.required' => 'El campo nombre es obligatorio',
                'nombre.string' => 'El campo nombre debe ser de tipo texto',
                'nombre.regex' => 'El campo nombre solo debe contener letras',
                'nombre.max' => 'El campo nombre debe contener maximo 255 caracteres',
                'importancia.required' => 'El campo importancia es obligatorio',
                'importancia.string' => 'El campo importancia debe ser de tipo texto',
                'importancia.regex' => 'El campo importancia solo debe contener letras',
                'importancia.max' => 'El campo importancia debe contener maximo 255 caracteres',
            ]
        );
        $requisito = Requisito::create($request->all());
        return redirect()->route('requisito.index', $requisito);
    }

    public function edit(Requisito $requisito)
    {
        return view('requisitos.edit', compact('requisito'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'nombre' => 'required|string|regex:/^[\pL\s\-]+$/u|max:255',
                'importancia' => 'required|string|regex:/^[\pL\s\-]+$/u|max:255',
            ],
            [
                'nombre.required' => 'El campo nombre es obligatorio',
                'nombre.string' => 'El campo nombre debe ser de tipo texto',
                'nombre.regex' => 'El campo nombre solo debe contener letras',
                'nombre.max' => 'El campo nombre debe contener maximo 255 caracteres',
                'importancia.required' => 'El campo importancia es obligatorio',
                'importancia.string' => 'El campo importancia debe ser de tipo texto',
                'importancia.regex' => 'El campo importancia solo debe contener letras',
                'importancia.max' => 'El campo importancia debe contener maximo 255 caracteres',
            ]
        );
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
