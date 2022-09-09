@extends('layouts.app', ['activePage' => 'unidad_organizacional', 'titlePage' => 'Unidad organizacional'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-left">
                    <a href="{{ route('unidad.create') }}" class="btn btn-outline-primary btn-white">
                        <b>Agregar Organización</b>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">

                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-tittle">Listado de Unidades Organizaciones</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="text-primary text-dark">
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Acciones</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($unidades as $unidad)
                                            <tr>
                                                <td>{{ $unidad->id }}</td>
                                                <td>{{ $unidad->nombre }}</td>
                                                <td class="td-actions">
                                                    <a href="{{ route('unidad.edit', $unidad->id) }}"
                                                        class="btn btn-primary">
                                                        <span class="material-icons">edit</span>

                                                    </a>
                                                    <form action="{{ route('unidad.delete', $unidad->id) }}" method="POST"
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
