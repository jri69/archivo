@extends('layouts.app', ['activePage' => 'administrativo', 'titlePage' => 'Administrativos'])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row" style="margin-left: 10%">
                <div class="col-md-10">
                    <form action="{{ route('administrativo.update', $administrativo->id) }}" method="post"
                        class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"> <b> Nombre:</b> </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="nombre"
                                            value="{{ old('nombre', $administrativo->nombre) }}" autofocus>
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
                                            value="{{ old('apellido', $administrativo->apellido) }}" autofocus>
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
                                        <div class="input-group">
                                            <input type="number" min="1" pattern="^[0-9]+" class="form-control"
                                                name="ci" value="{{ old('ci', $administrativo->ci) }}" autofocus>
                                            @if ($errors->has('ci'))
                                                <span class="error text-danger" for="input-ci">
                                                    {{ $errors->first('ci') }}
                                                </span>
                                            @endif
                                            <label for="nombre" class="col-sm-2 col-form-label">
                                                <b>Expedición:</b></label>
                                            <select class="form-control" name="expedicion">
                                                <option disabled selected value="">Seleccione la expedición</option>
                                                <option value="TJ"
                                                    {{ old('expedicion', $administrativo->expedicion) == 'TJ' ? 'selected' : '' }}>
                                                    TJ</option>
                                                <option value="SC"
                                                    {{ old('expedicion', $administrativo->expedicion) == 'SC' ? 'selected' : '' }}>
                                                    SC</option>
                                                <option value="CH"
                                                    {{ old('expedicion', $administrativo->expedicion) == 'CH' ? 'selected' : '' }}>
                                                    CH</option>
                                                <option value="LP"
                                                    {{ old('expedicion', $administrativo->expedicion) == 'LP' ? 'selected' : '' }}>
                                                    LP</option>
                                                <option value="CB"
                                                    {{ old('expedicion', $administrativo->expedicion) == 'CB' ? 'selected' : '' }}>
                                                    CB</option>
                                                <option value="OR"
                                                    {{ old('expedicion', $administrativo->expedicion) == 'OR' ? 'selected' : '' }}>
                                                    OR</option>
                                                <option value="PT"
                                                    {{ old('expedicion', $administrativo->expedicion) == 'PT' ? 'selected' : '' }}>
                                                    PT</option>
                                                <option value="BE"
                                                    {{ old('expedicion', $administrativo->expedicion) == 'BE' ? 'selected' : '' }}>
                                                    BE</option>
                                                <option value="PD"
                                                    {{ old('expedicion', $administrativo->expedicion) == 'PD' ? 'selected' : '' }}>
                                                    PD</option>
                                            </select>
                                            @if ($errors->has('expedicion'))
                                                <span class="error text-danger" for="input-expedicion">
                                                    {{ $errors->first('expedicion') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"> <b> Tipo de Contrato:</b>
                                    </label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="contrato">
                                            <option disabled selected value="">Seleccione el Contrato</option>
                                            <option value="Plazo Fijo"
                                                {{ old('contrato', $administrativo->contrato) == 'Plazo Fijo' ? 'selected' : '' }}>
                                                Plazo Fijo</option>
                                            <option value="Consultor"
                                                {{ old('contrato', $administrativo->contrato) == 'Consultor' ? 'selected' : '' }}>
                                                Consultor</option>
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
                                                <option value="{{ $cargo->id }}"
                                                    {{ old('cargo_id', $administrativo->cargo_id) == $cargo->id ? 'selected' : '' }}>
                                                    {{ $cargo->nombre }}</option>
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
                                    <label for="nombre" class="col-sm-2 col-form-label"> <b> Fecha de Ingreso:</b>
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="date" class="form-control" name="fecha_ingreso"
                                            value="{{ old('fecha_ingreso', $administrativo->fecha_ingreso) }}" autofocus>
                                        @if ($errors->has('fecha_ingreso'))
                                            <span class="error text-danger" for="input-fecha_ingreso">
                                                {{ $errors->first('fecha_ingreso') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"> <b> Fecha de Retiro:</b> </label>
                                    <div class="col-sm-8">
                                        <input type="date" class="form-control" name="fecha_retiro"
                                            value="{{ old('fecha_retiro', $administrativo->fecha_retiro) }}" autofocus>
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
