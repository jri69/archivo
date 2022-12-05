<div class="content">
    <div class="container-fluid">
        <div class="row" style="margin-left: 10%">
            <div class="col-md-11">

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
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
                                <div class="form-group">
                                    <label class="bmd-label-floating">Carrera</label>
                                    <input type="text" class="form-control" name="carrera"
                                        wire:model.defer='datos.carrera'>
                                </div>
                                @error('datos.carrera')
                                    <span class="error text-danger" for="input-nombre">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Universidad</label>
                                    <input type="text" class="form-control" name="universidad"
                                        wire:model.defer='datos.universidad'>
                                </div>
                                @error('datos.universidad')
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

                        {{-- Tabla con los requisitos y un campo para subir documentos --}}
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
