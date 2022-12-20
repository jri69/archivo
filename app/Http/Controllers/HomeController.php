<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\EstudianteModulo;
use App\Models\Modulo;
use App\Models\NotasPrograma;
use App\Models\Programa;
use Illuminate\Support\Facades\DB;

use function PHPSTORM_META\map;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $estudiantes = Estudiante::all()->count();
        $programas_finalizado = Programa::where('fecha_finalizacion', '>=', now())->get()->count();
        $programas_cursos = Programa::where('fecha_finalizacion', '<=', now())->get()->count();
        $modulos = Modulo::where('fecha_final', '<=', now())->get()->count();
        // agrupar por cal_docente los mejores promedios de docentes en los modulos los 10 primeros
        $cal_docente = DB::table('modulos')
            ->join('docentes', 'modulos.docente_id', 'docentes.id')
            ->select('docentes.honorifico', 'docentes.nombre', 'docentes.apellido', 'docentes.id', DB::raw('avg(cal_docente) as promedio'))
            ->groupBy('docentes.id')
            ->orderBy('promedio', 'desc')
            ->take(5)
            ->get();

        // Grafica
        $programas = Programa::where('has_grafica', '=', 'Si')->get();
        // dd($programas);
        $cantidad = [];
        $nombres = [];
        foreach ($programas as $programa) {
            $modulosP = Modulo::where('programa_id', $programa->id)->get();
            $first = 0;
            $last = 0;
            // obtener el primer modulo
            $first_modulo = $modulosP->first();
            // dd($first_modulo);
            $estudiantesM = NotasPrograma::join('estudiantes', 'estudiantes.id', 'notas_programas.id_estudiante')
                ->select('estudiantes.*', 'notas_programas.*')
                ->where('estudiantes.estado', 'Activo')
                ->where('id_modulo', $first_modulo->id)->get();
            $first = $estudiantesM->count();
            // dd($first);
            // obtener el ultimo modulo
            $ultimo_modulo = $modulosP->last();
            // dd($ultimo_modulo);
            $estudiantesM = NotasPrograma::join('estudiantes', 'estudiantes.id', 'notas_programas.id_estudiante')
                ->select('estudiantes.*', 'notas_programas.*')
                ->where('estudiantes.estado', 'Activo')
                ->where('id_modulo', $ultimo_modulo->id)->get();
            $last = $estudiantesM->count();
            // dd($last);

            $retirados = $first - $last;
            // dd($retirados);
            $indice = $retirados * 100 / $first;
            $cantidad[] = $indice;
            $nombres[] = $programa->nombre;
        }
        // dd($nombres, $cantidad);
        return view('dashboard', compact('estudiantes', 'programas_finalizado', 'programas_cursos', 'modulos', 'cal_docente', 'nombres', 'cantidad'));
    }
}
