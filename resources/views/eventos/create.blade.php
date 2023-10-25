@extends('layouts.app', ['activePage' => 'eventos', 'titlePage' => 'Eventos'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row" style="margin-left: 10%">
                <div class="col-md-11">
                    <form action="{{ route('eventos.store') }}" method="post" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <br>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Titulo del evento</label>
                                            <input type="text" class="form-control" name="titulo" required
                                                value="{{ old('titulo') }}">
                                        </div>
                                        @if ($errors->has('titulo'))
                                            <span class="error text-danger"
                                                for="input-titulo">{{ $errors->first('titulo') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nombre" class="bmd-label-floating">Lugar</label>
                                            <input type="text" class="form-control" name="lugar"
                                                value="{{ old('lugar') }}">
                                        </div>
                                        @if ($errors->has('lugar'))
                                            <span class="error text-danger"
                                                for="input-lugar">{{ $errors->first('lugar') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nombre" class="bmd-label-floating">Encargado</label>
                                            <select class="form-control" name="encargado" id="encargado">
                                                <option value="">Seleccione un encargado</option>
                                                @foreach ($encargados as $encargado)
                                                    <option value="{{ $encargado->nombre . ' ' . $encargado->apellido }}">
                                                        {{ $encargado->nombre }}
                                                        {{ $encargado->apellido }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @if ($errors->has('encargado'))
                                            <span class="error text-danger"
                                                for="input-encargado">{{ $errors->first('encargado') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <br>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="bmd-label-floating">Fecha de inicio</label>
                                        <div class="form-group">
                                            <input type="date" class="form-control" name="fecha_inicio" required>
                                        </div>
                                        @if ($errors->has('fecha_inicio'))
                                            <span class="error text-danger"
                                                for="input-fecha_inicio">{{ $errors->first('fecha_inicio') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <label class="bmd-label-floating">Fecha de finalizacion</label>
                                        <div class="form-group">
                                            <input type="date" class="form-control" name="fecha_final" required>
                                        </div>
                                        @if ($errors->has('fecha_final'))
                                            <span class="error text-danger"
                                                for="input-fecha_final">{{ $errors->first('fecha_final') }}</span>
                                        @endif
                                    </div>

                                </div>
                                <div class="row">

                                    <div class="col-md-6">
                                        <label class="bmd-label-floating">Hora</label>
                                        <div class="form-group">
                                            <input type="time" class="form-control" name="hora">
                                        </div>
                                        @if ($errors->has('hora'))
                                            <span class="error text-danger"
                                                for="input-hora">{{ $errors->first('hora') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit"class="btn btn-primary">
                                    <b>Guardar Datos</b>
                                </button>
                                <a href="{{ route('eventos.index') }}" class="btn btn-primary"><b>Cancelar</b></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
