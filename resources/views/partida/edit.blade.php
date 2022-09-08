@extends('layouts.app', ['activePage' => 'partida', 'titlePage' => 'Editar Partida'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row" style="margin-left: 10%">
                <div class="col-md-11">
                    <form action="{{ route('partida.update',$partida->id) }}" method="post" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"> <b> Codigo:</b> </label>
                                    <div class="col-sm-7">
                                        <input type="number" class="form-control" name="codigo"
                                        value="{{ old('codigo',$partida->codigo) }}"
                                        >
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"> <b> Nombre de la Partida:</b> </label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" name="nombre"
                                        value="{{ old('nombre',$partida->nombre) }}"
                                        >
                                    </div>
                                </div>
                                <br>
                            </div>
                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit"class="btn btn-primary">
                                    <b>Guardar Datos</b>
                                </button>
                                <a href="{{ route('partida.index') }}" class="btn btn-primary"><b>Cancelar</b></a>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
