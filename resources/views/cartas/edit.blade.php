@extends('layouts.app', ['activePage' => 'contrataciones', 'titlePage' => 'Registrar Carta'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row" style="margin-left: 10%">
                <div class="col-md-11">
                    <form action="{{ route('carta.update', $carta->id) }}" method="post" class="form-horizontal"
                        enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                @if ($codigo)
                                    <div class="row">
                                        <label for="nombre" class="col-sm-2 col-form-label"> <b>Codigo de la carta*</b>
                                        </label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="codigo" placeholder="Codigo"
                                                value="{{ $carta->codigo_admi }} ">
                                            @if ($errors->has('codigo'))
                                                <span class="error text-danger"
                                                    for="input-codigo">{{ $errors->first('codigo') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <br>
                                @endif
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"> <b> Fecha*</b>
                                    </label>
                                    <div class="col-sm-7">
                                        <input type="date" class="form-control" name="fecha"
                                            value="{{ $carta->fecha }}">
                                        @if ($errors->has('fecha'))
                                            <span class="error text-danger"
                                                for="input-fecha">{{ $errors->first('fecha') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                @if ($plazo)
                                    <div class="row">
                                        <label for="nombre" class="col-sm-2 col-form-label"> <b> Fecha de plazo</b>
                                        </label>
                                        <div class="col-sm-7">
                                            <input type="date" class="form-control" name="fecha_plazo"
                                                value="{{ $carta->fecha_plazo }}">
                                            @if ($errors->has('fecha'))
                                                <span class="error text-danger"
                                                    for="input-fecha">{{ $errors->first('fecha') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <br>
                                @endif
                                @if ($tabla)
                                    <div class="row">
                                        <label for="nombre" class="col-sm-2 col-form-label"> <b> Formación requerida</b>
                                        </label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="formacion_requerida"
                                                value="{{ $cuadro->formacion_requerida }}">
                                            @if ($errors->has('formacion_requerida'))
                                                <span class="error text-danger"
                                                    for="input-formacion_requerida">{{ $errors->first('formacion_requerida') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-header card-header-primary">
                                                    <h4> FORMULARIO C1</h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <thead class="text-primary text-dark">
                                                                <th>PUNTAJE DE EVALUACION</th>
                                                                <th>PUNTAJE</th>
                                                                <th>CUMPLE</th>
                                                                <th>NO CUMPLE</th>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>
                                                                        1.1 FORMACION: a Nivel Licenciatura Ing.
                                                                        Industrial
                                                                        o ramas
                                                                        afines.; <br> Titulo de maestría.
                                                                    </td>
                                                                    <td> 15 </td>
                                                                    <td>
                                                                        <input type="radio" name="formacion"
                                                                            {{ $cuadro->formacion == 'Si' ? 'checked' : '' }}
                                                                            value="Si">
                                                                        <span>SI</span>
                                                                    </td>
                                                                    <td>
                                                                        <input type="radio" name="formacion"
                                                                            {{ $cuadro->formacion == 'No' ? 'checked' : '' }}
                                                                            value="No">
                                                                        <span>NO</span>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        1.2 CURSOS DE FORMACION CONTINUA:
                                                                        Certificado de
                                                                        asistencia a cursos, seminarios,
                                                                        talleres,
                                                                        simposios, conferencia u otros
                                                                    </td>
                                                                    <td> 10 </td>
                                                                    <td>
                                                                        <input type="radio" name="cursos_continuo"
                                                                            {{ $cuadro->cursos_continuo == 'Si' ? 'checked' : '' }}
                                                                            value="Si">
                                                                        <span>SI</span>
                                                                    </td>
                                                                    <td>
                                                                        <input type="radio" name="cursos_continuo"
                                                                            {{ $cuadro->cursos_continuo == 'No' ? 'checked' : '' }}
                                                                            value="No">
                                                                        <span>NO</span>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        1.3 EXPERIENCIA GENERAL: 3 años mínimo
                                                                        de
                                                                        experiencia laboral certificada.
                                                                    </td>
                                                                    <td> 10 </td>
                                                                    <td>
                                                                        <input type="radio" name="experiencia_general"
                                                                            {{ $cuadro->experiencia_general == 'Si' ? 'checked' : '' }}
                                                                            checked value="Si">
                                                                        <span>SI</span>
                                                                    </td>
                                                                    <td>
                                                                        <input type="radio" name="experiencia_general"
                                                                            {{ $cuadro->experiencia_general == 'No' ? 'checked' : '' }}
                                                                            value="No">
                                                                        <span>NO</span>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        1.4 NACIONALIDAD: Boliviana; Extranjero
                                                                        con
                                                                        residencia en el país y/o permiso de
                                                                        trabajo
                                                                    </td>
                                                                    <td> </td>
                                                                    <td>
                                                                        <input type="radio" name="nacionalidad"
                                                                            {{ $cuadro->nacionalidad == 'Si' ? 'checked' : '' }}
                                                                            value="Si">
                                                                        <span>SI</span>
                                                                    </td>
                                                                    <td>
                                                                        <input type="radio" name="nacionalidad"
                                                                            {{ $cuadro->nacionalidad == 'No' ? 'checked' : '' }}
                                                                            value="No">
                                                                        <span>NO</span>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-header card-header-primary">
                                                    <h4> FORMULARIO C2</h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <thead class="text-primary text-dark">
                                                                <th>CONDICIONES ADICIONALES</th>
                                                                <th>PUNTAJE ASIGNADO</th>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>
                                                                        ( Experiencia laboral ) <br>
                                                                        * Menor a 1 año (5 puntos) <br>
                                                                        * Entre 1 y 2 años (8 puntos) <br>
                                                                        * Mayor o igual a 3 años (10 puntos)
                                                                    </td>
                                                                    <td>
                                                                        <input type="number" name="experiencia_especifica"
                                                                            value="{{ $cuadro->experiencia_especifica }}"
                                                                            min="0" max="23" required
                                                                            class="form-control" placeholder="0">
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        ( Seminarios, Cursos, Talleres, Simposios y otros )
                                                                        <br>
                                                                        * Tiene mayor o igual a 2 certificados (1 puntos)
                                                                        <br>
                                                                        * Tiene mayor o igual a 4 certificados (3 puntos)
                                                                        <br>
                                                                        * Tiene mayor o igual a 6 certificados (5 puntos)
                                                                    </td>
                                                                    <td>
                                                                        <input type="number" name="formacion_continua"
                                                                            min="0" max="9" required
                                                                            value="{{ $cuadro->formacion_continua }}"
                                                                            class="form-control" placeholder="0">
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        ( Propuesta Tecnica )
                                                                        <br>
                                                                        * Objetivo y desarrollo de las actividades (20
                                                                        puntos)
                                                                    </td>
                                                                    <td>
                                                                        <input type="number" name="propuesta_tecnica"
                                                                            value="{{ $cuadro->propuesta_tecnica }}"
                                                                            min="0" max="20" required
                                                                            class="form-control" placeholder="0">
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit"class="btn btn-primary">
                                    <b>Guardar Datos</b>
                                </button>
                                <a href="{{ route('contrataciones.show', $carta->contrato_id) }}"
                                    class="btn btn-primary"><b>Cancelar</b></a>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
