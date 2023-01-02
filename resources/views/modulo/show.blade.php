@extends('layouts.app', ['activePage' => 'modulo', 'titlePage' => 'Módulo'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-left">
                    <a href="{{ route('modulo.index') }}" class="btn btn-sm btn-primary">
                        <i class="material-icons">keyboard_backspace</i>
                        <span class="sidebar-normal">Volver</span>
                    </a>
                    <a href="{{ route('modulo.edit', $modulo->id) }}" class="btn btn-sm btn-primary">
                        <i class="material-icons">edit</i>
                        <span class="sidebar-normal">Actualizar datos</span>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Modulo</h4>
                            <p class="card-category"> Datos del modulo</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Nombre</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input type="text" class="form-control" disabled
                                            value="{{ $modulo->nombre }} - {{ $modulo->version . '.' . $modulo->edicion }}">
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
                                <label class="col-sm-2 col-form-label">Estado</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input type="text" class="form-control" disabled value="{{ $modulo->estado }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Modalidad</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input type="text" class="form-control" disabled
                                            value="{{ $modulo->modalidad }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Horas Academicas</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input type="text" class="form-control" disabled
                                            value="{{ $modulo->hrs_academicas . ' Hrs' }}">
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
                                <label class="col-sm-2 col-form-label">Estudiantes inscritos</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input type="text" class="form-control" disabled
                                            value="{{ $cant_estudiantes }}">
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
                            <h4 class="card-title ">Procesos</h4>
                            <p class="card-category"> Lista de procesos</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                        <th> Nombre </th>
                                        <th> Fecha </th>
                                        <th> Estado </th>
                                        <th> Acciones </th>
                                    </thead>
                                    <tbody>
                                        @foreach ($listaProceso as $proceso)
                                            <tr>
                                                <td> {{ $proceso['nombre'] }} </td>
                                                <td> {{ $proceso['fecha'] ? $proceso['fecha'] : '-' }} </td>
                                                <td>
                                                    @if ($proceso['estado'] == 'true')
                                                        <span class="badge badge-success">Realizado</span>
                                                    @else
                                                        <span class="badge badge-danger">Sin realizar</span>
                                                    @endif
                                                </td>
                                                <td class="td-actions">
                                                    @if ($proceso['estado'] != 'true')
                                                        <a href="{{ route('modulo.proceso', [$modulo->id, $proceso['id']]) }}"
                                                            class="btn btn-success">
                                                            <span class="material-icons">check</span>
                                                        </a>
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

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Estudiantes</h4>
                            <p class="card-category"> Lista de estudiantes inscritos</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                        <th> # </th>
                                        <th> Nombre </th>
                                        <th> Cedula </th>
                                        <th> Estado </th>
                                        <th> Observacion </th>
                                        <th> Nota </th>
                                    </thead>
                                    <tbody>
                                        @foreach ($estudiantesModulo as $key => $estudiante)
                                            <tr>
                                                <td> {{ $key + 1 }} </td>
                                                <td> {{ $estudiante->nombre }} </td>
                                                <td> {{ $estudiante->cedula }} </td>
                                                <td>
                                                    @if ($estudiante->estado == 'Activo')
                                                        <span class="badge badge-success">Activo</span>
                                                    @else
                                                        <span class="badge badge-danger">Inactivo</span>
                                                    @endif
                                                </td>
                                                <td> {{ $estudiante->observacion }} </td>
                                                <td>
                                                    @if ($estudiante->nota >= 51)
                                                        <h4> <span
                                                                class="badge badge-pill badge-success">{{ $estudiante->nota }}</span>
                                                        </h4>
                                                    @else
                                                        <h4> <span
                                                                class="badge badge-pill badge-danger">{{ $estudiante->nota }}</span>
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
