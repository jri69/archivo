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
                <a href="{{ route('activo.create') }}" class="btn btn-outline-primary btn-white">
                    <b>Agregar Activo</b>
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4>Listado de activos</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="text-primary text-dark">
                                    <th>Código</th>
                                    <th>Unidad</th>
                                    <th>Tipo</th>
                                    <th>Estado</th>
                                    <th>Area y Encargado</th>
                                    <th>Descripcion</th>
                                    <th>Acciones</th>
                                </thead>
                                <tbody>
                                    @foreach ($activos as $activo)
                                        <tr>
                                            <td>{{ $activo->codigo }} </td>
                                            <td>{{ $activo->unidad }}</td>
                                            <td>{{ $activo->tipo }}</td>
                                            <td>{{ $activo->estado }}</td>
                                            <td>{{ $activo->area->nombre }} <br> <b>{{ $activo->user->name }}</b></td>
                                            <td>{{ $activo->descripcion }}</td>
                                            <td class="td-actions">
                                                <a href="{{ route('activo.edit', $activo->id) }}"
                                                    class="btn btn-primary">
                                                    <span class="material-icons">edit</span>

                                                </a>
                                                <form action="{{ route('activo.delete', $activo->id) }}" method="POST"
                                                    style="display: inline-block;"
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
                    <!---paginacion-->
                    <div class="row ">
                        <div class="col text-sm">
                            {{ $activos->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
