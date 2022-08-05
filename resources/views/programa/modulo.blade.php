@extends('layouts.app', ['activePage' => 'programa', 'titlePage' => 'Programas'])

@section('content')
    <!--Mostrar datos del modulo-->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Módulo</h4>
                            <p class="card-category"> Datos del módulo</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Nombre</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input type="text" class="form-control" disabled value="{{ $modulo->nombre }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Sigla</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input type="text" class="form-control" disabled value="{{ $modulo->sigla }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Versión</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input type="text" class="form-control" disabled value="{{ $modulo->version }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Edición</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input type="text" class="form-control" disabled value="{{ $modulo->edicion }}">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!--Lista de estudiantes inscritos-->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Estudiantes inscritos</h4>
                            <p class="card-category"> Lista de estudiantes inscritos en el módulo</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                        <th>
                                            Nombre
                                        </th>
                                        <th>
                                            Cédula
                                        </th>
                                        <th>
                                            Observación
                                        </th>
                                        <th>
                                            Nota
                                        </th>
                                        <th>
                                            Acciones
                                        </th>
                                    </thead>
                                    <tbody>
                                        @foreach ($estudiante_programa as $estu_progm)
                                            <tr>
                                                <td>
                                                    {{ $estu_progm->estudiante->nombre }}
                                                </td>
                                                <td>
                                                    {{ $estu_progm->estudiante->cedula }}
                                                </td>
                                                <td>
                                                    {{ $estu_progm->observacion }}
                                                </td>
                                                <td>
                                                    {{ $estu_progm->nota }}
                                                </td>
                                                <td>
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
        </div>
    @endsection