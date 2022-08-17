@extends('layouts.app', ['activePage' => 'estudiante', 'titlePage' => 'Agregar Estudiante'])

@section('content')
    <!--seleccionar programa y guardar-->

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Programas</h4>
                            <p class="card-category">Seleccione un programa</p>
                        </div>
                        <div class="card-body">

                            <form action="{{ route('estudiante.storenewprogram', $estudiante->id) }}" method="post"
                                class="form-horizontal" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Programa</label>
                                            <select class="form-control" name="id_programa">
                                                <option disabled selected>Seleccione un programa</option>
                                                @foreach ($programas as $programa)
                                                    <option value="{{ $programa->id }}">{{ $programa->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary pull-right">Guardar</button>
                                <a href="{{ route('estudiante.show', $estudiante->id) }}"
                                    class="btn btn-primary pull-right">Cancelar</a>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
