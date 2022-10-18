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
                            <div class="table-responsive">
                                <table class="default">
                                    <thead class="text-primary text-dark">          
                                        <tr><th>Nombre</th>
                                        <td style="width: 25%"><h5><b>{{$estudiante->nombre}}</b></h5></td>
                                        </tr>                              
                                        <tr><th>Estado</th>
                                        <td><b>{{ $estado }}</b></td>
                                        </tr>
                                    <head>            
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
                                <table class="default">
                                    <thead class="text-primary text-dark">
                                        <tr>
                                        <th>Programa</th>
                                        <td width="46%"><h4><b>{{$pro->nombre}}</b></h4></td>
                                        </tr>      
                                        <tr><th>Version</th>
                                        <td><b>{{$pro->version}}</b></td>
                                        </tr>   
                                        <tr><th>Edicion</th>
                                        <td>{{$pro->edicion}}</td>
                                        </tr>  
                                        <tr><th>Fecha de inicio</th>
                                        <td>{{\Carbon\Carbon::parse($pro->fecha_inicio)->format('d-m-Y')}}</td>
                                        </tr>
                                        <tr><th>Fecha de finalizacion</th>
                                        <td>{{\Carbon\Carbon::parse($pro->fecha_finalizacion)->format('d-m-Y')}}</td>
                                        </tr>
                                        <tr><th>Cantidad de Modulos</th> 
                                        <td>{{ $programa->cantidad_modulos }}</td>
                                        </tr>                
                                        <tr><th>Costo Total del Programa</th>
                                        <td>{{$pro->costo}}</td>
                                        </tr>  
                                        <tr><th>Convalidacion</th> 
                                        <td>{{$programa->convalidacion}}</td>
                                        </tr>
                                        <tr><th>Descuento</th> 
                                        <td>{{$porcentaje}}</td>
                                        </tr>
                                        <tr><th>Costo Total con Descuento</th> 
                                        <td>{{$costo_t}}</td>
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
                                                        <span class="material-icons">visibility</span>
                                                    </a>
                                                    <!--<form action="#"
                                                        method="POST" style="display: inline-block;"
                                                        onsubmit="return confirm('¿Está seguro?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger" type="submit">
                                                            <i class="material-icons">close</i>
                                                        </button>
                                                    </form> -->
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