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
                <a href="{{ route('contrataciones.create') }}" class="btn btn-outline-primary btn-white">
                    <b>Nuevo Contrato</b>
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4>Listado de contratos</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="text-primary text-dark">
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>CI</th>
                                    <th>Modulo</th>
                                    <th>Inicio</th>
                                    <th>Final</th>
                                    <th>Acciones</th>
                                </thead>
                                <tbody>
                                    @foreach ($contratos as $contrato)
                                        <tr>

                                            <td>{{ $contrato->contrato_id }}</td>
                                            <td>{{ $contrato->modulo->docente->nombre . ' ' . $contrato->modulo->docente->apellido }}
                                            </td>
                                            <td>{{ $contrato->modulo->docente->cedula }}</td>
                                            <td>{{ $contrato->modulo->nombre }}</td>
                                            <td>{{ $contrato->fecha_inicio }}</td>
                                            <td>{{ $contrato->fecha_final }}</td>
                                            <td class="td-actions">
                                                <a href="{{ route('contrataciones.show', $contrato->contrato_id) }}"
                                                    class="btn btn-success">
                                                    <span class="material-icons">visibility</span>
                                                </a>
                                                <form
                                                    action="{{ route('contrataciones.delete', $contrato->contrato_id) }}"
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
                            {{ $contratos->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
