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
                <a href="{{ route('inventario.create') }}" class="btn btn-outline-primary btn-white">
                    <b>Agregar Producto</b>
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4>Listado de productos</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="text-primary text-dark">
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Tipo</th>
                                    <th>Modelo</th>
                                    <th>Cantidad</th>
                                    <th>Estado</th>
                                    <th>Observaciones</th>
                                    <th>Acciones</th>
                                </thead>
                                <tbody>
                                    @foreach ($productos as $producto)
                                        <tr>
                                            <td>{{ $producto->id }} </td>
                                            <td>{{ $producto->nombre }}</td>
                                            <td>{{ $producto->tipo }}</td>
                                            <td>{{ $producto->modelo }}</td>
                                            <td>{{ $producto->cantidad }}</td>
                                            <td>{{ $producto->estado }}</td>
                                            <td>{{ $producto->observaciones }}</td>
                                            <td class="td-actions">
                                                <a href="{{ route('inventario.edit', $producto->id) }}"
                                                    class="btn btn-primary">
                                                    <span class="material-icons">edit</span>

                                                </a>
                                                <form action="{{ route('inventario.delete', $producto->id) }}"
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
                            {{ $productos->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
