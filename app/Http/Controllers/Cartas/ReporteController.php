<?php

namespace App\Http\Controllers\Cartas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Cartas\Condiciones_Terminos;
use App\Http\Controllers\Cartas\Sol_Contrataciones;
use App\Http\Controllers\Cartas\Requerimiento_Propuesta;
use App\Http\Controllers\Cartas\Propuesta_Consultor;
use App\Http\Controllers\Cartas\Informe_Tecnico;
use App\Http\Controllers\Cartas\Notificacion_Adjudicacion;
use App\Http\Controllers\Cartas\Comunicacion_Interna;
use App\Http\Controllers\Cartas\Informe_Conformidad;
use App\Models\Carta;
use App\Models\CartaDirectivo;
use App\Models\Contrato;
use App\Models\ContratoCarta;
use App\Models\Directivo;
use App\Models\TipoCarta;

class ReporteController extends Controller
{
    protected $fpdf;

    public function index($request)
    {
        return $request;
    }

    public function carta_create($id, $tipo)
    {
        return view('cartas.create', compact('id', 'tipo'));
    }

    public function carta_store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|string',
            'fecha' => 'required|date',
        ]);
        $contrato = Contrato::findOrFail($request->contrato);
        $tipoCarta = TipoCarta::findOrFail($request->tipo);
        $carta = Carta::create([
            'codigo_admi' => $request->codigo,
            'fecha' => $request->fecha,
            'tipo_id' => $request->tipo,
            'contrato_id' => $request->contrato,
        ]);
        $this->createDirectivo($tipoCarta->nombre, $carta->id);
        return redirect()->route('contrataciones.show', $contrato->id);
    }

    public function pdf($id, $tipo, $idCarta)
    {
        $contrato = Contrato::find($id);
        switch ($tipo) {
            case 'Informe de conformidad':
                $this->Informe_Conformidad([$contrato, $idCarta]);
                break;

            case 'Comunicación interna':
                $this->Comunicacion_Interna([$contrato, $idCarta]);
                break;
            default:
                # code...
                break;
        }
        // $this->Condiciones_Terminos([]);
        // $this->Sol_Contrataciones([]);
        // $this->Requerimiento_Propuesta([]);
        // $this->Propuesta_Consultor([]);
        // $this->Informe_Tecnico([]);
        // $this->Notificacion_Adjudicacion([]);
    }

    private function createDirectivo($tipo, $carta)
    {
        switch ($tipo) {
            case 'Informe de conformidad':
                $director = Directivo::where('cargo', 'Director')->where('activo', true)->where('institucion', 'Escuela de Ingeniería - F.C.E.T.')->first();
                $coordinador = Directivo::where('cargo', 'Coordinador Académico')->where('activo', true)->where('institucion', 'Escuela de Ingeniería - UAGRM')->first();
                CartaDirectivo::create([
                    'carta_id' => $carta,
                    'directivo_id' => $director->id,
                ]);
                CartaDirectivo::create([
                    'carta_id' => $carta,
                    'directivo_id' => $coordinador->id,
                ]);
                break;
            case 'Comunicación interna':
                $director = Directivo::where('cargo', 'Director')->where('activo', true)->where('institucion', 'Escuela de Ingeniería - F.C.E.T.')->first();
                $asesorLegal = Directivo::where('cargo', 'Asesor Legal')->where('activo', true)->where('institucion', 'F.C.E.T. - UAGRM')->first();
                $responsable = Directivo::where('cargo', 'Responsable del proceso de contratación')->where('activo', true)->where('institucion', 'JAF')->first();
                CartaDirectivo::create([
                    'carta_id' => $carta,
                    'directivo_id' => $director->id,
                ]);
                CartaDirectivo::create([
                    'carta_id' => $carta,
                    'directivo_id' => $asesorLegal->id,
                ]);
                CartaDirectivo::create([
                    'carta_id' => $carta,
                    'directivo_id' => $responsable->id,
                ]);
                break;

            default:
                # code...
                break;
        }
    }

    public function Condiciones_Terminos($data)
    {
        $ct = new Condiciones_Terminos();
        return $ct->Condiciones_Terminos($data);
    }

    public function Sol_Contrataciones($data)
    {
        $sc = new Sol_Contrataciones();
        return $sc->contrataciones($data);
    }

    public function Requerimiento_Propuesta($data)
    {
        $rp = new Requerimiento_Propuesta();
        return $rp->propuesta($data);
    }

    public function Propuesta_Consultor($data)
    {
        $pc = new Propuesta_Consultor();
        return $pc->propuesta($data);
    }

    public function Informe_Tecnico($data)
    {
        $it = new Informe_Tecnico();
        return $it->informe($data);
    }

    public function Notificacion_Adjudicacion($data)
    {
        $na = new Notificacion_Adjudicacion();
        return $na->informe($data);
    }

    public function Comunicacion_Interna($data)
    {
        $ci = new Comunicacion_Interna();
        return $ci->informe($data);
    }

    public function Informe_Conformidad($data)
    {
        $ic = new Informe_Conformidad();
        return $ic->informe($data);
    }
}
