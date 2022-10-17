@extends('layouts.app', ['activePage' => 'usuario', 'titlePage' => 'Agregar Usuario'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row" style="margin-left: 10%">
                <div class="col-md-9">
                    <form action="{{ route('usuario.store') }}" method="post" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"> <b> Nombre:</b> </label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" name="nombre"
                                            value="{{ old('nombre') }}" autofocus placeholder="Nombre">
                                        @if ($errors->has('nombre'))
                                            <span class="error text-danger" for="input-nombre">
                                                {{ $errors->first('nombre') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"> <b>Apellido:</b></label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" name="apellido"
                                            value="{{ old('apellido') }}" autofocus placeholder="Apellido">
                                        @if ($errors->has('apellido'))
                                            <span class="error text-danger" for="input-nombre">
                                                {{ $errors->first('apellido') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"><b>Area:</b></label>
                                    <div class="col-sm-7">
                                        <select name="area_id" id="_area" class="form-control">
                                            <option disabled selected>Seleccione el Area</option>
                                            @foreach ($areas as $area)
                                                <option value="{{ $area->id }}">{{ $area->nombre }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('area_id'))
                                            <span class="error text-danger" for="input-area_id">
                                                {{ $errors->first('area_id') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"><b>Cargo:</b></label>
                                    <div class="col-sm-7">
                                        <select name="cargo_id" id="_cargo" class="form-control">
                                            <option disabled selected>Seleccione el Cargo</option>
                                            @foreach ($cargos as $cargo)
                                                <option value="{{ $cargo->id }}">{{ $cargo->nombre }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('cargo_id'))
                                            <span class="error text-danger" for="input-cargo_id">
                                                {{ $errors->first('cargo_id') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"><b>Rol:</b></label>
                                    <div class="col-sm-7">
                                        <select name="rol_id" id="_rol" class="form-control">
                                            <option disabled selected>Seleccione el rol</option>
                                            @foreach ($roles as $rol)
                                                <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('rol_id'))
                                            <span class="error text-danger" for="input-rol_id">
                                                {{ $errors->first('rol_id') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"><b>Ci:</b></label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" name="ci"
                                            value="{{ old('ci') }}" autofocus placeholder="Cedula">
                                        @if ($errors->has('ci'))
                                            <span class="error text-danger" for="input-nombre">
                                                {{ $errors->first('ci') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"><b>Correo:</b></label>
                                    <div class="col-sm-7">
                                        <input type="email" class="form-control" name="email"
                                            value="{{ old('email') }}" autofocus placeholder="Correo">
                                        @if ($errors->has('email'))
                                            <span class="error text-danger" for="input-nombre">
                                                {{ $errors->first('email') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"><b>Contraseña:</b></label>
                                    <div class="col-sm-7">
                                        <input type="password" class="form-control" name="password"
                                            placeholder="Contraseña">
                                        @if ($errors->has('password'))
                                            <span class="error text-danger" for="input-nombre">
                                                {{ $errors->first('password') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <br>
                            </div>
                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit"class="btn btn-primary">
                                    <b>Guardar Datos</b>
                                </button>
                                <a href="{{ route('usuario.index') }}" class="btn btn-primary"><b>Cancelar</b></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
