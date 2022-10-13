@extends('layouts.app', ['activePage' => 'presupuesto', 'titlePage' => 'Agregar Presupuesto'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row" style="margin-left: 10%">
                <div class="col-md-11">
                    <form action="{{ route('presupuesto.store') }}" method="post" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"> <b> Nombre:</b> </label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" autofocus
                                        >
                                        @if ($errors->has('nombre'))
                                    <span class="error text-danger" for="input-nombre">
                                        {{ $errors->first('nombre') }}
                                    </span>
                                @endif
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"> <b> Monto:</b> </label>
                                    <div class="col-sm-7">
                                        <input type="number" class="form-control" name="monto" value="{{ old('monto') }}" autofocus
                                        >
                                        @if ($errors->has('monto'))
                                    <span class="error text-danger" for="input-nombre">
                                        {{ $errors->first('monto') }}
                                    </span>
                                @endif
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"> <b> Año:</b> </label>
                                    <div class="col-sm-7">
                                        <input type="date" class="form-control" name="anio" value="{{ old('anio') }}" autofocus
                                        >
                                        @if ($errors->has('anio'))
                                    <span class="error text-danger" for="input-nombre">
                                        {{ $errors->first('anio') }}
                                    </span>
                                @endif
                                    </div>
                                </div>
                                <br>
                            </div>
                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit"class="btn btn-primary">
                                    <b>Guardar Datos</b>
                                </button>
                                <a href="{{ route('presupuesto.index') }}" class="btn btn-primary"><b>Cancelar</b></a>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
