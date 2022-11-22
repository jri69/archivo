@extends('layouts.app', ['activePage' => 'calendar', 'titlePage' => __('Calendario')])

@section('content')
    <div class="content">
        <div class="card" style="margin: 5px 0px">
            <div class="container" style="padding: 15">
                {{-- h2 de filtrar por --}}
                <div class="row" style="margin-bottom: 20px">
                    <div class="col-md-12">
                        <div class="card-header card-header-primary text-center">
                            <h4>OPCIONES DE FILTRADO</h4>
                        </div>
                    </div>
                </div>
                <div class="row" style="padding: 30">
                    <div class="col-sm" style="margin-left: 15px;margin-top:10px">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm">
                                    <label class="form-check" style="width: 100px">
                                        <input class="" type="radio" name="tipo" id="modulo" value="Modulo">
                                        <span class="">Ver Modulos</span>
                                    </label>
                                </div>
                                <div class="col-sm">
                                    <label class="form-check" style="width: 120px">
                                        <input class="" type="radio" name="tipo" id="programa" value="Programa"
                                            checked>
                                        <span class="">Ver Programas</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm">
                    </div>
                    <div class="col-sm" style="margin-bottom: 10px">
                        <div class="container" id="filtrar_programa">
                            <div class="row">
                                <div class="col-sm d-flex">
                                    <span class="" style="margin-top:10px; margin-right: 10px">Filtrar por: </span>
                                    <select class="form-control" id="tipo_programa" style="width: 200px">
                                        <option disabled>Filtrar por: </option>
                                        <option value="" selected>Todos</option>
                                        <option value="Doctorado">Doctorados</option>
                                        <option value="Maestria">Maestrías</option>
                                        <option value="Cursos">Cursos</option>
                                        <option value="Diplomado">Diplomados</option>
                                        <option value="Especialidad">Especialidades</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="card" style="padding: 15px 15px; margin: 5px 0px">
            {{-- calendario --}}
            <div id='calendar'>
            </div>
            {{-- modal para mostrar el evento --}}
            <div class="modal fade" id="fullCalModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header ">
                            <h4 class="modal-title " id="modalTitle"></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body text-center" id="modalBody">
                            <i class="fa fa-spinner fa-spin"></i>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            <a href="" type="button" id="eventUrl" class="btn btn-primary">Ver
                                Detalles</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // declarar variable global
        var tipo_programa = document.getElementById('tipo_programa').value;
        console.log("C" + tipo_programa);
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            themeSystem: 'bootstrap',
            initialView: 'dayGridMonth',
            locale: 'es',
            aspectRatio: 1.5,
            displayEventTime: false,
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,listWeek'
            },
            eventSources: [{
                    url: "{{ env('APP_URL') }} " + '/calendario/inicio',
                    color: '#0000FF',
                    textColor: 'white',
                    extraParams: {
                        tipo: tipo_programa,
                        ver: 'Programa'
                    },
                    failure: function() {
                        alert('there was an error while fetching events!');
                    },
                },
                {
                    url: "{{ env('APP_URL') }} " + '/calendario/finalizado',
                    color: '#8B0000',
                    textColor: 'white',
                    extraParams: {
                        tipo: tipo_programa,
                        ver: 'Programa'
                    },
                    failure: function() {
                        alert('there was an error while fetching events!');
                    }
                }
            ],
            // al hacer click en un evento mostrar un modal con la información del evento
            eventClick: function(info) {
                // obtener la url de la pagina y solo quedarme sin los ultimos 5 caracteres
                var url = window.location.href;
                url = url.substring(0, url.length - 10) + 'programa/show/' + info.event
                    .extendedProps
                    .programa_id;
                // dar formato a la fecha DD-MM-YYYY
                var fecha = new Date(info.event.start);
                var dd = String(fecha.getDate()).padStart(2, '0');
                var mm = String(fecha.getMonth() + 1).padStart(2, '0'); //January is 0!
                var yyyy = fecha.getFullYear();
                fecha = dd + '-' + mm + '-' + yyyy;
                // html para mostrar la fecha del evento la sigla y el tipo de evento
                var html = '<div class="row"><div class="col-12 text-left"><h5>' + 'Sigla: ' + info
                    .event
                    .extendedProps.sigla +
                    '</h5></div></div><div class="row"><div class="col-12 text-left"><h6>' +
                    'Tipo: ' + info
                    .event.extendedProps.tipo +
                    '</h6></div></div><div class="row"><div class="col-12 text-left"><h6>' +
                    'Fecha ' + info
                    .event.extendedProps.tipo_fecha + ' : ' + fecha +
                    '</h6></div></div>';
                $('#modalTitle').html(info.event.title);
                $('#modalBody').html(html);
                $('#eventUrl').attr('href', url);
                $('#fullCalModal').modal();
            },

        });
        calendar.render();
        // recargar el calendario cuando cambie el valor del select de la vista tipo_programa
        document.getElementById('tipo_programa').addEventListener('change', function() {
            tipo_programa = document.getElementById('tipo_programa').value;
            console.log(tipo_programa);
            var calendar = new FullCalendar.Calendar(calendarEl, {
                themeSystem: 'bootstrap',
                initialView: 'dayGridMonth',
                locale: 'es',
                aspectRatio: 1.5,
                displayEventTime: false,
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,listWeek'
                },
                eventSources: [{
                        url: "{{ env('APP_URL') }} " + '/calendario/inicio',
                        color: '#0000FF',
                        textColor: 'white',
                        extraParams: {
                            tipo: tipo_programa,
                            ver: 'Programa'
                        },
                        failure: function() {
                            alert('there was an error while fetching events!');
                        },
                    },
                    {
                        url: "{{ env('APP_URL') }} " + '/calendario/finalizado',
                        color: '#8B0000',
                        textColor: 'white',
                        extraParams: {
                            tipo: tipo_programa,
                            ver: 'Programa'
                        },
                        failure: function() {
                            alert('there was an error while fetching events!');
                        }
                    }
                ],
                // al hacer click en un evento mostrar un modal con la información del evento
                eventClick: function(info) {
                    // obtener la url de la pagina y solo quedarme sin los ultimos 5 caracteres
                    var url = window.location.href;
                    url = url.substring(0, url.length - 10) + 'programa/show/' + info.event
                        .extendedProps
                        .programa_id;
                    // dar formato a la fecha DD-MM-YYYY
                    var fecha = new Date(info.event.start);
                    var dd = String(fecha.getDate()).padStart(2, '0');
                    var mm = String(fecha.getMonth() + 1).padStart(2, '0'); //January is 0!
                    var yyyy = fecha.getFullYear();
                    fecha = dd + '-' + mm + '-' + yyyy;
                    // html para mostrar la fecha del evento la sigla y el tipo de evento
                    var html = '<div class="row"><div class="col-12 text-left"><h5>' + 'Sigla: ' + info
                        .event
                        .extendedProps.sigla +
                        '</h5></div></div><div class="row"><div class="col-12 text-left"><h6>' +
                        'Tipo: ' + info
                        .event.extendedProps.tipo +
                        '</h6></div></div><div class="row"><div class="col-12 text-left"><h6>' +
                        'Fecha ' + info
                        .event.extendedProps.tipo_fecha + ' : ' + fecha +
                        '</h6></div></div>';
                    $('#modalTitle').html(info.event.title);
                    $('#modalBody').html(html);
                    $('#eventUrl').attr('href', url);
                    $('#fullCalModal').modal();
                },

            });
            calendar.render();
        });

        // si tipo == modulo aumentar el atributo hidden al id filtrar
        document.getElementById('modulo').addEventListener('change', function() {
            value = document.getElementById('modulo').value;
            console.log(value);
            if (value == 'Modulo') {
                document.getElementById('filtrar_programa').hidden = true;
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    themeSystem: 'bootstrap',
                    initialView: 'dayGridMonth',
                    locale: 'es',
                    aspectRatio: 1.5,
                    displayEventTime: false,
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,listWeek'
                    },
                    eventSources: [{
                            url: "{{ env('APP_URL') }} " + '/calendario/inicio',
                            color: '#0000FF',
                            textColor: 'white',
                            extraParams: {
                                tipo: tipo_programa,
                                ver: 'Modulo',
                            },
                            failure: function() {
                                alert('there was an error while fetching events!');
                            },
                        },
                        {
                            url: "{{ env('APP_URL') }} " + '/calendario/finalizado',
                            color: '#8B0000',
                            textColor: 'white',
                            extraParams: {
                                tipo: tipo_programa,
                                ver: 'Modulo',
                            },
                            failure: function() {
                                alert('there was an error while fetching events!');
                            }
                        }
                    ],
                    // al hacer click en un evento mostrar un modal con la información del evento
                    eventClick: function(info) {
                        // obtener la url de la pagina y solo quedarme sin los ultimos 5 caracteres
                        var url = window.location.href;
                        url = url.substring(0, url.length - 10) + 'modulo/index/';
                        // dar formato a la fecha DD-MM-YYYY
                        var fecha = new Date(info.event.start);
                        var dd = String(fecha.getDate()).padStart(2, '0');
                        var mm = String(fecha.getMonth() + 1).padStart(2, '0'); //January is 0!
                        var yyyy = fecha.getFullYear();
                        fecha = dd + '-' + mm + '-' + yyyy;
                        // html para mostrar la fecha del evento la sigla y el tipo de evento
                        var html = '<div class="row"><div class="col-12 text-left"><h5>' + 'Sigla: ' +
                            info
                            .event
                            .extendedProps.sigla +
                            '</h5></div></div><div class="row"><div class="col-12 text-left"><h6>' +
                            'Tipo: ' + info
                            .event.extendedProps.tipo +
                            '</h6></div></div><div class="row"><div class="col-12 text-left"><h6>' +
                            'Fecha ' + info
                            .event.extendedProps.tipo_fecha + ' : ' + fecha +
                            '</h6></div></div>';
                        $('#modalTitle').html(info.event.title);
                        $('#modalBody').html(html);
                        $('#eventUrl').attr('href', url);
                        $('#fullCalModal').modal();
                    },
                });
                calendar.render();
            } else {
                document.getElementById('filtrar_programa').hidden = false;
            }
        });

        document.getElementById('programa').addEventListener('change', function() {
            value = document.getElementById('programa').value;
            console.log(value);
            if (value == 'Modulo') {
                document.getElementById('filtrar_programa').hidden = true;
            } else {
                document.getElementById('filtrar_programa').hidden = false;
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    themeSystem: 'bootstrap',
                    initialView: 'dayGridMonth',
                    locale: 'es',
                    aspectRatio: 1.5,
                    displayEventTime: false,
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,listWeek'
                    },
                    eventSources: [{
                            url: "{{ env('APP_URL') }} " + '/calendario/inicio',
                            color: '#0000FF',
                            textColor: 'white',
                            extraParams: {
                                tipo: tipo_programa,
                                ver: 'Programa'
                            },
                            failure: function() {
                                alert('there was an error while fetching events!');
                            },
                        },
                        {
                            url: "{{ env('APP_URL') }} " + '/calendario/finalizado',
                            color: '#8B0000',
                            textColor: 'white',
                            extraParams: {
                                tipo: tipo_programa,
                                ver: 'Programa'
                            },
                            failure: function() {
                                alert('there was an error while fetching events!');
                            }
                        }
                    ],
                    // al hacer click en un evento mostrar un modal con la información del evento
                    eventClick: function(info) {
                        // obtener la url de la pagina y solo quedarme sin los ultimos 5 caracteres
                        var url = window.location.href;
                        url = url.substring(0, url.length - 10) + 'programa/show/' + info.event
                            .extendedProps
                            .programa_id;
                        // dar formato a la fecha DD-MM-YYYY
                        var fecha = new Date(info.event.start);
                        var dd = String(fecha.getDate()).padStart(2, '0');
                        var mm = String(fecha.getMonth() + 1).padStart(2, '0'); //January is 0!
                        var yyyy = fecha.getFullYear();
                        fecha = dd + '-' + mm + '-' + yyyy;
                        // html para mostrar la fecha del evento la sigla y el tipo de evento
                        var html = '<div class="row"><div class="col-12 text-left"><h5>' + 'Sigla: ' +
                            info
                            .event
                            .extendedProps.sigla +
                            '</h5></div></div><div class="row"><div class="col-12 text-left"><h6>' +
                            'Tipo: ' + info
                            .event.extendedProps.tipo +
                            '</h6></div></div><div class="row"><div class="col-12 text-left"><h6>' +
                            'Fecha ' + info
                            .event.extendedProps.tipo_fecha + ' : ' + fecha +
                            '</h6></div></div>';
                        $('#modalTitle').html(info.event.title);
                        $('#modalBody').html(html);
                        $('#eventUrl').attr('href', url);
                        $('#fullCalModal').modal();
                    },

                });
                calendar.render();
            }
        });
    </script>
@endsection
