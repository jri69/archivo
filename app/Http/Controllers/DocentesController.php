<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocentesController extends Controller
{
    public function index()
    {
        return view('docentes.index');
    }

    public function create()
    {
        return view('docentes.create');
    }

    public function store(Request $request)
    {
        return redirect()->route('docentes.index');
    }

    public function show($id)
    {
        return view('docentes.show');
    }

    public function edit($id)
    {
        return view('docentes.edit');
    }

    public function update(Request $request, $id)
    {
        return redirect()->route('docentes.index');
    }

    public function destroy($id)
    {
        return view('docentes.destroy');
    }
}
