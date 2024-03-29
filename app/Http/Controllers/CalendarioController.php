<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\ProgramaCalendar;
use Illuminate\Http\Request;

class CalendarioController extends Controller
{
    public function index()
    {
        return view('calendar');
    }

    public function doctorados()
    {
        $programas = ProgramaCalendar::where('tipo', 'Doctorado')->get();
        return response()->json($programas);
    }

    public function maestrias()
    {
        $programas = ProgramaCalendar::where('tipo', 'Maestria')->get();
        return response()->json($programas);
    }

    public function especialidades()
    {
        $programas = ProgramaCalendar::where('tipo', 'Especialidad')->get();
        return response()->json($programas);
    }

    public function diplomados()
    {
        $programas = ProgramaCalendar::where('tipo', 'Diplomado')->get();
        return response()->json($programas);
    }

    public function cursos()
    {
        $programas = ProgramaCalendar::where('tipo', 'Cursos')->get();
        return response()->json($programas);
    }

    public function otros()
    {
        $programas = ProgramaCalendar::where('tipo', 'Sin tipo')->get();
        return response()->json($programas);
    }

    public function inicio()
    {
        $ver = request('ver');
        if ($ver == 'Modulo') {
            $programas = ProgramaCalendar::where('tipo_fecha', 'inicio')
                ->where('tipo', 'Modulo')->get();
            return response()->json($programas);
        } else if ($ver == 'Programa') {
            // obtener parametros de la url para filtrar
            if (request('tipo')) {
                request('tipo') ? $tipo = request('tipo') : '';
                $programas = ProgramaCalendar::where('tipo_fecha', 'inicio')
                    ->where('tipo', $tipo)->get();
                return response()->json($programas);
            } else {
                $programas = ProgramaCalendar::where('tipo_fecha', 'inicio')->where('tipo', '!=', 'Modulo')->where('tipo', '!=', 'Evento')->get();
                return response()->json($programas);
            }
        }
    }

    public function finalizado()
    {
        $ver = request('ver');
        if ($ver == 'Modulo') {
            $programas = ProgramaCalendar::where('tipo_fecha', 'final')
                ->where('tipo', 'Modulo')->get();
            return response()->json($programas);
        } else if ($ver == 'Programa') {
            // obtener parametros de la url para filtrar
            if (request('tipo')) {
                request('tipo') ? $tipo = request('tipo') : $tipo = '';
                $programas = ProgramaCalendar::where('tipo_fecha', 'final')
                    ->where('tipo', $tipo)->get();
                return response()->json($programas);
            } else {
                $programas = ProgramaCalendar::where('tipo_fecha', 'final')->where('tipo', '!=', 'Modulo')->where('tipo', '!=', 'Evento')->get();
                return response()->json($programas);
            }
        }
    }

    public function eventos()
    {
        $eventos = ProgramaCalendar::where('tipo', 'Evento')->get();
        return response()->json($eventos);
    }
}
