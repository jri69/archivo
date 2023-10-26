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
        $carrera = Carrera::create($request->all());
        return redirect()->route('carreras.index');
    }

    public function destroy(Carrera $carrera)
    {
        $carrera->delete();
        return redirect()->route('carreras.index');
    }
}
