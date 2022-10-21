@extends('layouts.app', ['activePage' => 'calendar', 'titlePage' => __('Calendario')])

@section('content')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let tipo_programa = document.getElementById('tipo_programa').value;
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
                    right: 'dayGridMonth,timeGridWeek,listWeek'
                },
                eventSources: [{
                        url: "{{ env('APP_URL') }} " + '/calendario/inicio',
                        color: '#0000FF',
                        textColor: 'white',
                        extraParams: {
                            tipo: tipo_programa,
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
                        },
                        failure: function() {
                            alert('there was an error while fetching events!');
                        }
                    }
                    /* ,
                                        {
                                            url: "{{ env('APP_URL') }} " + '/calendario/doctorados',
                                            color: '#f44336',
                                            textColor: 'white',
                                            failure: function() {
                                                alert('there was an error while fetching events!');
                                            },
                                        },
                                        {
                                            url: "{{ env('APP_URL') }} " + '/calendario/maestrias',
                                            color: '#9c27b0',
                                            textColor: 'white',
                                            failure: function() {
                                                alert('there was an error while fetching events!');
                                            }
                                        },
                                        {
                                            url: "{{ env('APP_URL') }} " + '/calendario/cursos',
                                            color: '#3f51b5',
                                            textColor: 'white',
                                            failure: function() {
                                                alert('there was an error while fetching events!');
                                            }
                                        },
                                        {
                                            url: "{{ env('APP_URL') }} " + '/calendario/diplomados',
                                            color: '#2196f3',
                                            textColor: 'white',
                                            failure: function() {
                                                alert('there was an error while fetching events!');
                                            }
                                        },
                                        {
                                            url: "{{ env('APP_URL') }} " + '/calendario/especialidades',
                                            color: '#009688',
                                            textColor: 'white',
                                            failure: function() {
                                                alert('there was an error while fetching events!');
                                            }
                                        },
                                        {
                                            url: "{{ env('APP_URL') }} " + '/calendario/otros',
                                            color: '#ff9800',
                                            textColor: 'white',
                                            failure: function() {
                                                alert('there was an error while fetching events!');
                                            }
                                        } */
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
            // recargar el calendario cuando cambie el valor del select de la vista tipo_programa
            document.getElementById('tipo_programa').addEventListener('change', function() {
                tipo_programa = document.getElementById('tipo_programa').value;
                console.log(tipo_programa);
                // cargar nuevamente los eventos del calendario
                calendar.refetchEvents();
            });
            calendar.render();
        });
    </script>

    <div class="content">
        <div class="card" style="padding: 15px">
            {{-- select para elegir que tipo de programa mostrar --}}
            <div class="row">
                <div class="col-3 text-right">
                    <div class="form-group bmd-form-group">
                        <select class="form-control" id="tipo_programa">
                            <option value="">Selecciona que tipo de programas</option>
                            <option value="Doctorado">Doctorados</option>
                            <option value="Maestria">Maestrías</option>
                            <option value="Cursos">Cursos</option>
                            <option value="Diplomado">Diplomados</option>
                            <option value="Especialidad">Especialidades</option>
                            <option value="Sin tipo">Otros</option>
                        </select>
                    </div>
                </div>
            </div>

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
                            <a href="" type="button" id="eventUrl" class="btn btn-primary">Ver Detalles</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
