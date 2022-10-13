@extends('layouts.app',['activePage' => 'Descuento', 'titlePage' => 'Editar Descuento'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row" style="margin-left: 10%">
                <div class="col-md-11">
                    <form action="{{route('descuento.update',$descuento->id)}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <label for="nombre" class="col-sm-2 col-form-label"> <b> Nombre del Descuento:</b> </label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control"
                                        name="nombre"
                                        value="{{old('nombre',$descuento->nombre)}}"
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
                                    <label for="nombre" class="col-sm-2 col-form-label"> <b> Descuento %:</b> </label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control"
                                        name="monto"
                                        value="{{old('monto',$descuento->monto)}}"
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
                                    <label for="nombre" class="col-sm-2 col-form-label"><b>Archivo:</b></label>
                                    <div class="col-sm-7">
                                        <input type="file" name="archivo" class="form-control"
                                               id="exampleInputEmail" placeholder="Seleccione un archivo..."
                                               accept=".docx, .pdf, .doc, .png, .jpg" 
                                               value="{{ old('archivo') }}" autofocus
                                               >
                                               @if ($errors->has('archivo'))
                                           <span class="error text-danger" for="input-nombre">
                                               {{ $errors->first('archivo') }}
                                           </span>
                                           @endif
                                    </div>                                    
                                </div>                       
                            </div>
                            <div class="card-footer ml-auto mr-auto">
                            <button type="submit"class="btn btn-primary">
                                <b>Guardar Datos</b>                                 
                            </button>
                            <a href="{{route('descuento.index')}}" class="btn btn-primary"><b>Cancelar</b></a>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection