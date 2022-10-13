@extends('layouts.app',['activePage' => 'detalle_factura', 'titlePage' => 'Detalle Factura'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="form-row">           
            <div class="col text-left">
                <a href="{{route('detalle_factura.create')}}" class="btn btn-outline-primary btn-white">
                    <b>Agregar Detalle Factura</b>
                </a>
                <a href="{{ route('factura.index') }}" style="margin-left:60%" class="btn btn-sm btn-primary">
                    <i class="material-icons">keyboard_backspace</i>
                    atras</a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4>Listado de Facturas</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="text-primary text-dark">
                                    <th>#</th>
                                    <th>Cantidad</th>
                                    <th>Detalle</th>
                                    <th>Subtotal</th>
                                    <th>Acciones</th>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <!---paginacion-->
                    <div class="row">
                        <div class="col">
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection