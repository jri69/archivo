@extends('layouts.app',['activePage' => 'servi', 'titlePage' => 'Pago Servicios'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-left">
                    <a href="{{route('servicio.create')}}" class="btn btn-outline-primary btn-white">
                        <b>Agregar Servicio</b> 
                    </a> 
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card"> 
                        <div class="card-header card-header-primary">
                            <h4>Listado de Servicios</h4>
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
                                        @foreach ($servicios as $servicio )
                                            <tr>
                                                <td>{{$servicio->id}}</td>
                                            <td><h4>{{$servicio->nombre}}</h4></td>
                                            <td class="td-actions">
                                                {{--Editar Area--}}
                                                <a href="{{route('servicio.edit',$servicio->id)}}" class="btn btn-primary">
                                                    <span class="material-icons">edit</span>

                                                </a>
                                               <!-- <form action="#" method="POST" style="display: inline-block;"
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