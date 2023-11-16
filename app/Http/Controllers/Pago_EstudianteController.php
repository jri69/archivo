<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\EstudianteModulo;
use App\Models\EstudiantePrograma;
use App\Models\Modulo;
use App\Models\Pago;
use App\Models\Pago_estudiante;
use App\Models\Programa;
use App\Models\tipo_descuento;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Pago_EstudianteController extends Controller
{

    public function index()
    {
        return view('pago_estudiante.index');
    }

    public function create($estudiante)
    {
        $descuentos = tipo_descuento::all();
        $estudiante = Estudiante::findOrFail($estudiante);
        $programa_inscritos = EstudiantePrograma::where('id_estudiante', $estudiante->id)->get();
        $programas = [];
        foreach ($programa_inscritos as $key => $programa_inscrito) {
            $pago_estudiante = Pago_estudiante::where('estudiante_id', $estudiante->id)->where('programa_id', $programa_inscrito->id_programa)->get()->first();
            if ($pago_estudiante == null) {
                $programas[$key] = DB::table('programas')->select('id', 'nombre', 'costo', 'cantidad_modulos')->where('id', $programa_inscrito->id_programa)->get()->first();
            }
        }
        return view('pago_estudiante.create', compact('descuentos', 'programas', 'estudiante'));
    }

    public function store(Request $request, $estudiante)
    {
        $request->validate([
            'programa_id' => 'required',
            'tipo_descuento_id' => 'required',
        ], [
            'programa_id.required' => 'El programa es requerido',
            'tipo_descuento_id.required' => 'El tipo de descuento es requerido',
        ]);
        $data = [
            'estudiante_id' => $estudiante,
            'programa_id' => $request['programa_id'],
            'tipo_descuento_id' => $request['tipo_descuento_id'],
            'convalidacion' => $request['convalidacion'],
            'estado' => 'CON DEUDA',
        ];
        $exist = Pago_estudiante::where('estudiante_id', $estudiante)
            ->where('programa_id', $request['programa_id'])
            ->first();
        if ($exist != null) {
            return redirect()->route('pago_estudiante.create', $estudiante)->with('error', 'El estudiante ya tiene un pago registrado para este programa');
        }
        Pago_estudiante::create($data);
        return redirect()->route('pago_estudiante.index');
    }

    public function show($id)
    {
        $estudiante = Estudiante::findOrFail($id);
        $pagos_programas = Pago_estudiante::where('estudiante_id', $estudiante->id)->get();
        foreach ($pagos_programas as $key => $pago_programa) {
            $programa = Programa::findOrFail($pago_programa->programa_id);
            $pagos_programas_array[$key] = $pago_programa;
            $monto_adeudado = Pago_estudiante::calcularEstadoDeuda($pago_programa);
            $pagos_programas_array[$key]['deuda'] = $monto_adeudado;
        }
        return view('pago.index', compact('pagos_programas', 'estudiante'));
    }

    public function show_programa($pago_estudiante)
    {
        $pago_estudiante = Pago_estudiante::findOrFail($pago_estudiante);
        $programa = Programa::findOrFail($pago_estudiante->programa_id);
        $estudiante = Estudiante::findOrFail($pago_estudiante->estudiante_id);
        $pagos = [];
        $pagos_db = Pago::where('pago_estudiante_id', $pago_estudiante->id)->get();
        foreach ($pagos_db as $key => $pago) {
            $pagos[$key] = $pago;
            $pagos[$key]['acumulado'] = Pago::where('pago_estudiante_id', $pago_estudiante->id)->where('id', '<=', $pago->id)->sum('monto');
        }

        $descuento  = $programa->costo * $pago_estudiante->tipo_descuento->monto / 100;
        $monto_pagado = Pago::where('pago_estudiante_id', $pago_estudiante->id)->sum('monto');
        $monto_adeudado = Pago_estudiante::calcularEstadoDeuda($pago_estudiante);
        $pagado_adeudado = $monto_pagado + $monto_adeudado;
        $monto_total = ($programa->costo - $pago_estudiante->convalidacion) - $descuento;
        $deuda = $monto_total - $pagado_adeudado;
        return view('pago.show_programa', compact('pago_estudiante', 'programa', 'estudiante', 'pagos', 'monto_pagado', 'monto_adeudado', 'pagado_adeudado', 'monto_total', 'deuda', 'descuento'));
    }

    public function edit($id)
    {
        $estudiante = Pago_estudiante::where('pago_estudiante.estudiante_id', '=', $id)->first();
        //return $estudiante;
        $fecha = Carbon::now();
        $programas = DB::table('programas')->select('id', 'nombre', 'costo', 'cantidad_modulos')->where('fecha_finalizacion', '>=', $fecha)->get();
        $descuentos = tipo_descuento::all();
        return view('pago_estudiante.edit', compact('estudiante', 'programas', 'descuentos'));
    }

    public function update(Request $request, $id)
    {
        //return $id;
        $pago_estu = Pago_estudiante::findOrFail($id);
        $pago_estu->estudiante_id =  $pago_estu->estudiante_id;
        $pago_estu->programa_id = $request['programa_id'];
        $pago_estu->tipo_descuento_id = $request['tipo_descuento_id'];
        $pago_estu->convalidacion = $request['convalidacion'];
        $pago_estu->save();

        return redirect()->route('pago_estudiante.index');
    }
}
