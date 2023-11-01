@extends('layouts.app', ['activePage' => 'estudiantes', 'titlePage' => 'Agregar Postgraduante'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row" style="margin-left: 10%">
                <div class="col-md-11">
                    <form action="{{ route('pago_estudiante.store', $estudiante->id) }}" method="post" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <br>
                                <div class="row">
                                    <label for="programa" class="col-sm-2 col-form-label"><b>Programa:</b></label>
                                    <div class="col-sm-7">
                                        <select name="programa_id" id="_programa" class="form-control">
                                            <option disabled selected>Seleccione el programa</option>
                                            @foreach ($programas as $programa)
                                                <option value="{{ $programa->id }}">{{ $programa->nombre }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('programa_id'))
                                            <span class="error text-danger"
                                                for="input-programa_id">{{ $errors->first('programa_id') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"><b>Nombre del
                                            Descuento:</b></label>
                                    <div class="col-sm-7">
                                        <select name="tipo_descuento_id" id="_descuento" class="form-control">
                                            <option disabled selected>Seleccione el Tipo de Descuento</option>
                                            @foreach ($descuentos as $descuento)
                                                <option value="{{ $descuento->id }}">{{ $descuento->nombre }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('tipo_descuento_id'))
                                            <span class="error text-danger"
                                                for="input-tipo_descuento_id">{{ $errors->first('tipo_descuento_id') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <label for="modulos" class="col-sm-2 col-form-label"><b>Convalidacion:</b></label>
                                    <div class="col-sm-7">
                                        <input type="number" class="form-control" name="convalidacion" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit"class="btn btn-primary">
                                    <b>Guardar Datos</b>
                                </button>
                                <a href="{{ route('pago_estudiante.show', $estudiante) }}"
                                    class="btn btn-primary"><b>Cancelar</b></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
