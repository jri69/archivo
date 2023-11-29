<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\Evento;
use App\Models\Modulo;
use App\Models\NotasPrograma;
use App\Models\Programa;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $now = now();
        $now = $now->format('Y-m-d');
        $estudiantes = Estudiante::where('estado', 'Activo')->get()->count();
        // $programas_finalizado = Programa::where('fecha_finalizacion', '<', $now)->get()->count();
        $modulos_finalizados = Modulo::where('fecha_final', '<', $now)->get()->count();
        $programas_cursos = Programa::where('fecha_finalizacion', '>=', $now)->get()->count();
        $modulos = Modulo::where('fecha_final', '>=', $now)->get()->count();
        $fecha = now()->addDays(7);
        $eventos = Evento::where('fecha_inicio', '>=', $now)->where('fecha_final', '<=', $fecha)->where('hora', '>=', now()->format('H:m:s'))->limit(4)->get();
        $cal_docente = DB::table('modulos')
            ->join('docentes', 'modulos.docente_id', 'docentes.id')
            ->select('docentes.honorifico', 'docentes.nombre', 'docentes.apellido', 'docentes.id', DB::raw('avg(cal_docente) as promedio'))
            ->groupBy('docentes.id')
            ->orderBy('promedio', 'desc')
            ->take(5)
            ->get();
        $programas = Programa::where('has_grafica', '=', 'Si')->get();
        $cantidad = [];
        $nombres = [];
        foreach ($programas as $programa) {
            $modulosP = Modulo::where('programa_id', $programa->id)->get();
            if (count($modulosP) == 0) {
                continue;
            }
            $first = 0;
            $last = 0;
            $first_modulo = $modulosP->first();
            $estudiantesM = NotasPrograma::join('estudiantes', 'estudiantes.id', 'notas_programas.id_estudiante')
                ->select('estudiantes.*', 'notas_programas.*')
                ->where('estudiantes.estado', 'Activo')
                ->where('id_modulo', $first_modulo->id)->get();
            $first = $estudiantesM->count();
            $ultimo_modulo = $modulosP->last();
            $estudiantesM = NotasPrograma::join('estudiantes', 'estudiantes.id', 'notas_programas.id_estudiante')
                ->select('estudiantes.*', 'notas_programas.*')
                ->where('estudiantes.estado', 'Activo')
                ->where('id_modulo', $ultimo_modulo->id)->get();
            $last = $estudiantesM->count();
            $retirados = $first - $last;
            $first == 0 ? $first = 1 : $first;
            $indice = $retirados * 100 / $first;
            $cantidad[] = $indice;
            $nombres[] = $programa->sigla . ' ' . $programa->version . '.' . $programa->edicion;
        }
        return view('dashboard', compact('estudiantes', 'eventos', 'modulos_finalizados', 'programas_cursos', 'modulos', 'cal_docente', 'nombres', 'cantidad'));
    }
}
