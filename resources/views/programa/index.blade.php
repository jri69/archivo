@extends('layouts.app', ['activePage' => 'programa', 'titlePage' => 'Programas'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-left">
                    <a href="{{ route('programa.create') }}" class="btn btn-outline-primary btn-white">
                        <b>Agregar Programa</b>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4>Listado de programas</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="text-primary text-dark">
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Sigla</th>
                                        <th>Costo</th>
                                        <th>Fecha de inicio</th>
                                        <th>Acciones</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($programas as $programa)
                                            <tr>
                                                <td>{{ $programa->id }} </td>
                                                <td>{{ $programa->tipo_estudio->nombre }}</td>
                                                <td>{{ $programa->tipo_estudio->sigla }}</td>
                                                <td>{{ $programa->costo }}</td>
                                                <td>{{ $programa->fecha_inicio }}</td>
                                                <td class="td-actions">
                                                    <a href="{{ route('programa.edit', $programa->id) }}"
                                                        class="btn btn-success">
                                                        <span class="material-icons">visibility</span>
                                                    </a>
                                                    <form action="{{ route('programa.delete', $programa->id) }}"
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
        </div>
    </div>
@endsection
