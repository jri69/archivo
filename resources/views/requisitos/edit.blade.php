@extends('layouts.app', ['activePage' => 'requisitos', 'titlePage' => 'Agregar Requisito'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row" style="margin-left: 10%">
                <div class="col-md-11">
                    <form action="{{ route('requisito.update', $requisito->id) }}" method="post" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"> <b> Nombre del Requisito:</b>
                                    </label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" name="nombre" placeholder="Nombre"
                                            value="{{ old('nombre', $requisito->nombre) }}">
                                        @if ($errors->has('nombre'))
                                            <span class="error text-danger"
                                                for="input-nombre">{{ $errors->first('nombre') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"> <b> Importancia:</b> </label>
                                    <div class="col-sm-7">
                                        <select name="importancia" id="_importancia" class="form-control"
                                            value="{{ $requisito->importancia }}">
                                            <option disabled>Seleccione la importancia</option>
                                            <option value="Alto">Alto</option>
                                            <option value="Bajo">Bajo</option>
                                        </select>
                                        @if ($errors->has('importancia'))
                                            <span class="error text-danger"
                                                for="input-importancia">{{ $errors->first('importancia') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <br>
                            </div>
                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit"class="btn btn-primary">
                                    <b>Guardar Datos</b>
                                </button>
                                <a href="{{ route('requisito.index') }}" class="btn btn-primary"><b>Cancelar</b></a>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
