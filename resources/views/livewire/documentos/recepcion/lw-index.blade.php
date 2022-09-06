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
                <a href="{{ route('recepcion.create') }}" class="btn btn-outline-primary btn-white">
                    <b>Agregar recepción</b>
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4>Listado de recepciones</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="text-primary text-dark">
                                    <th>Código</th>
                                    <th>Recibido</th>
                                    <th>Area</th>
                                    <th>Unidad organizativa</th>
                                    <th>Fecha</th>
                                    <th>Descripción</th>
                                    <th>Acciones</th>
                                </thead>
                                <tbody>
                                    @foreach ($recepciones as $recepcion)
                                        <tr>
                                            <td>{{ $recepcion->codigo }} </td>
                                            <td>{{ $recepcion->user->usuario->nombre . ' ' . $recepcion->user->usuario->apellido }}
                                            </td>
                                            <td>{{ $recepcion->user->usuario->area->nombre }}</td>
                                            <td>{{ $recepcion->unidad_organizativa->nombre }}</td>
                                            <td>{{ $recepcion->fecha }}</td>
                                            <td>{{ $recepcion->descripcion }}</td>
                                            <td class="td-actions">
                                                <a href="{{ route('recepcion.show', $recepcion->id) }}"
                                                    class="btn btn-success">
                                                    <span class="material-icons">visibility</span>
                                                </a>
                                                <form action="{{ route('recepcion.delete', $recepcion->id) }}"
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
                            {{ $recepciones->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
