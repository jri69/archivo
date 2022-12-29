@extends('layouts.app', ['activePage' => 'modulo', 'titlePage' => 'Agregar Módulo'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row" style="margin-left: 10%">
                <div class="col-md-11">
                    <form action="{{ route('modulo.store') }}" method="post" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select class="form-control" name="programa_id">
                                                <option disabled selected>Seleccione el programa</option>
                                                @foreach ($programas as $programa)
                                                    <option value="{{ $programa->id }}">
                                                        {{ $programa->nombre }} -
                                                        {{ $programa->version . '.' . $programa->edicion }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('programa_id'))
                                                <span class="error text-danger"
                                                    for="input-programa_id">{{ $errors->first('programa_id') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select class="form-control" name="docente_id">
                                                <option disabled selected>Seleccione el docente</option>
                                                @foreach ($docentes as $docente)
                                                    <option value="{{ $docente->id }}">
                                                        {{ $docente->honorifico }} {{ $docente->nombre }}
                                                        {{ $docente->apellido }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('docente_id'))
                                                <span class="error text-danger"
                                                    for="input-docente_id">{{ $errors->first('docente_id') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Codigo del modulo</label>
                                            <input type="text" class="form-control" name="codigo"
                                                value="{{ old('codigo') }}">
                                            @if ($errors->has('codigo'))
                                                <span class="error text-danger"
                                                    for="input-codigo">{{ $errors->first('codigo') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Nombre del modulo</label>
                                            <input type="text" class="form-control" name="nombre"
                                                value="{{ old('nombre') }}">
                                            @if ($errors->has('nombre'))
                                                <span class="error text-danger"
                                                    for="input-nombre">{{ $errors->first('nombre') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Sigla</label>
                                            <input type="text" class="form-control" name="sigla"
                                                value="{{ old('sigla') }}">
                                            @if ($errors->has('sigla'))
                                                <span class="error text-danger"
                                                    for="input-sigla">{{ $errors->first('sigla') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Hrs Academicas</label>
                                            <input type="number" class="form-control" name="hrs_academicas"
                                                value="{{ old('hrs_academicas') }}">
                                            @if ($errors->has('hrs_academicas'))
                                                <span class="error text-danger"
                                                    for="input-hrs_academicas">{{ $errors->first('hrs_academicas') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Versión</label>
                                            <input type="text" class="form-control" name="version"
                                                value="{{ old('version') }}">
                                            @if ($errors->has('version'))
                                                <span class="error text-danger"
                                                    for="input-version">{{ $errors->first('version') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Edición</label>
                                            <input type="text" class="form-control" name="edicion"
                                                value="{{ old('edicion') }}">
                                            @if ($errors->has('edicion'))
                                                <span class="error text-danger"
                                                    for="input-edicion">{{ $errors->first('edicion') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"> <b> Modalidad:</b>
                                    </label>
                                    <div class="col-sm-7">
                                        <input type="radio" name="modalidad" value="Presencial" checked>
                                        <span>Presencial</span>

                                        <input type="radio" name="modalidad" value="Virtual" style='margin-left: 20px'>
                                        <span>Virtual</span>

                                        <input type="radio" name="modalidad" value="Semi-Presencial"
                                            style='margin-left: 20px'>
                                        <span>Semi-Presencial</span>
                                    </div>
                                    <div class="col-sm-7">
                                        @if ($errors->has('modalidad'))
                                            <span class="error text-danger"
                                                for="input-modalidad">{{ $errors->first('modalidad') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"> <b> Fecha de inicio:</b>
                                    </label>
                                    <div class="col-sm-7">
                                        <input type="date" class="form-control" name="fecha_inicio">
                                        @if ($errors->has('fecha_inicio'))
                                            <span class="error text-danger"
                                                for="input-fecha_inicio">{{ $errors->first('fecha_inicio') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"> <b> Fecha de finalización:</b>
                                    </label>
                                    <div class="col-sm-7">
                                        <input type="date" class="form-control" name="fecha_final">
                                        @if ($errors->has('fecha_final'))
                                            <span class="error text-danger"
                                                for="input-fecha_final">{{ $errors->first('fecha_final') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div hidden>
                                    <input type="text" class="form-control" name="estado" value="Sin iniciar">
                                </div>
                                <br>
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"> <b> Contenido:</b>
                                    </label>
                                    <div class="col-sm-7">
                                        <textarea class="form-control" name="contenido" rows="5" value="{{ old('contenido') }}"></textarea>
                                        @if ($errors->has('contenido'))
                                            <span class="error text danger"
                                                for="input-contenido">{{ $errors->first('contenido') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit"class="btn btn-primary">
                                    <b>Guardar Datos</b>
                                </button>
                                <a href="{{ route('modulo.index') }}" class="btn btn-primary"><b>Cancelar</b></a>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
