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
                                    <label for="nombre" class="col-sm-2 col-form-label"> <b> Programa:</b> </label>
                                    <div class="col-sm-7">
                                        <select class="form-control" name="id_programa">
                                            <option disabled selected>Seleccione el programa</option>
                                            @foreach ($programas as $programa)
                                                <option value="{{ $programa->id }}">
                                                    {{ $programa->nombre }} -
                                                    {{ $programa->version . '.' . $programa->edicion }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('id_programa'))
                                            <span class="error text-danger"
                                                for="input-id_programa">{{ $errors->first('id_programa') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"> <b> Docente:</b> </label>
                                    <div class="col-sm-7">
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
                                <br>
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"> <b> Nombre del Módulo:</b>
                                    </label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" name="nombre" placeholder="Nombre">
                                        @if ($errors->has('nombre'))
                                            <span class="error text-danger"
                                                for="input-nombre">{{ $errors->first('nombre') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"> <b> Sigla:</b> </label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" name="sigla" placeholder="Sigla">
                                        @if ($errors->has('sigla'))
                                            <span class="error text-danger"
                                                for="input-sigla">{{ $errors->first('sigla') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"> <b> Versión:</b> </label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" name="version" placeholder="Versión">
                                        @if ($errors->has('version'))
                                            <span class="error text-danger"
                                                for="input-version">{{ $errors->first('version') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"> <b> Edición:</b> </label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" name="edicion" placeholder="Edición">
                                        @if ($errors->has('edicion'))
                                            <span class="error text-danger"
                                                for="input-edicion">{{ $errors->first('edicion') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"> <b> Fecha de inicio:</b> </label>
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
