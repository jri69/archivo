@extends('layouts.app', ['activePage' => 'estudiante', 'titlePage' => 'Agregar carta'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row" style="margin-left: 10%">
                <div class="col-md-11">
                    <form action="{{ route('estudiante.cartaStore', [$estudiante->id, $titulacion->id, $tipo->id]) }}"
                        method="post" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Codigo de carta</label>
                                            <input type="text" class="form-control" name="codigo_admi" required>
                                        </div>
                                        @if ($errors->has('codigo_admi'))
                                            <span class="error text-danger"
                                                for="input-codigo_admi">{{ $errors->first('codigo_admi') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {{-- <label class="bmd-label">Fecha de la carta</label> --}}
                                            <input type="date" class="form-control" name="fecha"
                                                value="{{ date('Y-m-d') }}">
                                        </div>
                                        @if ($errors->has('fecha'))
                                            <span class="error text-danger"
                                                for="input-fecha">{{ $errors->first('fecha') }}</span>
                                        @endif
                                    </div>
                                </div>
                                @if ($codigo1 || $codigo2)
                                    <br>
                                    <div class="row">
                                        @if ($codigo1)
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="bmd-label-floating">
                                                        @if ($tipo->id == 18 || $tipo->id == 25)
                                                            Codigo de resolucion CAC
                                                        @elseif ($tipo->id == 21 || $tipo->id == 23)
                                                            Codigo de coordinacion de investigacion
                                                        @elseif ($tipo->id == 31)
                                                            Codigo de resolucion de tribunal
                                                        @elseif ($tipo->id == 32)
                                                            Codigo Res. COM. AC-C Nº
                                                        @else
                                                            Codigo de CA
                                                        @endif
                                                    </label>
                                                    <input type="text" class="form-control" name="codigo1">
                                                </div>
                                                @if ($errors->has('codigo1'))
                                                    <span class="error text-danger"
                                                        for="input-codigo1">{{ $errors->first('codigo1') }}</span>
                                                @endif
                                            </div>
                                        @endif
                                        <div class="col-md-6">
                                            @if ($codigo2)
                                                <div class="form-group">
                                                    <label class="bmd-label-floating">
                                                        @if ($tipo->id == 20)
                                                            Codigo de resolucion homolagacion
                                                        @elseif ($tipo->id == 21)
                                                            Codigo de informe de cumplimiento de requisitos
                                                        @elseif ($tipo->id == 32)
                                                            Codigo Res. CONS.D.P. Nº
                                                        @else
                                                            Codigo de resolucion CAC
                                                        @endif
                                                    </label>
                                                    <input type="text" class="form-control" name="codigo2">
                                                </div>
                                                @if ($errors->has('codigo2'))
                                                    <span class="error text-danger"
                                                        for="input-codigo2">{{ $errors->first('codigo2') }}</span>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                @if ($codigo3 || $exceso)
                                    <br>
                                    <div class="row">
                                        @if ($codigo3)
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="bmd-label-floating">
                                                        @if ($tipo->id == 13)
                                                            Codigo de ICRP
                                                        @endif
                                                        @if ($tipo->id == 32)
                                                            Codigo de resolucion de DEP
                                                        @endif
                                                        @if ($tipo->id == 14 || $tipo->id == 23)
                                                            Codigo de resolucion CAC
                                                        @endif
                                                        @if ($tipo->id == 18 || $tipo->id == 25)
                                                            Codigo de resolucion CD
                                                        @endif
                                                    </label>
                                                    <input type="text" class="form-control" name="codigo3" required>
                                                </div>
                                                @if ($errors->has('codigo3'))
                                                    <span class="error text-danger"
                                                        for="input-codigo3">{{ $errors->first('codigo3') }}</span>
                                                @endif
                                            </div>
                                        @endif
                                        <div class="col-md-6">
                                            @if ($exceso)
                                                <div class="form-group">
                                                    <label class="bmd-label-floating">
                                                        @if ($tipo->id == 23)
                                                            Codigo Resolucion DGP
                                                        @else
                                                            Tiempo de elaboracion
                                                        @endif
                                                    </label>
                                                    <input type="text" class="form-control" name="exceso" required>
                                                </div>
                                                @if ($errors->has('exceso'))
                                                    <span class="error text-danger"
                                                        for="input-exceso">{{ $errors->first('exceso') }}</span>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                @if ($fecha_ini || $fecha_fin)
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            @if ($fecha_ini)
                                                <label class="bmd-label-floating">Fecha de inicio del programa</label>
                                                <div class="form-group">
                                                    <input type="date" class="form-control" name="fecha_ini" required>
                                                </div>
                                                @if ($errors->has('fecha_ini'))
                                                    <span class="error text-danger"
                                                        for="input-fecha_ini">{{ $errors->first('fecha_ini') }}</span>
                                                @endif
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            @if ($fecha_fin)
                                                <label class="bmd-label-floating">Fecha de finalizacion del programa</label>
                                                <div class="form-group">
                                                    <input type="date" class="form-control" name="fecha_fin" required>
                                                </div>
                                                @if ($errors->has('fecha_fin'))
                                                    <span class="error text-danger"
                                                        for="input-fecha_fin">{{ $errors->first('fecha_fin') }}</span>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                @if ($dia_defensa || $hora_defensa)
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            @if ($dia_defensa)
                                                @if ($tipo->id == 31)
                                                    <label class="bmd-label-floating"> fecha de defensa </label>
                                                    <div class="form-group">
                                                        <input type="date" class="form-control" name="dia_defensa"
                                                            required>
                                                    </div>
                                                @else
                                                    <label class="bmd-label-floating"> Dia y fecha de presentacion </label>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="dia_defensa"
                                                            placeholder="Dia y fecha" required>
                                                    </div>
                                                @endif
                                                @if ($errors->has('dia_defensa'))
                                                    <span class="error text-danger"
                                                        for="input-dia_defensa">{{ $errors->first('dia_defensa') }}</span>
                                                @endif
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            @if ($hora_defensa)
                                                <label class="bmd-label-floating">Hora de defensa</label>
                                                <div class="form-group">
                                                    <input type="time" class="form-control" name="hora_defensa" required>
                                                </div>
                                                @if ($errors->has('hora_defensa'))
                                                    <span class="error text-danger"
                                                        for="input-hora_defensa">{{ $errors->first('hora_defensa') }}</span>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                @if ($articulo)
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="bmd-label-floating"> Articulo </label>
                                                <input type="text" class="form-control" name="articulo" required>
                                            </div>
                                            @if ($errors->has('articulo'))
                                                <span class="error text-danger"
                                                    for="input-articulo">{{ $errors->first('articulo') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                @if ($nroTransaccion)
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="bmd-label-floating"> N° de transaccion </label>
                                                <input type="text" class="form-control" name="nroTransaccion"
                                                    required>
                                            </div>
                                            @if ($errors->has('nroTransaccion'))
                                                <span class="error text-danger"
                                                    for="input-nroTransaccion">{{ $errors->first('nroTransaccion') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                @if ($consupo)
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">
                                                    Consupo
                                                </label>
                                                <input type="text" class="form-control" name="consupo" required>
                                            </div>
                                            @if ($errors->has('consupo'))
                                                <span class="error text-danger"
                                                    for="input-consupo">{{ $errors->first('consupo') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                @if ($directorTFG)
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">
                                                    Director TFG
                                                </label>
                                                <input type="text" class="form-control" name="directorTFG" required>
                                            </div>
                                            @if ($errors->has('directorTFG'))
                                                <span class="error text-danger"
                                                    for="input-directorTFG">{{ $errors->first('directorTFG') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                @if ($whatPay || $poa)
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">Motivo de pago</label>
                                                <input type="text" class="form-control" name="whatPay" required>
                                            </div>
                                            @if ($errors->has('whatPay'))
                                                <span class="error text-danger"
                                                    for="input-whatPay">{{ $errors->first('whatPay') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">POA</label>
                                                <input type="text" class="form-control" name="poa" required>
                                            </div>
                                            @if ($errors->has('poa'))
                                                <span class="error text-danger"
                                                    for="input-poa">{{ $errors->first('poa') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                @if ($apertura || $codigo_partida)
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">Apertura programatica</label>
                                                <input type="text" class="form-control" name="apertura" required>
                                            </div>
                                            @if ($errors->has('apertura'))
                                                <span class="error text-danger"
                                                    for="input-apertura">{{ $errors->first('apertura') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">Codigo de partida</label>
                                                <input type="text" class="form-control" name="codigo_partida"
                                                    required>
                                            </div>
                                            @if ($errors->has('codigo_partida'))
                                                <span class="error text-danger"
                                                    for="input-codigo_partida">{{ $errors->first('codigo_partida') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                @if ($monto_pagar)
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">Monto a pagar</label>
                                                <input type="text" class="form-control" name="monto_pagar" required>
                                            </div>
                                            @if ($errors->has('monto_pagar'))
                                                <span class="error text-danger"
                                                    for="input-monto_pagar">{{ $errors->first('monto_pagar') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                @if ($originalidad || $similitud)
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            @if ($originalidad)
                                                <div class="form-group">
                                                    <label class="bmd-label-floating">Originalidad</label>
                                                    <input type="number" class="form-control" name="originalidad">
                                                </div>
                                                @if ($errors->has('originalidad'))
                                                    <span class="error text-danger"
                                                        for="input-originalidad">{{ $errors->first('originalidad') }}</span>
                                                @endif
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            @if ($similitud)
                                                <div class="form-group">
                                                    <label class="bmd-label-floating">Similitud</label>
                                                    <input type="number" class="form-control" name="similitud">
                                                </div>
                                                @if ($errors->has('similitud'))
                                                    <span class="error text-danger"
                                                        for="input-similitud">{{ $errors->first('similitud') }}</span>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                @if ($ejeTematico || $isDocente)
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            @if ($ejeTematico)
                                                <div class="form-group">
                                                    <label class="bmd-label-floating">Ejes tematicos</label>
                                                    <input type="text" class="form-control" name="eje_tematico">
                                                </div>
                                                @if ($errors->has('eje_tematico'))
                                                    <span class="error text-danger"
                                                        for="input-eje_tematico">{{ $errors->first('eje_tematico') }}</span>
                                                @endif
                                            @endif
                                        </div>
                                        @if ($isDocente)
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <div class="form-check form-check-radio col-md-4">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" type="radio"
                                                                name="is_docente" value="Es docente" checked> Docente
                                                            <span class="circle">
                                                                <span class="check"></span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                    <div class="form-check form-check-radio col-md-4">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" type="radio"
                                                                name="is_docente" value="No es docente"> No Docente
                                                            <span class="circle">
                                                                <span class="check"></span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                                @if ($documento && $tipo->id != 24 && $tipo->id != 25)
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <div class="form-check form-check-radio col-md-3">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="radio" name="documento"
                                                            value="perfil" checked> Perfil
                                                        <span class="circle">
                                                            <span class="check"></span>
                                                        </span>
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-radio col-md-3">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="radio" name="documento"
                                                            value="borrador"> Borrador
                                                        <span class="circle">
                                                            <span class="check"></span>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                        </div>
                                    </div>
                                @endif
                                @if ($documento && $tipo->id == 24)
                                    <input class="form-check-input" type="radio" name="documento"
                                        value="Trabajo final de grado" checked hidden>
                                @endif
                                @if ($documento && $tipo->id == 25)
                                    <input class="form-check-input" type="radio" name="documento" value="Final"
                                        checked hidden>
                                @endif
                                @if ($tematica)
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="bmd-label-floating"> Tematica </label>
                                                <input type="text" class="form-control" name="tematica" required>
                                            </div>
                                            @if ($errors->has('tematica'))
                                                <span class="error text-danger"
                                                    for="input-tematica">{{ $errors->first('tematica') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                @if ($profesion || $aporte)
                                    <br>
                                    <div class="row">
                                        @if ($profesion)
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <textarea class="form-control" name="profesion" rows="3" placeholder="Profesion"></textarea>
                                                    <div class="alert alert-info" role="alert">
                                                        <strong>Cada profesion separada de una coma</strong>
                                                    </div>
                                                </div>
                                                @if ($errors->has('profesion'))
                                                    <span class="error text-danger"
                                                        for="input-profesion">{{ $errors->first('profesion') }}</span>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                    <div class="row">
                                        @if ($aporte)
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <textarea class="form-control" name="aporte_academico" rows="3" placeholder="Aporte Cientifico"></textarea>
                                                </div>
                                                @if ($errors->has('aporte_academico'))
                                                    <span class="error text-danger"
                                                        for="input-aporte_academico">{{ $errors->first('aporte_academico') }}</span>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                @endif
                                @if ($tribunal)
                                    <br>
                                    {{-- h4 que diga miembros del tribunal --}}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">Nombre del jurado</label>
                                                <input type="text" class="form-control" name="nombre">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <div class="form-check form-check-radio col-md-3"
                                                    style="margin-left: 20px">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="radio" name="sexo"
                                                            value="M" checked> Hombre
                                                        <span class="circle">
                                                            <span class="check"></span>
                                                        </span>
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-radio col-md-3">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="radio" name="sexo"
                                                            value="F"> Mujer
                                                        <span class="circle">
                                                            <span class="check"></span>
                                                        </span>
                                                    </label>
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
                                <a href="{{ route('estudiante.carta', [$estudiante->id, $titulacion->programa_id]) }}"
                                    class="btn btn-primary"><b>Cancelar</b></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
