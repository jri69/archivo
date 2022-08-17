@extends('layouts.app', ['activePage' => 'activo', 'titlePage' => 'Activos'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row" style="margin-left: 10%">
                <div class="col-md-11">
                    <form action="{{ route('activo.store') }}" method="post" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"> <b> Código del activo:</b>
                                    </label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" name="codigo" placeholder="Código">
                                        @if ($errors->has('codigo'))
                                            <span class="error text-danger"
                                                for="input-codigo">{{ $errors->first('codigo') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"> <b> Unidad:</b>
                                    </label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" name="unidad" placeholder="Unidad">
                                        @if ($errors->has('unidad'))
                                            <span class="error text-danger"
                                                for="input-unidad">{{ $errors->first('unidad') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"> <b> Área:</b> </label>
                                    <div class="col-sm-7">
                                        <select name="id_area" id="_area" class="form-control">
                                            <option disabled selected>Seleccione el área</option>
                                            @foreach ($areas as $area)
                                                <option value="{{ $area->id }}">{{ $area->nombre }}</option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('id_area'))
                                            <span class="error text-danger"
                                                for="input-id_area">{{ $errors->first('id_area') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"> <b> Encargado:</b> </label>
                                    <div class="col-sm-7">
                                        <select name="id_usuario" id="_area" class="form-control">
                                            <option disabled selected>Seleccione el encargado</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('id_usuario'))
                                            <span class="error text-danger"
                                                for="input-id_usuario">{{ $errors->first('id_usuario') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <br>

                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"> <b> Tipo:</b> </label>
                                    <div class="col-sm-7">
                                        <select name="tipo" id="_tipo" class="form-control">
                                            <option disabled selected>Seleccione el tipo</option>
                                            <option value="Mueble">Mueble</option>
                                            <option value="Equipo Electrónico">Equipo Electrónico</option>
                                            <option value="Material de oficina">Material de oficina</option>
                                            <option value="Otro">Otro</option>
                                        </select>

                                        @if ($errors->has('tipo'))
                                            <span class="error text-danger"
                                                for="input-tipo">{{ $errors->first('tipo') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <br>

                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"> <b> Estado:</b> </label>
                                    <div class="col-sm-7">
                                        <select name="estado" id="_estado" class="form-control">
                                            <option disabled selected>Seleccione el estado</option>
                                            <option value="Bueno">Bueno</option>
                                            <option value="Regular">Regular</option>
                                            <option value="Malo">Malo</option>
                                        </select>

                                        @if ($errors->has('estado'))
                                            <span class="error text-danger"
                                                for="input-estado">{{ $errors->first('estado') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"> <b> Descripción:</b> </label>
                                    <div class="col-sm-7">
                                        <textarea name="descripcion" id="descripcion" cols="30" rows="10" class="form-control"
                                            placeholder="Descripción"></textarea>
                                        @if ($errors->has('descripcion'))
                                            <span class="error text-danger"
                                                for="input-descripcion">{{ $errors->first('descripcion') }}</span>
                                        @endif
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit"class="btn btn-primary">
                                    <b>Guardar Datos</b>
                                </button>
                                <a href="{{ route('activo.index') }}" class="btn btn-primary"><b>Cancelar</b></a>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
