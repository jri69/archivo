@extends('layouts.app', ['activePage' => 'pagos', 'titlePage' => 'Agregar Pago de Servicio'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row" style="margin-left: 10%">
                <div class="col-md-11">
                    <form action="{{route('pago_servicio.store')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <label for="nombre" class="col-sm-2 col-form-label"> <b> Servicio:</b> </label>
                                <div class="col-sm-7">
                                    <select name="servicio_id" id="_area" class="form-control">
                                        <option disabled selected>Seleccione el Servicio</option>
                                        @foreach ($servicios as $servicio)
                                            <option value="{{$servicio->id}}">{{$servicio->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>                                
                            </div>
                            <br>                            
                            <div class="row">
                                <label for="nombre" class="col-sm-2 col-form-label"> <b> Monto:</b> </label>
                                <div class="col-sm-7">
                                    <input type="number" class="form-control"
                                    name="monto"
                                    >
                                </div>                                
                            </div>
                            <br>
                            <div class="row">
                                <label for="nombre" class="col-sm-2 col-form-label"> <b> Fecha:</b> </label>
                                <div class="col-sm-7">
                                    <input type="date" class="form-control"
                                    name="fecha"
                                    >
                                </div>                                
                            </div>
                            <br>
                            <div class="row">
                                <label for="nombre" class="col-sm-2 col-form-label"><b>Comprobante:</b></label>
                                <div class="col-sm-7">
                                    <input type="file" class="form-control" name="comprobante" placeholder="Seleccione un documento..."
                                    accept=".docx, .pdf, .doc, .png, .jpg">
                                </div>
                            </div>
                            
                        </div>
                        <div class="card-footer ml-auto mr-auto">
                            <button type="submit"class="btn btn-primary">
                                <b>Guardar Datos</b>                                 
                            </button>
                            <a href="{{route('pago_servicio.index')}}" class="btn btn-primary"><b>Cancelar</b></a>
                        </div>
                    </div>
                </form>
                </div>
                
            </div>
        </div>
    </div>
@endsection