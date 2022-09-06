<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use App\Models\MovimientoDoc;
use App\Models\Recepcion;
use App\Models\UnidadOrganizacional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RecepcionController extends Controller
{
    public function index()
    {
        return view('recepcion.index');
    }

    public function create()
    {
        $unidades = UnidadOrganizacional::all();
        return view('recepcion.create', compact('unidades'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|unique:recepcions',
            'fecha' => 'required|date',
            'departamento' => 'required|regex:/^[\pL\s\-]+$/u',
            'descripcion' => 'required',
            'unidad_organizativa_id' => 'required',
            'tipo' => 'required|regex:/^[\pL\s\-]+$/u',
        ]);
        $recepcion = Recepcion::create([
            'codigo' => $request->codigo,
            'fecha' => $request->fecha,
            'departamento' => $request->departamento,
            'descripcion' => $request->descripcion,
            'unidad_organizativa_id' => $request->unidad_organizativa_id,
            'user_id' => auth()->user()->id,
        ]);
        foreach ($request->documento as $archivo) {
            $filename = $archivo->getClientOriginalName();
            $dir = Storage::disk('public')->put('Recepcion', $archivo);
            Documento::create([
                'nombre' => $filename,
                'dir' => $dir,
                'tipo' => $request->tipo,
                'recepcion_id' => $recepcion->id,
            ]);
        }
        return redirect()->route('recepcion.index', $recepcion);
    }

    public function show($id)
    {
        $recepcion = Recepcion::find($id);
        $movimientos = MovimientoDoc::where('recepcion_id', $id)->get();
        return view('recepcion.show', compact('recepcion', 'movimientos'));
    }

    public function edit($id)
    {
        $recepcion = Recepcion::find($id);
        $unidades = UnidadOrganizacional::all();
        return view('recepcion.edit', compact('recepcion', 'unidades'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'fecha' => 'required|date',
            'departamento' => 'required|regex:/^[\pL\s\-]+$/u',
            'descripcion' => 'required',
            'unidad_organizativa_id' => 'required',
        ]);
        $recepcion = Recepcion::find($id);
        $recepcion->update([
            'fecha' => $request->fecha,
            'departamento' => $request->departamento,
            'descripcion' => $request->descripcion,
            'unidad_organizativa_id' => $request->unidad_organizativa_id,
            'user_id' => auth()->user()->id,
        ]);
        if ($request->documento) {
            foreach ($request->documento as $archivo) {
                $filename = $archivo->getClientOriginalName();
                $dir = Storage::disk('public')->put('Recepcion', $archivo);
                Documento::create([
                    'nombre' => $filename,
                    'dir' => $dir,
                    'tipo' => $request->tipo,
                    'recepcion_id' => $recepcion->id,
                ]);
            }
        }

        return redirect()->route('recepcion.index', $recepcion);
    }

    public function destroy($id)
    {
        //
    }
}
