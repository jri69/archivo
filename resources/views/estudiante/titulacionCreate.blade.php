@extends('layouts.app', ['activePage' => 'estudiante', 'titlePage' => 'Agregar titulacion'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row" style="margin-left: 10%">
                <div class="col-md-11">
                    <form action="{{ route('estudiante.titulacionStore', [$estudiante->id, $programa->id]) }}" method="post"
                        class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Nombre de la tesis</label>
                                            <input type="text" class="form-control" name="tesis">
                                        </div>
                                        @if ($errors->has('tesis'))
                                            <span class="error text-danger"
                                                for="input-tesis">{{ $errors->first('tesis') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Director de la tesis</label>
                                            <input type="text" class="form-control" name="director">
                                        </div>
                                        @if ($errors->has('director'))
                                            <span class="error text-danger"
                                                for="input-director">{{ $errors->first('director') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <br>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Lineas de investigacion</label>
                                            <input type="text" class="form-control" name="lineas_academicas">
                                        </div>
                                        @if ($errors->has('lineas_academicas'))
                                            <span class="error text-danger"
                                                for="input-lineas_academicas">{{ $errors->first('lineas_academicas') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Grado academico en</label>
                                            <input type="text" class="form-control" name="grado_academico">
                                        </div>
                                        @if ($errors->has('grado_academico'))
                                            <span class="error text-danger"
                                                for="input-grado_academico">{{ $errors->first('grado_academico') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit"class="btn btn-primary">
                                    <b>Guardar Datos</b>
                                </button>
                                <a href="{{ route('estudiante.show', $estudiante->id) }}"
                                    class="btn btn-primary"><b>Cancelar</b></a>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
