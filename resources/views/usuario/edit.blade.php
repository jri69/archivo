@extends('layouts.app',['activePage' => 'usuario', 'titlePage' => 'Agregar Usuario'])

@section('content') 
    <div class="content" >
        <div class="container-fluid" >            
            <div class="row" style="margin-left: 10%">
                <div class="col-md-9">
                    <form action="{{route('usuario.update',$usuario->id)}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-body">                            
                            <div class="row">
                                <label for="nombre" class="col-sm-2 col-form-label"> <b> Nombre:</b> </label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control"
                                    name="nombre"
                                    value="{{old('nombre',$usuario->nombre)}}"
                                    autofocus
                                        >
                                        @if ($errors->has('nombre'))
                                    <span class="error text-danger" for="input-nombre">
                                        {{ $errors->first('nombre') }}
                                    </span>
                                @endif
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <label for="nombre" class="col-sm-2 col-form-label"> <b>Apellido:</b></label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control"
                                    name="apellido"
                                    value="{{old('apellido',$usuario->apellido)}}"
                                    autofocus
                                        >
                                        @if ($errors->has('apellido'))
                                    <span class="error text-danger" for="input-nombre">
                                        {{ $errors->first('apellido') }}
                                    </span>
                                @endif
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <label for="nombre" class="col-sm-2 col-form-label"><b>Area:</b></label>
                                <div class="col-sm-7">
                                    <select name="area_id" id="_area" class="form-control">
                                        <option disabled selected>Seleccione el Area</option>
                                        @foreach ($areas as $area)
                                            <option value="{{$area->id}}">{{$area->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <label for="nombre" class="col-sm-2 col-form-label"><b>Cargo:</b></label>
                                <div class="col-sm-7">
                                    <select name="cargo_id" id="_cargo" class="form-control">
                                        <option disabled selected>Seleccione el Cargo</option>
                                        @foreach ($cargos as $cargo)
                                            <option value="{{$cargo->id}}">{{$cargo->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <label for="nombre" class="col-sm-2 col-form-label"><b>Ci:</b></label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control"
                                    name="ci"
                                    value="{{old('ci',$usuario->ci)}}"
                                    autofocus
                                        >
                                        @if ($errors->has('ci'))
                                    <span class="error text-danger" for="input-nombre">
                                        {{ $errors->first('ci') }}
                                    </span>
                                @endif
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <label for="nombre" class="col-sm-2 col-form-label"><b>Correo:</b></label>
                                <div class="col-sm-7">
                                    <input type="email" class="form-control"
                                    name="email"
                                    >
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <label for="nombre" class="col-sm-2 col-form-label"><b>Contraseña:</b></label>
                                <div class="col-sm-7">
                                    <input type="password" class="form-control"
                                    name="password"
                                    >
                                </div>
                            </div>
                            <br>
                        </div>
                        <div class="card-footer ml-auto mr-auto">
                            <button type="submit"class="btn btn-primary">
                                <b>Guardar Datos</b>                                 
                            </button>
                            <a href="{{route('usuario.index')}}" class="btn btn-primary"><b>Cancelar</b></a>
                        </div>
                    </div>                    
                    </form>
                </div>
            </div>
        </div>
    </div>    
@endsection