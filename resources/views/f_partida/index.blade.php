@extends('layouts.app',['activePage' => 'fifthpartida', 'titlePage' => 'Fifth Partida'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="{{ route('presupuesto.create') }}">
                <div class="col-12 text-left">
                    <a href="{{ route('c_partida.create') }}" class="btn btn-outline-primary btn-white">
                        <b>Agregar 5 partida</b> 
                    </a> 
                    <a href="{{ route('partida.index') }}" style="margin-left:70%" class="btn btn-sm btn-primary">
                        <i class="material-icons">keyboard_backspace</i>
                        atras</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4>Listado de Quinta partida</h4>
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
                                                    <a href="{{route('c_partida.edit',$partida->id)}}" class="btn btn-primary">
                                                        <span class="material-icons">edit</span>
    
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                {{ $items->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection