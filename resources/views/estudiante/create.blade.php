@extends('layouts.app', ['activePage' => 'estudiante', 'titlePage' => 'Agregar Estudiante'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row" style="margin-left: 10%">
                <div class="col-md-11">
                    <form action="{{ route('estudiante.store') }}" method="post" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Nombre del estudiante</label>
                                            <input type="text" class="form-control" name="nombre">
                                        </div>
                                        @if ($errors->has('nombre'))
                                            <span class="error text-danger"
                                                for="input-nombre">{{ $errors->first('nombre') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Correo Electrónico</label>
                                            <input type="email" class="form-control" name="email">
                                        </div>
                                        @if ($errors->has('email'))
                                            <span class="error text-danger"
                                                for="input-email">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Telefono</label>
                                            <input type="text" class="form-control" name="telefono">
                                        </div>
                                        @if ($errors->has('telefono'))
                                            <span class="error text-danger"
                                                for="input-telefono">{{ $errors->first('telefono') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <br>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Cédula de identidad</label>
                                            <input type="text" class="form-control" name="cedula">
                                        </div>
                                        @if ($errors->has('cedula'))
                                            <span class="error text-danger"
                                                for="input-cedula">{{ $errors->first('cedula') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select class="form-control" name="expedicion">
                                                <option disabled selected>Seleccione la expedición</option>
                                                <option value="TJ">TJ</option>
                                                <option value="SC">SC</option>
                                                <option value="CH">CH</option>
                                                <option value="LP">LP</option>
                                                <option value="CB">CB</option>
                                                <option value="OR">OR</option>
                                                <option value="PT">PT</option>
                                                <option value="BE">BE</option>
                                                <option value="PD">PD</option>
                                            </select>
                                        </div>
                                        @if ($errors->has('expedicion'))
                                            <span class="error text-danger"
                                                for="input-expedicion">{{ $errors->first('expedicion') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <br>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Carrera</label>
                                            <input type="text" class="form-control" name="carrera">
                                        </div>
                                        @if ($errors->has('carrera'))
                                            <span class="error text-danger"
                                                for="input-carrera">{{ $errors->first('carrera') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Universidad</label>
                                            <input type="text" class="form-control" name="universidad">
                                        </div>
                                        @if ($errors->has('universidad'))
                                            <span class="error text-danger"
                                                for="input-universidad">{{ $errors->first('universidad') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <br>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select class="form-control" name="id_programa">
                                                <option disabled selected>Seleccione el programa</option>
                                                @foreach ($programas as $programa)
                                                    <option value="{{ $programa->id }}">
                                                        {{ $programa->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @if ($errors->has('id_programa'))
                                            <span class="error text-danger"
                                                for="input-id_programa">{{ $errors->first('id_programa') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <br>

                                <!-- input para subir multiples archivos solo pdf -->
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"> <b> Archivo:</b> </label>
                                    <div class="col-sm-7">
                                        <input type="file" class="form-control" name="archivo[]" } multiple>
                                        @if ($errors->has('archivo'))
                                            <span class="error text-danger"
                                                for="input-archivo">{{ $errors->first('archivo') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <br>

                                <!-- checkbox con requisitos-->
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"> <b> Requisitos:</b> </label>
                                    <div class="col-sm-7">
                                        @foreach ($requisitos as $requisito)
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="checkbox" name="requisitos[]"
                                                        value="{{ $requisito->id }}">
                                                    {{ $requisito->nombre }}
                                                    <span class="form-check-sign">
                                                        <span class="check"></span>
                                                    </span>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <br>

                                <div hidden>
                                    <input type="text" name="estado" value="Activo">
                                </div>
                            </div>

                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit" class="btn btn-primary">
                                    <b>Guardar Datos</b>
                                </button>
                                <a href="{{ route('estudiante.index') }}" class="btn btn-primary"><b>Cancelar</b></a>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
