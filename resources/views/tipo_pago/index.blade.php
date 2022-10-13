@extends('layouts.app',['activePage' => 'tipo_pago', 'titlePage' => 'Agregar Metodo de Pago'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-left">
                    <a href="{{route('tipo_pago.create')}}" class="btn btn-outline-primary btn-white">
                        <b>Agregar Metodo de Pago</b> 
                    </a> 
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4>Listado de Metodos de Pago</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="text-primary text-dark">
                                        <th>#</th>
                                        <th>Nombre</th>                                         
                                        <th>Acciones</th>                                         
                                    </thead>
                                    <tbody>
                                        @foreach ($item as $pago )
                                            <tr>
                                                <td>{{$pago->id}}</td>
                                            <td>{{$pago->nombre}}</td>
                                            <td class="td-actions">
                                                {{--Editar Tipo pago--}}
                                                <a href="{{route('tipo_pago.edit',$pago->id)}}" class="btn btn-primary">
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
                                {{ $item->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection