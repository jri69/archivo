@extends('layouts.app', ['activePage' => 'inventario', 'titlePage' => 'Inventario'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row" style="margin-left: 10%">
                <div class="col-md-11">
                    <form action="{{ route('inventario.store') }}" method="post" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-body">

                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"> <b> Nombre del equipo:</b>
                                    </label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" name="nombre" placeholder="Nombre">
                                        @if ($errors->has('nombre'))
                                            <span class="error text-danger"
                                                for="input-nombre">{{ $errors->first('nombre') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"> <b> Tipo:</b>
                                    </label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" name="tipo" placeholder="Tipo">
                                        @if ($errors->has('tipo'))
                                            <span class="error text-danger"
                                                for="input-tipo">{{ $errors->first('tipo') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"> <b> Modelo:</b>
                                    </label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" name="modelo" placeholder="Modelo">
                                        @if ($errors->has('modelo'))
                                            <span class="error text-danger"
                                                for="input-modelo">{{ $errors->first('modelo') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"> <b> Cantidad:</b>
                                    </label>
                                    <div class="col-sm-7">
                                        <input type="number" class="form-control" min="0" name="cantidad"
                                            placeholder="Cantidad">
                                        @if ($errors->has('cantidad'))
                                            <span class="error text-danger"
                                                for="input-cantidad">{{ $errors->first('cantidad') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"> <b> Estado:</b> </label>
                                    <div class="col-sm-7">
                                        <select name="estado" id="_estado" class="form-control">
                                            <option disabled selected>Seleccione el estado</option>
                                            <option value="Funcionamiento">Funcionamiento</option>
                                            <option value="Dado de baja">Dado de baja</option>
                                        </select>

                                        @if ($errors->has('estado'))
                                            <span class="error text-danger"
                                                for="input-estado">{{ $errors->first('estado') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"> <b> Observaciones:</b> </label>
                                    <div class="col-sm-7">
                                        <textarea name="observaciones" id="observaciones" cols="30" rows="10" class="form-control"
                                            placeholder="Observaciones"></textarea>
                                        @if ($errors->has('observaciones'))
                                            <span class="error text-danger"
                                                for="input-observaciones">{{ $errors->first('observaciones') }}</span>
                                        @endif
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit"class="btn btn-primary">
                                    <b>Guardar Datos</b>
                                </button>
                                <a href="{{ route('inventario.index') }}" class="btn btn-primary"><b>Cancelar</b></a>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
