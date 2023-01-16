@extends('layouts.app', ['activePage' => 'directivos', 'titlePage' => 'directivos'])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row" style="margin-left: 10%">
                <div class="col-md-11">
                    <form action="{{ route('directivo.update', $directivo->id) }}" method="post" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Honorifico</label>
                                            <select name="honorifico" id="_honorifico" class="form-control">
                                                <option disabled>Seleccione el honorifico</option>
                                                <option {{ $directivo->honorifico == 'Lic.' ? 'selected' : '' }}
                                                    value="Lic.">Lic</option>
                                                <option {{ $directivo->honorifico == 'Ing.' ? 'selected' : '' }}
                                                    value="Ing.">Ing</option>
                                                <option {{ $directivo->honorifico == 'M.Sc.' ? 'selected' : '' }}
                                                    value="M.Sc.">M.Sc</option>
                                                <option {{ $directivo->honorifico == 'Ph.D.' ? 'selected' : '' }}
                                                    value="Ph.D.">Ph.D</option>
                                                <option {{ $directivo->honorifico == 'Abog.' ? 'selected' : '' }}
                                                    value="Abog.">Abog</option>
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
                                            <input type="text" class="form-control" name="nombre"
                                                value="{{ $directivo->nombre }}">
                                        </div>
                                        @if ($errors->has('nombre'))
                                            <span class="error text-danger"
                                                for="input-nombre">{{ $errors->first('nombre') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Apellido</label>
                                            <input type="text" class="form-control" name="apellido"
                                                value="{{ $directivo->apellido }}">
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
                                                <option disabled value="">Seleccione el cargo</option>
                                                <option {{ $directivo->cargo == 'Director' ? 'selected' : '' }}
                                                    value="Director">
                                                    Director</option>
                                                <option
                                                    {{ $directivo->cargo == 'Coordinador Académico' ? 'selected' : '' }}
                                                    value="Coordinador Académico">
                                                    Coordinador Académico</option>
                                                <option {{ $directivo->cargo == 'Asesor Legal' ? 'selected' : '' }}
                                                    value="Asesor Legal">
                                                    Asesor Legal</option>
                                                <option
                                                    {{ $directivo->cargo == 'Responsable del proceso de contratación' ? 'selected' : '' }}
                                                    value="Responsable del proceso de contratación">
                                                    Responsable del proceso de contratación</option>
                                                <option {{ $directivo->cargo == 'Decano' ? 'selected' : '' }}
                                                    value="Decano">
                                                    Decano</option>
                                                <option
                                                    {{ $directivo->cargo == 'Jefe ADM. y Financiero' ? 'selected' : '' }}
                                                    value="Jefe ADM. y Financiero">
                                                    Jefe ADM. y Financiero</option>
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
                                                <option disabled value="">Seleccione la institucion</option>
                                                <option
                                                    {{ $directivo->institucion == 'Escuela de Ingeniería - F.C.E.T.' ? 'selected' : '' }}
                                                    value="Escuela de Ingeniería - F.C.E.T.">Escuela de Ingeniería
                                                    -F.C.E.T.</option>
                                                <option
                                                    {{ $directivo->institucion == 'Escuela de Ingeniería - UAGRM' ? 'selected' : '' }}
                                                    value="Escuela de Ingeniería - UAGRM">Escuela de Ingeniería - UAGRM
                                                </option>
                                                <option
                                                    {{ $directivo->institucion == 'F.C.E.T. - UAGRM' ? 'selected' : '' }}
                                                    value="F.C.E.T. - UAGRM">F.C.E.T. - UAGRM</option>
                                                <option {{ $directivo->institucion == 'JAF' ? 'selected' : '' }}
                                                    value="JAF">JAF</option>
                                                <option {{ $directivo->institucion == 'F.C.E.T.' ? 'selected' : '' }}
                                                    value="F.C.E.T."> F.C.E.T.</option>
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
                                            <input type="radio" name="sexo" value="M"
                                                {{ $directivo->sexo == 'M' ? 'checked' : '' }}>
                                            <span>Masculino</span>
                                            <input type="radio" name="sexo" value="F" style='margin-left: 20px'
                                                {{ $directivo->sexo == 'F' ? 'checked' : '' }}>
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
                                            <input type="radio" name="activo" value="true"
                                                {{ $directivo->activo == true ? 'checked' : '' }}>
                                            <span>Si</span>
                                            <input type="radio" name="activo" value="false"
                                                style='margin-left: 20px  {{ $directivo->activo == false ? 'checked' : '' }}'>
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
