<?php

namespace App\Http\Controllers;

use App\Models\Detalle_Factura;
use Illuminate\Http\Request;

class DetalleFacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {

        $factura = Detalle_Factura::where('factura_id', '=', $id)->get();
        //return $factura;
        return view('detalle_factura.index', compact('factura', 'id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {

        return view('detalle_factura.create', compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {

        $request->validate([
            'primero' => 'required',
            'segundo' => 'required',
            'cantidad' => 'required',
            'detalle' => 'required',
            'precio_unitario' => 'required',
            'subtotal' => 'required'
        ]);

        Detalle_Factura::create([
            'factura_id' => $id,
            'primero' => $request->primero,
            'segundo' => $request->segundo,
            'tercero' => $request->tercero,
            'cuarto' => $request->cuarto,
            'quinto' => $request->quinto,
            'cantidad' => $request->cantidad,
            'detalle' => $request->detalle,
            'precio_unitario' => $request->precio_unitario,
            'subtotal' => $request->subtotal
        ]);
        return redirect()->route('detalle_factura.index', compact('id'));
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
    public function edit($id)
    {
        $detalle = Detalle_Factura::find($id);
        return view('detalle_factura.edit', compact('id', 'detalle'));
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
        $detalle_factura = Detalle_Factura::find($id);
        //return $detalle_factura;
        $request->validate([
            'primero' => 'required',
            'segundo' => 'required',
            'cantidad' => 'required',
            'detalle' => 'required',
            'precio_unitario' => 'required',
            'subtotal' => 'required'
        ]);

        $detalle_factura->primero = $request->primero;
        $detalle_factura->segundo = $request->segundo;
        $detalle_factura->tercero = $request->tercero;
        $detalle_factura->cuarto = $request->cuarto;
        $detalle_factura->quinto = $request->quinto;
        $detalle_factura->cantidad = $request->cantidad;
        $detalle_factura->detalle = $request->detalle;
        $detalle_factura->precio_unitario = $request->precio_unitario;
        $detalle_factura->subtotal = $request->subtotal;
        $detalle_factura->update();
        $id = $detalle_factura->factura_id;
        return redirect()->route('detalle_factura.index', compact('id'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $detalle_factura = Detalle_Factura::find($id);
        $detalle_factura->delete();
        return redirect()->route('detalle_factura.index', $id);
    }
}