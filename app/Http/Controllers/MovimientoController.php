<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use App\Models\MovimientoDoc;
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
    }

    public function show($id, $idRecepcion)
    {
        $movimiento = MovimientoDoc::find($id);
        $documento = Documento::where('movimiento_doc_id', $movimiento->id)->first();
        $recepcion = Recepcion::find($idRecepcion);
        return view('movimiento.show', compact('movimiento', 'recepcion', 'documento'));
    }

    public function confirmar($id, $idRecepcion)
    {
        $movimiento = MovimientoDoc::find($id);
        $movimiento->confirmacion = 'Confirmado';
        $movimiento->save();
        $recepcion = Recepcion::find($idRecepcion);
        $documento = Documento::where('movimiento_doc_id', $movimiento->id)->first();

        return view('movimiento.show', compact('movimiento', 'recepcion', 'documento'));
    }

    public function destroy($id)
    {
        $movimiento = MovimientoDoc::find($id);
        $movimiento->delete();
        return redirect()->route('recepcion.show', $movimiento->recepcion_id);
    }
}
