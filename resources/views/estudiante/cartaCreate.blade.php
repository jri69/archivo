@extends('layouts.app', ['activePage' => 'estudiante', 'titlePage' => 'Agregar carta'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row" style="margin-left: 10%">
                <div class="col-md-11">
                    <form action="{{ route('estudiante.cartaStore', [$estudiante->id, $titulacion->id, $tipo->id]) }}"
                        method="post" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Codigo de carta</label>
                                            <input type="text" class="form-control" name="codigo_admi">
                                        </div>
                                        @if ($errors->has('codigo_admi'))
                                            <span class="error text-danger"
                                                for="input-codigo_admi">{{ $errors->first('codigo_admi') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {{-- <label class="bmd-label">Fecha de la carta</label> --}}
                                            <input type="date" class="form-control" name="fecha"
                                                value="{{ date('Y-m-d') }}">
                                        </div>
                                        @if ($errors->has('fecha'))
                                            <span class="error text-danger"
                                                for="input-fecha">{{ $errors->first('fecha') }}</span>
                                        @endif
                                    </div>
                                </div>
                                @if ($codigo1)
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">Codigo de CA</label>
                                                <input type="text" class="form-control" name="codigo1">
                                            </div>
                                            @if ($errors->has('codigo1'))
                                                <span class="error text-danger"
                                                    for="input-codigo1">{{ $errors->first('codigo1') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit"class="btn btn-primary">
                                    <b>Guardar Datos</b>
                                </button>
                                <a href="{{ route('estudiante.carta', [$estudiante->id, $titulacion->programa_id]) }}"
                                    class="btn btn-primary"><b>Cancelar</b></a>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
