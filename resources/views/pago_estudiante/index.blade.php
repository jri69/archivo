@extends('layouts.app', ['activePage' => 'estudiante', 'titlePage' => 'Pago Estudiantes'])

@section('content')
    <div class="content">
    <div class="container-fluid">
        <div class="form-row">
            <div class="col">
                <div class="form-group label-floating has-success">
                    <input type="text" class="form-control" placeholder="Buscar...." wire:model.lazy="attribute">
                    <span class="form-control-feedback">
                        <i class="material-icons">search</i>
                    </span>
                </div>
            </div>
            <div class="col text-right">
                <a href="{{route('pago_estudiante.create')}}" class="btn btn-outline-primary btn-white">
                    <b>Agregar Estudiante</b>
                </a>
                <a href="{{route('pago.index')}}" class="btn btn-outline-primary btn-white">
                    <b>Pago</b>
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4>Listado de Estudiantes</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="text-primary text-dark">
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Correo</th>
                                    <th>Telefono</th>
                                    <th>Carnet</th>
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