<div class="content">
    <div class="container-fluid">
        <div class="row" style="margin-left: 10%">
            <div class="col-md-10">
                <form action="{{route('detalle_factura.store',$id)}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <br>
                        <div class="row">
                            <label for="nombre" class="col-sm-3 col-form-label"><b>Primera Partida:</b></label>
                            <div class="col-sm-7">
                                <select wire:model="first" name="primero" id="_primero" class="form-control">
                                    <option disabled selected>Seleccione la Primera Partida</option>
                                    @foreach ($primero as $item)
                                    <option value="{{$item->id}}">{{$item->codigo}}-{{$item->nombre}}</option>
                                @endforeach
                                </select>
                            </div>
                            {{-- <div>prueba: @json($first)</div>
                            <div>prueba: @json($prueba)</div> --}}
                        </div>
                        <br>
                        <div class="row">
                            <label for="nombre" class="col-sm-3 col-form-label"><b>Segunda Partida:</b></label>
                            <div class="col-sm-7">
                                <select wire:model="second" wire:click="segundo()" name="segundo" id="_segundo" class="form-control">
                                    <option disabled selected>Seleccione la Segunda Partida</option>
                                    @foreach ($segundo as $item)
                                    <option value="{{$item->id}}">{{$item->codigo}}-{{$item->nombre}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <label for="nombre" class="col-sm-3 col-form-label"><b>Tercera Partida:</b></label>
                            <div class="col-sm-7">
                                <select wire:click="tercero()" wire:model="third" name="tercero" id="_tercero" class="form-control">
                                    <option disabled selected>Seleccione la Tercera Partida</option>
                                    @foreach ($tercero as $item)
                                    <option value="{{$item->id}}">{{$item->codigo}}-{{$item->nombre}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <label for="nombre" class="col-sm-3 col-form-label"><b>Cuarta Partida:</b></label>
                            <div class="col-sm-7">
                                <select wire:click="cuarto()" wire:model="four"  name="cuarto" id="_cuarto" class="form-control">
                                    <option value="null">Seleccione la Cuarta Partida</option>
                                    @foreach ($cuarto as $item)
                                    <option value="{{$item->id}}">{{$item->codigo}}-{{$item->nombre}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <label for="nombre" class="col-sm-3 col-form-label"><b>Quinta Partida:</b></label>
                            <div class="col-sm-7">
                                <select wire:click="quinto()" name="quinto" id="_quinto" class="form-control">
                                    <option value="null">Seleccione la Quinta Partida</option>
                                    @foreach ($quinto as $item)
                                    <option value="{{$item->id}}">{{$item->codigo}}-{{$item->nombre}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <label for="nombre" class="col-sm-3 col-form-label"><b>Cantidad:</b></label>
                            <div class="col-sm-7">
                                <input type="number" class="form-control"
                                name="cantidad"
                                value="{{old('cantidad')}}"
                                        autofocus
                                        >
                                        @if ($errors->has('cantidad'))
                                    <span class="error text-danger" for="input-cantidad">
                                        {{ $errors->first('cantidad') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <label for="input-detalle" class="col-sm-3 col-form-label"><b>Detalle/Producto:</b></label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control"
                                name="detalle"
                                value="{{old('detalle')}}"
                                        autofocus
                                        >
                                        @if ($errors->has('detalle'))
                                    <span class="error text-danger" for="input-detalle">
                                        {{ $errors->first('detalle') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <label for="nombre" class="col-sm-3 col-form-label"><b>Precio Unitario:</b></label>
                            <div class="col-sm-7">
                                <input type="number" class="form-control"
                                name="precio_unitario"
                                value="{{old('precio_unitario')}}"
                                        autofocus
                                        >
                                        @if ($errors->has('precio_unitario'))
                                    <span class="error text-danger" for="input-precio_unitario">
                                        {{ $errors->first('precio_unitario') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <label for="subtotal" class="col-sm-3 col-form-label"><b>Total:</b></label>
                            <div class="col-sm-7">
                                <input type="number" class="form-control"
                                name="subtotal"
                                value="{{old('subtotal')}}"
                                        autofocus
                                        >
                                        @if ($errors->has('subtotal'))
                                    <span class="error text-danger" for="input-subtotal">
                                        {{ $errors->first('subtotal') }}
                                    </span>
                                @endif
                            </div>

                            </div>
                        </div>
                        <div class="card-footer ml-auto mr-auto">
                            <button type="submit"class="btn btn-primary">
                                <b>Guardar Datos</b>
                            </button>
                            <a href="{{route('detalle_factura.index',$id)}}" class="btn btn-primary"><b>Cancelar</b></a>
                        </div>
                    </div>

                </div>
            </form>
            </div>

        </div>
        {{-- <div class="row" style="margin-left: 10%">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4>Listado de Compras</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Cantidad</th>
                                        <th>Detalle</th>
                                        <th>Precio Unitario</th>
                                        <th>Sub Total</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
</div>

