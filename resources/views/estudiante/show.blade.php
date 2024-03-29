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
                        <span class="sidebar-normal">Inscribir</span>
                    </a>
                    <a href="{{ route('estudiante.estado', $estudiante->id) }}" class="btn btn-sm btn-primary">
                        <i class="material-icons">
                            {{ $estudiante->estado == 'Activo' ? 'block' : 'check' }}
                        </i>
                        <span class="sidebar-normal">
                            {{ $estudiante->estado == 'Activo' ? 'Abandono' : 'Regreso' }}
                        </span>
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
                        <div class="row">
                            <div class="col-md-2">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <br>
                                            <img src="{{ asset($estudiante->foto) }}" alt="Foto"
                                                class="img-thumbnail img-responsive" width="300px">
                                        </div>
                                    </div>
                                </div>
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
                                @if ($estudiante->email || $estudiante->telefono)
                                    <br>
                                    <div class="row">
                                        @if ($estudiante->email)
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="bmd-label-floating">Correo Electrónico</label>
                                                    <input type="email" class="form-control"
                                                        value="{{ $estudiante->email }}" disabled>
                                                </div>
                                            </div>
                                        @endif
                                        @if ($estudiante->telefono)
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="bmd-label-floating">Telefono</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ $estudiante->telefono }}" disabled>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Cedula</label>
                                            <input type="text" class="form-control"
                                                value="{{ $estudiante->cedula }} - {{ $estudiante->expedicion }}"
                                                disabled>
                                        </div>
                                    </div>
                                    @if ($estudiante->numero_registro)
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">Registro</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $estudiante->numero_registro }}" disabled>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                @if ($estudiante->estado == 'Inactivo')
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">Estado</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $estudiante->estado }}" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">Fecha Abandono</label>
                                                <input type="text" class="form-control"
                                                    value="{{ date('d-m-Y', strtotime($estudiante->fecha_inactividad)) }}"
                                                    disabled>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Carrera</label>
                                            <input type="text" class="form-control" value="{{ $estudiante->carrera }}"
                                                disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Universadad</label>
                                            <input type="text" class="form-control"
                                                value="{{ $estudiante->universidad }}" disabled>
                                        </div>
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
                            <p class="card-category">Lista de documentos del estudiante</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                        <th>Requisito</th>
                                        <th>Nombre documento</th>
                                        <th>Importancia</th>
                                        <th>Acciones</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($documentos as $documento)
                                            <tr>
                                                <td>
                                                    {{ $documento->requisito->nombre }}
                                                </td>
                                                <td>
                                                    {{ $documento->nombre }}
                                                </td>
                                                <td>
                                                    {{ $documento->requisito->importancia }}
                                                </td>
                                                <td class="td-actions">
                                                    <a href="{{ asset($documento->dir) }}" target="_blank"
                                                        class="btn btn-success">
                                                        <span class="material-icons">visibility</span>
                                                    </a>
                                                    <form action="{{ route('estudiante.deleteFile', $documento->id) }}"
                                                        method="POST" style="display: inline-block;"
                                                        onsubmit="return confirm('¿Está seguro?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger" type="submit">
                                                            <i class="material-icons">close</i>
                                                        </button>
                                                    </form>
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
                                            <th>Version</th>
                                            <th>Edicion</th>
                                            <th>Tipo</th>
                                            <th>Inicio</th>
                                            <th>Final</th>
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
                                                    <td>
                                                        {{ $programa->version }}
                                                    </td>
                                                    <td>
                                                        {{ $programa->edicion }}
                                                    </td>
                                                    <td>
                                                        {{ $programa->tipo }}
                                                    </td>
                                                    <td>
                                                        {{ date('d-m-Y', strtotime($programa->fecha_inicio)) }}
                                                    </td>
                                                    <td>
                                                        {{ date('d-m-Y', strtotime($programa->fecha_finalizacion)) }}
                                                    </td>
                                                    <td class="td-actions">
                                                        <a href="{{ route('estudiante.showNotas', [$estudiante->id, $programa->id]) }}"
                                                            class="btn btn-success">
                                                            <span class="material-icons">visibility</span>
                                                        </a>
                                                        <a href="{{ route('estudiante.titulacionCreate', [$estudiante->id, $programa->id]) }}"
                                                            class="btn btn-primary">
                                                            <span class="material-icons">file_copy</span>
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

            @if (count($pagos_programas) > 0)
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title ">Pagos</h4>
                                <p class="card-category">Pagos de los programas</p>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class=" text-primary">
                                            <th>#</th>
                                            <th>Nombre</th>
                                            <th>Sigla</th>
                                            <th>Estado</th>
                                            <th>Deuda</th>
                                            {{-- <th>Acciones</th> --}}
                                        </thead>
                                        <tbody>
                                            @foreach ($pagos_programas as $pago_programa)
                                                <tr>
                                                    <td>
                                                        {{ $loop->iteration }}
                                                    </td>
                                                    <td>
                                                        {{ $pago_programa->programa->nombre }}
                                                    </td>
                                                    <td>
                                                        {{ $pago_programa->programa->sigla }} -
                                                        {{ $pago_programa->programa->version }}.{{ $pago_programa->programa->edicion }}
                                                    </td>

                                                    <td>
                                                        @if ($pago_programa->estado == 'SIN DEUDA')
                                                            <span class="badge badge-success">SIN DEUDA</span>
                                                        @else
                                                            <span class="badge badge-danger">CON DEUDA</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{ $pago_programa->deuda ?? 'N/A' }}
                                                    </td>
                                                    {{-- <td class="td-actions">
                                                        <a href="{{ route('pago_estudiante.show_programa', [$pago_programa->id]) }}"
                                                            class="btn btn-success">
                                                            <span class="material-icons">visibility</span>
                                                        </a>
                                                    </td> --}}
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
