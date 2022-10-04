<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SueldosController extends Controller
{
    public function index()
    {
        return view('sueldos.index');
    }

    public function create()
    {
        return view('sueldos.create');
    }

    public function store(Request $request)
    {
        return redirect()->route('sueldos.index');
    }

    public function show($id)
    {
        return view('sueldos.show');
    }

    public function edit($id)
    {
        return view('sueldos.edit');
    }

    public function update(Request $request, $id)
    {
        return redirect()->route('sueldos.index');
    }

    public function destroy($id)
    {
        return view('sueldos.destroy');
    }
}
