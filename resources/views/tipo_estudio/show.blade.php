@extends('layouts.app', ['activePage' => 'tipo_estudio', 'titlePage' => 'Tipo de Estudio'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Tipo de Estudio</h4>
                            <p class="card-category"> Detalles del Tipo de Estudio</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Nombre</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input type="text" class="form-control" value="{{ $tipo_estudio->nombre }}"
                                            disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Sigla</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input type="text" class="form-control" value="{{ $tipo_estudio->sigla }}"
                                            disabled>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Módulos</h4>
                            <p class="card-category"> Lista de Módulos</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                        <th>
                                            #
                                        </th>
                                        <th>
                                            Nombre
                                        </th>
                                        <th>
                                            Sigla
                                        </th>
                                    </thead>
                                    <tbody>
                                        @foreach ($modulos as $key => $modulo)
                                            <tr>
                                                <td>
                                                    {{ $key + 1 }}
                                                </td>
                                                <td>
                                                    {{ $modulo->modulo->nombre }}
                                                </td>
                                                <td>
                                                    {{ $modulo->modulo->sigla }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-footer ml-auto mr-auto">
                <a href="{{ route('estudio.edit', $tipo_estudio->id) }}" class="text-white btn btn-primary">
                    <b>Editar registro</b>
                </a>
                <a href="{{ route('estudio.index') }}" class="btn btn-primary"><b>Regresar</b></a>
            </div>
        </div>
    @endsection
