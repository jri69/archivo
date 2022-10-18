@extends('layouts.app', ['activePage' => 'programa', 'titlePage' => 'Programas'])

@section('content')
    <!--Mostrar datos del modulo-->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-left">
                    <a href="{{ route('programa.show', $programa->id) }}" class="btn btn-sm btn-primary">
                        <i class="material-icons">keyboard_backspace</i>
                        <span class="sidebar-normal">Volver</span>
                    </a>
                    <a href="{{ route('programa.inscritos', [$programa->id, $modulo->id]) }}" class="btn btn-sm btn-primary">
                        <i class="material-icons">update</i>
                        <span class="sidebar-normal">Actualizar inscritos</span>
                    </a>
                    <a href="{{ route('programa.notas', [$programa->id, $modulo->id]) }}" class="btn btn-sm btn-primary">
                        <i class="material-icons">summarize</i>
                        <span class="sidebar-normal">Poner notas</span>
                    </a>
                    @if ($modulo->estado != 'Iniciado' && $modulo->estado != 'Finalizado')
                        <a href="{{ route('programa.init', [$programa->id, $modulo->id]) }}" class="btn btn-sm btn-primary">
                            <i class="material-icons">play_arrow</i>
                            <span class="sidebar-normal">Iniciar módulo</span>
                        </a>
                    @endif
                </div>
            </div>

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
                                <label class="col-sm-2 col-form-label">Docente</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input type="text" class="form-control" disabled
                                            value="{{ $modulo->docente->honorifico . ' ' . $modulo->docente->nombre . ' ' . $modulo->docente->apellido }}">
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
                                <label class="col-sm-2 col-form-label">Fecha de inicio</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input type="text" class="form-control" disabled
                                            value="{{ date('d-m-Y', strtotime($modulo->fecha_inicio)) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Fecha de finalizacion</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input type="text" class="form-control" disabled
                                            value="{{ date('d-m-Y', strtotime($modulo->fecha_final)) }}">
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
                                        <!--<th>
                                                                                                                                                    Acciones
                                                                                                                                                </th>-->
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
                                                    {{ $estu_progm->observaciones }}
                                                </td>
                                                <td>
                                                    @if ($estu_progm->nota >= 51)
                                                        <h4> <span
                                                                class="badge badge-pill badge-success">{{ $estu_progm->nota }}</span>
                                                        </h4>
                                                    @else
                                                        <h4> <span
                                                                class="badge badge-pill badge-danger">{{ $estu_progm->nota }}</span>
                                                        </h4>
                                                    @endif
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
    </div>
@endsection
