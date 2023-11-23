@extends('layouts.app', ['activePage' => 'contrataciones', 'titlePage' => 'Registrar Carta'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row" style="margin-left: 10%">
                <div class="col-md-11">
                    <form action="{{ route('carta.store') }}" method="post" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                @if ($codigo)
                                    <div class="row">
                                        <label for="nombre" class="col-sm-2 col-form-label"> <b>Codigo de la carta*</b>
                                        </label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="codigo" placeholder="Codigo">
                                            @if ($errors->has('codigo'))
                                                <span class="error text-danger"
                                                    for="input-codigo">{{ $errors->first('codigo') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <br>
                                @endif
                                @if ($contrato_admi)
                                    <div class="row">
                                        <label for="nombre" class="col-sm-2 col-form-label">
                                            <b>Contrato administrativo*</b>
                                        </label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="contrato_admi"
                                                placeholder="Contrato administrativo">
                                            @if ($errors->has('contrato_admi'))
                                                <span class="error text-danger"
                                                    for="input-contrato_admi">{{ $errors->first('contrato_admi') }}</span>
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
                                            value="{{ date('Y-m-d') }}">
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
                                                value="{{ date('Y-m-d') }}">
                                            @if ($errors->has('fecha'))
                                                <span class="error text-danger"
                                                    for="input-fecha">{{ $errors->first('fecha') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <br>
                                @endif
                                @if ($informe_legal)
                                    <div class="row">
                                        <label for="nombre" class="col-sm-2 col-form-label"> <b>Solicitud de
                                                contratación*</b>
                                        </label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="solicitud_contratacion">
                                            @if ($errors->has('solicitud_contratacion'))
                                                <span class="error text-danger"
                                                    for="input-solicitud_contratacion">{{ $errors->first('solicitud_contratacion') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <label for="nombre" class="col-sm-2 col-form-label"> <b> Segunda Fecha*</b>
                                        </label>
                                        <div class="col-sm-7">
                                            <input type="date" class="form-control" name="fecha_dos"
                                                value="{{ date('Y-m-d') }}">
                                            @if ($errors->has('fecha_dos'))
                                                <span class="error text-danger"
                                                    for="input-fecha_dos">{{ $errors->first('fecha_dos') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <label for="nombre" class="col-sm-2 col-form-label"> <b>Registro de ejecución*</b>
                                        </label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="fecha_resolucion">
                                            @if ($errors->has('registro_ejecucion'))
                                                <span class="error text-danger"
                                                    for="input-registro_ejecucion">{{ $errors->first('registro_ejecucion') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <label for="nombre" class="col-sm-2 col-form-label"> <b>Comunicacion interna*</b>
                                        </label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="comunicacion_interna">
                                            @if ($errors->has('comunicacion_interna'))
                                                <span class="error text-danger"
                                                    for="input-comunicacion_interna">{{ $errors->first('comunicacion_interna') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <label for="nombre" class="col-sm-2 col-form-label"> <b>Modalidad de
                                                adjudicacion*</b>
                                        </label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="modalidad_adjudicacion">
                                            @if ($errors->has('modalidad_adjudicacion'))
                                                <span class="error text-danger"
                                                    for="input-modalidad_adjudicacion">{{ $errors->first('modalidad_adjudicacion') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <label for="nombre" class="col-sm-2 col-form-label"> <b>Forma de adjudicacion*</b>
                                        </label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="forma_adjudicacion">
                                            @if ($errors->has('forma_adjudicacion'))
                                                <span class="error text-danger"
                                                    for="input-forma_adjudicacion">{{ $errors->first('forma_adjudicacion') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <br>
                                @endif

                                @if ($contrato_administrativo)
                                    <div class="row">
                                        <label for="nombre" class="col-sm-2 col-form-label"> <b>Fecha de informe de
                                                calificacion*</b>
                                        </label>
                                        <div class="col-sm-7">
                                            <input type="date" class="form-control" name="fecha_calificacion"
                                                value="{{ date('Y-m-d') }}">
                                            @if ($errors->has('fecha_calificacion'))
                                                <span class="error text-danger"
                                                    for="input-fecha_calificacion">{{ $errors->first('fecha_calificacion') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <label for="nombre" class="col-sm-2 col-form-label"> <b> Resolucion*</b>
                                        </label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="resolucion">
                                            @if ($errors->has('resolucion'))
                                                <span class="error text-danger"
                                                    for="input-resolucion">{{ $errors->first('resolucion') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <label for="nombre" class="col-sm-2 col-form-label"> <b>Fecha resolucion*</b>
                                        </label>
                                        <div class="col-sm-7">
                                            <input type="date" class="form-control" name="fecha_resolucion"
                                                value="{{ date('Y-m-d') }}">
                                            @if ($errors->has('fecha_resolucion'))
                                                <span class="error text-danger"
                                                    for="input-fecha_resolucion">{{ $errors->first('fecha_resolucion') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <label for="nombre" class="col-sm-2 col-form-label"> <b>Fecha informe de
                                                calificacion*</b>
                                        </label>
                                        <div class="col-sm-7">
                                            <input type="date" class="form-control" name="fecha_informe_calificacion">
                                            @if ($errors->has('fecha_informe_calificacion'))
                                                <span class="error text-danger"
                                                    for="input-fecha_informe_calificacion">{{ $errors->first('fecha_informe_calificacion') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <label for="nombre" class="col-sm-2 col-form-label"> <b>Plazo prestacion
                                                consultoria*</b>
                                        </label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control"
                                                name="plazo_prestacion_consultoria">
                                            @if ($errors->has('plazo_prestacion_consultoria'))
                                                <span class="error text-danger"
                                                    for="input-plazo_prestacion_consultoria">{{ $errors->first('plazo_prestacion_consultoria') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <br>
                                @endif

                                @if ($tabla)
                                    <div class="row">
                                        <label for="nombre" class="col-sm-2 col-form-label"> <b> Formación
                                                requerida</b>
                                        </label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="formacion_requerida"
                                                placeholder="Formacion Requerida">
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
                                                                        <input type="radio" name="formacion" checked
                                                                            value="Si">
                                                                        <span>SI</span>
                                                                    </td>
                                                                    <td>
                                                                        <input type="radio" name="formacion"
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
                                                                            checked value="Si">
                                                                        <span>SI</span>
                                                                    </td>
                                                                    <td>
                                                                        <input type="radio" name="cursos_continuo"
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
                                                                            checked value="Si">
                                                                        <span>SI</span>
                                                                    </td>
                                                                    <td>
                                                                        <input type="radio" name="experiencia_general"
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
                                                                        <input type="radio" name="nacionalidad" checked
                                                                            value="Si">
                                                                        <span>SI</span>
                                                                    </td>
                                                                    <td>
                                                                        <input type="radio" name="nacionalidad"
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
                                                                        <input type="number"
                                                                            name="experiencia_especifica" min="0"
                                                                            max="23" required class="form-control"
                                                                            placeholder="0">
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        ( Seminarios, Cursos, Talleres, Simposios y
                                                                        otros )
                                                                        <br>
                                                                        * Tiene mayor o igual a 2 certificados (1
                                                                        puntos)
                                                                        <br>
                                                                        * Tiene mayor o igual a 4 certificados (3
                                                                        puntos)
                                                                        <br>
                                                                        * Tiene mayor o igual a 6 certificados (5
                                                                        puntos)
                                                                    </td>
                                                                    <td>
                                                                        <input type="number" name="formacion_continua"
                                                                            min="0" max="9" required
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
                            <input type="hidden" value="{{ $id }}" name="contrato">
                            <input type="hidden" value="{{ $tipo }}" name="tipo">

                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit"class="btn btn-primary">
                                    <b>Guardar Datos</b>
                                </button>
                                <a href="{{ route('contrataciones.show', $id) }}"
                                    class="btn btn-primary"><b>Cancelar</b></a>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
