@extends('layouts.app', ['activePage' => 'modulo', 'titlePage' => 'Editar Módulo'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row" style="margin-left: 10%">
                <div class="col-md-11">
                    <form action="{{ route('modulo.update', $modulo->id) }}" method="post" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <label class="col-sm-2 col-form-label"><b> Programa:</b></label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <input type="text" class="form-control" disabled
                                                value="{{ $programa->nombre }}">
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label"><b> Docente:</b></label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <input type="text" class="form-control" disabled
                                                value="{{ $modulo->docente->honorifico . ' ' . $modulo->docente->nombre . ' ' . $modulo->docente->apellido }}">
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"> <b> Nombre del Módulo:</b>
                                    </label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" name="nombre" placeholder="Nombre"
                                            value="{{ old('nombre', $modulo->nombre) }}">
                                        @if ($errors->has('nombre'))
                                            <span class="error text-danger"
                                                for="input-nombre">{{ $errors->first('nombre') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"> <b> Hrs Academicas:</b> </label>
                                    <div class="col-sm-7">
                                        <input type="number" class="form-control" name="hrs_academicas"
                                            placeholder="Horas Academicas"
                                            value="{{ old('hrs_academicas', $modulo->hrs_academicas) }}">
                                        @if ($errors->has('hrs_academicas'))
                                            <span class="error text-danger"
                                                for="input-hrs_academicas">{{ $errors->first('hrs_academicas') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"> <b> Sigla:</b> </label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" name="sigla" placeholder="Sigla"
                                            value="{{ old('sigla', $modulo->sigla) }}">
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
                                        <input type="text" class="form-control" name="version" placeholder="Versión"
                                            value="{{ old('version', $modulo->version) }}">
                                        @if ($errors->has('version'))
                                            <span class="error text-danger"
                                                for="input-version">{{ $errors->first('version') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"> <b> Modalidad:</b>
                                    </label>
                                    <div class="col-sm-7">
                                        <input type="radio" name="modalidad" value="Presencial"
                                            {{ $modulo->modalidad == 'Presencial' ? 'checked' : '' }}>
                                        <span>Presencial</span>

                                        <input type="radio" name="modalidad" value="Virtual" style='margin-left: 20px'
                                            {{ $modulo->modalidad == 'Virtual' ? 'checked' : '' }}>
                                        <span>Virtual</span>
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
                                    <label for="nombre" class="col-sm-2 col-form-label"> <b> Edición:</b> </label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" name="edicion" placeholder="Edición"
                                            value="{{ old('edicion', $modulo->edicion) }}">
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
                                        <input type="date" class="form-control" name="fecha_inicio"
                                            value="{{ $modulo->fecha_inicio }}">
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
                                        <input type="date" class="form-control" name="fecha_final"
                                            value="{{ $modulo->fecha_final }}">
                                        @if ($errors->has('fecha_final'))
                                            <span class="error text-danger"
                                                for="input-fecha_final">{{ $errors->first('fecha_final') }}</span>
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
