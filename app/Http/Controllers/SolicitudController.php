<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use App\Models\SolicitudInv;
use Illuminate\Http\Request;

class SolicitudController extends Controller
{
    // Ver las Solicitudes
    public function index()
    {
        return view('solicitud.index');
    }

    // Interface para crear una Solicitud
    public function create()
    {
        return view('solicitud.create');
    }

    public function show($id)
    {
        $solicitud = Solicitud::findOrFail($id);
        $detalles = SolicitudInv::where('solicitud_id', $id)->get();
        return view('solicitud.show', compact('solicitud', 'detalles'));
    }

    // Eliminar un Solicitud
    public function destroy($requisito)
    {
        $requisito = Solicitud::findOrFail($requisito);
        $requisito->delete();
        return redirect()->route('solicitud.index');
    }

    // Actualizar un Solicitud
    public function confirmar($id)
    {
        $solicitud = Solicitud::findOrFail($id);
        $solicitud->estado = 'Confirmado';
        $solicitud->save();
        return redirect()->route('solicitudes.show', $id);
    }
}
