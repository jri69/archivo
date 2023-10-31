<?php

namespace App\Http\Controllers;

use App\Models\Universidad;
use Illuminate\Http\Request;

class UniversidadController extends Controller
{

    public function index()
    {
        return view('universidades.index');
    }

    public function create()
    {
        return view('universidades.create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'nombre' => 'required|unique:universidads,nombre',
            ],
            [
                'nombre.required' => 'El campo nombre es obligatorio',
                'nombre.unique' => 'El nombre de la universidad ya existe',
            ]
        );
        $universidad = Universidad::create($request->all());
        return redirect()->route('universidad.index');
    }

    public function destroy(Universidad $universidad)
    {
        $universidad->delete();
        return redirect()->route('universidad.index');
    }
}
