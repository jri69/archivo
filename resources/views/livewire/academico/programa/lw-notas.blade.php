    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12 text-left">
                    <a href="{{ route('programa.inscritos', [$programa->id, $modulo->id]) }}"
                        class="btn btn-outline-primary btn-white">
                        <b>Guardar</b>
                    </a>
                </div>
            </div>

            <!--Lista de estudiantes inscritos-->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Estudiantes inscritos</h4>
                            <p class="card-category"> Lista de estudiantes inscritos en el módulo</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                        <th>
                                            Nombre
                                        </th>
                                        <th>
                                            Cédula
                                        </th>
                                        <th>
                                            Observación
                                        </th>
                                        <th>
                                            Nota
                                        </th>
                                    </thead>
                                    <tbody>
                                        @foreach ($estudiante_programa as $estu_progm)
                                            <tr>
                                                <td>
                                                    {{ $estu_progm->estudiante->nombre }}
                                                </td>
                                                <td>
                                                    {{ $estu_progm->estudiante->cedula }}
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control"
                                                        wire.model='observaciones.{{ $estu_progm->id }}'
                                                        placeholder="Observaciones">
                                                </td>
                                                <td class="">
                                                    <input type="text" class="form-control"
                                                        wire.model="notas.{{ $estu_progm->id }}" placeholder="Nota">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                @foreach ($notas as $item)
                                    {{ $item }}
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
