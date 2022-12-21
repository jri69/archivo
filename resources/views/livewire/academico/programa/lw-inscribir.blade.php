<div class="content">
    <div class="container-fluid">
        <div class="row" style="margin-bottom: 20px">
            <div class="col-12 text-left">
                <a href="{{ route('programa.modulo', [$programa->id, $modulo->id]) }}" class="btn btn-sm btn-primary">
                    <i class="material-icons">keyboard_backspace</i>
                    <span class="sidebar-normal">Volver</span>
                </a>
                <a wire:click='save' class="btn btn-sm btn-primary text-white">
                    <i class="material-icons">save</i>
                    <span class="sidebar-normal">Guardar</span>
                </a>
                <a wire:click='all' class="btn btn-sm btn-primary text-white">
                    <i class="material-icons">done_all</i>
                    <span class="sidebar-normal">Seleccionar todos</span>
                </a>
            </div>
        </div>

        <div class="form-row">
            <div class="col" style="margin-left: 20px">
                <div class="form-group label-floating has-success">
                    <input type="text" class="form-control" placeholder="Buscar...." wire:model.lazy="attribute">
                    <span class="form-control-feedback">
                        <i class="material-icons">search</i>
                    </span>
                </div>
            </div>
            <div class="col">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4>Listado de estudiantes</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="text-primary text-dark">
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Cedula</th>
                                    <th>Carrera</th>
                                    <th>Inscrito</th>
                                </thead>
                                <tbody>
                                    @foreach ($estudiantes as $estudiante)
                                        <tr>
                                            <td>{{ $estudiante->id }} </td>
                                            <td>{{ $estudiante->nombre }} </td>
                                            <td>{{ $estudiante->cedula }}</td>
                                            <td>{{ $estudiante->carrera }}</td>
                                            <td class="td-actions">
                                                <div class="form-check">
                                                    <label class="form-check" for="defaultCheck1">
                                                        <input class="form-check" type="checkbox"
                                                            {{ in_array($estudiante->id, $listEstudents) ? 'checked' : '' }}
                                                            wire:click="add({{ $estudiante->id }})">
                                                        <span class="form-check"></span>
                                                    </label>
                                                </div>
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
