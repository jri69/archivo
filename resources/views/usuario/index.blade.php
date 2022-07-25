@extends('layouts.app',['activePage' => 'usuario', 'titlePage' => 'Usuario'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-left">
                    <a href="{{route('usuario.create')}}" class="btn btn-outline-primary btn-white">
                        <b>Agregar Usuario</b> 
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">

                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-tittle">Listado de Usuarios</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="text-primary text-dark">
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Cargo</th>
                                        <th>Acciones</th> 
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection