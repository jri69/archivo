@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
    <div class="content">
        {{-- tarjetas de 4 columnas y 4 filas  --}}
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-primary card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">groups</i>
                        </div>
                        <p class="card-category">
                            <strong class="h6 card-title">Estudiantes Registrados</strong>
                        </p>
                        <h3 class="card-title">{{ $estudiantes }} </h3>
                    </div>
                    @can('estudiante.index')
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons text-danger">visibility</i>
                                <a href="{{ route('estudiante.index') }}">Ver estudiantes</a>
                            </div>
                        </div>
                    @endcan
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-primary card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">auto_awesome_motion</i>
                        </div>
                        <p class="card-category">
                            <strong class="h6 card-title">Programas <br> en curso</strong>
                        </p>
                        <h3 class="card-title">{{ $programas_cursos }} </h3>
                    </div>
                    @can('programa.index')
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons text-danger">visibility</i>
                                <a href="{{ route('programa.index') }}">Ver programas</a>
                            </div>
                        </div>
                    @endcan
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-primary card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">domain_verification</i>
                        </div>
                        <p class="card-category">
                            <strong class="h6 card-title">Programas finalizados</strong>
                        </p>
                        <h3 class="card-title">{{ $programas_finalizado }} </h3>
                    </div>
                    @can('programa.index')
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons text-danger">visibility</i>
                                <a href="{{ route('programa.index') }}">Ver programas</a>
                            </div>
                        </div>
                    @endcan
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-primary card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">article</i>
                        </div>
                        <p class="card-category">
                            <strong class="h6 card-title">Modulos <br> en curso</strong>
                        </p>
                        <h3 class="card-title">{{ $modulos }} </h3>
                    </div>
                    @can('modulo.index')
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons text-danger">visibility</i>
                                <a href="{{ route('modulo.index') }}">Ver modulos</a>
                            </div>
                        </div>
                    @endcan
                </div>
            </div>
        </div>

        {{-- tabla con programas --}}
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4>Docentes mejor calificados</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="text-primary">
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Calificacion</th>
                                </thead>
                                <tbody>
                                    @foreach ($cal_docente as $docente)
                                        <tr>
                                            <td>{{ $docente->id }}</td>
                                            <td>{{ $docente->honorifico . ' ' . $docente->nombre . ' ' . $docente->apellido }}
                                            </td>
                                            <td>{{ substr($docente->promedio, 0, 5) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <!-- <div style="width: 500px;"><canvas id="dimensions"></canvas></div><br/> -->
                <div style="width: 800px;"><canvas id="acquisitions"></canvas></div>

                <!-- <script type="module" src="dimensions.js"></script> -->
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
    <script type="module" src="acquisitions.js"></script>
@endpush
