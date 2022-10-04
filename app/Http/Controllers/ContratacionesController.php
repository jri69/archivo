<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContratacionesController extends Controller
{
    // estructura de controller
    public function index()
    {
        return view('contrataciones.index');
    }

    public function create()
    {
        return view('contrataciones.create');
    }

    public function store(Request $request)
    {
        return redirect()->route('contrataciones.index');
    }

    public function show($id)
    {
        return view('contrataciones.show');
    }

    public function edit($id)
    {
        return view('contrataciones.edit');
    }

    public function update(Request $request, $id)
    {
        return redirect()->route('contrataciones.index');
    }

    public function destroy($id)
    {
        return view('contrataciones.destroy');
    }
}
