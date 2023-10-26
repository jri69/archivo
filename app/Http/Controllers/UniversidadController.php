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
        $universidad = Universidad::create($request->all());
        return redirect()->route('universidad.index');
    }

    public function destroy(Universidad $universidad)
    {
        $universidad->delete();
        return redirect()->route('universidad.index');
    }
}
