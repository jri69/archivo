<div class="content">
    <div class="container-fluid">
        <div class="form-row">
            <div class="col">
            </div>
            <div class="col text-right">
                <a href="{{ route('administrativo.create') }}" class="btn btn-outline-primary btn-white">
                    <b>Agregar</b>
                </a>
            </div>
        </div>
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
                <a class="btn btn-primary text-white" wire:click="todos">
                    <i class="material-icons">refresh</i>
                    <b>Todos</b>
                </a>
                <a class="btn btn-primary text-white" wire:click="consultor">
                    <i class="material-icons">people</i>
                    <b>Consultores</b>
                </a>
                <a class="btn btn-primary text-white" wire:click="plazo_fijo">
                    <i class="material-icons">person</i>
                    <b>Plazo Fijo</b>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4>Listado de Administrativos</h4>
                        {{ $filtro }}
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="text-primary text-dark">
                                    <th>Foto</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Contrato</th>
                                    <th>Cedula</th>
                                    <th>Sueldo</th>
                                    <th>Fecha de Ingreso</th>
                                    <th>Fecha de Retiro</th>
                                    <th>Acciones</th>
                                </thead>
                                <tbody>
                                <tbody>
                                    @foreach ($administrativo as $item)
                                        <tr>
                                            <td>
                                                <img src="{{ asset($item->foto) }}" alt="" class="img-fluid"
                                                    width="50">
                                            </td>
                                            <td>{{ $item->nombre }}</td>
                                            <td>{{ $item->apellido }}</td>
                                            <td>{{ $item->contrato }}</td>
                                            <td>{{ $item->ci }}-{{ $item->expedicion }}</td>
                                            <td>{{ $item->sueldo }}</td>
                                            <td>{{ $item->fecha_ingreso }}</td>
                                            <td>{{ $item->fecha_retiro ?? 'N/A' }}</td>
                                            <td class="td-actions">
                                                <a href="{{ route('administrativo.edit', $item->id) }}"
                                                    class="btn btn-primary">
                                                    <span class="material-icons">edit</span>
                                                </a>
                                                <form action="{{ route('administrativo.delete', $item->id) }}"
                                                    method="POST" style="display: inline-block;"
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
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            {{ $administrativo->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
