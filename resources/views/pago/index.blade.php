@extends('layouts.app',['activePage' => 'Pago', 'titlePage' => 'Pagos'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="form-row">
                <div class="col text-right">
                    <a href="{{route('pago.create')}}" class="btn btn-outline-primary btn-white">
                        <b>Agregar Pago</b>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <center>
                            <h4>Pago por Participante</h4>
                            </center>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table-border">
                                    <thead class="text-primary text-dark">          
                                        <tr><th>Nombre</th>
                                        <td></td>
                                        </tr>                              
                                        <tr><th>Estado</th>
                                        <td></td>
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
                            <h4>Datos del Programa</h4>
                            </center>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table-border">
                                    <thead class="text-primary text-dark">
                                        <tr><th>Programa</th>
                                        <td></td>
                                        </tr>                              
                                        <tr><th>Version</th>
                                        <td></td>
                                        </tr>                                                                           
                                        <tr><th>Edicion</th>
                                        <td></td>
                                        </tr>  
                                        <tr><th>Fecha de inicio</th>
                                        <td></td>
                                        </tr>
                                        <tr><th>Fecha de finalizacion</th>
                                        <td></td>
                                        </tr>
                                        <tr><th>Cantidad de Modulos</th> 
                                        <td></td>
                                        </tr>
                                        <tr><th>Costo Total del Programa</th>
                                        <td></td>
                                        </tr>  
                                        <tr><th>Descuento</th> 
                                        <td></td>
                                        </tr>
                                        <tr><th>Costo Total con Descuento</th> 
                                        <td></td>
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
                            <h4>Datos Economicos</h4>
                            </center>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="text-primary text-dark">
                                        <th>Monto Pagado </th>
                                        <th>Monto adeudado hasta la fecha</th> 
                                        <th>Saldo para estar al dia</th>
                                        <th>saldo total del programa</th>                                         
                                    </thead>
                                    <tr>
                                        <td>1</td>
                                        <td>2</td>
                                        <td>3</td>
                                        <td>4</td>
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
                            <h4>Detalles de Pagos</h4>
                            </center>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="text-primary text-dark">
                                        <th>#</th>
                                        <th>Metodo de Pago</th> 
                                        <th>Comprobante</th> 
                                        <th>Fecha de pago</th>
                                        <th>Monto Pagado</th>  
                                        <th>Acumulado</th>                                        
                                    </thead>
                                    
                                </table>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection