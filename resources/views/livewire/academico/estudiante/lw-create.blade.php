<div class="content">
    <div class="container-fluid">
        <div class="row" style="margin-left: 10%">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select name="honorifico" id="_honorifico" class="form-control"
                                        wire:model.defer='datos.honorifico'>
                                        <option disabled value="">Seleccione el honorifico</option>
                                        <option value="Lic">Lic</option>
                                        <option value="Ing">Ing</option>
                                        <option value="MsC">MsC</option>
                                        <option value="PhD">PhD</option>
                                    </select>
                                </div>
                                @error('datos.honorifico')
                                    <span class="error text-danger" for="input-honorifico">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Nombre del estudiante</label>
                                    <input type="text" class="form-control" name="nombre"
                                        wire:model.defer='datos.nombre'>
                                </div>
                                @error('datos.nombre')
                                    <span class="error text-danger" for="input-nombre">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Correo Electrónico</label>
                                    <input type="email" class="form-control" name="email"
                                        wire:model.defer='datos.email'>
                                </div>
                                @error('datos.email')
                                    <span class="error text-danger" for="input-nombre">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Telefono</label>
                                    <input type="text" class="form-control" name="telefono"
                                        wire:model.defer='datos.telefono'>
                                </div>
                                @error('datos.telefono')
                                    <span class="error text-danger" for="input-nombre">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Cédula de identidad</label>
                                    <input type="text" class="form-control" name="cedula"
                                        wire:model.defer='datos.cedula'>
                                </div>
                                @error('datos.cedula')
                                    <span class="error text-danger" for="input-nombre">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="form-control" name="expedicion" wire:model.defer='datos.expedicion'>
                                        <option disabled value="">Seleccione la expedición</option>
                                        <option value="TJ">TJ</option>
                                        <option value="SC">SC</option>
                                        <option value="CH">CH</option>
                                        <option value="LP">LP</option>
                                        <option value="CB">CB</option>
                                        <option value="OR">OR</option>
                                        <option value="PT">PT</option>
                                        <option value="BE">BE</option>
                                        <option value="PD">PD</option>
                                    </select>
                                </div>
                                @error('datos.expedicion')
                                    <span class="error text-danger" for="input-nombre">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="nombre" class="">
                                    Sexo:
                                </label>
                                <div class="">
                                    <input wire:model.defer="datos.sexo" type="radio" name="sexo" value="M"
                                        checked>
                                    <span>Masculino</span>
                                    <input wire:model.defer="datos.sexo" type="radio" name="sexo" value="F"
                                        style='margin-left: 20px'>
                                    <span>Femenino</span>
                                </div>
                                <div class="">
                                    @error('datos.sexo')
                                        <span class="error text-danger" for="input-nombre">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="nombre" class="col-sm-7">
                                    Nacionalidad:
                                </label>
                                <div class="col-sm-7">
                                    <input wire:model.defer="datos.nacionalidad" type="radio" name="nacionalidad"
                                        value="Boliviano" checked>
                                    <span>Boliviano</span>
                                    <input wire:model.defer="datos.nacionalidad" type="radio" name="nacionalidad"
                                        value="Extranjero" style='margin-left: 20px'>
                                    <span>Extranjero</span>
                                </div>
                                <div class="col-sm-7">
                                    @error('datos.nacionalidad')
                                        <span class="error text-danger" for="input-nombre">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Registro</label>
                                    <input type="text" class="form-control" name="numero_registro"
                                        wire:model.defer='datos.numero_registro'>
                                </div>
                                @error('datos.numero_registro')
                                    <span class="error text-danger" for="input-nombre">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <select class="form-control" name="universidad" wire:model='datos.universidad'>
                                        <option disabled value="">Seleccione la universidad</option>
                                        @foreach ($universidades as $universidad)
                                            <option value="{{ $universidad->nombre }}">
                                                {{ $universidad->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('datos.universidad')
                                    <span class="error text-danger" for="input-nombre">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="form-control" name="carrera" wire:model='datos.carrera'>
                                        <option disabled value="">Seleccione la carrera</option>
                                        @foreach ($carreras as $carrera)
                                            <option value="{{ $carrera->nombre }}">
                                                {{ $carrera->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('datos.carrera')
                                    <span class="error text-danger" for="input-nombre">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="form-control" name="id_programa" wire:model='datos.id_programa'>
                                        <option disabled value="">Seleccione el programa</option>
                                        @foreach ($programas as $programa)
                                            <option value="{{ $programa->id }}">
                                                {{ $programa->nombre . ' - ' . $programa->version . '.' . $programa->edicion }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('datos.id_programa')
                                    <span class="error text-danger" for="input-nombre">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="form-control" name="id_modulo" wire:model='datos.id_modulo'>
                                        <option disabled value="">Seleccione el modulo</option>
                                        @foreach ($listModulos as $modulo)
                                            <option value="{{ $modulo->id }}">
                                                {{ $modulo->nombre . ' - ' . $modulo->version . '.' . $modulo->edicion }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('datos.id_modulo')
                                    <span class="error text-danger" for="input-nombre">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="bmd-label-floating">Subir una Foto</label>
                                <input type="file" class="form-control" name="foto" style="display: visible"
                                    wire:model.defer='foto'>
                            </div>
                            @error('foto')
                                <span class="error text-danger" for="input-foto">{{ $message }}</span>
                            @enderror
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header card-header-primary">
                                        <h4 class="card-title ">Requisitos</h4>
                                        <p class="card-category"> Documentos requeridos para la inscripción</p>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead class=" text-primary">
                                                    <th>
                                                        Nombre
                                                    </th>
                                                    <th>
                                                        Importancia
                                                    </th>
                                                    <th>
                                                        Documento
                                                    </th>
                                                </thead>
                                                <tbody>
                                                    @foreach ($requisitos as $requisito)
                                                        <tr>
                                                            <td>
                                                                {{ $requisito->nombre }}
                                                            </td>
                                                            <td>
                                                                {{ $requisito->importancia }}
                                                            </td>
                                                            <td>
                                                                <input type="file" name="documento"
                                                                    wire:model.defer='documentos.{{ $requisito->id }}'>
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


                        <div hidden>
                            <input type="text" name="estado" value="Activo" wire:model.defer='datos.estado'>
                        </div>
                    </div>

                    <div class="card-footer ml-auto mr-auto">
                        <button wire:click='store()' class="btn btn-primary">
                            <b>Guardar Datos</b>
                        </button>
                        <a href="{{ route('estudiante.index') }}" class="btn btn-primary"><b>Cancelar</b></a>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
