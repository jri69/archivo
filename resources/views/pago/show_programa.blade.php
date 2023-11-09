@extends('layouts.app', ['activePage' => 'Pago', 'titlePage' => 'Pagos'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="form-row">
                <div class="col text-left">
                    <a href="{{ route('pago_estudiante.show', $estudiante->id) }}" class="btn btn-sm btn-primary">
                        <i class="material-icons">keyboard_backspace</i>
                        atras</a>
                    @if ($monto_pagado != $pagado_adeudado || $monto_adeudado != 0 || $deuda != 0)
                        <a href="{{ route('pago.create', $estudiante->id) }}" class="btn btn-sm btn-primary">
                            <i class="material-icons">add</i>
                            <span class="sidebar-normal">Pago</span>
                        </a>
                    @endif
                    <a href="{{ route('pago.pdf', $estudiante->id) }}" class="btn btn-sm btn-primary">
                        <i class="material-icons">picture_as_pdf</i>
                        <b>PDF</b>
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <center>
                                <h4><b>Datos Estudiante</b></h4>
                            </center>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Nombre</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input type="text" class="form-control" disabled
                                            value="{{ $estudiante->nombre }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Estado</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input type="text" class="form-control" disabled
                                            value="{{ $pago_estudiante->estado }}">
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
                            <center>
                                <h4><b>Datos Programa</b></h4>
                            </center>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Nombre</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input type="text" class="form-control" disabled
                                            value="{{ $programa->nombre }} - {{ $programa->version . '.' . $programa->edicion }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Tipo</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input type="text" class="form-control" disabled value="{{ $programa->tipo }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Modalidad</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input type="text" class="form-control" disabled
                                            value="{{ $programa->modalidad }}">
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
                                <label class="col-sm-2 col-form-label">Costo Total Programa</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input type="text" class="form-control" disabled value="{{ $programa->costo }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Descuento</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input type="text" class="form-control" disabled value="{{ $descuento }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Total con descuento</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input type="text" class="form-control" disabled
                                            value="{{ $programa->costo - $descuento }}">
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
                            <center>
                                <h4><b>Datos Economicos</b></h4>
                            </center>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="text-primary text-dark">
                                        <th><b>Monto Pagado</b> </th>
                                        <th><b>Monto adeudado hasta la fecha</b></th>
                                        <th><b>Monto pagado hasta la fecha</b></th>
                                        <th><b>Saldo total del programa</b></th>
                                    </thead>
                                    <tr>
                                        <td>{{ $monto_pagado }}</td>
                                        <td>{{ $monto_adeudado ?? 0 }}</td>
                                        <td>{{ $pagado_adeudado }}</td>
                                        <td>{{ $deuda }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <center>
                                <h4><b>Detalles de Pagos</b></h4>
                            </center>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="text-primary text-dark">
                                        <th><b>#</b></th>
                                        <th><b>Comprobante</b></th>
                                        <th><b>Metodo de Pago</b></th>
                                        <th><b>Fecha de pago</b></th>
                                        <th><b>Monto Pagado</b></th>
                                        <th><b>Monto Acumulado</b></th>
                                        <th><b>Acciones</b></th>
                                    </thead>
                                    <tbody>
                                        @foreach ($pagos as $pago)
                                            <tr>
                                                <td>{{ $pago->id }}</td>
                                                <td><a href="{{ $pago->compro_file }}"
                                                        target="_blank"><b>{{ $pago->comprobante }}</b></a></td>
                                                <td>{{ $pago->tipo_pago->nombre }}</td>
                                                <td>{{ \Carbon\Carbon::parse($pago->fecha)->format('d-m-Y') }}</td>
                                                <td>{{ $pago->monto }}</td>
                                                <td>{{ $pago->acumulado }}</td>
                                                <td class="td-actions">
                                                    <a href="{{ route('pago.edit', $pago->id) }}"
                                                        class="btn btn-success">
                                                        <span class="material-icons">edit</span>
                                                    </a>
                                                    <form action="{{ route('pago.delete', $pago->id) }}" method="POST"
                                                        style="display: inline-block;"
                                                        onsubmit="return confirm('¿Estás seguro de eliminar este pago?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">
                                                            <span class="material-icons">delete</span>
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
