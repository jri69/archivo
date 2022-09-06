@extends('layouts.app', ['activePage' => 'recepcion', 'titlePage' => 'Ver Recepciones'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row" style="margin-left: 10%">
                <div class="col-md-11">
                    <form action="{{ route('recepcion.update', $recepcion->id) }}" method="post" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Código</label>
                                            <input type="text" class="form-control" name="codigo"
                                                value="{{ $recepcion->codigo }}" disabled>
                                        </div>
                                        @if ($errors->has('codigo'))
                                            <span class="error text-danger"
                                                for="input-codigo">{{ $errors->first('codigo') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="date" class="form-control" name="fecha"
                                                value="{{ $recepcion->fecha }}">
                                        </div>
                                        @if ($errors->has('fecha'))
                                            <span class="error text-danger"
                                                for="input-fecha">{{ $errors->first('fecha') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Departamento</label>
                                            <input type="text" class="form-control" name="departamento"
                                                value="{{ $recepcion->departamento }}">
                                        </div>
                                        @if ($errors->has('departamento'))
                                            <span class="error text-danger"
                                                for="input-departamento">{{ $errors->first('departamento') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select class="form-control" name="unidad_organizativa_id"
                                                value="{{ $recepcion->unidad_organizativa_id }}">
                                                <option disabled>Seleccione la unidad organizacional</option>
                                                @foreach ($unidades as $unidad)
                                                    <option value="{{ $unidad->id }}">
                                                        {{ $unidad->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @if ($errors->has('unidad_organizativa_id'))
                                            <span class="error text-danger"
                                                for="input-unidad_organizativa_id">{{ $errors->first('unidad_organizativa_id') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select class="form-control" name="tipo">
                                                <option disabled selected>Seleccione el tipo de documento</option>
                                                <option value="Recepción">Recepción </option>
                                                <option value="Comprobante">Comprobante</option>
                                                <option value="Respuesta">Respuesta </option>
                                            </select>
                                        </div>
                                        @if ($errors->has('tipo'))
                                            <span class="error text-danger"
                                                for="input-tipo">{{ $errors->first('tipo') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <br>
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"> <b> Documento:</b> </label>
                                    <div class="col-sm-7">
                                        <input type="file" class="form-control" name="documento[]" } multiple>
                                        @if ($errors->has('documento'))
                                            <span class="error text-danger"
                                                for="input-documento">{{ $errors->first('documento') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <br>
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"> <b> Descripción:</b> </label>
                                    <div class="col-sm-7">
                                        <textarea class="form-control" name="descripcion" rows="3">{{ $recepcion->descripcion }}</textarea>
                                        @if ($errors->has('descripcion'))
                                            <span class="error text-danger"
                                                for="input-descripcion">{{ $errors->first('descripcion') }}</span>
                                        @endif
                                    </div>
                                </div>

                            </div>

                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit" class="btn btn-primary">
                                    <b>Guardar Datos</b>
                                </button>
                                <a href="{{ route('recepcion.show', $recepcion->id) }}"
                                    class="btn btn-primary"><b>Cancelar</b></a>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
