@extends('layouts.app',['activePage' => 'presupuesto', 'titlePage' => 'Editar Presupuesto'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form action="{{route('presupuesto.update',$presupuesto->id)}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"> <b> Nombre:</b> </label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control"
                                        name="nombre"
                                        value="{{old('nombre',$presupuesto->nombre)}}"
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
                                    <label for="nombre" class="col-sm-2 col-form-label"> <b> Monto:</b> </label>
                                    <div class="col-sm-7">
                                        <input type="number" class="form-control"
                                        name="monto"
                                        value="{{old('monto',$presupuesto->monto)}}"
                                        autofocus
                                        >
                                        @if ($errors->has('monto'))
                                    <span class="error text-danger" for="input-nombre">
                                        {{ $errors->first('monto') }}
                                    </span>
                                @endif
                                    </div>
                                </div>
                                <br>  
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"> <b> Año:</b> </label>
                                    <div class="col-sm-7">
                                        <input type="date" class="form-control"
                                        name="anio"
                                        value="{{old('anio',$presupuesto->anio)}}"
                                        autofocus
                                        >
                                        @if ($errors->has('anio'))
                                    <span class="error text-danger" for="input-nombre">
                                        {{ $errors->first('anio') }}
                                    </span>
                                @endif
                                    </div>
                                </div>
                                <br>                           
                            </div>
                            <div class="card-footer ml-auto mr-auto">
                            <button type="submit"class="btn btn-primary">
                                <b>Guardar Datos</b>                                 
                            </button>
                            <a href="{{route('area.index')}}" class="btn btn-primary"><b>Cancelar</b></a>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection