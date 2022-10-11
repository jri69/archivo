@extends('layouts.app', ['activePage' => 'estudiante', 'titlePage' => 'Estudiantes'])

@section('content')
    <!---Mostrar notas de los modulos del programa-->

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!--volver para atras-->
                    <a href="{{ route('estudiante.show', $estudiante->id) }}" class="btn btn-sm btn-primary">
                        <i class="material-icons">keyboard_backspace</i>
                        <span class="sidebar-normal">Volver</span>
                    </a>
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Notas</h4>
                            <p class="card-category">Notas de los modulos de {{ $programa->nombre }}</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                        <th>
                                            ID
                                        </th>
                                        <th>
                                            Modulo
                                        </th>
                                        <th>
                                            Docente
                                        </th>
                                        <th>
                                            Observaciones
                                        </th>
                                        <th>
                                            Nota
                                        </th>

                                    </thead>
                                    <tbody>
                                        @foreach ($notas as $nota)
                                            <tr>
                                                <td>
                                                    {{ $nota->id }}
                                                </td>
                                                <td>
                                                    {{ $nota->modulo->nombre }}
                                                </td>
                                                <td>
                                                    {{ $nota->modulo->docente->honorifico }}
                                                    {{ $nota->modulo->docente->nombre }}
                                                    {{ $nota->modulo->docente->apellido }}
                                                </td>
                                                <td>
                                                    @if ($nota->observaciones)
                                                        {{ $nota->observaciones }}
                                                    @else
                                                        No hay observaciones
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($nota->nota >= 51)
                                                        <h4>
                                                            <span
                                                                class="badge badge-pill badge-success">{{ $nota->nota }}</span>
                                                        </h4>
                                                    @else
                                                        <h4>

                                                            <span
                                                                class="badge badge-pill badge-danger">{{ $nota->nota }}</span>
                                                        </h4>
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
@endsection
