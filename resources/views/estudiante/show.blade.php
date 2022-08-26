@extends('layouts.app', ['activePage' => 'estudiante', 'titlePage' => 'Estudiantes'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-left">
                    <a href="{{ route('estudiante.index') }}" class="btn btn-sm btn-primary">
                        <i class="material-icons">keyboard_backspace</i>
                        <span class="sidebar-normal">Volver</span>
                    </a>
                    <a href="{{ route('estudiante.edit', $estudiante->id) }}" class="btn btn-sm btn-primary">
                        <i class="material-icons">edit</i>
                        <span class="sidebar-normal">Actualizar datos</span>
                    </a>
                    <a href="{{ route('estudiante.newprogram', $estudiante->id) }}" class="btn btn-sm btn-primary">
                        <i class="material-icons">add</i>
                        <span class="sidebar-normal">Nuevo programa</span>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Estudiante</h4>
                            <p class="card-category">Informacion del estudiante</p>
                        </div>
                        <div class="card-body">
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Nombre</label>
                                        <input type="text" class="form-control" value="{{ $estudiante->nombre }}"
                                            disabled>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Correo Electrónico</label>
                                        <input type="email" class="form-control" value="{{ $estudiante->email }}"
                                            disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Telefono</label>
                                        <input type="text" class="form-control" value="{{ $estudiante->telefono }}"
                                            disabled>
                                    </div>
                                </div>
                            </div>
                            <br>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Cedula</label>
                                        <input type="text" class="form-control"
                                            value="{{ $estudiante->cedula }} - {{ $estudiante->expedicion }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Carrera</label>
                                        <input type="text" class="form-control" value="{{ $estudiante->carrera }}"
                                            disabled>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Universadad</label>
                                        <input type="text" class="form-control" value="{{ $estudiante->universidad }}"
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
                            <h4 class="card-title ">Documentos</h4>
                            <p class="card-category">Documentos del estudiante</p>
                        </div>
                        <div class="card-body">
                            @if (count($requisitos) > 0)
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating text-black"> <b> Requisitos
                                                    Faltantes</b></label>
                                            <br>
                                            @foreach ($requisitosFaltantes as $requisito)
                                                &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                                <label class="bmd-label-floating">
                                                    {{ $requisito->nombre }}</label>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                @if (count($documentos) > 0)
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="bmd-label-floating text-black"><b>Requisitos Entregados</b>
                                                </label> <br>
                                                @foreach ($documentos as $documento)
                                                    <a href="{{ asset($documento->dir) }}" target="_blank"
                                                        class="btn btn-link">
                                                        {{ $documento->nombre }}
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <!--Mensaje de sin requisitos-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">No hay documentos</label>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!---Mostrar los programas en los que esta inscrito-->
            @if (count($programas) > 0)
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title ">Programas</h4>
                                <p class="card-category">Programas en los que esta inscrito</p>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class=" text-primary">
                                            <th>#</th>
                                            <th>Nombre</th>
                                            <th>Sigla</th>
                                            <th>Acciones</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($programas as $programa)
                                                <tr>
                                                    <td>
                                                        {{ $loop->iteration }}
                                                    </td>
                                                    <td>
                                                        {{ $programa->nombre }}
                                                    </td>
                                                    <td>
                                                        {{ $programa->sigla }}
                                                    </td>
                                                    <td class="td-actions">
                                                        <a href="{{ route('estudiante.showNotas', [$estudiante->id, $programa->id]) }}"
                                                            class="btn btn-success">
                                                            <span class="material-icons">visibility</span>
                                                        </a>
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
            @endif
        </div>
    </div>
@endsection
