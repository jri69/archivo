<?php

namespace App\Http\Controllers;

use App\Models\Recepcion;
use App\Models\User;
use App\Models\Usuario;
use Illuminate\Http\Request;

class MovimientoController extends Controller
{

    public function index()
    {
        return view('movimiento.index');
    }

    public function create($id_recepcion)
    {
        $recepcion = Recepcion::find($id_recepcion);
        return view('movimiento.create', compact('recepcion'));
    }

    public function store(Request $request)
    {
        if ($request->codigo) {
            $request->validate([
                'recepcion_id' => 'required',
                'user_id' => 'required',
                'fecha' => 'required',
                'departamento' => 'required',
                'codigo' => 'required',
                'tipo' => 'required',
                'documento.*' => 'required',
            ], [
                'recepcion_id.required' => 'El campo recepcion es obligatorio',
                'user_id.required' => 'El campo usuario es obligatorio',
                'fecha.required' => 'El campo fecha es obligatorio',
                'departamento.required' => 'El campo departamento es obligatorio',
                'codigo.required' => 'El campo codigo es obligatorio',
                'tipo.required' => 'El campo tipo es obligatorio',
                'documento.*.required' => 'El campo documento es obligatorio',
            ]);
        } else {
            $request->validate([
                'recepcion_id' => 'required',
                'user_id' => 'required',
                'fecha' => 'required',
                'departamento' => 'required',
            ], [
                'recepcion_id.required' => 'El campo recepcion es obligatorio',
                'user_id.required' => 'El campo usuario es obligatorio',
                'fecha.required' => 'El campo fecha es obligatorio',
                'departamento.required' => 'El campo departamento es obligatorio',
            ]);
        }
    }
}
