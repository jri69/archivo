@extends('layouts.app', ['activePage' => 'docentes', 'titlePage' => 'Docentes'])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row" style="margin-left: 10%">
                <div class="col-md-11">
                    <form action="{{ route('docentes.store') }}" method="post" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Honorifico</label>
                                            <select name="honorifico" id="_honorifico" class="form-control">
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
                                            <input type="text" class="form-control" name="nombre">
                                        </div>
                                        @if ($errors->has('nombre'))
                                            <span class="error text-danger"
                                                for="input-nombre">{{ $errors->first('nombre') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Apellido</label>
                                            <input type="text" class="form-control" name="apellido">
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
                                            <input type="text" class="form-control" name="cedula">
                                        </div>
                                        @if ($errors->has('cedula'))
                                            <span class="error text-danger"
                                                for="input-cedula">{{ $errors->first('cedula') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
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
                                        </div>
                                        @if ($errors->has('expedicion'))
                                            <span class="error text-danger"
                                                for="input-expedicion">{{ $errors->first('expedicion') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Telefono</label>
                                            <input type="text" class="form-control" name="telefono">
                                        </div>
                                        @if ($errors->has('telefono'))
                                            <span class="error text-danger"
                                                for="input-telefono">{{ $errors->first('telefono') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Correo</label>
                                            <input type="text" class="form-control" name="correo">
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
                                        <div>
                                            <label class="bmd-label-floating">Subir una Foto</label>
                                            <input type="file" class="form-control" name="foto"
                                                style="display: visible">
                                        </div>
                                        @if ($errors->has('foto'))
                                            <span class="error text-danger"
                                                for="input-foto">{{ $errors->first('foto') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <div>
                                            <label class="bmd-label-floating">Subir una CV</label>
                                            <input type="file" class="form-control" name="cv"
                                                style="display: visible">
                                        </div>
                                        @if ($errors->has('cv'))
                                            <span class="error text-danger"
                                                for="input-cv">{{ $errors->first('cv') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <br>
                                <div class="row">
                                    <label for="nombre" class="col-sm-2"> <b> Facturacion</b>
                                    </label>
                                    <div class="col-sm-7">
                                        <input type="radio" name="facturacion" value="true" checked>
                                        <span>Si</span>
                                        <input type="radio" name="facturacion" value="false"
                                            style="margin-left: 15px">
                                        <span>No</span>
                                    </div>
                                    @if ($errors->has('facturacion'))
                                        <span class="error text-danger"
                                            for="input-facturacion">{{ $errors->first('facturacion') }}</span>
                                    @endif
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
