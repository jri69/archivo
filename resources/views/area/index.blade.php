@extends('layouts.app',['activePage' => 'area', 'titlePage' => 'Area'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-left">
                    <a href="{{route('area.create')}}" class="btn btn-outline-primary btn-white">
                        <b>Agregar Area</b> 
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4>Listado de Areas</h4>
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
                                        @foreach ($areas as $area )
                                            <tr>
                                                <td>{{$area->id}}</td>
                                            <td>{{$area->nombre}}</td>
                                            <td class="td-actions">
                                                {{--Editar Area--}}
                                                <a href="{{route('area.edit',$area->id)}}" class="btn btn-primary">
                                                    <span class="material-icons">edit</span>

                                                </a>
                                                <form action="{{route('area.delete',$area->id)}}" method="POST" style="display: inline-block;"
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