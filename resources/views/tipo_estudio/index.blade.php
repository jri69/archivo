@extends('layouts.app', ['activePage' => 'tipo_estudio', 'titlePage' => 'Tipo de Estudio'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-left">
                    <a href="{{ route('estudio.create') }}" class="btn btn-outline-primary btn-white">
                        <b>Agregar Tipo de Estudio</b>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4>Listado de Estudios</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="text-primary text-dark">
                                        <th>#</th>
                                        <th>Sigla</th>
                                        <th>Nombre</th>
                                        <th>Acciones</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($estudios as $estudio)
                                            <tr>
                                                <td>{{ $estudio->id }} </td>
                                                <td>{{ $estudio->sigla }}</td>
                                                <td>{{ $estudio->nombre }}</td>
                                                <td class="td-actions">
                                                    <a href="{{ route('estudio.show', $estudio->id) }}"
                                                        class="btn btn-success">
                                                        <span class="material-icons">visibility</span>
                                                    </a>
                                                    <form action="{{ route('estudio.delete', $estudio->id) }}"
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
