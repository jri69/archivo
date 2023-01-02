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
                <a href="{{ route('procesos.create') }}" class="btn btn-outline-primary btn-white">
                    <b>Agregar Proceso</b>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4>Listado de Procesos</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="text-primary text-dark">
                                    <th>Proceso</th>
                                    <th>Orden</th>
                                    <th>Acciones</th>
                                </thead>
                                <tbody>
                                    @foreach ($procesos as $proceso)
                                        <tr>
                                            <td>{{ $proceso->orden }} </td>
                                            <td>{{ $proceso->nombre }} </td>
                                            <td class="td-actions">
                                                <button class="btn btn-success"
                                                    wire:click="subirNivel({{ $proceso->id }})">
                                                    <span class="material-icons">arrow_upward</span>
                                                </button>
                                                <button class="btn btn-success"
                                                    wire:click="bajarNivel({{ $proceso->id }})">
                                                    <span class="material-icons">arrow_downward</span>
                                                </button>
                                                <a href="{{ route('procesos.edit', $proceso->id) }}"
                                                    class="btn btn-primary">
                                                    <span class="material-icons">edit</span>
                                                </a>
                                                <form action="{{ route('procesos.delete', $proceso->id) }}"
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
                            {{ $procesos->links() }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
