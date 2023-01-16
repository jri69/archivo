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
                <a href="{{ route('directivo.create') }}" class="btn btn-outline-primary btn-white">
                    <b>Agregar Directivo</b>
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4>Listado de directivos</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="text-primary text-dark">
                                    <th>#</th>
                                    <td>Honorifico</td>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Cargo</th>
                                    <th>Activo</th>
                                    <th>Acciones</th>
                                </thead>
                                <tbody>
                                    @foreach ($directivos as $directivo)
                                        <tr>
                                            <td>{{ $directivo->id }}</td>
                                            <td>{{ $directivo->honorifico }}</td>
                                            <td>{{ $directivo->nombre }}</td>
                                            <td>{{ $directivo->apellido }}</td>
                                            <td>
                                                {{ $directivo->cargo }} <br>
                                                <small>
                                                    {{ $directivo->institucion }}
                                                </small>
                                            </td>
                                            <td>
                                                @if ($directivo->activo)
                                                    <span class="badge badge-success">Activo</span>
                                                @else
                                                    <span class="badge badge-danger">Inactivo</span>
                                                @endif
                                            </td>
                                            <td class="td-actions">
                                                <a href="{{ route('directivo.edit', $directivo->id) }}"
                                                    class="btn btn-primary">
                                                    <span class="material-icons">edit</span>
                                                </a>

                                                {{-- <form action="{{ route('directivo.delete', $directivo->id) }}"
                                                    method="POST" style="display: inline-block;"
                                                    onsubmit="return confirm('¿Está seguro?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger" type="submit">
                                                        <i class="material-icons">close</i>
                                                    </button>
                                                </form> --}}
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
                            {{ $directivos->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
