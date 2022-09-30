@extends('layouts.app',['activePage' => 'subpartida', 'titlePage' => 'Area'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="{{ route('presupuesto.create') }}">
                <div class="col-12 text-left">
                    <a href="{{ route('subpartida.create') }}" class="btn btn-outline-primary btn-white">
                        <b>Agregar Subpartida</b> 
                    </a> 
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4>Listado de Sub partidas</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="text-primary text-dark">
                                        <th>#</th>
                                        <th>Codigo</th> 
                                        <th>Nombre</th> 
                                        <th>Acciones</th>                                         
                                    </thead>
                                    <tbody>
                                        @foreach ($items as $partida)
                                            <tr>
                                                <td>{{ $partida->id }}</td>
                                                <td>{{ $partida->codigo }}</td>
                                                <td>{{ $partida->nombre }}</td>
                                                <td class="td-actions">
                                                    <a href="{{route('subpartida.edit',$partida->id)}}" class="btn btn-primary">
                                                        <span class="material-icons">edit</span>
    
                                                    </a>
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