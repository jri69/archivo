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
                <a href="{{ route('programa.create') }}" class="btn btn-outline-primary btn-white">
                    <b>Agregar Programa</b>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4>Listado de programas</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="text-primary text-dark">
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Tipo</th>
                                    <th>Sigla</th>
                                    <th>Costo</th>
                                    <th>Inicio</th>
                                    <th>Finalización</th>
                                    <th>Acciones</th>
                                </thead>
                                <tbody>
                                    @foreach ($programas as $programa)
                                        <tr>
                                            <td>{{ $programa->id }} </td>
                                            <td>{{ $programa->nombre }}</td>
                                            <td>{{ $programa->tipo }}</td>
                                            <td>{{ $programa->sigla }}</td>
                                            <td>{{ $programa->costo }}</td>
                                            <td>{{ \Carbon\Carbon::parse($programa->fecha_inicio)->format('d-m-Y') }}
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($programa->fecha_finalizacion)->format('d-m-Y') }}
                                            </td>
                                            <td class="td-actions">
                                                <a href="{{ route('programa.show', $programa->id) }}"
                                                    class="btn btn-success">
                                                    <span class="material-icons">visibility</span>
                                                </a>
                                                <form action="{{ route('programa.delete', $programa->id) }}"
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
                    <div class="row">
                        <div class="col">
                            {{ $programas->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
