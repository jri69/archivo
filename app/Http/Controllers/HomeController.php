<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\Modulo;
use App\Models\Programa;
use Illuminate\Support\Facades\DB;

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
        return view('dashboard', compact('estudiantes', 'programas_finalizado', 'programas_cursos', 'modulos', 'cal_docente'));
    }
}
