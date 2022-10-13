@extends('layouts.app',['activePage' => 'pagos', 'titlePage' => 'Pago Servicios'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-left">
                    <a href="{{ route('pago_servicio.create') }}" class="btn btn-outline-primary btn-white">
                        <b>Agregar Pago de Servicio</b> 
                    </a> 
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4>Listado de Pagos de Servicios</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="text-primary text-dark">
                                        <th>#</th>
                                        <th>Nombre</th> 
                                        <th>Monto</th>
                                        <th>Fecha</th>
                                        <th>Acciones</th>                                         
                                    </thead>
                                    <tbody>
                                        @foreach ($pagos as $pago )
                                            <tr>
                                                <td>{{$pago->id}}</td>
                                            <td><a href="{{ $pago->comprobante }}" target="_blank" rel="noopener noreferrer"><b>{{ $pago->servicio()->pluck('nombre')->first() }}</b></a></td>
                                            <td>{{$pago->monto}}</td>
                                            <td>{{ $pago->fecha }}</td>
                                            <td class="td-actions">
                                                {{--Editar Tipo pago--}}
                                                <a href="{{ route('pago_servicio.edit',$pago->id) }}" class="btn btn-primary">
                                                    <span class="material-icons">edit</span>

                                                </a>
                                                <!--<form action="#" method="POST" style="display: inline-block;"
                                                onsubmit="return confirm('¿Está seguro?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger" type="submit">
                                                    <i class="material-icons">close</i>
                                                </button>
                                                </form> -->
                                            </td>
                                            </tr>                                            
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                {{ $pagos->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection