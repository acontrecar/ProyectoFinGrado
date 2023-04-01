<?php
session_start();

// Verifica si hay un mensaje de error almacenado en la sesión
if ($_SESSION['Rol'] == 'cliente') {
?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Home - Brand</title>
        <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700&amp;display=swap">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic&amp;display=swap">
        <link rel="stylesheet" href="../../assets/fonts/font-awesome.min.css">
        <link rel="stylesheet" href="../../assets/bootstrap/css/styles.css">
        <link rel="stylesheet" href="../../assets/bootstrap/css/Login-Form-Basic-icons.css">

        <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css' rel='stylesheet' />
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js'></script>

        <style>
            .fc-body {
                background-color: #f5f5f5;
            }

            select {
                padding: 8px;
                border: none;
                border-radius: 4px;
                background-color: #f1f1f1;
                font-size: 16px;
                color: #333;
                appearance: none;
                -webkit-appearance: none;
                -moz-appearance: none;
            }

            select option {
                padding: 8px;
                font-size: 16px;
                color: #333;
                background-color: #fff;
                border: none;
                border-radius: 4px;
            }


            .modal-backdrop {
                background-color: rgba(0, 0, 0, 0.5);
            }

            .modal-dialog {
                margin: auto;
            }

            .modal-header,
            .modal-body,
            .modal-footer {
                font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            }

            .modal-content {
                border-radius: 6px;
            }
        </style>



    </head>

    <body>
        <nav class="navbar navbar-light navbar-expand-lg fixed-top bg-secondary text-uppercase" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="../index.html"><i style="color:white" class="fa fa-home fa-2x" aria-hidden="true"></i>ContrePisos</a><button data-toggle="collapse" data-target="#navbarResponsive" class="navbar-toggler text-white bg-primary navbar-toggler-right text-uppercase rounded" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item mx-0 mx-lg-1"></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="login.html">login</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="Registro/">singup</a></li>
                    </ul>
                </div>
            </div>
        </nav>



        <header class="text-center text-white bg-primary masthead mt-4">
            <div class="container">
                <div class="mb-5 h5">
                    <?php
                    //Menu desplegable con bootstrap
                    require '../../Conexion/Conexion.php';
                    $sql = "SELECT * FROM tipoTarea";
                    $result = mysqli_query($conn, $sql);
                    echo "<select class='form-select' name='deplegableTarea' id='deplegableTarea'>";
                    echo "<option value='0' id='0' name='0'>Mostrar todas las tareass</option>";

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='" . $row['IdTipoTarea'] . "' style='color:" . $row['Color'] . ";' id='" . $row['IdTipoTarea'] . "' name='" . $row['IdTipoTarea'] . "'>" . $row['NombreTarea'] . "</option>";
                    }
                    echo "</select>";
                    ?>
                </div>
                <div id='calendar'></div>
            </div>
        </header>


        <!-- Ventan modal para Fullcalendar -->
        <div class="modal fade justify-content-center align-items-center" id="event-modal" tabindex="-1" role="dialog" aria-labelledby="event-modal-label">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="event-modal-label">Rellene los campos</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <p>¿Qué tipo de tarea es?</p>

                                <?php
                                $sql = "SELECT * FROM tipoTarea";
                                $result = mysqli_query($conn, $sql);
                                echo "<select class='form-control' name='deplegableTareaModal' id='deplegableTareaModal'>";
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option style='color:" . $row['Color'] . ";' id='" . $row['IdTipoTarea'] . "' value='" . $row['IdTipoTarea'] . "' name='" . $row['IdTipoTarea'] . "'>" . $row['NombreTarea'] . "</option>";
                                }
                                echo "</select>";
                                ?>
                            </div>

                            <div class="row mt-4">
                                <div class="col">
                                    <p>¿Usuario implicados?</p>
                                </div>

                                <div class="col">

                                    <?php
                                    $sql = "SELECT * FROM usuarios where IdPiso=" . $_SESSION['IdPiso'] . " ";
                                    $result = mysqli_query($conn, $sql);

                                    echo "<div class='form-group'>";

                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<div class='form-check'>";
                                        if ($row['Nombre']) {
                                            echo "<input type='checkbox' class='form-check-input' id='" . $row['IdUsuario'] . "' name='usuarios[]' value='" . $row['IdUsuario'] . "'>";
                                            echo "<label class='form-check-label' for='" . $row['IdUsuario'] . "'>" . $row['Email'] . "</label>";
                                        } else {
                                            echo "<input type='checkbox' class='form-check-input' id='" . $row['IdUsuario'] . "' name='usuarios[]' value='" . $row['IdUsuario'] . "'>";
                                            echo "<label class='form-check-label' for='" . $row['IdUsuario'] . "'>" . $row['Nombre'] . "</label>";
                                        }
                                        echo "</div>";
                                    }
                                    echo "</div>";
                                    ?>

                                </div>
                            </div>

                            <div class="row mt-4">
                                <p>¿De qué se trata la tarea?</p>
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="botonModal" name="botonModal" class="btn btn-primary">Aceptar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>



        <footer class="text-center footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 mb-5 mb-lg-0">
                    </div>
                    <div class="col-md-4 mb-5 mb-lg-0">
                        <h4 class="text-uppercase">About me</h4>
                        <ul class="list-inline">
                            <li class="list-inline-item"><a class="btn btn-outline-light text-center btn-social rounded-circle" role="button" href="https://github.com/acontrecar"><i class="fa fa-github fa-fw"></i></a>
                            </li>
                            <li class="list-inline-item"><a class="btn btn-outline-light text-center btn-social rounded-circle" role="button" href="https://www.linkedin.com/in/antoniocontrerasc%C3%A1rdenas/"><i class="fa fa-linkedin-square fa-fw"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                    </div>
                </div>
            </div>

        </footer>

        <?php
        //Recojo las tareas para mostrarlas en el calendario
        $sql = "SELECT * FROM tareas WHERE IdPiso=" . $_SESSION['IdPiso'] . " ";
        $result = mysqli_query($conn, $sql);
        $tareas = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $tareas[] = $row;
        }
        $jsonTareas = json_encode($tareas);
        echo "<script>var tareas = " . $jsonTareas . ";</script>";

        echo "<script>console.log(tareas)</script>";


        ?>

        <script>
            //Recoger los datos
            const filtroTareas = document.getElementById('deplegableTarea');

            filtroTareas.addEventListener('change', () => {
                const valorSeleccionado = filtroTareas.value;
                console.log(valorSeleccionado)
                const xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (this.readyState === 4 && this.status === 200) {
                        const resultados = JSON.parse(this.responseText);
                        // aquí actualizas la página para mostrar solo los resultados obtenidos
                        console.log(resultados);
                    }
                };

                xhr.open('GET', `cargaTareas.php?filtro=${valorSeleccionado}`, true);
                xhr.setRequestHeader('Content-Type', 'application/json');

                xhr.send();
            });


            $(document).ready(function() {

                $('#calendar').fullCalendar({
                    // Configuración del calendario
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay'
                    },
                    defaultDate: '2023-03-21',
                    navLinks: true,
                    editable: true,
                    eventLimit: true,
                    selectable: true,
                    selectHelper: true,
                    //event: resultados,
                    select: function(start, end, allDays) {


                        $('#event-modal').modal('toggle');

                        $('#botonModal').on('click', function() {
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
                            var start = moment(start).format("Y-MM-DD HH:mm:ss");
                            var end = moment(end).format("Y-MM-DD HH:mm:ss");
                            $.ajax({
                                url: 'insertaTarea.php',
                                type: "POST",
                                data: {
                                    title: title,
                                    start: start,
                                    end: end,
                                    descripcion: descripcion,
                                    usuariosSeleccionados: usuariosSeleccionados
                                },
                                success: function(response) {
                                    console.log(response);
                                    $('#event-modal').modal('hide');
                                }
                            });
                        });
                    },




                    /*eventClick: function(event) {
                        $('#event-modal-label').html(event.title);
                        $('#event-date').html(moment(event.start).format('DD/MM/YYYY'));
                        $('#event-modal').modal();
                    }*/
                });
            });
        </script>

        <script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="calendario.js"></script>

    </body>


    </html>
<?php } else {
    header('Location: ../../index.html');
}
