<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use Illuminate\Http\Request;

class CarreraController extends Controller
{

    public function index()
    {
        return view('carreras.index');
    }

    public function create()
    {
        return view('carreras.create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'nombre' => 'required|unique:carreras,nombre',
            ],
            [
                'nombre.required' => 'El campo nombre es obligatorio',
                'nombre.unique' => 'El nombre de la carrera ya existe',
            ]
        );
        $carrera = Carrera::create($request->all());
        return redirect()->route('carreras.index');
    }

    public function destroy(Carrera $carreras)
    {
        $carreras->delete();
        return redirect()->route('carreras.index');
    }
}
