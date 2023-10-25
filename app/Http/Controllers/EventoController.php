<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\ProgramaCalendar;
use App\Models\User;
use App\Models\Usuario;
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
        $encargados = Usuario::all();
        return view('eventos.create', compact('encargados'));
    }

    // Guardar un administrativo
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string',
            'lugar' => 'required|string',
            'encargado' => 'required|string',
            'fecha_inicio' => 'date|required',
            'fecha_final' => 'date|required',
            'hora' => 'required',
        ], [
            'titulo.required' => 'El titulo es requerido',
            'lugar.required' => 'El lugar es requerido',
            'encargado.required' => 'El encargado es requerido',
            'fecha_inicio.required' => 'La fecha de inicio es requerida',
            'fecha_final.required' => 'La fecha de finalizacion es requerida',
            'hora.required' => 'La hora es requerida',
        ]);
        $evento = Evento::create($request->all());

        $fechaInicio = new \DateTime($evento->fecha_inicio);
        $fechaFinal = new \DateTime($evento->fecha_final);
        $hora = new \DateTime($evento->hora);
        $fechaInicio = $fechaInicio->format('Y-m-d') . 'T' . $hora->format('H:i:s');
        $fechaFinal = $fechaFinal->format('Y-m-d') . 'T' . $hora->format('H:i:s');

        ProgramaCalendar::create([
            'title' => $evento->titulo,
            'start' => $fechaInicio,
            'end' => $fechaFinal,
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
        $encargados = Usuario::all();
        return view('eventos.edit', compact('evento', 'encargados'));
    }

    // Actualizar un administrativo
    public function update(Request $request, $id)
    {
        $request->validate([
            'titulo' => 'required|string',
            'lugar' => 'required|string',
            'encargado' => 'required|string',
            'fecha_inicio' => 'date|required',
            'fecha_final' => 'date|required',
            'hora' => 'required',
        ], [
            'titulo.required' => 'El titulo es requerido',
            'lugar.required' => 'El lugar es requerido',
            'encargado.required' => 'El encargado es requerido',
            'fecha_inicio.required' => 'La fecha de inicio es requerida',
            'fecha_final.required' => 'La fecha de finalizacion es requerida',
            'hora.required' => 'La hora es requerida',
        ]);
        $evento = Evento::findOrFail($id);
        $evento->update($request->all());

        $calendar = ProgramaCalendar::where('evento_id', $evento->id)->first();
        $fechaInicio = new \DateTime($evento->fecha_inicio);
        $fechaFinal = new \DateTime($evento->fecha_final);
        $hora = new \DateTime($evento->hora);
        $fechaInicio = $fechaInicio->format('Y-m-d') . 'T' . $hora->format('H:i:s');
        $fechaFinal = $fechaFinal->format('Y-m-d') . 'T' . $hora->format('H:i:s');

        $calendar->update([
            'title' => $request->titulo,
            'start' => $fechaInicio,
            'end' => $fechaFinal,
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
        if ($calendario)
            $calendario->delete();
        $evento->delete();
        return redirect()->route('eventos.index');
    }
}
