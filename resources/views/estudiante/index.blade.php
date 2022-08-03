@extends('layouts.app', ['activePage' => 'estudiante', 'titlePage' => 'Estudiantes'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-left">
                    <a href="{{ route('estudiante.create') }}" class="btn btn-outline-primary btn-white">
                        <b>Agregar Estudiante</b>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4>Listado de Estudiantes</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="text-primary text-dark">
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Correo</th>
                                        <th>Telefono</th>
                                        <th>Cedula</th>
                                        <th>Acciones</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($estudiantes as $estudiante)
                                            <tr>
                                                <td>{{ $estudiante->id }} </td>
                                                <td>{{ $estudiante->nombre }}</td>
                                                <td>{{ $estudiante->email }}</td>
                                                <td>{{ $estudiante->telefono }}</td>
                                                <td>{{ $estudiante->cedula }}</td>
                                                <td class="td-actions">
                                                    <a href="{{ route('estudiante.edit', $estudiante->id) }}"
                                                        class="btn btn-success">
                                                        <span class="material-icons">visibility</span>
                                                    </a>
                                                    <form action="{{ route('estudiante.delete', $estudiante->id) }}"
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
