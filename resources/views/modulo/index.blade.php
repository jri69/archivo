@extends('layouts.app', ['activePage' => 'modulo', 'titlePage' => 'Módulo'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-left">
                    <a href="{{ route('modulo.create') }}" class="btn btn-outline-primary btn-white">
                        <b>Agregar Módulo</b>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4>Listado de Módulos</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="text-primary text-dark">
                                        <th>#</th>
                                        <th>Programa</th>
                                        <th>Nombre</th>
                                        <th>Versión</th>
                                        <th>Edición</th>
                                        <th>Costo</th>
                                        <th>Fecha inicio</th>
                                        <th>Fecha final</th>

                                        <th>Acciones</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($modulos as $modulo)
                                            <tr>
                                                <td>{{ $modulo->id }} </td>
                                                <td>{{ $modulo->programa()->sigla }}</td>
                                                <td>{{ $modulo->nombre }}</td>
                                                <td>{{ $modulo->version }}</td>
                                                <td>{{ $modulo->edicion }}</td>
                                                <td>{{ $modulo->costo }}</td>
                                                <td>{{ $modulo->fecha_inicio }}</td>
                                                <td>{{ $modulo->fecha_final }}</td>

                                                <td class="td-actions">
                                                    <a href="{{ route('modulo.edit', $modulo->id) }}"
                                                        class="btn btn-primary">
                                                        <span class="material-icons">edit</span>
                                                    </a>
                                                    <form action="{{ route('modulo.delete', $modulo->id) }}" method="POST"
                                                        style="display: inline-block;"
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
        </div>
    </div>
@endsection
