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
                <a href="{{route('administrativo.create')}}" class="btn btn-outline-primary btn-white">
                    <b>Agregar administrativo</b>
                </a>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4>Listado de Administrativos</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="text-primary text-dark">
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Contrato</th>
                                    <th>Cedula</th>
                                    <th>Fecha de Ingreso</th>
                                    <th>Fecha de Retiro</th>
                                    <th>Acciones</th>
                                </thead>
                                <tbody>
                                    <tbody>
                                        @foreach ($administrativo as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->nombre }}</td>
                                                <td>{{ $item->apellido }}</td>
                                                <td>{{ $item->contrato }}</td>
                                                <td>{{ $item->ci}}-{{$item->expedicion}}</td>
                                                <td>{{ $item->fecha_ingreso }}</td>
                                                <td>{{ $item->fecha_retiro }}</td>
                                                <td class="td-actions">
                                                    {{-- Editar Area --}}
                                                    <a href="{{ route('area.edit', $item->id) }}" class="btn btn-primary">
                                                        <span class="material-icons">edit</span>

                                                    </a>
                                                    <form action="{{ route('area.delete', $item->id) }}" method="POST"
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
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{-- <div class="row">
                        <div class="col">
                            {{ $cargos->links() }}
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
