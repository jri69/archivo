<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\ProgramaCalendar;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;

class EventoController extends Controller
{
    // Ver los administrativos
    public function index()
    {
        return view('eventos.index');
    }

    // Interface para crear un administrativo
    public function create()
    {
        return view('eventos.create');
    }

    // Guardar un administrativo
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string',
            'lugar' => 'required|string',
            'encargado' => 'required|string',
            'fecha' => 'date|required',
            'hora' => 'required',
        ], [
            'titulo.required' => 'El titulo es requerido',
            'lugar.required' => 'El lugar es requerido',
            'encargado.required' => 'El encargado es requerido',
            'fecha.required' => 'La fecha es requerida',
            'hora.required' => 'La hora es requerida',
        ]);
        $evento = Evento::create($request->all());
        ProgramaCalendar::create([
            'title' => $evento->titulo,
            'start' => $evento->fecha,
            'end' => $evento->fecha,
            'tipo_fecha' => 'inicio',
            'tipo' => 'Evento',
            'evento_id' => $evento->id,
            'lugar' => $evento->lugar,
            'hora' =>  $evento->hora,
            'encargado' => $evento->encargado,
        ]);
        return redirect()->route('eventos.index');
    }

    // Interface de edición de un administrativo
    public function edit($id)
    {
        $evento = Evento::findOrFail($id);
        return view('eventos.edit', compact('evento'));
    }

    // Actualizar un administrativo
    public function update(Request $request, $id)
    {
        $request->validate([
            'titulo' => 'required|string',
            'lugar' => 'required|string',
            'encargado' => 'required|string',
            'fecha' => 'date|required',
            'hora' => 'required',
        ], [
            'titulo.required' => 'El titulo es requerido',
            'lugar.required' => 'El lugar es requerido',
            'encargado.required' => 'El encargado es requerido',
            'fecha.required' => 'La fecha es requerida',
            'hora.required' => 'La hora es requerida',
        ]);
        $evento = Evento::findOrFail($id);
        $evento->update($request->all());
        $calendar = ProgramaCalendar::where('evento_id', $evento->id)->first();
        $calendar->update([
            'title' => $request->titulo,
            'start' => $request->fecha,
            'end' => $request->fecha,
            'tipo_fecha' => 'inicio',
            'tipo' => 'Evento',
            'evento_id' => $evento->id,
        ]);
        return redirect()->route('eventos.index');
    }

    // Eliminar un administrativo
    public function destroy($id)
    {
        $evento = Evento::findOrFail($id);
        $calendario = ProgramaCalendar::where('evento_id', $evento->id)->first();
        $calendario->delete();
        $evento->delete();
        return redirect()->route('eventos.index');
    }
}
