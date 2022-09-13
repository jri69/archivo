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
        $request->validate(
            [
                'codigo' => 'required|unique:recepcions|max:255',
                'fecha' => 'required|date',
                'departamento' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
                'descripcion' => 'required|max:300',
                'unidad_organizativa_id' => 'required|numeric',
                'tipo' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
            ],
            [
                'codigo.required' => 'El campo codigo es obligatorio',
                'codigo.unique' => 'El codigo ya existe',
                'codigo.max' => 'El campo codigo debe contener maximo 255 caracteres',
                'fecha.required' => 'El campo fecha es obligatorio',
                'fecha.date' => 'El campo fecha debe ser de tipo fecha',
                'departamento.required' => 'El campo departamento es obligatorio',
                'departamento.regex' => 'El campo departamento solo debe contener letras',
                'departamento.max' => 'El campo departamento debe contener maximo 255 caracteres',
                'descripcion.required' => 'El campo descripcion es obligatorio',
                'descripcion.max' => 'El campo descripcion debe contener maximo 300 caracteres',
                'unidad_organizativa_id.required' => 'El campo unidad organizativa es obligatorio',
                'tipo.required' => 'El campo tipo es obligatorio',
                'tipo.regex' => 'El campo tipo solo debe contener letras',
                'tipo.max' => 'El campo tipo debe contener maximo 255 caracteres',
            ]
        );
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
            $dir = 'storage/' . Storage::disk('public')->put('Recepcion', $archivo);
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
        $movimientos = MovimientoDoc::where('recepcion_id', $id)->orderBy('id', 'desc')->get();
        $documento = Documento::where('recepcion_id', $id)->first();
        return view('recepcion.show', compact('recepcion', 'movimientos', 'documento'));
    }

    public function edit($id)
    {
        $recepcion = Recepcion::find($id);
        $unidades = UnidadOrganizacional::all();
        return view('recepcion.edit', compact('recepcion', 'unidades'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'fecha' => 'required|date',
                'departamento' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
                'descripcion' => 'required|max:300',
                'unidad_organizativa_id' => 'required|numeric',
            ],
            [
                'fecha.required' => 'El campo fecha es obligatorio',
                'fecha.date' => 'El campo fecha debe ser de tipo fecha',
                'departamento.required' => 'El campo departamento es obligatorio',
                'departamento.regex' => 'El campo departamento solo debe contener letras',
                'departamento.max' => 'El campo departamento debe contener maximo 255 caracteres',
                'descripcion.required' => 'El campo descripcion es obligatorio',
                'descripcion.max' => 'El campo descripcion debe contener maximo 300 caracteres',
                'unidad_organizativa_id.required' => 'El campo unidad organizativa es obligatorio',
                'unidad_organizativa_id.numeric' => 'El campo unidad organizativa debe ser numerico',
            ]
        );
        $recepcion = Recepcion::find($id);
        $recepcion->update([
            'fecha' => $request->fecha,
            'departamento' => $request->departamento,
            'descripcion' => $request->descripcion,
            'unidad_organizativa_id' => $request->unidad_organizativa_id,
            'user_id' => auth()->user()->id,
        ]);
        return redirect()->route('recepcion.index', $recepcion);
    }

    public function destroy($id)
    {
        $recepcion = Recepcion::find($id);
        $recepcion->delete();
        return redirect()->route('recepcion.index');
    }
}
