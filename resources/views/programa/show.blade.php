@extends('layouts.app', ['activePage' => 'programa', 'titlePage' => 'Programas'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Programa</h4>
                            <p class="card-category"> Datos del programa</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Nombre</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input type="text" class="form-control" disabled value="{{ $programa->nombre }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Fecha de inicio</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input type="text" class="form-control" disabled
                                            value="{{ $programa->fecha_inicio }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Fecha de finalizacion</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input type="text" class="form-control" disabled
                                            value="{{ $programa->fecha_finalizacion }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Costo</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input type="text" class="form-control" disabled value="{{ $programa->costo }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Cantidad de módulos</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input type="text" class="form-control" disabled
                                            value="{{ $programa->cantidad_modulos }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Estudiantes inscritos</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input type="text" class="form-control" disabled value="{{ $cant_estudiantes }}">
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
                                        <th>
                                            Estado
                                        </th>
                                        <th>
                                            Edición
                                        </th>
                                        <th>
                                            Versión
                                        </th>
                                        <th>
                                            Acciones
                                        </th>
                                    </thead>
                                    <tbody>
                                        @foreach ($modulos as $key => $modulo)
                                            <tr>
                                                <td>
                                                    {{ $key + 1 }}
                                                </td>
                                                <td>
                                                    {{ $modulo->nombre }}
                                                </td>
                                                <td>
                                                    {{ $modulo->sigla }}
                                                </td>
                                                <td>
                                                    {{ $modulo->estado }}
                                                </td>
                                                <td>
                                                    {{ $modulo->edicion }}
                                                </td>
                                                <td>
                                                    {{ $modulo->version }}
                                                </td>
                                                <td class="td-actions">
                                                    <a href="{{ route('programa.modulo', [$programa->id, $modulo->id]) }}"
                                                        class="btn btn-success">
                                                        <span class="material-icons">visibility</span>
                                                    </a>
                                                    <form action="{{ route('programa.delete', $modulo->id) }}"
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
            <div class="card-footer ml-auto mr-auto">
                <a href="{{ route('programa.edit', $programa->id) }}" class="text-white btn btn-primary">
                    <b>Editar programa</b>
                </a>
                <a href="{{ route('programa.index') }}" class="btn btn-primary"><b>Regresar</b></a>
            </div>
        </div>
    </div>
@endsection
