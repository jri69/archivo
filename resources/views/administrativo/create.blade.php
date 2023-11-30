@extends('layouts.app', ['activePage' => 'administrativo', 'titlePage' => 'Administrativos'])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row" style="margin-left: 10%">
                <div class="col-md-10">
                    <form action="{{ route('administrativo.store') }}" method="post" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"> <b> Nombre:</b> </label>
                                    <div class="col-sm-8">
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
                                    <label for="nombre" class="col-sm-2 col-form-label"> <b> Apellido:</b> </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="apellido"
                                            value="{{ old('apellido') }}" autofocus placeholder="Apellido">
                                        @if ($errors->has('apellido'))
                                            <span class="error text-danger" for="input-apellido">
                                                {{ $errors->first('apellido') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <label for="ci" class="col-sm-2 col-form-label"><b> CI: </b></label>
                                    <div class="col-sm-8">
                                        <input type="number" min="1" pattern="^[0-9]+" class="form-control"
                                            name="ci" value="{{ old('ci') }}" autofocus placeholder="CI">
                                        @if ($errors->has('ci'))
                                            <span class="error text-danger" for="input-ci">
                                                {{ $errors->first('ci') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"> <b>Expedición:</b></label>\
                                    <div class="col-sm-8">
                                        <select class="form-control" name="expedicion">
                                            <option disabled selected value="">Seleccione la expedición</option>
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
                                        @if ($errors->has('expedicion'))
                                            <span class="error text-danger" for="input-expedicion">
                                                {{ $errors->first('expedicion') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"> <b> Tipo de Contrato:</b>
                                    </label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="contrato">
                                            <option disabled selected value="">Seleccione el Contrato</option>
                                            <option value="Plazo Fijo">Plazo Fijo</option>
                                            <option value="Consultor">Consultor</option>
                                        </select>
                                        @if ($errors->has('contrato'))
                                            <span class="error text-danger" for="input-contrato">
                                                {{ $errors->first('contrato') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"><b>Cargo:</b></label>
                                    <div class="col-sm-8">
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
                                    <label for="ci" class="col-sm-2 col-form-label"><b> Sueldo: </b></label>
                                    <div class="col-sm-8">
                                        <input type="number" min="1" class="form-control" name="sueldo"
                                            value="{{ old('sueldo') }}" autofocus placeholder="sueldo">
                                        @if ($errors->has('sueldo'))
                                            <span class="error text-danger" for="input-sueldo">
                                                {{ $errors->first('sueldo') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"> <b> Fecha de Ingreso:</b>
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="date" class="form-control" name="fecha_ingreso"
                                            value="{{ old('fecha_ingreso') }}" autofocus>
                                        @if ($errors->has('fecha_ingreso'))
                                            <span class="error text-danger" for="input-fecha_ingreso">
                                                {{ $errors->first('fecha_ingreso') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"> <b> Fecha de Retiro:</b>
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="date" class="form-control" name="fecha_retiro"
                                            value="{{ old('fecha_retiro') }}" autofocus>
                                        @if ($errors->has('fecha_retiro'))
                                            <span class="error text-danger" for="input-fecha_retiro">
                                                {{ $errors->first('fecha_retiro') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                {{-- foto --}}
                                <br>
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"> <b> Subir una foto:</b>
                                    </label>
                                    <div class="col-sm-8">

                                        <input type="file" class="form-control" name="foto"
                                            style="display: visible">
                                        @if ($errors->has('fecha_retiro'))
                                            <span class="error text-danger" for="input-fecha_retiro">
                                                {{ $errors->first('fecha_retiro') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit"class="btn btn-primary">
                                    <b>Guardar Datos</b>
                                </button>
                                <a href="{{ route('administrativo.index') }}" class="btn btn-primary"><b>Cancelar</b></a>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
