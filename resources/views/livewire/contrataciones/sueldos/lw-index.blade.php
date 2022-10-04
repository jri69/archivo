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
                <a href="{{ route('sueldos.create') }}" class="btn btn-outline-primary btn-white">
                    <b>Nuevos pagos</b>
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4>Listado de pago de sueldos</h4>
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
                                    <tr>
                                        <td>1</td>
                                        <td>a</td>
                                        <td>s</td>
                                        <td>s</td>
                                        <td>s</td>
                                        <td>s</td>
                                        <td>d</td>
                                        <td class="td-actions">
                                            <a href="{{ route('contrataciones.show', 0) }}" class="btn btn-success">
                                                <span class="material-icons">visibility</span>
                                            </a>
                                            <form action="{{ route('sueldos.delete', 0) }}" method="POST"
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
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!---paginacion-->
                    {{-- <div class="row ">
                        <div class="col text-sm">
                            {{ $productos->links() }}
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
