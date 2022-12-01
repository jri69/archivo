@extends('layouts.app',['activePage' => 'detalle_factura', 'titlePage' => 'Detalle Factura'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="form-row">
            <div class="col text-left">
                <a href="{{route('detalle_factura.create',$id)}}" class="btn btn-outline-primary btn-white">
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
                                    <th>Precio Unitario</th>
                                    <th>Subtotal</th>
                                    <th>Acciones</th>
                                </thead>
                                <tbody>
                                    @foreach ($factura as $item )
                                        <tr>
                                            <td>{{$item->id}}</td>
                                        <td>{{$item->cantidad}}</td>
                                        <td>{{$item->detalle}}</td>
                                        <td>{{$item->precio_unitario}}</td>
                                        <td>{{$item->subtotal}}</td>
                                        <td class="td-actions">

                                            <a href="{{route('detalle_factura.edit',$item->id)}}" class="btn btn-primary">
                                                <span class="material-icons">edit</span>

                                            </a>
                                            <form action="{{route('detalle_factura.delete',$item->id)}}" method="POST" style="display: inline-block;"
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
