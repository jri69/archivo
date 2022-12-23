@extends('layouts.app', ['activePage' => 'eventos', 'titlePage' => 'Eventos'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row" style="margin-left: 10%">
                <div class="col-md-11">
                    <form action="{{ route('eventos.update', $evento->id) }}" method="post" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Titulo del evento</label>
                                            <input type="text" class="form-control" name="titulo" required
                                                value={{ $evento->titulo }}>
                                        </div>
                                        @if ($errors->has('titulo'))
                                            <span class="error text-danger"
                                                for="input-titulo">{{ $errors->first('titulo') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nombre" class="bmd-label-floating">Encargado</label>
                                            <input type="text" class="form-control" name="encargado"
                                                value={{ $evento->encargado }}>
                                        </div>
                                        @if ($errors->has('encargado'))
                                            <span class="error text-danger"
                                                for="input-encargado">{{ $errors->first('encargado') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nombre" class="bmd-label-floating">Lugar</label>
                                            <input type="text" class="form-control" name="lugar"
                                                value={{ $evento->lugar }}>
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
                                        <label class="bmd-label-floating">Fecha</label>
                                        <div class="form-group">
                                            <input type="date" class="form-control" name="fecha" required
                                                value={{ $evento->fecha }}>
                                        </div>
                                        @if ($errors->has('fecha'))
                                            <span class="error text-danger"
                                                for="input-fecha">{{ $errors->first('fecha') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-md-6">
                                        <label class="bmd-label-floating">Hora</label>
                                        <div class="form-group">
                                            <input type="time" class="form-control" name="hora"
                                                value={{ $evento->hora }}>
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
