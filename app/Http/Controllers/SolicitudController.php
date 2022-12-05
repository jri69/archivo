<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use Illuminate\Http\Request;

class SolicitudController extends Controller
{
    // Ver las Solicitudes
    public function index()
    {
        return view('solicitud.index');
    }

    // Interface para crear una Solicitud
    public function create()
    {
        return view('solicitud.create');
    }

    // Guardar una Solicitud
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
        $producto = Solicitud::create($request->all());
        return redirect()->route('Solicitud.index', $producto);
    }

    // Interface de edición de una Solicitud
    public function edit(Solicitud $Solicitud)
    {
        return view('solicitud.edit', compact('Solicitud'));
    }

    // Actualizar un Solicitud
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
        $producto = Solicitud::findOrFail($id);
        $producto->update($request->all());
        return redirect()->route('solicitud.index');
    }

    // Eliminar un Solicitud
    public function destroy($requisito)
    {
        $requisito = Solicitud::findOrFail($requisito);
        $requisito->delete();
        return redirect()->route('solicitud.index');
    }
}
