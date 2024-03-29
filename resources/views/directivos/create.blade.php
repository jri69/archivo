@extends('layouts.app', ['activePage' => 'directivos', 'titlePage' => 'Directivos'])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row" style="margin-left: 10%">
                <div class="col-md-11">
                    <form action="{{ route('directivo.store') }}" method="post" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Honorifico</label>
                                            <select name="honorifico" id="_honorifico" class="form-control">
                                                <option disabled selected>Seleccione el honorifico</option>
                                                <option value="Lic.">Lic</option>
                                                <option value="Ing.">Ing</option>
                                                <option value="M.Sc.">M.Sc</option>
                                                <option value="Ph.D.">Ph.D</option>
                                                <option value="Abog.">Abog</option>
                                            </select>
                                        </div>
                                        @if ($errors->has('honorifico'))
                                            <span class="error text-danger"
                                                for="input-honorifico">{{ $errors->first('honorifico') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-6">

                                    </div>
                                </div>
                                <br>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Nombre</label>
                                            <input type="text" class="form-control" name="nombre">
                                        </div>
                                        @if ($errors->has('nombre'))
                                            <span class="error text-danger"
                                                for="input-nombre">{{ $errors->first('nombre') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Apellido</label>
                                            <input type="text" class="form-control" name="apellido">
                                        </div>
                                        @if ($errors->has('apellido'))
                                            <span class="error text-danger"
                                                for="input-apellido">{{ $errors->first('apellido') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <br>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select class="form-control" name="cargo">
                                                <option disabled selected value="">Seleccione el cargo</option>
                                                <option value="Director">Director</option>
                                                <option value="Coordinador Académico">Coordinador Académico</option>
                                                <option value="Asesor Legal">Asesor Legal</option>
                                                <option value="Responsable del proceso de contratación">Responsable del
                                                    proceso de contratación</option>
                                                <option value="Decano">Decano</option>
                                                <option value="Jefe ADM. y Financiero">Jefe ADM. y Financiero</option>
                                                <option value="Coordinador de investigación">Coordinador de investigación
                                                </option>
                                                <option value="Presidente">Presidente</option>
                                                <option value="Directora general de postgrado">Director general de
                                                    postgrado</option>
                                            </select>
                                        </div>
                                        @if ($errors->has('cargo'))
                                            <span class="error text-danger"
                                                for="input-cargo">{{ $errors->first('cargo') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select class="form-control" name="institucion">
                                                <option disabled selected value="">Seleccione la institucion</option>
                                                <option value="Escuela de Ingeniería - F.C.E.T.">Escuela de Ingeniería
                                                    -F.C.E.T.</option>
                                                <option value="Escuela de Ingeniería - UAGRM">Escuela de Ingeniería - UAGRM
                                                </option>
                                                <option value="F.C.E.T. - UAGRM">F.C.E.T. - UAGRM</option>
                                                <option value="JAF">JAF</option>
                                                <option value="F.C.E.T.">F.C.E.T.</option>
                                                <option value="UAGRM">UAGRM</option>
                                                <option value="Consejo directivo de postgrado">Consejo directivo de
                                                    postgrado</option>
                                            </select>
                                        </div>
                                        @if ($errors->has('institucion'))
                                            <span class="error text-danger"
                                                for="input-institucion">{{ $errors->first('institucion') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="nombre" class=""> Sexo: </label>
                                        <div class="">
                                            <input type="radio" name="sexo" value="M" checked>
                                            <span>Masculino</span>
                                            <input type="radio" name="sexo" value="F" style='margin-left: 20px'>
                                            <span>Femenino</span>
                                        </div>
                                        <div class="">
                                            @if ($errors->has('sexo'))
                                                <span class="error text-danger"
                                                    for="input-sexo">{{ $errors->first('sexo') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="nombre" class="col-sm-7"> Activo: </label>
                                        <div class="col-sm-7">
                                            <input type="radio" name="activo" value="true" checked>
                                            <span>Si</span>
                                            <input type="radio" name="activo" value="false" style='margin-left: 20px'>
                                            <span>No</span>
                                        </div>
                                        <div class="col-sm-7">
                                            @if ($errors->has('activo'))
                                                <span class="error text-danger"
                                                    for="input-activo">{{ $errors->first('activo') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit"class="btn btn-primary">
                                    <b>Guardar Datos</b>
                                </button>
                                <a href="{{ route('directivo.index') }}" class="btn btn-primary"><b>Cancelar</b></a>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
