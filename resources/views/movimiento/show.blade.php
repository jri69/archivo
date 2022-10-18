@extends('layouts.app', ['activePage' => 'movimientos', 'titlePage' => 'Ver Movimientos'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-left">
                    <a href="{{ route('recepcion.show', $recepcion->id) }}" class="btn btn-sm btn-primary">
                        <i class="material-icons">keyboard_backspace</i>
                        <span class="sidebar-normal">Volver</span>
                    </a>

                    @if ($movimiento->user_id === Auth::user()->id && $movimiento->confirmacion == 'Sin confirmar')
                        <a href="{{ route('movimiento.confirmar', [$movimiento->id, $recepcion->id]) }}"
                            class="btn btn-sm btn-primary">
                            <i class="material-icons">check</i>
                            <span class="sidebar-normal">Confirmar Recibo</span>
                        </a>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Movimiento</h4>
                            <p class="card-category"> Datos generales</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Código</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input type="text" class="form-control" disabled
                                            value="{{ $movimiento->codigo }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Recibido</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input type="text" class="form-control" disabled
                                            value="{{ $movimiento->user->usuario->nombre . ' ' . $movimiento->user->usuario->apellido }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Área</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input type="text" class="form-control" disabled
                                            value="{{ $movimiento->user->usuario->area->nombre }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-sm-2 col-form-label">Departamento</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input type="text" class="form-control" disabled
                                            value="{{ $movimiento->departamento }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-sm-2 col-form-label">Fecha</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input type="text" class="form-control" disabled
                                            value="{{ date('d-m-Y', strtotime($movimiento->fecha)) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Confirmación</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input type="text" class="form-control" disabled
                                            value="{{ $movimiento->confirmacion }}">
                                    </div>
                                </div>
                            </div>
                            @if ($documento)
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">Documento</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <a href="{{ asset($documento->dir) }}"
                                                target="_blank">{{ $documento->nombre }}</a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Descripción</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <textarea class="form-control" disabled>{{ $movimiento->descripcion }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
