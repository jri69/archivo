<?php

namespace App\Http\Controllers;

use App\Models\Administrativo;
use App\Models\Cargo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdministrativoController extends Controller
{
    // Ver los administrativos
    public function index()
    {
        return view('administrativo.index');
    }

    // Interface para crear un administrativo
    public function create()
    {
        $cargos = Cargo::all();
        return view('administrativo.create', compact('cargos'));
    }

    // Guardar un administrativo
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:150',
            'apellido' => 'required|string|max:150',
            'ci' => 'required|string|max:10',
            'expedicion' => 'required',
            'contrato' => 'required',
            'cargo_id' => 'required',
            'fecha_ingreso' => 'required',
            'fecha_retiro' => 'nullable|date',
            'sueldo' => 'required|numeric',
            'foto' => 'required|image',
        ], [
            'nombre.required' => 'El nombre es requerido',
            'nombre.string' => 'El nombre debe ser una cadena de texto',
            'nombre.max' => 'El nombre debe tener máximo 150 caracteres',
            'apellido.required' => 'El apellido es requerido',
            'apellido.string' => 'El apellido debe ser una cadena de texto',
            'apellido.max' => 'El apellido debe tener máximo 150 caracteres',
            'ci.required' => 'La cédula es requerida',
            'ci.string' => 'La cédula debe ser una cadena de texto',
            'ci.max' => 'La cédula debe tener máximo 10 caracteres',
            'expedicion.required' => 'La expedicion es requerida',
            'contrato.required' => 'El tipo de contrato es requerido',
            'cargo_id.required' => 'El Cargo es requerido',
            'fecha_ingreso.required' => 'La fecha de ingreso es requerida',
            'sueldo.required' => 'El sueldo es requerido',
            'sueldo.numeric' => 'El sueldo debe ser un número',
            'foto.required' => 'La foto es requerida',
            'foto.image' => 'La foto debe ser una imagen',
        ]);

        $dir_foto =  $request->file('foto')->store('administrativos/fotos', 'public');
        $data = [
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'ci' => $request->ci,
            'expedicion' => $request->expedicion,
            'contrato' => $request->contrato,
            'cargo_id' => $request->cargo_id,
            'fecha_ingreso' => $request->fecha_ingreso,
            'fecha_retiro' => $request->fecha_retiro,
            'sueldo' => $request->sueldo,
            'foto' => 'storage/' . $dir_foto,
        ];
        Administrativo::create($data);
        return redirect()->route('administrativo.index');
    }

    // Ver los detalles de un administrativo
    public function show($id)
    {
        // $docente = Docente::findOrFail($id);
        // $contratos = Contrato::join('modulos', 'modulos.id', '=', 'contratos.modulo_id')
        //     ->join('administrativo', 'administrativo.id', '=', 'modulos.docente_id')
        //     ->where('docente_id', $id)->get();
        // return view('administrativo.show', compact('docente', 'contratos'));
    }

    // Interface de edición de un administrativo
    public function edit($id)
    {
        $administrativo = Administrativo::find($id);
        $cargos = Cargo::all();
        return view('administrativo.edit', compact('administrativo', 'cargos'));
    }

    // Actualizar un administrativo
    public function update(Request $request, $id)
    {
        $administrativo = Administrativo::find($id);
        $request->validate([
            'nombre' => 'required|string|max:150',
            'apellido' => 'required|string|max:150',
            'ci' => 'required|string|max:10',
            'expedicion' => 'required',
            'contrato' => 'required',
            'cargo_id' => 'required',
            'fecha_ingreso' => 'required',
            'fecha_retiro' => 'nullable|date',
            'sueldo' => 'required|numeric',
            'foto' => 'nullable|image',
        ], [
            'nombre.required' => 'El nombre es requerido',
            'nombre.string' => 'El nombre debe ser una cadena de texto',
            'nombre.max' => 'El nombre debe tener máximo 150 caracteres',
            'apellido.required' => 'El apellido es requerido',
            'apellido.string' => 'El apellido debe ser una cadena de texto',
            'apellido.max' => 'El apellido debe tener máximo 150 caracteres',
            'ci.required' => 'La cédula es requerida',
            'ci.string' => 'La cédula debe ser una cadena de texto',
            'ci.max' => 'La cédula debe tener máximo 10 caracteres',
            'expedicion.required' => 'La expedicion es requerida',
            'contrato.required' => 'El tipo de contrato es requerido',
            'cargo_id.required' => 'El Cargo es requerido',
            'fecha_ingreso.required' => 'La fecha de ingreso es requerida',
            'sueldo.required' => 'El sueldo es requerido',
            'sueldo.numeric' => 'El sueldo debe ser un número',
            'foto.image' => 'La foto debe ser una imagen',
        ]);

        $data = [
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'ci' => $request->ci,
            'expedicion' => $request->expedicion,
            'contrato' => $request->contrato,
            'cargo_id' => $request->cargo_id,
            'fecha_ingreso' => $request->fecha_ingreso,
            'fecha_retiro' => $request->fecha_retiro,
            'sueldo' => $request->sueldo,
        ];
        if ($request->foto) {
            Storage::delete($administrativo->foto);
            $dir_foto =  $request->file('foto')->store('administrativos/fotos', 'public');
            $data['foto'] = 'storage/' . $dir_foto;
        }
        $administrativo->update($data);
        return redirect()->route('administrativo.index');
    }

    // Eliminar un administrativo
    public function destroy($id)
    {
        $administrativo = Administrativo::find($id);
        $administrativo->delete();
        return redirect()->route('administrativo.index');
    }
}
