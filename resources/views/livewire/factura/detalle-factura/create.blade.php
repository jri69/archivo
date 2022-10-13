<div class="content">
    <div class="container-fluid">
        <div class="row" style="margin-left: 10%">
            <div class="col-md-11">
                <form action="#" method="post" class="form-horizontal" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <br>
                        <div class="row">
                            <label for="nombre" class="col-sm-2 col-form-label"><b>Primera Partida:</b></label>
                            <div class="col-sm-7">
                                <select name="id_itinerario" id="_itinerario" class="form-control">
                                    <option disabled selected>Seleccione la Primera Partida</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <label for="nombre" class="col-sm-2 col-form-label"><b>Segunda Partida:</b></label>
                            <div class="col-sm-7">
                                <select name="id_bus" id="_bus" class="form-control">
                                    <option disabled selected>Seleccione la Segunda Partida</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <label for="nombre" class="col-sm-2 col-form-label"><b>Tercera Partida:</b></label>
                            <div class="col-sm-7">
                                <select name="asiento" id="_asiento" class="form-control">
                                    <option disabled selected>Seleccione la Tercera Partida</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <label for="nombre" class="col-sm-2 col-form-label"><b>Cuarta Partida:</b></label>
                            <div class="col-sm-7">
                                <select name="asiento" id="_asiento" class="form-control">
                                    <option disabled selected>Seleccione la Cuarta Partida</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <label for="nombre" class="col-sm-2 col-form-label"><b>Quinta Partida:</b></label>
                            <div class="col-sm-7">
                                <select name="asiento" id="_asiento" class="form-control">
                                    <option disabled selected>Seleccione la Quinta Partida</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <label for="nombre" class="col-sm-2 col-form-label"><b>Cantidad:</b></label>
                            <div class="col-sm-7">
                                <input type="number" class="form-control"
                                name="cantidad"
                                >
                            </div>                                
                        </div>
                        <br>
                        <div class="row">
                            <label for="nombre" class="col-sm-2 col-form-label"><b>Detalle/Producto:</b></label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control"
                                name="detalle"
                                >
                            </div>                                
                        </div>
                        <br>
                        <div class="row">
                            <label for="nombre" class="col-sm-2 col-form-label"><b>Precio Unitario:</b></label>
                            <div class="col-sm-7">
                                <input type="number" class="form-control"
                                name="precio_unitario"
                                >
                            </div>                                
                        </div>
                        <br>
                        <div class="row">
                            <label for="nombre" class="col-sm-2 col-form-label"><b>Subtotal:</b></label>
                            <div class="col-sm-7">
                                <input type="number" class="form-control"
                                name="subtotal"
                                >
                            </div>                             
                            
                            </div>                                
                        </div>
                        <div class="card-footer ml-auto mr-auto">
                            <button type="submit"class="btn btn-primary">
                                <b>Guardar Datos</b>                                 
                            </button>
                            <a href="#" class="btn btn-primary"><b>Cancelar</b></a>
                        </div>
                    </div>                   
                   
                </div>
            </form>
            </div>
            
        </div>
        <div class="row" style="margin-left: 10%">
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
        </div>
    </div>
</div>
{{-- <script>
    const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
    //llenado del select itinerario
    document.getElementById('_fecha').addEventListener('change',(e)=>{
        fetch('itinerario',{
            method : 'POST',
            body: JSON.stringify({texto: e.target.value}),
            headers:{
                'Content-Type': 'application/json',
                "X-CSRF-Token": csrfToken
            }
        }).then(response => {
            return response.json()
        }).then(data =>{
            var opciones = "";
            opciones+= '<option value="">Seleccione Itinerario</option>';
            for (let i in data.lista) {
            opciones+= '<option value="'+data.lista[i].id+'">'+data.lista[i].nombre_itineario+' '+data.lista[i].hora_salida+'</option>';
            }
            document.getElementById("_itinerario").innerHTML = opciones;
        }).catch(error =>console.error(error));
    })
    //llenado del select bus
    document.getElementById('_itinerario').addEventListener('change',(e)=>{
        fetch('bus',{
            method : 'POST',
            body: JSON.stringify({texto: e.target.value}),
            headers:{
                'Content-Type': 'application/json',
                "X-CSRF-Token": csrfToken
            }
        }).then(response => {
            return response.json()
        }).then(dat =>{
            var opciones = "";
            opciones+= '<option value="">Seleccione la Placa</option>';
            for (let i in dat.lista) {
            opciones+= '<option value="'+dat.lista[i].id+'">'+dat.lista[i].placa+'</option>';
            }
            document.getElementById("_bus").innerHTML = opciones;
        }).catch(error =>console.error(error));
    })
    //llenado del select asiento
    document.getElementById('_bus').addEventListener('change',(e)=>{
        fetch('asiento',{
            method : 'POST',
            body: JSON.stringify({texto: e.target.value}),
            headers:{
                'Content-Type': 'application/json',
                "X-CSRF-Token": csrfToken
            }
        }).then(response => {
            return response.json()
        }).then(data =>{
            var opciones = "";
            opciones+= '<option value="">Seleccione el Asiento</option>';
            for (let i in data.lista) {
            opciones+= '<option value="'+data.lista[i].id+'">'+data.lista[i].NumeroAsiento+'</option>';
            }
            document.getElementById("_asiento").innerHTML = opciones;
        }).catch(error =>console.error(error));
    })
</script> --}}