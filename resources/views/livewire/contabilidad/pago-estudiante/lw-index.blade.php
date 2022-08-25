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
                                <tbody>
                                        @foreach ($estudiantes as $estudiante )
                                            <tr>
                                            <td>{{$estudiante->id}}</td>
                                            <td>{{$estudiante->nombre}}</td>
                                            <td>{{$estudiante->email}}</td>
                                            <td>{{$estudiante->telefono}}</td>
                                            <td>{{$estudiante->cedula}}</td>
                                            <td class="td-actions">
                                                {{----}}
                                                <a href="{{route('pago_estudiante.show',$estudiante->id)}}" class="btn btn-primary">
                                                    <span class="material-icons">visibility</span>

                                                </a>   
                                                <a href="{{route('pago_estudiante.edit',$estudiante->id)}}" class="btn btn-primary">
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
