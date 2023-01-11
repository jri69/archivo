<?php

namespace App\Http\Controllers;

use App\Models\CartaDirectivo;
use App\Models\CartaTitulacion as ModelsCartaTitulacion;
use App\Models\Directivo;
use App\Models\Estudiante;
use App\Models\Programa;
use App\Models\TipoCarta;
use App\Models\Titulacion;
use App\Models\TitulacionDirectivo;
use Illuminate\Http\Request;

class CartaTitulacion extends Controller
{
    // Ver las cartas de titulacion
    private $ICR = 10;
    private $DDTG = 11;
    private $Cac_Dt = 12;

    // Cargos
    private $DR = 'Director';
    private $CA = 'Coordinador Académico';
    private $RPC = 'Responsable del proceso de contratación';
    private $DC = 'Decano';
    private $AL = 'Asesor Legal';
    private $JAYF = 'Jefe ADM. y Financiero';
    private $CDI = 'Coordinador de investigación';

    // Instituciones
    private $EI = 'Escuela de Ingeniería - F.C.E.T.';
    private $EIUAGRM = 'Escuela de Ingeniería - UAGRM';
    private $JAF = 'JAF';
    private $FCET = 'F.C.E.T.';
    private $FCETUAGRM = 'F.C.E.T. - UAGRM';

    public function carta($estudiante, $programa)
    {
        $estudiante = Estudiante::findOrFail($estudiante);
        $programa = Programa::findOrFail($programa);
        $tipos = TipoCarta::Where('tipo', 'Titulacion')->orderBy('id', 'asc')->get();
        $titulacion = Titulacion::where('programa_id', $programa->id)->first();
        $cartas = ModelsCartaTitulacion::where('titulacion_id', $titulacion->id)->get();
        $tipos_cartas = [];
        foreach ($tipos as $key => $tipo) {
            // $carta = $cartas->where('tipo_carta_id', $tipo->id)->first();
            $carta = $cartas->where('tipo_id', $tipo->id)->first();
            $tipos_cartas[$key] = [
                'tipo' => $tipo,
                'carta' => $carta
            ];
        }
        return view('estudiante.carta', compact('estudiante', 'programa', 'tipos_cartas', 'titulacion'));
    }

    public function cartaCreate($estudiante, $titulacion, $tipo)
    {
        $codigo1 = false;
        $codigo2 = false;
        $codigo3 = false;
        $estudiante = Estudiante::findOrFail($estudiante);
        $titulacion = Titulacion::findOrFail($titulacion);
        $tipo = TipoCarta::findOrFail($tipo);
        $tipo->id == 12 ? $codigo1 = true : $codigo1 = false;
        return view('estudiante.cartaCreate', compact('estudiante', 'titulacion', 'tipo', 'codigo1', 'codigo2', 'codigo3'));
    }

    public function cartaStore(Request $request, $estudiante, $titulacion, $tipo)
    {
        // dd($request->all());
        $request->validate([
            'codigo_admi' => 'required',
            'fecha' => 'required|date',
        ]);
        $data = [
            'codigo_admi' => $request->codigo_admi,
            'fecha' => $request->fecha,
            'tipo_id' => $tipo,
            'titulacion_id' => $titulacion,
        ];
        if ($tipo == 12) {
            $request->validate(['codigo1' => 'required',]);
            $data['codigo1'] = $request->codigo1;
        }
        $carta = ModelsCartaTitulacion::create($data);
        $this->createDirectivo($tipo, $carta->id);
        return redirect()->route('estudiante.carta', [$estudiante, $titulacion]);
    }

    public function cartaDestroy($carta)
    {
        $titulacion = ModelsCartaTitulacion::findOrFail($carta);
        $titulacion->delete();
        return back()->with('mensaje', 'Carta eliminada');
    }

    public function titulacionCreate($estudiante, $programa)
    {
        $titulacion = Titulacion::where('estudiante_id', $estudiante)
            ->where('programa_id', $programa)->first();
        if ($titulacion) {
            return redirect()->route('estudiante.carta', [$estudiante, $programa]);
        }
        $estudiante = Estudiante::findOrFail($estudiante);
        $programa = Programa::findOrFail($programa);
        return view('estudiante.titulacionCreate', compact('estudiante', 'programa'));
    }

    public function titulacionEdit($idTitulacion)
    {
        $titulacion = Titulacion::findOrFail($idTitulacion);
        return view('estudiante.titulacionEdit', compact('titulacion'));
    }

    public function titulacionDestroy($idTitulacion)
    {
        $titulacion = Titulacion::findOrFail($idTitulacion);
        $titulacion->delete();
        return back()->with('mensaje', 'Eliminado Correctamente');
    }

    public function titulacionStore(Request $request, $estudiante, $programa)
    {
        $request->validate([
            'tesis' => 'required|string',
            'director' => 'required|string',
            'lineas_academicas' => 'required|string',
            'grado_academico' => 'required|string'
        ], [
            'tesis.required' => 'El campo Tesis es obligatorio',
            'director.required' => 'El campo Director es obligatorio',
            'lineas_academicas.required' => 'El campo Lineas Academicas es obligatorio',
            'grado_academico' => 'El campo Grado Academico es obligatorio'
        ]);
        $request->merge([
            'estudiante_id' => $estudiante,
            'programa_id' => $programa,
        ]);
        Titulacion::create($request->all());
        return redirect()->route('estudiante.carta', [$estudiante, $programa]);
    }

    public function titulacionUpdate(Request $request, $idTitulacion)
    {
        $request->validate([
            'tesis' => 'required|string',
            'director' => 'required|string',
            'lineas_academicas' => 'required|string',
            'grado_academico' => 'required|string'
        ], [
            'tesis.required' => 'El campo Tesis es obligatorio',
            'director.required' => 'El campo Director es obligatorio',
            'lineas_academicas.required' => 'El campo Lineas Academicas es obligatorio',
            'grado_academico' => 'El campo Grado Academico es obligatorio'
        ]);
        $titulacion = Titulacion::findOrFail($idTitulacion);
        $titulacion->update($request->all());
        return redirect()->route('estudiante.carta', [$titulacion->estudiante_id, $titulacion->programa_id]);
    }


    private function directivo($cargo, $institucion)
    {
        return Directivo::where('cargo', $cargo)->where('activo', true)->where('institucion', $institucion)->first();
    }

    private function addCartaDirectivo($carta, $idDirectivo)
    {
        TitulacionDirectivo::create([
            'titulacion_id' => $carta,
            'directivo_id' => $idDirectivo,
        ]);
    }

    private function createDirectivo($tipo, $carta)
    {
        switch ($tipo) {
            case $this->Cac_Dt:
                $director = $this->directivo($this->DR, $this->EI);
                $coordinador = $this->directivo($this->CA, $this->EIUAGRM);
                $investigacion = $this->directivo($this->CDI, $this->EI);
                $this->addCartaDirectivo($carta, $director->id);
                $this->addCartaDirectivo($carta, $coordinador->id);
                $this->addCartaDirectivo($carta, $investigacion->id);
                break;
            default:
                break;
        }
    }
}
