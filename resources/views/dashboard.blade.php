@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
    <div class="content">
        {{-- tarjetas de 4 columnas y 4 filas  --}}
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-primary card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">person</i>
                        </div>
                        <p class="card-category">Estudiantes Registrados</p>
                        <h3 class="card-title">{{ $estudiantes }} </h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons text-danger">visibility</i>
                            <a href="{{ route('estudiante.index') }}">Ver estudiantes</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-primary card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">person</i>
                        </div>
                        <p class="card-category">Programas en curso</p>
                        <h3 class="card-title">{{ $programas_cursos }} </h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons text-danger">visibility</i>
                            <a href="{{ route('programa.index') }}">Ver programas</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-primary card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">person</i>
                        </div>
                        <p class="card-category">Programas finalizados</p>
                        <h3 class="card-title">{{ $programas_finalizado }} </h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons text-danger">visibility</i>
                            <a href="{{ route('programa.index') }}">Ver programas</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-primary card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">person</i>
                        </div>
                        <p class="card-category">Modulos <br> en curso</p>
                        <h3 class="card-title">{{ $modulos }} </h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons text-danger">visibility</i>
                            <a href="{{ route('modulo.index') }}">Ver modulos</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- tabla con programas --}}
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4>Ultimos Programas</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="text-primary text-dark">
                                    <th>#</th>
                                    <th>Sigla</th>
                                    <th>Programa</th>
                                    <th>Tipo</th>
                                    <th>Fecha inicio</th>
                                    <th>Fecha final</th>
                                    <th>Acciones</th>
                                </thead>
                                <tbody>
                                    @foreach ($programas as $programa)
                                        <tr>
                                            <td>{{ $programa->id }} </td>
                                            <td>{{ $programa->sigla . ' ' . $programa->version . '.' . $programa->edicion }}
                                            </td>
                                            <td>{{ $programa->nombre }} </td>
                                            <td>{{ $programa->tipo }} </td>
                                            <td>{{ date('d-m-Y', strtotime($programa->fecha_inicio)) }}</td>
                                            <td>{{ date('d-m-Y', strtotime($programa->fecha_finalizacion)) }}</td>
                                            <td class="td-actions">
                                                <a href="{{ route('programa.show', $programa->id) }}"
                                                    class="btn btn-primary">
                                                    <span class="material-icons">visibility</span>
                                                </a>
                                                <a href=""></a>
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
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            // Javascript method's body can be found in assets/js/demos.js
            md.initDashboardPageCharts();
        });
    </script>
@endpush
