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
                    <a href="{{ route('estudiante.titulacionEdit', $titulacion->id) }}" class="btn btn-sm btn-primary">
                        <i class="material-icons">edit</i>
                        <span class="sidebar-normal">Editar</span>
                    </a>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-title ">Titulacion</h4>
                                    <p class="card-category">Informacion de la titulacion</p>
                                </div>
                                <div class="card-body">
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">Nombre de la tesis</label>
                                                <input type="text" class="form-control" value="{{ $titulacion->tesis }}"
                                                    disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">Nombre del director</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $titulacion->director }}" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Cartas</h4>
                            <p class="card-category">Cartas de {{ $estudiante->nombre }}</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                        <th> # </th>
                                        <th> Nombre </th>
                                        <th> Fecha </th>
                                        <th> Acciones </th>
                                    </thead>
                                    <tbody>
                                        @foreach ($tipos_cartas as $key => $carta)
                                            <tr>

                                                <td> {{ $key + 1 }} </td>
                                                <td> {{ $carta['tipo']->nombre }} </td>
                                                <td> {{ $carta['carta'] ? $carta['carta']->fecha : 'No creado' }}
                                                </td>
                                                <td class="td-actions">
                                                    {{-- @if ((!$tipo['carta'] && $tipos_cartas[0]['carta']) || ($tipos_cartas[0] == $tipo && !$tipo['carta'])) --}}
                                                    @if (!$carta['carta'])
                                                        <a href="{{ route('estudiante.cartaCreate', [$estudiante->id, $titulacion->id, $carta['tipo']->id]) }}"
                                                            class="btn btn-success">
                                                            <span class="material-icons">save</span>
                                                        </a>
                                                    @endif
                                                    {{-- @if ($tipo['carta']) --}}
                                                    @if ($carta['carta'])
                                                        <a href="{{ route('carta.pdf', [$titulacion->id, $carta['tipo']->id, $carta['carta']->id]) }}"
                                                            class="btn btn-primary" target="_blank">
                                                            <span class="material-icons">cloud_download</span>
                                                        </a>
                                                        <form
                                                            action="{{ route('estudiante.cartaDestroy', $carta['carta']->id) }}"
                                                            method="POST" style="display: inline-block;"
                                                            onsubmit="return confirm('¿Está seguro?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger" type="submit">
                                                                <i class="material-icons">delete</i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                    {{-- @endif --}}
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
