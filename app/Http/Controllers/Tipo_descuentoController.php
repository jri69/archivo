<?php

namespace App\Http\Controllers;

use App\Models\tipo_descuento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\isNull;

class Tipo_descuentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $descuentos = tipo_descuento::orderBy('id', 'asc')->paginate(10);
        return view('tipo_descuento.index', compact('descuentos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tipo_descuento.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'nombre' => 'required',
            'monto' => 'required',

        ]);
        if (isNull($request->hasFile('archivo'))) {
            $archivo = 'null';
        }
        if ($request->hasFile('archivo')) {
            $file = $request->file('archivo')->store('public/archivos');
            $archivo = Storage::url($file);
        }

        tipo_descuento::create([
            'nombre' => $request->nombre,
            'monto' => $request->monto,
            'archivo' => $archivo
        ]);

        return redirect()->route('descuento.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(tipo_descuento $descuento)
    {
        return view('tipo_descuento.edit', compact('descuento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
            'monto' => 'required'
        ]);
        if (isNull($request->hasFile('archivo'))) {
            $archivo = 'null';
        }
        if ($request->hasFile('archivo')) {
            $file = $request->file('archivo')->store('public/archivos');
            $archivo = Storage::url($file);
        }

        $descuento = tipo_descuento::findOrFail($id);
        $descuento->nombre = $request['nombre'];
        $descuento->monto = $request['monto'];
        $descuento->archivo = $archivo;
        $descuento->save();
        return redirect()->route('descuento.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
