<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\Modulo;
use App\Models\Programa;

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
        $programas = Programa::orderBy('created_at', 'desc')->paginate(10);
        return view('dashboard', compact('estudiantes', 'programas_finalizado', 'programas_cursos', 'modulos', 'programas'));
    }
}
