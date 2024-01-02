<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use App\Models\Docente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocentesController extends Controller
{
    // Ver los docentes
    public function index()
    {
        return view('docentes.index');
    }

    // Interface para crear un docente
    public function create()
    {
        return view('docentes.create');
    }

    // Guardar un docente
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:150',
            'apellido' => 'required|string|max:150',
            'honorifico' => 'required|string|max:10',
            'correo' => 'required|email|unique:docentes,correo',
            'telefono' => 'required|string|max:10',
            'cedula' => 'required|string|max:10',
            'facturacion' => 'required',
            'foto' => 'image',
            'cv' => 'file|mimes:pdf'
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
            'correo.required' => 'El correo es requerido',
            'correo.email' => 'El correo debe ser un correo electrónico',
            'correo.unique' => 'El correo ya existe',
            'telefono.required' => 'El teléfono es requerido',
            'telefono.string' => 'El teléfono debe ser una cadena de texto',
            'foto.image' => 'La foto debe ser una imagen',
            'cv.file' => 'El CV debe ser un archivo',
        ]);
        if ($request->hasFile('foto'))
            $dir_foto = 'storage/' .  $request->file('foto')->store('docentes/fotos', 'public');
        if ($request->hasFile('cv'))
            $dir_cv = 'storage/' . $request->file('cv')->store('docentes/cvs', 'public');
        $data = [
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'honorifico' => $request->honorifico,
            'cedula' => $request->cedula,
            'facturacion' => $request->facturacion,
            'correo' => $request->correo,
            'telefono' => $request->telefono,
            'foto' => $dir_foto ?? 'person_default.webp',
            'cv' =>  $dir_cv ?? '',
        ];
        Docente::create($data);
        return redirect()->route('docentes.index');
    }

    // Ver los detalles de un docente
    public function show($id)
    {
        $docente = Docente::findOrFail($id);
        $contratos = Contrato::join('modulos', 'modulos.id', '=', 'contratos.modulo_id')
            ->join('docentes', 'docentes.id', '=', 'modulos.docente_id')
            ->select("contratos.*")
            ->where('docente_id', $id)->get();
        return view('docentes.show', compact('docente', 'contratos'));
    }

    // Interface de edición de un docente
    public function edit($id)
    {
        $docente = Docente::findOrFail($id);
        return view('docentes.edit', compact('docente'));
    }

    // Actualizar un docente
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:150',
            'apellido' => 'required|string|max:150',
            'telefono' => 'required|string|max:10',
            'correo' => 'required|email|unique:docentes,correo,' . $id,
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
            'correo.required' => 'El correo es requerido',
            'correo.email' => 'El correo debe ser un correo electrónico',
            'correo.unique' => 'El correo ya existe',
            'telefono.required' => 'El teléfono es requerido',
            'telefono.string' => 'El teléfono debe ser una cadena de texto',
        ]);
        $data = [
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'honorifico' => $request->honorifico,
            'cedula' => $request->cedula,
            'facturacion' => $request->facturacion,
            'correo' => $request->correo,
            'telefono' => $request->telefono,
        ];
        $docente = Docente::findOrFail($id);
        if ($request->hasFile('foto')) {
            $dir_foto =  $request->file('foto')->store('docentes/fotos', 'public');
            if ($docente->foto != 'person_default.webp')
                Storage::disk('public')->delete($docente->foto);
            $data['foto'] = 'storage/' . $dir_foto;
        }
        if ($request->hasFile('cv')) {
            $dir_cv =  $request->file('cv')->store('docentes/cvs', 'public');
            Storage::disk('public')->delete($docente->cv);
            $data['cv'] = 'storage/' . $dir_cv;
        }
        $docente->update($data);
        return redirect()->route('docentes.show', $docente->id);
    }

    // Eliminar un docente
    public function destroy($id)
    {
        if (Docente::findOrFail($id)->foto != 'person_default.webp')
            Storage::disk('public')->delete(Docente::findOrFail($id)->foto);
        $docente = Docente::findOrFail($id);
        $docente->delete();
        return redirect()->route('docentes.index');
    }
}
