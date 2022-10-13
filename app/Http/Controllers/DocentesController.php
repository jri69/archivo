<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use App\Models\Docente;
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

        Docente::create($request->all());
        return redirect()->route('docentes.index');
    }

    public function show($id)
    {
        $docente = Docente::find($id);
        $contratos = Contrato::join('modulos', 'modulos.id', '=', 'contratos.modulo_id')
            ->join('docentes', 'docentes.id', '=', 'modulos.docente_id')
            ->where('docente_id', $id)->get();
        return view('docentes.show', compact('docente', 'contratos'));
    }

    public function edit($id)
    {
        $docente = Docente::find($id);
        return view('docentes.edit', compact('docente'));
    }

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
        $docente = Docente::find($id);
        $docente->update($request->all());
        return redirect()->route('docentes.show', $docente->id);
    }

    public function destroy($id)
    {
        $docente = Docente::find($id);
        $docente->delete();
        return redirect()->route('docentes.index');
    }
}