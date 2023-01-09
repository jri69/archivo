<div class="content">
    <div class="container-fluid">
        <div class="row" style="margin-left: 10%">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Nombre</label>
                                    <input type="text" class="form-control" name="name" wire:model.defer="name">
                                </div>
                                @error('name')
                                    <span class="error text-danger" for="input-name">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-11">
                                <div class="">
                                    <label class="bmd-label"> <b>Permisos Administrativos</b></label><br>
                                    @foreach ($administrativos as $key => $permission)
                                        <label>
                                            <input wire:model.defer='permisos.{{ $permission->id }}' type="checkbox"
                                                name="" id="" value="{{ $permission->id }}"
                                                class="checkbox">
                                            {{ $permission->description }} &nbsp;
                                        </label>
                                    @endforeach
                                    <br> <br>
                                    <label class="bmd-label"><b>Permisos Academicos</b></label><br>
                                    @foreach ($academicos as $key => $permission)
                                        <label>
                                            <input wire:model.defer='permisos.{{ $permission->id }}' type="checkbox"
                                                name="" id="" value="{{ $permission->id }}"
                                                class="checkbox">
                                            {{ $permission->description }} &nbsp;
                                        </label>
                                    @endforeach
                                    <br> <br>
                                    <label class="bmd-label"><b>Permisos Contables</b></label><br>
                                    @foreach ($contables as $key => $permission)
                                        <label>
                                            <input wire:model.defer='permisos.{{ $permission->id }}' type="checkbox"
                                                name="" id="" value="{{ $permission->id }}"
                                                class="checkbox">
                                            {{ $permission->description }} &nbsp;
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>

                    <div class="card-footer ml-auto mr-auto">
                        <a class="btn btn-primary text-white" wire:click="save()">
                            <b>Guardar Datos</b>
                        </a>
                        <a href="{{ route('roles.index') }}" class="btn btn-primary"><b>Cancelar</b></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
