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
use App\Models\Tribunal;
use Illuminate\Http\Request;

class CartaTitulacion extends Controller
{
    // Ver las cartas de titulacion
    private $ICR = 10;
    private $DDTG = 11;
    private $CAC_DT = 12;
    private $CAC_ICR = 13;
    private $CDDT = 14;
    private $ITR = 15;
    private $IADT = 16;
    private $IDO = 17;
    private $SHRCDO = 18;
    private $EBT = 19;
    private $ICR2 = 20;
    private $CAC_ICR2 = 21;
    private $CAC_TRB = 22;
    private $CD_TB = 23;
    private $IO = 24;
    private $SH = 25;

    private $PD = 27;
    private $EP = 28;

    private $SFD = 30;

    // Cargos
    private $DR = 'Director';
    private $DRA = 'Directora general de postgrado';
    private $CA = 'Coordinador Académico';
    private $RPC = 'Responsable del proceso de contratación';
    private $DC = 'Decano';
    private $AL = 'Asesor Legal';
    private $JAYF = 'Jefe ADM. y Financiero';
    private $CDI = 'Coordinador de investigación';
    private $PRD = 'Presidente';

    // Instituciones
    private $EI = 'Escuela de Ingeniería - F.C.E.T.';
    private $EIUAGRM = 'Escuela de Ingeniería - UAGRM';
    private $JAF = 'JAF';
    private $FCET = 'F.C.E.T.';
    private $FCETUAGRM = 'F.C.E.T. - UAGRM';
    private $CDP = 'Consejo directivo de postgrado';
    private $UAGRM = 'UAGRM';

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
        $codigo1 = false; // codigo CA
        $codigo2 = false; // resolucion CAC
        $codigo3 = false; // informe CRP || resolucion CAC
        $tribunal = false; // tribunal
        $profesion = false;
        $consupo = false;
        $originalidad = false;
        $similitud = false;
        $aporte = false;
        $documento = false;
        $exceso = false;
        $fecha_ini = false;
        $fecha_fin = false;
        $articulo = false;
        $dia_defensa = false;
        $hora_defensa = false;
        $estudiante = Estudiante::findOrFail($estudiante);
        $titulacion = Titulacion::findOrFail($titulacion);
        $tipo = TipoCarta::findOrFail($tipo);
        if ($tipo->id == $this->CAC_DT || $tipo->id == $this->CAC_ICR || $tipo->id == $this->CDDT || $tipo->id == $this->SHRCDO || $tipo->id == $this->CAC_ICR2 || $tipo->id == $this->CD_TB || $tipo->id == $this->SH)
            $codigo1 = true;
        if ($tipo->id == $this->CAC_ICR || $tipo->id == $this->CDDT || $tipo->id == $this->SHRCDO || $tipo->id == $this->ICR2 || $tipo->id == $this->CAC_ICR2 || $tipo->id == $this->CAC_TRB || $tipo->id == $this->CD_TB || $tipo->id == $this->SH)
            $codigo2 = true;
        if ($tipo->id == $this->CAC_ICR || $tipo->id == $this->CDDT || $tipo->id == $this->SHRCDO || $tipo->id == $this->CD_TB || $tipo->id == $this->SH)
            $codigo3 = true;
        if ($tipo->id == $this->ITR)
            $tribunal = true;
        if ($tipo->id == $this->IADT)
            $profesion = true;
        if ($tipo->id == $this->CDDT || $tipo->id == $this->EBT || $tipo->id == $this->SFD)
            $consupo = true;
        if ($tipo->id == $this->SHRCDO || $tipo->id == $this->IDO || $tipo->id == $this->IO || $tipo->id == $this->SH)
            $documento = true;
        if ($tipo->id == $this->EBT || $tipo->id == $this->CD_TB)
            $exceso = true;
        if ($tipo->id == $this->CAC_TRB || $tipo->id == $this->ICR2 || $tipo->id == $this->CAC_ICR2 || $tipo->id == $this->CD_TB)
            $articulo = true;
        if ($tipo->id == $this->PD) {
            $dia_defensa = true;
            $hora_defensa = true;
        }
        if ($tipo->id == $this->IDO || $tipo->id == $this->IO) {
            $originalidad = true;
            $similitud = true;
            $aporte = true;
        }
        if ($tipo->id == $this->ICR2 || $tipo->id == $this->CAC_ICR2) {
            $fecha_ini = true;
            $fecha_fin = true;
        }
        return view('estudiante.cartaCreate', compact('estudiante', 'titulacion', 'tipo', 'codigo1', 'codigo2', 'codigo3', 'tribunal', 'profesion', 'consupo', 'originalidad', 'similitud', 'aporte', 'documento', 'exceso', 'fecha_ini', 'fecha_fin', 'articulo', 'dia_defensa', 'hora_defensa'));
    }

    public function cartaStore(Request $request, $estudiante, $titulacion, $tipo)
    {
        // dd($request->all());
        $request->validate([
            'codigo_admi' => 'required',
            'fecha' => 'required|date',
        ]);
        $data = [
            'codigo_admi' => $request->codigo_admi ? $request->codigo_admi : "",
            'fecha' => $request->fecha,
            'tipo_id' => $tipo,
            'titulacion_id' => $titulacion,
            'consupo' => $request->consupo ? $request->consupo : "",
        ];
        // codigo 1
        if ($tipo == $this->CAC_DT || $tipo == $this->CAC_ICR || $tipo == $this->CDDT || $tipo == $this->SHRCDO || $tipo == $this->CAC_ICR2 || $tipo == $this->CD_TB || $tipo == $this->SH) {
            $request->validate(['codigo1' => 'required',]);
            $data['codigo1'] = $request->codigo1;
        }
        // codigo 2
        if ($tipo == $this->CAC_ICR || $tipo == $this->CDDT || $tipo == $this->SHRCDO || $tipo == $this->ICR2 || $tipo == $this->CAC_ICR2 || $tipo == $this->CAC_TRB || $tipo == $this->CD_TB || $tipo == $this->SH) {
            $request->validate(['codigo2' => 'required',]);
            $data['codigo2'] = $request->codigo2;
        }
        //codigo 3
        if ($tipo == $this->CAC_ICR || $tipo == $this->CDDT || $tipo == $this->SHRCDO || $tipo == $this->CD_TB || $tipo == $this->SH) {
            $request->validate(['codigo3' => 'required',]);
            $data['codigo3'] = $request->codigo3;
        }
        if ($tipo == $this->SHRCDO || $tipo == $this->IDO || $tipo == $this->IO || $tipo == $this->SH) {
            $request->validate(['documento' => 'required',]);
            $data['documento'] = $request->documento;
        }
        if ($tipo == $this->IADT) {
            $request->validate(['profesion' => 'required',]);
            $data['profesion'] = $request->profesion;
        }
        if ($tipo == $this->EBT || $tipo == $this->CD_TB) {
            $request->validate(['exceso' => 'required',]);
            $data['exceso'] = $request->exceso;
        }
        if ($tipo == $this->CAC_TRB || $tipo == $this->CD_TB) {
            $request->validate(['articulo' => 'required',]);
            $data['articulo'] = $request->articulo;
        }
        if ($tipo == $this->PD) {
            $request->validate(['dia_defensa' => 'required', 'hora_defensa' => 'required']);
            $titulacion = Titulacion::findOrFail($titulacion);
            $titulacion->update(['dia_defensa' => $request->dia_defensa, 'hora_defensa' => $request->hora_defensa]);
        }
        if ($tipo == $this->ICR2 || $tipo == $this->CAC_ICR2) {
            $request->validate(['fecha_ini' => 'required', 'fecha_fin' => 'required']);
            $titulacion = Titulacion::findOrFail($titulacion);
            $titulacion->update(['fecha_ini' => $request->fecha_ini, 'fecha_fin' => $request->fecha_fin]);
        }
        if ($tipo == $this->IDO || $tipo == $this->IO) {
            $request->validate(['originalidad' => 'required', 'similitud' => 'required', 'aporte_academico' => 'required']);
            $titulacion = Titulacion::findOrFail($titulacion);
            $titulacion->update(['originalidad' => $request->originalidad, 'similitud' => $request->similitud, 'aporte_academico' =>  $request->aporte_academico]);
        }
        $carta = ModelsCartaTitulacion::create($data);
        $this->createDirectivo($tipo, $carta->id);
        if ($tipo == $this->ITR) {
            Tribunal::create([
                'nombre' => $request['nombre'],
                'sexo' => $request['sexo'],
                'carta_titulacion_id' => $carta->id
            ]);
        }
        return redirect()->route('estudiante.carta', [$estudiante, $titulacion]);
    }

    public function cartaDestroy($carta)
    {
        $carta = ModelsCartaTitulacion::findOrFail($carta);
        if ($carta->tipo_id == $this->ITR) {
            $cartas = ModelsCartaTitulacion::where('titulacion_id', $carta->titulacion_id)->where('tipo_id', $carta->tipo_id)->get();
            foreach ($cartas as $key => $value) {
                $value->delete();
            }
            return back()->with('mensaje', 'Carta eliminada');
        }
        $carta->delete();
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

    private function addCartaDirectivo($carta, $idDirectivo = null)
    {
        TitulacionDirectivo::create([
            'carta_titulacion_id' => $carta,
            'directivo_id' => $idDirectivo,
        ]);
    }

    private function createDirectivo($tipo, $carta)
    {
        if ($tipo == $this->CAC_DT || $tipo == $this->CAC_ICR || $tipo == $this->CAC_ICR2 || $tipo == $this->CAC_TRB) {
            $director = $this->directivo($this->DR, $this->EI);
            $coordinador = $this->directivo($this->CA, $this->EIUAGRM);
            $investigacion = $this->directivo($this->CDI, $this->EI);
            $this->addCartaDirectivo($carta, $director->id);
            $this->addCartaDirectivo($carta, $coordinador->id);
            $this->addCartaDirectivo($carta, $investigacion->id);
            return;
        };
        if ($tipo == $this->IADT || $tipo == $this->IDO || $tipo == $this->SHRCDO || $tipo == $this->IO || $tipo == $this->SH || $tipo == $this->SFD) {
            $directora = $this->directivo($this->DRA, $this->UAGRM);
            $this->addCartaDirectivo($carta, $directora->id);
            return;
        }
        if ($tipo == $this->CDDT || $tipo == $this->CD_TB) {
            $director = $this->directivo($this->DR, $this->EI);
            $presidente = $this->directivo($this->PRD, $this->CDP);
            $this->addCartaDirectivo($carta, $director->id);
            $this->addCartaDirectivo($carta, $presidente->id);
            return;
        }
    }
}
