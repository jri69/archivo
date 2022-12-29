@extends('layouts.app', ['activePage' => 'marketing', 'titlePage' => 'Marketing'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row" style="margin-left: 10%">
                <div class="col-md-11">
                    <form action="{{ route('marketing.store') }}" method="post" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Nombre del prospecto</label>
                                            <input type="text" class="form-control" name="nombre" required
                                                value="{{ old('nombre') }}">
                                        </div>
                                        @if ($errors->has('nombre'))
                                            <span class="error text-danger"
                                                for="input-nombre">{{ $errors->first('nombre') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nombre" class="bmd-label-floating">Correo</label>
                                            <input type="text" class="form-control" name="email"
                                                value="{{ old('email') }}">
                                        </div>
                                        @if ($errors->has('email'))
                                            <span class="error text-danger"
                                                for="input-email">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nombre" class="bmd-label-floating">Telefono</label>
                                            <input type="text" class="form-control" name="telefono"
                                                value="{{ old('telefono') }}">
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
                                            <label class="bmd-label-floating">Interes</label>
                                            <input type="text" class="form-control" name="interes" required
                                                value="{{ old('interes') }}">
                                        </div>
                                        @if ($errors->has('interes'))
                                            <span class="error text-danger"
                                                for="input-interes">{{ $errors->first('interes') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Carrera</label>
                                            <input type="text" class="form-control" name="carrera"
                                                value="{{ old('carrera') }}">
                                        </div>
                                        @if ($errors->has('carrera'))
                                            <span class="error text-danger"
                                                for="input-carrera">{{ $errors->first('carrera') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col" style="padding: 0px 0px">
                                        <label for="nombre" class="col-sm-2 col-form-label"> Grado de interes:
                                        </label>
                                        <div class="col-sm-7">
                                            <input type="radio" name="grado_interes" value="Alto" checked>
                                            <span>Alto</span>

                                            <input type="radio" name="grado_interes" value="Medio"
                                                style='margin-left: 20px'>
                                            <span>Medio</span>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Observaciones</label>
                                            <textarea class="form-control" name="observaciones" rows="5" value="{{ old('observaciones') }}"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit"class="btn btn-primary">
                                    <b>Guardar Datos</b>
                                </button>
                                <a href="{{ route('marketing.index') }}" class="btn btn-primary"><b>Cancelar</b></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
