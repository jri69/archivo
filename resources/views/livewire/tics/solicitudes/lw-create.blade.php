<div class="content">
    <div class="container-fluid">
        <div class="row" style="margin-bottom: 20px">
            <div class="col-12 text-left">
                <a href="{{ route('solicitudes.index') }}" class="btn btn-sm btn-primary">
                    <i class="material-icons">keyboard_backspace</i>
                    <span class="sidebar-normal">Volver</span>
                </a>
                <a wire:click='save' class="btn btn-sm btn-primary text-white">
                    <i class="material-icons">save</i>
                    <span class="sidebar-normal">Guardar</span>
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
                        <h4>Listado de equipos/materiales</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="text-primary text-dark">
                                    <th>#</th>
                                    <th>Equipo</th>
                                    <th>Modelo</th>
                                    <th>Tipo</th>
                                    <th>Stock</th>
                                    <th>Solicito</th>
                                </thead>
                                <tbody>
                                    @foreach ($equipos as $equipo)
                                        <tr>
                                            <td>{{ $equipo->id }} </td>
                                            <td>{{ $equipo->nombre }} </td>
                                            <td>{{ $equipo->modelo }}</td>
                                            <td>{{ $equipo->tipo }}</td>
                                            <td>{{ $equipo->cantidad }}</td>
                                            <td>
                                                <input type="number" min="0" max="{{ $equipo->cantidad }}"
                                                    wire:model.defer="solicitud.{{ $equipo->id }}"
                                                    class="form-control" placeholder="Cantidad">
                                                <!--mostrar errores de validacion-->
                                                @if ($errorValidation && $idError == $equipo->id)
                                                    <div class="error text-danger">
                                                        {{ $mensaje }}
                                                    </div>
                                                @endif
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
