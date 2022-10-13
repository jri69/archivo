<div class="content">
    <div class="container-fluid">
        <div class="row" style="margin-left: 10%">
            <div class="col-md-11">
                <form action="{{route('factura.store')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-body">
                        
                        <div class="row">
                            <label for="nombre" class="col-sm-2 col-form-label"> <b> Numero de Factura:</b> </label>
                            <div class="col-sm-7">
                                <input type="number" class="form-control"
                                id="_numero"
                                name="numero"
                                value="{{ old('numero') }}" autofocus>
                                @if ($errors->has('numero'))
                                    <span class="error text-danger" for="input-nombre">
                                        {{ $errors->first('numero') }}
                                    </span>
                                @endif
                            </div>                                
                        </div>
                        <br>
                        <div class="row">
                            <label for="nombre" class="col-sm-2 col-form-label"> <b> Fecha:</b> </label>
                            <div class="col-sm-7">
                                <input type="date" class="form-control"
                                id="_fecha"
                                name="fecha"
                                value="{{ old('fecha') }}" autofocus>
                                @if ($errors->has('fecha'))
                                    <span class="error text-danger" for="input-nombre">
                                        {{ $errors->first('fecha') }}
                                    </span>
                                @endif
                            </div>                                
                        </div>
                        <br>
                        <div class="row">
                            <label for="nombre" class="col-sm-2 col-form-label"> <b> Monto:</b> </label>
                            <div class="col-sm-7">
                                <input type="number" class="form-control"
                                id="_monto"
                                name="monto"
                                value="{{ old('monto') }}" autofocus>
                                @if ($errors->has('monto'))
                                    <span class="error text-danger" for="input-nombre">
                                        {{ $errors->first('monto') }}
                                    </span>
                                @endif
                            </div>                                
                        </div>
                        <br>
                        <div class="row">
                            <label for="nombre" class="col-sm-2 col-form-label"><b>Factura:</b></label>
                            <div class="col-sm-7">
                                <input type="file" class="form-control" name="file" placeholder="Seleccione un archivo..."
                                accept=".docx, .pdf, .doc, .png, .jpg">
                            </div>
                        </div>
                    </div>                   
                    <div class="card-footer ml-auto mr-auto">
                        <button type="submit"class="btn btn-primary">
                            <b>Guardar Datos</b>                                 
                        </button>
                        <a href="{{route('factura.index')}}" class="btn btn-primary"><b>Cancelar</b></a>
                    </div>
                </div>
            </form>
            </div>            
        </div>
    </div>
</div>