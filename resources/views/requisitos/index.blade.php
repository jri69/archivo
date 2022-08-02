@extends('layouts.app', ['activePage' => 'requisito', 'titlePage' => 'Requisitos'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-left">
                    <a href="{{ route('requisito.create') }}" class="btn btn-outline-primary btn-white">
                        <b>Agregar Requisito</b>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4>Listado de requisitos</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="text-primary text-dark">
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Importancia</th>
                                        <th>Acciones</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($requisitos as $requisito)
                                            <tr>
                                                <td>{{ $requisito->id }} </td>
                                                <td>{{ $requisito->nombre }}</td>
                                                <td>{{ $requisito->importancia }}</td>
                                                <td class="td-actions">
                                                    <a href="{{ route('requisito.edit', $requisito->id) }}"
                                                        class="btn btn-primary">
                                                        <span class="material-icons">edit</span>

                                                    </a>
                                                    <form action="{{ route('requisito.delete', $requisito->id) }}"
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
