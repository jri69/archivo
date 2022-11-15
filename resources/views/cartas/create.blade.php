@extends('layouts.app', ['activePage' => 'contrataciones', 'titlePage' => 'Registrar Carta'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row" style="margin-left: 10%">
                <div class="col-md-11">
                    <form action="{{ route('carta.store') }}" method="post" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"> <b>Codigo de la carta:</b>
                                    </label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" name="codigo" placeholder="Codigo">
                                        @if ($errors->has('codigo'))
                                            <span class="error text-danger"
                                                for="input-codigo">{{ $errors->first('codigo') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"> <b> Fecha:</b>
                                    </label>
                                    <div class="col-sm-7">
                                        <input type="date" class="form-control" name="fecha">
                                        @if ($errors->has('fecha'))
                                            <span class="error text-danger"
                                                for="input-fecha">{{ $errors->first('fecha') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            {{-- ocultar un input --}}

                            <input type="hidden" value="{{ $id }}" name="contrato">
                            <input type="hidden" value="{{ $tipo }}" name="tipo">

                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit"class="btn btn-primary">
                                    <b>Guardar Datos</b>
                                </button>
                                <a href="{{ route('contrataciones.show', $id) }}"
                                    class="btn btn-primary"><b>Cancelar</b></a>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
