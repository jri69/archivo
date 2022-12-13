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
                <a href="{{ route('solicitudes.create') }}" class="btn btn-outline-primary btn-white">
                    <b>Agregar Solicitud</b>
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4>Listado de solicitudes</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="text-primary text-dark">
                                    <th>#</th>
                                    <th>Solicitante</th>
                                    <th>Equipo</th>
                                    <th>Cantidad</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </thead>
                                <tbody>
                                    @foreach ($solicitudes as $solicitud)
                                        <tr>
                                            <td>{{ $solicitud->id }} </td>
                                            <td>{{ $solicitud->name }}</td>
                                            <td>{{ $solicitud->nombre }}</td>
                                            <td>{{ $solicitud->cantidad }}</td>
                                            <td>{{ $solicitud->estado }}</td>
                                            <td class="td-actions">
                                                <a href="{{ route('solicitudes.show', $solicitud->id) }}"
                                                    class="btn btn-primary">
                                                    <span class="material-icons">show</span>

                                                </a>
                                                <form action="{{ route('solicitudes.delete', $solicitud->id) }}"
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
                            </table>
                        </div>
                    </div>
                    <!---paginacion-->
                    <div class="row ">
                        <div class="col text-sm">
                            {{ $solicitudes->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
