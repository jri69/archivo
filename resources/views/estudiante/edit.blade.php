@extends('layouts.app', ['activePage' => 'estudiante', 'titlePage' => 'Agregar Estudiante'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row" style="margin-left: 10%">
                <div class="col-md-11">
                    <form action="{{ route('estudiante.update', $estudiante->id) }}" method="post" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Nombre del estudiante</label>
                                            <input type="text" class="form-control" name="nombre"
                                                value="{{ $estudiante->nombre }}">
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
                                            <input type="email" class="form-control" name="email"
                                                value="{{ $estudiante->email }}">
                                        </div>
                                        @if ($errors->has('email'))
                                            <span class="error text-danger"
                                                for="input-email">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Telefono</label>
                                            <input type="text" class="form-control" name="telefono"
                                                value="{{ $estudiante->telefono }}">
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
                                            <input type="text" class="form-control" name="cedula"
                                                value="{{ $estudiante->cedula }}">
                                        </div>
                                        @if ($errors->has('cedula'))
                                            <span class="error text-danger"
                                                for="input-cedula">{{ $errors->first('cedula') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select class="form-control" name="expedicion"
                                                value="{{ $estudiante->expedicion }}">
                                                <option disabled>Seleccione la expedición</option>
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
                                            <input type="text" class="form-control" name="carrera"
                                                value="{{ $estudiante->carrera }}">
                                        </div>
                                        @if ($errors->has('carrera'))
                                            <span class="error text-danger"
                                                for="input-carrera">{{ $errors->first('carrera') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Universidad</label>
                                            <input type="text" class="form-control" name="universidad"
                                                value="{{ $estudiante->universidad }}">
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
                                            <label class="bmd-label-floating">Estado</label>
                                            <input type="text" class="form-control" name="estado"
                                                value="{{ $estudiante->estado }}">
                                        </div>
                                        @if ($errors->has('estado'))
                                            <span class="error text-danger"
                                                for="input-estado">{{ $errors->first('estado') }}</span>
                                        @endif
                                    </div>

                                </div>
                                <br>

                                <!-- input para subir multiples archivos solo pdf -->
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"> <b> Archivo:</b> </label>
                                    <div class="col-sm-7">
                                        <input type="file" class="form-control" name="archivo[]" placeholder="Archivo"
                                            multiple>
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
                                                        value="{{ $requisito->id }}"
                                                        {{ in_array($requisito->id, $requisitosCumplidos) ? 'checked' : '' }}>
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
                            </div>

                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit"class="btn btn-primary">
                                    <b>Guardar Datos</b>
                                </button>
                                <a href="{{ route('estudiante.show', $estudiante->id) }}"
                                    class="btn btn-primary"><b>Cancelar</b></a>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
