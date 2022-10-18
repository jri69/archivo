<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('administrativo.create');
    }

    // Guardar un administrativo
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:150',
            'apellido' => 'required|string|max:150',
            'honorifico' => 'required|string|max:10',
            'cedula' => 'required|string|max:10',
            'facturacion' => 'required'
        ], [
            'nombre.required' => 'El nombre es requerido',
            'nombre.string' => 'El nombre debe ser una cadena de texto',
            'nombre.max' => 'El nombre debe tener máximo 150 caracteres',
            'apellido.required' => 'El apellido es requerido',
            'apellido.string' => 'El apellido debe ser una cadena de texto',
            'apellido.max' => 'El apellido debe tener máximo 150 caracteres',
            'honorifico.required' => 'El honorifico es requerido',
            'honorifico.string' => 'El honorifico debe ser una cadena de texto',
            'honorifico.max' => 'El honorifico debe tener máximo 10 caracteres',
            'cedula.required' => 'La cédula es requerida',
            'cedula.string' => 'La cédula debe ser una cadena de texto',
            'cedula.max' => 'La cédula debe tener máximo 10 caracteres',
            'facturacion.required' => 'La facturación es requerida',
        ]);
        //::create($request->all());
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
        // $docente = Docente::findOrFail($id);
        // return view('administrativo.edit', compact('docente'));
    }

    // Actualizar un administrativo
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:150',
            'apellido' => 'required|string|max:150',
            'honorifico' => 'required|string|max:10',
            'cedula' => 'required|string|max:10',
            'facturacion' => 'required'
        ], [
            'nombre.required' => 'El nombre es requerido',
            'nombre.string' => 'El nombre debe ser una cadena de texto',
            'nombre.max' => 'El nombre debe tener máximo 150 caracteres',
            'apellido.required' => 'El apellido es requerido',
            'apellido.string' => 'El apellido debe ser una cadena de texto',
            'apellido.max' => 'El apellido debe tener máximo 150 caracteres',
            'honorifico.required' => 'El honorifico es requerido',
            'honorifico.string' => 'El honorifico debe ser una cadena de texto',
            'honorifico.max' => 'El honorifico debe tener máximo 10 caracteres',
            'cedula.required' => 'La cédula es requerida',
            'cedula.string' => 'La cédula debe ser una cadena de texto',
            'cedula.max' => 'La cédula debe tener máximo 10 caracteres',
            'facturacion.required' => 'La facturación es requerida',
        ]);
        // $docente = Docente::findOrFail($id);
        // $docente->update($request->all());
        // return redirect()->route('administrativo.show', $docente->id);
    }

    // Eliminar un administrativo
    public function destroy($id)
    {
        // $docente = Docente::findOrFail($id);
        // $docente->delete();
        // return redirect()->route('administrativo.index');
    }
}
