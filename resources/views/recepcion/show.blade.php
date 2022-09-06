@extends('layouts.app', ['activePage' => 'recepcion', 'titlePage' => 'Ver Recepciones'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-left">
                    <a href="{{ route('recepcion.index') }}" class="btn btn-sm btn-primary">
                        <i class="material-icons">keyboard_backspace</i>
                        <span class="sidebar-normal">Volver</span>
                    </a>
                    <a href="{{ route('recepcion.edit', $recepcion->id) }}" class="btn btn-sm btn-primary">
                        <i class="material-icons">edit</i>
                        <span class="sidebar-normal">Actualizar datos</span>
                    </a>
                    <a href="{{ route('movimiento.create', $recepcion->id) }}" class="btn btn-sm btn-primary">
                        <i class="material-icons">add</i>
                        <span class="sidebar-normal">Nuevo movimiento</span>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Recepción</h4>
                            <p class="card-category"> Datos generales</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Código</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input type="text" class="form-control" disabled
                                            value="{{ $recepcion->codigo }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Recibido</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input type="text" class="form-control" disabled
                                            value="{{ $recepcion->user->usuario->nombre . ' ' . $recepcion->user->usuario->apellido }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Fecha</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input type="text" class="form-control" disabled value="{{ $recepcion->fecha }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Departamento</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input type="text" class="form-control" disabled
                                            value="{{ $recepcion->departamento }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Unidad Organizacional</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input type="text" class="form-control" disabled
                                            value="{{ $recepcion->unidad_organizativa->nombre }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Descripción</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <textarea class="form-control" disabled>{{ $recepcion->descripcion }}</textarea>
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
                            <h4 class="card-title ">Movimientos</h4>
                            <p class="card-category"> Lista de Movimientos</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                        <th>
                                            Código
                                        </th>
                                        <th>
                                            Encargado
                                        </th>
                                        <th>
                                            Fecha
                                        </th>
                                        <th>
                                            Departamento
                                        </th>
                                        <th>
                                            Estado
                                        </th>
                                        <th>
                                            Acciones
                                        </th>
                                    </thead>
                                    <tbody>
                                        @foreach ($movimientos as $key => $movimiento)
                                            <tr>
                                                <td>
                                                    {{ $movimiento->codigo }}
                                                </td>
                                                <td>
                                                    {{ $movimiento->user->usuario->nombre . ' ' . $movimiento->user->usuario->apellido }}
                                                </td>
                                                <td>
                                                    {{ $movimiento->fecha }}
                                                </td>
                                                <td>
                                                    {{ $movimiento->departamento }}
                                                </td>
                                                <td>
                                                    {{ $movimiento->confirmacion }}
                                                </td>

                                                <td class="td-actions">
                                                    <a href="{{ route('movimiento.edit', [$recepcion->id, $movimiento->id]) }}"
                                                        class="btn btn-success">
                                                        <span class="material-icons">visibility</span>
                                                    </a>
                                                    <form action="{{ route('movimiento.delete', $movimiento->id) }}"
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
