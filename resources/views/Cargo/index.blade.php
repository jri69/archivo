@extends('layouts.app',['activePage' => 'cargo', 'titlePage' => 'Cargo'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-left">
                    <a href="{{route('cargo.create')}}" class="btn btn-outline-primary btn-white">
                        <b>Agregar Cargo</b> 
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4>Listado de Cargo</h4>
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
                                        @foreach ($cargos as $cargo )
                                            <tr>
                                                <td>{{$cargo->id}}</td>
                                            <td>{{$cargo->nombre}}</td>
                                            <td class="td-actions">
                                                {{--Editar Cargo--}}
                                                <a href="{{route('cargo.edit',$cargo->id)}}" class="btn btn-primary">
                                                    <span class="material-icons">edit</span>

                                                </a>
                                                <form action="{{route('cargo.delete',$cargo->id)}}" method="POST" style="display: inline-block;"
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