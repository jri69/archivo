@extends('layouts.app', ['activePage' => 'docentes', 'titlePage' => 'Docentes'])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row" style="margin-left: 10%">
                <div class="col-md-11">
                    <form action="{{ route('docentes.update', $docente->id) }}" method="post" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Honorifico</label>
                                            <select name="honorifico" id="_honorifico" class="form-control"
                                                value='{{ $docente->honorifico }}'>
                                                <option disabled selected>Seleccione el honorifico</option>
                                                <option value="Lic">Lic</option>
                                                <option value="Ing">Ing</option>
                                                <option value="MsC">MsC</option>
                                                <option value="PhD">PhD</option>
                                            </select>
                                        </div>
                                        @if ($errors->has('honorifico'))
                                            <span class="error text-danger"
                                                for="input-honorifico">{{ $errors->first('honorifico') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-6">

                                    </div>
                                </div>
                                <br>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Nombre</label>
                                            <input type="text" class="form-control" name="nombre"
                                                value='{{ $docente->nombre }}'>
                                        </div>
                                        @if ($errors->has('nombre'))
                                            <span class="error text-danger"
                                                for="input-nombre">{{ $errors->first('nombre') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Apellido</label>
                                            <input type="text" class="form-control" name="apellido"
                                                value='{{ $docente->apellido }}'>
                                        </div>
                                        @if ($errors->has('apellido'))
                                            <span class="error text-danger"
                                                for="input-apellido">{{ $errors->first('apellido') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <br>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Cedula</label>
                                            <input type="text" class="form-control" name="cedula"
                                                value='{{ $docente->cedula }}'>
                                        </div>
                                        @if ($errors->has('cedula'))
                                            <span class="error text-danger"
                                                for="input-cedula">{{ $errors->first('cedula') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Correo</label>
                                            <input type="text" class="form-control" name="correo"
                                                value='{{ $docente->correo }}'>
                                        </div>
                                        @if ($errors->has('correo'))
                                            <span class="error text-danger"
                                                for="input-correo">{{ $errors->first('correo') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Telefono</label>
                                            <input type="text" class="form-control" name="telefono"
                                                value='{{ $docente->telefono }}'>
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
                                            <label class="bmd-label-floating">Facturacion</label>
                                            <div class="form-check form-check-radio col-md-2">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" name="facturacion"
                                                        id="exampleRadios1" value="true"
                                                        {{ $docente->facturacion ? 'checked' : '' }}>
                                                    Si
                                                    <span class="circle">
                                                        <span class="check"></span>
                                                    </span>
                                                </label>
                                            </div>
                                            <div class="form-check form-check-radio col-md-2">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" name="facturacion"
                                                        id="exampleRadios2" value="false"
                                                        {{ !$docente->facturacion ? 'checked' : '' }}>
                                                    No
                                                    <span class="circle">
                                                        <span class="check"></span>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                        @if ($errors->has('facturacion'))
                                            <span class="error text-danger"
                                                for="input-facturacion">{{ $errors->first('facturacion') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-6">

                                    </div>
                                </div>
                                <br>
                            </div>
                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit"class="btn btn-primary">
                                    <b>Guardar Datos</b>
                                </button>
                                <a href="{{ route('docentes.index') }}" class="btn btn-primary"><b>Cancelar</b></a>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
