<?php

namespace App\Http\Controllers;

use App\Models\Tic;
use Illuminate\Http\Request;

class TicController extends Controller
{
    // Ver el inventario
    public function index()
    {
        return view('tic.index');
    }

    // Interface para crear un inventario
    public function create()
    {
        return view('tic.create');
    }

    // Guardar un inventario
    public function store(Request $request)
    {
        $request->validate(
            [
                'nombre' => 'required|string|max:150',
                'estado' => 'required|string|regex:/^[\pL\s\-]+$/u|max:100',
                'tipo' => 'required|string|regex:/^[\pL\s\-]+$/u|max:100',
                'modelo' => 'required|string|max:150',
                'cantidad' => 'required|numeric',
            ],
            [
                'nombre.required' => 'El campo nombre es obligatorio',
                'nombre.string' => 'El campo nombre debe ser de tipo texto',
                'nombre.max' => 'El campo nombre debe contener maximo 150 caracteres',
                'estado.required' => 'El campo estado es obligatorio',
                'estado.string' => 'El campo estado debe ser de tipo texto',
                'estado.regex' => 'El campo estado solo debe contener letras',
                'estado.max' => 'El campo estado debe contener maximo 100 caracteres',
                'tipo.required' => 'El campo tipo es obligatorio',
                'tipo.string' => 'El campo tipo debe ser de tipo texto',
                'tipo.regex' => 'El campo tipo solo debe contener letras',
                'tipo.max' => 'El campo tipo debe contener maximo 100 caracteres',
                'modelo.required' => 'El campo modelo es obligatorio',
                'modelo.string' => 'El campo modelo debe ser de tipo texto',
                'modelo.max' => 'El campo modelo debe contener maximo 150 caracteres',
                'cantidad.required' => 'El campo cantidad es obligatorio',
                'cantidad.numeric' => 'El campo cantidad debe ser de tipo numerico',
            ]
        );
        $producto = Tic::create($request->all());
        return redirect()->route('tic.index', $producto);
    }

    // Interface de edición de un tic
    public function edit(Tic $tic)
    {
        return view('tic.edit', compact('tic'));
    }

    // Actualizar un tic
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'nombre' => 'required|string|max:150',
                'estado' => 'required|string|regex:/^[\pL\s\-]+$/u|max:100',
                'tipo' => 'required|string|regex:/^[\pL\s\-]+$/u|max:100',
                'modelo' => 'required|string|max:150',
                'cantidad' => 'required|numeric',
            ],
            [
                'nombre.required' => 'El campo nombre es obligatorio',
                'nombre.string' => 'El campo nombre debe ser de tipo texto',
                'nombre.regex' => 'El campo nombre solo debe contener letras',
                'nombre.max' => 'El campo nombre debe contener maximo 150 caracteres',
                'estado.required' => 'El campo estado es obligatorio',
                'estado.string' => 'El campo estado debe ser de tipo texto',
                'estado.regex' => 'El campo estado solo debe contener letras',
                'estado.max' => 'El campo estado debe contener maximo 100 caracteres',
                'tipo.required' => 'El campo tipo es obligatorio',
                'tipo.string' => 'El campo tipo debe ser de tipo texto',
                'tipo.regex' => 'El campo tipo solo debe contener letras',
                'tipo.max' => 'El campo tipo debe contener maximo 100 caracteres',
                'modelo.required' => 'El campo modelo es obligatorio',
                'modelo.string' => 'El campo modelo debe ser de tipo texto',
                'modelo.max' => 'El campo modelo debe contener maximo 150 caracteres',
                'cantidad.required' => 'El campo cantidad es obligatorio',
                'cantidad.numeric' => 'El campo cantidad debe ser de tipo numerico',
            ]
        );
        $producto = Tic::findOrFail($id);
        $producto->update($request->all());
        return redirect()->route('tic.index');
    }

    // Eliminar un tic
    public function destroy($requisito)
    {
        $requisito = Tic::findOrFail($requisito);
        $requisito->delete();
        return redirect()->route('tic.index');
    }
}
