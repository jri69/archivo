<?php

namespace App\Http\Controllers;

use App\Models\Carta;
use App\Models\CartaDirectivo;
use App\Models\Contrato;
use App\Models\cuadroEvaluativo;
use App\Models\Directivo;
use App\Models\TipoCarta;
use Illuminate\Http\Request;

class CartaController extends Controller
{
    public function carta_create($id, $tipo)
    {
        $plazo = false;
        $codigo = true;
        $tabla = false;
        $contrato_admi = false;
        $tipoCarta = TipoCarta::find($tipo);
        $tipoCarta->nombre == 'Requerimiento de propuesta' ? $plazo = true : '';
        $tipoCarta->nombre == 'Comunicación interna' ? $plazo = true : '';
        $tipoCarta->nombre == 'Propuesta del consultor' ? $codigo = false : '';
        $tipoCarta->nombre == 'Informe técnico' ? $codigo = false : '';
        $tipoCarta->nombre == 'Condiciones y términos para la contratación' ? $tabla = true : '';
        $tipoCarta->nombre == 'Condiciones y términos para la contratación' ? $codigo = false : '';
        $tipoCarta->nombre == 'Informe de conformidad' ? $contrato_admi = true : '';
        return view('cartas.create', compact('id', 'plazo', 'tipo', 'codigo', 'tabla', 'contrato_admi'));
    }

    public function carta_edit($id)
    {
        $carta = Carta::find($id);
        $cuadro = cuadroEvaluativo::where('carta_id', $carta->id)->first();
        $plazo = false;
        $codigo = true;
        $tabla = false;
        $tipoCarta = TipoCarta::find($carta->tipo_id);
        $tipoCarta->nombre == 'Requerimiento de propuesta' ? $plazo = true : '';
        $tipoCarta->nombre == 'Comunicación interna' ? $plazo = true : '';
        $tipoCarta->nombre == 'Propuesta del consultor' ? $codigo = false : '';
        $tipoCarta->nombre == 'Informe técnico' ? $codigo = false : '';
        $tipoCarta->nombre == 'Condiciones y términos para la contratación' ? $tabla = true : '';
        $tipoCarta->nombre == 'Condiciones y términos para la contratación' ? $codigo = false : '';
        $tipoCarta->nombre == 'Condiciones y términos para la contratación' ? $codigo = false : '';
        return view('cartas.edit', compact('id', 'plazo', 'codigo', 'tabla', 'carta', 'cuadro'));
    }


    public function carta_update($id, Request $request)
    {
        $carta = Carta::find($id);
        $tipoCarta = TipoCarta::findOrFail($carta->tipo_id);
        if ($tipoCarta->nombre == 'Propuesta del consultor' || $tipoCarta->nombre == 'Informe técnico' || $tipoCarta->nombre == 'Condiciones y términos para la contratación') {
            $request->validate([
                'fecha' => 'required|date',
                'formacion_requerida' => 'required',
            ], [
                'fecha.required' => 'La fecha es requerida',
                'fecha.date' => 'La fecha debe ser una fecha válida',
                'formacion_requerida.required' => 'La formación requerida es requerida',
            ]);
            // else if
        } else if ($tipoCarta->nombre == 'Requerimiento de propuesta' || $tipoCarta->nombre == 'Comunicación interna') {
            $request->validate([
                'codigo' => 'required|string',
                'fecha' => 'required|date',
                'fecha_plazo' => 'required|date',
            ], [
                'fecha_plazo.required' => 'La fecha de plazo es requerida',
                'fecha_plazo.date' => 'La fecha de plazo debe ser una fecha válida',
            ]);
        } else {
            $request->validate([
                'codigo' => 'required|string',
                'fecha' => 'required|date',
            ]);
        }
        $dataCarta = [
            'codigo_admi' => $request->codigo,
            'fecha' => $request->fecha,
        ];
        $request->fecha_plazo ? $dataCarta['fecha_plazo'] = $request->fecha_plazo : '';
        $carta->update($dataCarta);
        if ($tipoCarta->nombre == 'Condiciones y términos para la contratación') {
            $cuadro = cuadroEvaluativo::where('carta_id', $carta->id)->first();
            $cuadro->update([
                'formacion' => $request->formacion,
                'cursos_continuo' => $request->cursos_continuo,
                'experiencia_general' => $request->experiencia_general,
                'nacionalidad' => $request->nacionalidad,
                'experiencia_especifica' => $request->experiencia_especifica,
                'formacion_continua' => $request->formacion_continua,
                'propuesta_tecnica' => $request->propuesta_tecnica,
                'formacion_requerida' => $request->formacion_requerida,
            ]);
        }
        return redirect()->route('contrataciones.show', $carta->contrato_id);
    }

    public function carta_store(Request $request)
    {
        $tipoCarta = TipoCarta::findOrFail($request->tipo);
        if ($tipoCarta->nombre == 'Propuesta del consultor' || $tipoCarta->nombre == 'Informe técnico') {
            $request->validate([
                'fecha' => 'required|date',
            ], [
                'fecha.required' => 'La fecha es requerida',
                'fecha.date' => 'La fecha debe ser una fecha válida',
            ]);
            // else if
        } else if ($tipoCarta->nombre == 'Requerimiento de propuesta' || $tipoCarta->nombre == 'Comunicación interna') {
            $request->validate([
                'codigo' => 'required|string',
                'fecha' => 'required|date',
                'fecha_plazo' => 'required|date',
            ], [
                'fecha_plazo.required' => 'La fecha de plazo es requerida',
                'fecha_plazo.date' => 'La fecha de plazo debe ser una fecha válida',
            ]);
        } else if ($tipoCarta->nombre == 'Condiciones y términos para la contratación') {
            $request->validate([
                'fecha' => 'required|date',
                'formacion_requerida' => 'required',
            ], [
                'fecha.required' => 'La fecha es requerida',
                'fecha.date' => 'La fecha debe ser una fecha válida',
                'formacion_requerida.required' => 'La formación requerida es requerida',
            ]);
        } else if ($tipoCarta->nombre == 'Informe de conformidad') {
            $request->validate([
                'codigo' => 'required|string',
                'fecha' => 'required|date',
                'contrato_admi' => 'required|string',
            ], [
                'contrato_admi.required' => 'El contrato administrativo es requerido',
            ]);
        } else {
            $request->validate([
                'codigo' => 'required|string',
                'fecha' => 'required|date',
            ]);
        }
        $contrato = Contrato::findOrFail($request->contrato);
        $dataCarta = [
            'codigo_admi' => $request->codigo,
            'fecha' => $request->fecha,
            'tipo_id' => $request->tipo,
            'contrato_id' => $request->contrato,
        ];
        $request->fecha_plazo ? $dataCarta['fecha_plazo'] = $request->fecha_plazo : '';
        $request->contrato_admi ? $dataCarta['contrato_admi'] = $request->contrato_admi : '';
        $carta = Carta::create($dataCarta);
        $this->createDirectivo($tipoCarta->nombre, $carta->id);
        if ($tipoCarta->nombre == 'Condiciones y términos para la contratación') {
            cuadroEvaluativo::create([
                'carta_id' => $carta->id,
                'formacion' => $request->formacion,
                'cursos_continuo' => $request->cursos_continuo,
                'experiencia_general' => $request->experiencia_general,
                'nacionalidad' => $request->nacionalidad,
                'experiencia_especifica' => $request->experiencia_especifica,
                'formacion_continua' => $request->formacion_continua,
                'propuesta_tecnica' => $request->propuesta_tecnica,
                'formacion_requerida' => $request->formacion_requerida,
            ]);
        }
        return redirect()->route('contrataciones.show', $contrato->id);
    }

    public function carta_delete($id)
    {
        $carta = Carta::findOrFail($id);
        $contrato = $carta->contrato_id;
        $carta->delete();
        return redirect()->route('contrataciones.show', $contrato);
    }

    private function createDirectivo($tipo, $carta)
    {
        switch ($tipo) {
            case 'Solicitud de contratacion':
                $director = Directivo::where('cargo', 'Director')->where('activo', true)->where('institucion', 'Escuela de Ingeniería - F.C.E.T.')->first();
                $coordinador = Directivo::where('cargo', 'Coordinador Académico')->where('activo', true)->where('institucion', 'Escuela de Ingeniería - UAGRM')->first();
                $responsable = Directivo::where('cargo', 'Responsable del proceso de contratación')->where('activo', true)->where('institucion', 'JAF')->first();
                $decano = Directivo::where('cargo', 'Decano')->where('activo', true)->where('institucion', 'F.C.E.T.')->first();
                CartaDirectivo::create([
                    'carta_id' => $carta,
                    'directivo_id' => $director->id,
                ]);
                CartaDirectivo::create([
                    'carta_id' => $carta,
                    'directivo_id' => $coordinador->id,
                ]);
                CartaDirectivo::create([
                    'carta_id' => $carta,
                    'directivo_id' => $responsable->id,
                ]);
                CartaDirectivo::create([
                    'carta_id' => $carta,
                    'directivo_id' => $decano->id,
                ]);
                break;
            case 'Requerimiento de propuesta':
                $coordinador = Directivo::where('cargo', 'Coordinador Académico')->where('activo', true)->where('institucion', 'Escuela de Ingeniería - UAGRM')->first();
                CartaDirectivo::create([
                    'carta_id' => $carta,
                    'directivo_id' => $coordinador->id,
                ]);
                break;
            case 'Propuesta del Consultor':
                $coordinador = Directivo::where('cargo', 'Coordinador Académico')->where('activo', true)->where('institucion', 'Escuela de Ingeniería - UAGRM')->first();
                CartaDirectivo::create([
                    'carta_id' => $carta,
                    'directivo_id' => $coordinador->id,
                ]);
                break;
            case 'Informe técnico':
                $coordinador = Directivo::where('cargo', 'Coordinador Académico')->where('activo', true)->where('institucion', 'Escuela de Ingeniería - UAGRM')->first();
                $responsable = Directivo::where('cargo', 'Responsable del proceso de contratación')->where('activo', true)->where('institucion', 'JAF')->first();
                CartaDirectivo::create([
                    'carta_id' => $carta,
                    'directivo_id' => $coordinador->id,
                ]);
                CartaDirectivo::create([
                    'carta_id' => $carta,
                    'directivo_id' => $responsable->id,
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
            case 'Condiciones y términos para la contratación':
                $coordinador = Directivo::where('cargo', 'Coordinador Académico')->where('activo', true)->where('institucion', 'Escuela de Ingeniería - UAGRM')->first();
                CartaDirectivo::create([
                    'carta_id' => $carta,
                    'directivo_id' => $coordinador->id,
                ]);
                break;
            case 'Planilla de pago':
                $director = Directivo::where('cargo', 'Director')->where('activo', true)->where('institucion', 'Escuela de Ingeniería - F.C.E.T.')->first();
                $decano = Directivo::where('cargo', 'Decano')->where('activo', true)->where('institucion', 'F.C.E.T.')->first();
                $responsable = Directivo::where('cargo', 'Jefe ADM. y Financiero')->where('activo', true)->where('institucion', 'F.C.E.T.')->first();
                CartaDirectivo::create([
                    'carta_id' => $carta,
                    'directivo_id' => $director->id,
                ]);
                CartaDirectivo::create([
                    'carta_id' => $carta,
                    'directivo_id' => $decano->id,
                ]);
                CartaDirectivo::create([
                    'carta_id' => $carta,
                    'directivo_id' => $responsable->id,
                ]);
                break;
            default:
                break;
        }
    }
}
