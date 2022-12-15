<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use App\Models\MovimientoDoc;
use App\Models\Recepcion;
use App\Models\User;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MovimientoController extends Controller
{
    // Ver los movimientos
    public function index()
    {
        return view('movimiento.index');
    }

    // Interface para crear un movimiento
    public function create($id_recepcion)
    {
        $recepcion = Recepcion::findOrFail($id_recepcion);
        return view('movimiento.create', compact('recepcion'));
    }

    // Ver detalles de un movimiento
    public function show($id, $idRecepcion)
    {
        $movimiento = MovimientoDoc::findOrFail($id);
        $documento = Documento::where('movimiento_doc_id', $movimiento->id)->first();
        $recepcion = Recepcion::findOrFail($idRecepcion);
        return view('movimiento.show', compact('movimiento', 'recepcion', 'documento'));
    }

    // Confirmar el recibo del documento
    public function confirmar($id, $idRecepcion)
    {
        $movimiento = MovimientoDoc::findOrFail($id);
        $movimiento->confirmacion = 'Confirmado';
        $movimiento->save();
        $recepcion = Recepcion::findOrFail($idRecepcion);
        $documento = Documento::where('movimiento_doc_id', $movimiento->id)->first();
        return view('movimiento.show', compact('movimiento', 'recepcion', 'documento'));
    }

    // Eliminar un movimiento
    public function destroy($id)
    {
        $movimiento = MovimientoDoc::findOrFail($id);
        $documento = Documento::where('movimiento_doc_id', $movimiento->id)->first();
        if ($documento) {
            $dir = substr($documento->dir, 8);
            Storage::disk('public')->delete($dir);
            $documento->delete();
        }
        $movimiento->delete();
        return redirect()->route('recepcion.show', $movimiento->recepcion_id);
    }
}
