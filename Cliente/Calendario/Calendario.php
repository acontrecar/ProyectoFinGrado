<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8' />
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css' />
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/locale/es.js"></script>
    <!-- <title>ContrePisos</title> -->

    <style>
        .fc-body {
            background-color: #f5f5f5;
        }

        .fc .fc-axis {
            color: #128f76;
        }
    </style>
</head>

<body>

    <div id='calendar'></div>

    <script>
        var calendar, ultimoEventoId;


        muestraCalendarioSinEventos();


        function initCalendar(events) {
            calendar = $('#calendar').fullCalendar({
                // Configuración del calendario
                locale: 'es',
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                navLinks: true,
                eventLimit: true,
                selectable: true,
                selectHelper: true,
                events: events,
                select: function(start, end, allDays) {

                    $('#event-modal').modal('toggle');

                    $('#botonModal').off().on('click', function() {
                        var title = $('#deplegableTareaModal').val(); //obtiene el texto del option seleccionado
                        var checkboxes = document.getElementsByName("usuarios[]"); //array de checkboxes
                        var usuariosSeleccionados = []; //array donde se guardan los usuarios seleccionados

                        for (var i = 0; i < checkboxes.length; i++) {
                            if (checkboxes[i].checked) {
                                usuariosSeleccionados.push(checkboxes[i].value);
                            }
                        }

                        if (usuariosSeleccionados.length == 0) {
                            usuariosSeleccionados.push(<?php echo $_SESSION['IdUsuario']; ?>);
                        }

                        var descripcion = $('#descripcion').val();
                        var fechaInicio = moment(start).format("Y-MM-DD HH:mm:ss");
                        var fechaFin = moment(end).format("Y-MM-DD HH:mm:ss");


                        $.ajax({
                            url: 'insertaTarea.php',
                            type: "POST",
                            data: {
                                title: title,
                                start: fechaInicio,
                                end: fechaFin,
                                descripcion: descripcion,
                                usuariosSeleccionados: usuariosSeleccionados
                            },
                            success: function(response) {
                                if (response.success) {
                                    $('#event-modal').modal('hide');
                                    $('#calendar').fullCalendar('renderEvent', {
                                        'id': response.id,
                                        'title': response.title,
                                        'start': response.start,
                                        'end': response.end,
                                        'color': response.color
                                    });
                                    Swal.fire("Bien", "Tu tarea se ha dado de alta", "success");
                                } else {
                                    $('#tituloError').html(response.message);
                                }
                            },
                        });

                        //$('#deplegableTareaModal').val('');
                        //$('input[name="usuarios[]"]').prop('checked', false);
                        $('#descripcion').val('');
                    });
                },


                //Cambiar que no se pueda eliminar la tarea y que salgan los usuarios en la descripcion
                eventClick: function(event) {
                    $('#listaUsuarios').html('');

                    $('#tituloEvento').text(event.title);
                    $('#fechaEvento').text(moment(event.start).format('DD/MM/YYYY h:mm a') + ' - ' + moment(event.end).format('DD/MM/YYYY h:mm a'));
                    $('#eventDescription-modal').modal('toggle');
                    var eventId = event.id;

                    console.log('entrando en el evento click');
                    console.log(eventId);

                    $.ajax({
                        url: 'muestraUsuarios.php',
                        type: "POST",
                        data: {
                            id: eventId
                        },
                        success: function(response) {
                            console.log(response.data);
                            for (var i = 0; i < response.data.length; i++) {
                                var li = document.createElement('li');
                                li.textContent = response.data[i].Nombre;
                                document.getElementById('listaUsuarios').appendChild(li);
                            }
                        },
                    });

                },

            });
        }

        function muestraCalendarioConEventos(datosFiltrado) {
            $(document).ready(function() {
                if (!calendar) {
                    initCalendar(datosFiltrado);
                } else {
                    calendar.fullCalendar('removeEvents');
                    calendar.fullCalendar('addEventSource', datosFiltrado);
                }
            });
        }

        function muestraCalendarioSinEventos() {
            $(document).ready(function() {
                if (!calendar) {
                    initCalendar([]);
                } else {
                    calendar.fullCalendar('removeEvents');
                }
            });
        }

        const filtroTareas = document.getElementById('deplegableTarea');
        var datosFiltrado;

        filtroTareas.addEventListener('change', () => {
            const valorSeleccionado = filtroTareas.value;
            const xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    const resultados = JSON.parse(this.responseText);
                    // aquí actualizas la página para mostrar solo los resultados obtenidos

                    var tareasInicial = resultados.data;

                    if (resultados.success == true) {
                        datosFiltrado = tareasInicial.map(function(item) {
                            return {
                                id: item.IdTarea,
                                title: item.Descripción,
                                start: item.FechaInicio,
                                end: item.FechaFin,
                                color: item.Color
                            };
                        })
                        muestraCalendarioConEventos(datosFiltrado);
                    } else {
                        muestraCalendarioSinEventos();
                    }


                }
            };

            xhr.open('GET', `cargaTareas.php?filtro=${valorSeleccionado}`, true);
            xhr.setRequestHeader('Content-Type', 'application/json');

            xhr.send();
        });
    </script>
</body>

</html>