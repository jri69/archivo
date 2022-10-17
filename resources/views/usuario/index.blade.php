@extends('layouts.app', ['activePage' => 'usuario', 'titlePage' => 'Usuario'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-left">
                    <a href="{{ route('usuario.create') }}" class="btn btn-outline-primary btn-white">
                        <b>Agregar Usuario</b>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">

                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-tittle">Listado de Usuarios</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="text-primary text-dark">
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Cargo</th>
                                        <th>Area</th>
                                        <th>Rol</th>
                                        <th>Acciones</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($usuarios as $user)
                                            <tr>
                                                <td>{{ $user->id }}</td>
                                                <td>{{ $user->nombre }}</td>
                                                <td>{{ $user->apellido }}</td>
                                                <td>{{ $user->cargo->nombre }}</td>
                                                <td>{{ $user->area->nombre }}</td>
                                                <td>
                                                    @foreach ($user->user->getRoleNames() as $rol)
                                                        {{ $rol }}
                                                    @endforeach
                                                </td>
                                                <td class="td-actions">
                                                    <a href="{{ route('usuario.edit', $user->id) }}"
                                                        class="btn btn-primary">
                                                        <span class="material-icons">edit</span>

                                                    </a>
                                                    <form action="{{ route('usuario.delete', $user->id) }}" method="POST"
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
