@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
    <div class="content">
        {{-- tarjetas de 4 columnas y 4 filas  --}}
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4>Proximos eventos</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="text-primary">
                                    <th>Titulo</th>
                                    <th>Lugar</th>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                </thead>
                                <tbody>
                                    @foreach ($eventos as $evento)
                                        <tr>
                                            <td>{{ $evento->titulo }}</td>
                                            <td>{{ $evento->lugar }}</td>
                                            <td>{{ date('d-m-Y', strtotime($evento->fecha)) }}</td>
                                            <td>{{ $evento->hora }}</td>
                                        </tr>
                                    @endforeach
                                    @if (count($eventos) == 0)
                                        <tr>
                                            <td colspan="3">No hay eventos para hoy</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-primary card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">groups</i>
                        </div>
                        <p class="card-category">
                            <strong class="h6 card-title">Estudiantes Activos</strong>
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
                <div class="card card-stats">
                    <div class="card-header card-header-primary card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">article</i>
                        </div>
                        <p class="card-category">
                            <strong class="h6 card-title">Modulos en curso</strong>
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
            <div class="col-lg-3 col-md-6 col-sm-6">

                <div class="card card-stats">
                    <div class="card-header card-header-primary card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">auto_awesome_motion</i>
                        </div>
                        <p class="card-category">
                            <strong class="h6 card-title">Programas en curso</strong>
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
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4>Indice de deserción</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div style="width: 480px;"><canvas id="acquisitions"></canvas></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    {{-- <script type="module" src="{{ asset('js/grafica.js') }}" defer></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    {{-- usar variables php en js --}}
    <script type="text/javascript">
        var labels = @json($nombres);
        var users = @json($cantidad);
        const data = {
            labels: labels,
            datasets: [{
                label: 'Indice de deserción',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: users,
            }]
        };

        const config = {
            type: 'line',
            data: data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }

            }
        };

        const myChart = new Chart(
            document.getElementById('acquisitions'),
            config
        );
    </script>
@endpush
