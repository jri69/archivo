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
    // Cartas
    private $SC = 'Solicitud de contratacion';
    private $CTC = 'Condiciones y términos para la contratación';
    private $RP = 'Requerimiento de propuesta';
    private $PC = 'Propuesta del consultor';
    private $IL = 'Informe legal';
    private $IT = 'Informe técnico';
    private $NA = 'Notificación de adjudicación';
    private $CAD = 'Contrato administrativo';
    private $CI = 'Comunicación interna';
    private $IC = 'Informe de conformidad';
    private $PP = 'Planilla de pago';

    // Cargos
    private $DR = 'Director';
    private $CA = 'Coordinador Académico';
    private $RPC = 'Responsable del proceso de contratación';
    private $DC = 'Decano';
    private $AL = 'Asesor Legal';
    private $JAYF = 'Jefe ADM. y Financiero';
    private $CDC = 'Comisión de calificación';

    // Instituciones
    private $EI = 'Escuela de Ingeniería - F.C.E.T.';
    private $EIUAGRM = 'Escuela de Ingeniería - UAGRM';
    private $JAF = 'JAF';
    private $FCET = 'F.C.E.T.';
    private $FCETUAGRM = 'F.C.E.T. - UAGRM';

    public function carta_create($id, $tipo)
    {
        $plazo = false;
        $codigo = true;
        $tabla = false;
        $contrato_admi = false;
        $informe_legal = false;
        $contrato_admi = false;
        $tipoCarta = TipoCarta::find($tipo);
        $tipoCarta->nombre == $this->RP ? $plazo = true : '';
        $tipoCarta->nombre == $this->CI ? $plazo = true : '';
        $tipoCarta->nombre == $this->PC ? $codigo = false : '';
        $tipoCarta->nombre == $this->IT ? $codigo = false : '';
        $tipoCarta->nombre == $this->CTC ? $tabla = true : '';
        $tipoCarta->nombre == $this->CTC ? $codigo = false : '';
        $tipoCarta->nombre == $this->IC ? $contrato_admi = true : '';
        $tipoCarta->nombre == $this->IL ? $informe_legal = true : '';
        $tipoCarta->nombre == $this->CAD ? $contrato_admi = true : '';
        return view('cartas.create', compact('id', 'plazo', 'tipo', 'codigo', 'tabla', 'contrato_admi', 'informe_legal', 'contrato_admi'));
    }

    public function carta_edit($id)
    {
        $carta = Carta::find($id);
        $cuadro = cuadroEvaluativo::where('carta_id', $carta->id)->first();
        $plazo = false;
        $codigo = true;
        $tabla = false;
        $tipoCarta = TipoCarta::find($carta->tipo_id);
        $tipoCarta->nombre == $this->RP ? $plazo = true : '';
        $tipoCarta->nombre == $this->CI ? $plazo = true : '';
        $tipoCarta->nombre == $this->PC ? $codigo = false : '';
        $tipoCarta->nombre == $this->IT ? $codigo = false : '';
        $tipoCarta->nombre == $this->CTC ? $tabla = true : '';
        $tipoCarta->nombre == $this->CTC ? $codigo = false : '';
        return view('cartas.edit', compact('id', 'plazo', 'codigo', 'tabla', 'carta', 'cuadro'));
    }

    public function carta_update($id, Request $request)
    {
        $carta = Carta::find($id);
        $tipoCarta = TipoCarta::findOrFail($carta->tipo_id);
        if ($tipoCarta->nombre == $this->PC || $tipoCarta->nombre == $this->IT || $tipoCarta->nombre == $this->CTC) {
            $request->validate([
                'fecha' => 'required|date',
                'formacion_requerida' => 'required',
            ], [
                'fecha.required' => 'La fecha es requerida',
                'fecha.date' => 'La fecha debe ser una fecha válida',
                'formacion_requerida.required' => 'La formación requerida es requerida',
            ]);
        } else if ($tipoCarta->nombre == $this->RP || $tipoCarta->nombre == $this->CI) {
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
        if ($tipoCarta->nombre == $this->CTC) {
            $cuadro = cuadroEvaluativo::where('carta_id', $carta->id)->first();
            $cuadro->update($request->all());
        }
        return redirect()->route('contrataciones.show', $carta->contrato_id);
    }

    public function carta_store(Request $request)
    {
        $tipoCarta = TipoCarta::findOrFail($request->tipo);
        if ($tipoCarta->nombre == $this->PC || $tipoCarta->nombre == $this->IT) {
            $request->validate([
                'fecha' => 'required|date',
            ], [
                'fecha.required' => 'La fecha es requerida',
                'fecha.date' => 'La fecha debe ser una fecha válida',
            ]);
        } else if ($tipoCarta->nombre == $this->RP || $tipoCarta->nombre == $this->CI) {
            $request->validate([
                'codigo' => 'required|string',
                'fecha' => 'required|date',
                'fecha_plazo' => 'required|date',
            ], [
                'fecha_plazo.required' => 'La fecha de plazo es requerida',
                'fecha_plazo.date' => 'La fecha de plazo debe ser una fecha válida',
            ]);
        } else if ($tipoCarta->nombre == $this->CTC) {
            $request->validate([
                'fecha' => 'required|date',
                'formacion_requerida' => 'required',
            ], [
                'fecha.required' => 'La fecha es requerida',
                'fecha.date' => 'La fecha debe ser una fecha válida',
                'formacion_requerida.required' => 'La formación requerida es requerida',
            ]);
        } else if ($tipoCarta->nombre == $this->IC) {
            $request->validate([
                'codigo' => 'required|string',
                'fecha' => 'required|date',
                'contrato_admi' => 'required|string',
            ], [
                'contrato_admi.required' => 'El contrato administrativo es requerido',
            ]);
        } else if ($tipoCarta->nombre == $this->IL) {
            $request->validate([
                'codigo' => 'required|string',
                'fecha' => 'required|date',
                'solicitud_contratacion' => 'required|string',
                'fecha_dos' => 'required|date',
                'registro_ejecucion' => 'required|string',
                'comunicacion_interna' => 'required|string',
                'modalidad_adjudicacion' => 'required|string',
                'forma_adjudicacion' => 'required|string'
            ], [
                'contrato_admi.required' => 'El contrato administrativo es requerido',
                'solicitud_contratacion.required' => 'La solicitud de contratación es requerida',
                'fecha_dos.required' => 'La fecha es requerida',
                'fecha_dos.date' => 'La fecha debe ser una fecha válida',
                'registro_ejecucion.required' => 'El registro de ejecución es requerido',
                'comunicacion_interna.required' => 'La comunicación interna es requerida',
                'modalidad_adjudicacion.required' => 'La modalidad de adjudicación es requerida',
                'forma_adjudicacion.required' => 'La forma de adjudicación es requerida',
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
        if ($tipoCarta->nombre == $this->IL) {
            $dataCarta['campo_adicional_uno'] = $request->solicitud_contratacion;
            $dataCarta['campo_adicional_dos'] = $request->fecha_dos;
            $dataCarta['campo_adicional_tres'] = $request->registro_ejecucion;
            $dataCarta['campo_adicional_cuatro'] = $request->comunicacion_interna;
            $dataCarta['campo_adicional_cinco'] = $request->modalidad_adjudicacion;
            $dataCarta['campo_adicional_seis'] = $request->forma_adjudicacion;
        }
        $carta = Carta::create($dataCarta);
        $this->createDirectivo($tipoCarta->nombre, $carta->id);
        if ($tipoCarta->nombre == $this->CTC) {
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

    private function directivo($cargo, $institucion)
    {
        return Directivo::where('cargo', $cargo)->where('activo', true)->where('institucion', $institucion)->first();
    }

    private function addCartaDirectivo($carta, $idDirectivo)
    {
        CartaDirectivo::create([
            'carta_id' => $carta,
            'directivo_id' => $idDirectivo,
        ]);
    }

    private function createDirectivo($tipo, $carta)
    {
        switch ($tipo) {
            case $this->SC:
                $director = $this->directivo($this->DR, $this->EI);
                $coordinador = $this->directivo($this->CA, $this->EIUAGRM);
                $responsable = $this->directivo($this->RPC, $this->JAF);
                $decano = $this->directivo($this->DC, $this->FCET);
                $this->addCartaDirectivo($carta, $director->id);
                $this->addCartaDirectivo($carta, $coordinador->id);
                $this->addCartaDirectivo($carta, $responsable->id);
                $this->addCartaDirectivo($carta, $decano->id);
                break;
            case $this->RP:
                $coordinador = $this->directivo($this->CA, $this->EIUAGRM);
                $this->addCartaDirectivo($carta, $coordinador->id);
                break;
            case $this->PC:
                $coordinador = $this->directivo($this->CA, $this->EIUAGRM);
                $this->addCartaDirectivo($carta, $coordinador->id);
                break;
            case $this->IT:
                $coordinador = $this->directivo($this->CA, $this->EIUAGRM);
                $responsable = $this->directivo($this->RPC, $this->JAF);
                $this->addCartaDirectivo($carta, $coordinador->id);
                $this->addCartaDirectivo($carta, $responsable->id);
                break;
            case $this->CI:
                $director = $this->directivo($this->DR, $this->EI);
                $responsable = $this->directivo($this->RPC, $this->JAF);
                $asesorLegal = $this->directivo($this->AL, $this->FCETUAGRM);
                $this->addCartaDirectivo($carta, $director->id);
                $this->addCartaDirectivo($carta, $responsable->id);
                $this->addCartaDirectivo($carta, $asesorLegal->id);
                break;
            case $this->IC:
                $director = $this->directivo($this->DR, $this->EI);
                $coordinador = $this->directivo($this->CA, $this->EIUAGRM);
                $this->addCartaDirectivo($carta, $director->id);
                $this->addCartaDirectivo($carta, $coordinador->id);
                break;
            case $this->CTC:
                $coordinador = $this->directivo($this->CA, $this->EIUAGRM);
                $this->addCartaDirectivo($carta, $coordinador->id);
                break;
            case $this->PP:
                $director = $this->directivo($this->DR, $this->EI);
                $jefeAd = $this->directivo($this->JAYF, $this->FCET);
                $decano = $this->directivo($this->DC, $this->FCET);
                $this->addCartaDirectivo($carta, $director->id);
                $this->addCartaDirectivo($carta, $jefeAd->id);
                $this->addCartaDirectivo($carta, $decano->id);
                break;
            case $this->IL:
                $asesorLegal = $this->directivo($this->AL, $this->FCETUAGRM);
                $comisionCalificacion = $this->directivo($this->CDC, $this->EIUAGRM);
                $this->addCartaDirectivo($carta, $asesorLegal->id);
                $this->addCartaDirectivo($carta, $comisionCalificacion->id);
                break;
            default:
                break;
        }
    }
}
