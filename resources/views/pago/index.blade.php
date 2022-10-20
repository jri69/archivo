@extends('layouts.app',['activePage' => 'Pago', 'titlePage' => 'Pagos'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="form-row">
                <div class="col text-left">
                    <a href="{{ route('pago_estudiante.index') }}" class="btn btn-sm btn-primary">
                        <i class="material-icons">keyboard_backspace</i>
                        atras</a>
                    <a href="{{route('pago.create',$pago_id->id)}}" class="btn btn-sm btn-primary">
                        <b>Agregar Pago</b>
                    </a>
                    <a href="{{route('pago.pdf',$estudiante->id)}}" class="btn btn-sm btn-primary">
                        <b>PDF</b>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <center>
                            <h4><b>Pago por Participante</b></h4>
                            </center>
                        </div>
                        <div class="card-body">
                           
                                <div class="table-responsive-xl">
                                <table class="table">
                                    <thead class="text-primary text-dark">          
                                        <tr><th>Nombre</th>
                                        <th>{{$estudiante->nombre}}</th>
                                        </tr>                              
                                        <tr><th>Estado</th>
                                        <th>{{ $estado }}</th>
                                        </tr>
                                    </thead>            
                                </table>
                            </div>
                            
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <center>
                            <h4><b>Datos del Programa</b></h4>
                            </center>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive"> 
                                <table class="table">
                                    <thead class="text-primary text-dark">
                                        <tr>
                                        <th>Programa</th>
                                        <th><h4><b>{{$programa->nombre}}</b></h4></th>
                                        </tr>      
                                        <tr><th>Version</th>
                                        <th>{{$programa->version}}</th>
                                        </tr>   
                                        <tr><th>Edicion</th>
                                        <th>{{$programa->edicion}}</th>
                                        </tr>  
                                        <tr><th>Fecha de inicio</th>
                                        <th>{{\Carbon\Carbon::parse($programa->fecha_inicio)->format('d-m-Y')}}</th>
                                        </tr>
                                        <tr><th>Fecha de finalizacion</th>
                                        <th>{{\Carbon\Carbon::parse($programa->fecha_finalizacion)->format('d-m-Y')}}</th>
                                        </tr>
                                        <tr><th>Cantidad de Modulos</th> 
                                        <th>{{ $programa->cantidad_modulos }}</th>
                                        </tr>                
                                        <tr><th>Costo Total del Programa</th>
                                        <th>{{$programa->costo}}</th>
                                        </tr>  
                                        <tr><th>Convalidacion</th> 
                                        <th>{{$programa->convalidacion}}</th>
                                        </tr>
                                        <tr><th>Descuento</th> 
                                        <th>{{$porcentaje}}</th>
                                        </tr>
                                        <tr><th>Costo Total con Descuento</th> 
                                        <th>{{$costo_t}}</th>
                                        </tr>   
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <center>
                            <h4><b>Datos Economicos</b></h4>
                            </center>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="text-primary text-dark">
                                        <th><b>Monto Pagado</b> </th>
                                        <th><b>Monto adeudado hasta la fecha</b></th> 
                                        <th><b>Monto pagado hasta la fecha</b></th>
                                        <th><b>saldo total del programa</b></th>                                         
                                    </thead>
                                    <tr>
                                        <td>{{$monto}}</td>
                                        <td>{{$deuda}}</td>
                                        <td>{{$cuenta}}</td>
                                        <td>{{$saldo}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <center>
                            <h4><b>Detalles de Pagos</b></h4>
                            </center>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="text-primary text-dark">
                                        <th><b>#</b></th>
                                        <th><b>Metodo de Pago</b></th> 
                                        <th><b>Comprobante</b></th> 
                                        <th><b>Fecha de pago</b></th>
                                        <th><b>Monto Pagado</b></th>  
                                        <th><b>Acciones</b></th>
                                                                               
                                    </thead>
                                    <tbody>
                                        @foreach ($pagos as $pago)
                                            <tr>
                                                <td>{{ $pago->id }}</td>
                                                <td>{{ $pago->nombre }}</td>
                                                <td><a href="{{ $pago->compro_file }}" target="_blank"><b>{{ $pago->comprobante }}</b></a></td>
                                                <td>{{\Carbon\Carbon::parse($pago->fecha)->format('d-m-Y') }}</td>
                                                <td>{{ $pago->monto }}</td>
                                                
                                                <td class="td-actions">
                                                    <a href="{{ route('pago.edit',$pago->id) }}"
                                                        class="btn btn-success">
                                                        <span class="material-icons">edit</span>
                                                    </a>
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
        </div>
    </div>
@endsection