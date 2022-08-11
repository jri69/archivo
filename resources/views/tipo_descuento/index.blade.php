@extends('layouts.app',['activePage' => 'Descuento', 'titlePage' => 'Descuento'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-left">
                    <a href="{{route('descuento.create')}}" class="btn btn-outline-primary btn-white">
                        <b>Agregar Descuento</b> 
                    </a> 
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4>Listado de Descuentos</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="text-primary text-dark">
                                        <th>#</th>
                                        <th>Nombre</th> 
                                        <th>Monto</th>
                                        <th>Acciones</th>                                         
                                    </thead>
                                    <tbody>
                                        @foreach ($descuentos as $descuento )
                                            <tr>
                                                <td>{{$descuento->id}}</td>
                                            <td>{{$descuento->nombre}}</td>
                                            <td>{{$descuento->monto}}</td>
                                            <td class="td-actions">
                                                {{--Editar Tipo pago--}}
                                                <a href="{{route('descuento.edit',$descuento->id)}}" class="btn btn-primary">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection