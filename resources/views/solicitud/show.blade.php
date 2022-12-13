@extends('layouts.app', ['activePage' => 'solicitudes', 'titlePage' => 'Solicitudes'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-left">
                    <a href="{{ route('solicitudes.index') }}" class="btn btn-sm btn-primary">
                        <i class="material-icons">keyboard_backspace</i>
                        <span class="sidebar-normal">Volver</span>
                    </a>
                    @if ($solicitud->estado == 'Pendiente')
                        <a href="{{ route('solicitudes.confirmar', $solicitud->id) }}" class="btn btn-sm btn-primary">
                            <i class="material-icons">check</i>
                            <span class="sidebar-normal">Confirmar</span>
                        </a>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Solicitud</h4>
                            <p class="card-category"> Datos de la solicitud</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Solicitante</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input type="text" class="form-control" disabled
                                            value="{{ $solicitud->user->name }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Estado</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input type="text" class="form-control" disabled
                                            value="{{ $solicitud->estado }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Fecha</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input type="text" class="form-control" disabled
                                            value="{{ date('d-m-Y', strtotime($solicitud->created_at)) }}">
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
                            <h4 class="card-title ">Equipos/Materiales</h4>
                            <p class="card-category"> Lista de equipos/materiales</p>
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
                                            Tipo
                                        </th>
                                        <th>
                                            Modelo
                                        </th>
                                        <th>
                                            Cantidad
                                        </th>
                                    </thead>
                                    <tbody>
                                        @foreach ($detalles as $key => $detalle)
                                            <tr>
                                                <td>
                                                    {{ $detalle->id }}
                                                </td>
                                                <td>
                                                    {{ $detalle->inventario->nombre }}
                                                </td>
                                                <td>
                                                    {{ $detalle->inventario->tipo }}
                                                </td>
                                                <td>
                                                    {{ $detalle->inventario->modelo }}
                                                </td>
                                                <td>
                                                    {{ $detalle->cantidad }}
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
