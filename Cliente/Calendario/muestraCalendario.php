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
        <title>ContrePisos-Calendario</title>
        <link rel="icon" type="image/x-icon" href="../../favicon.ico">
        <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700&amp;display=swap">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic&amp;display=swap">
        <link rel="stylesheet" href="../../assets/fonts/font-awesome.min.css">
        <link rel="stylesheet" href="../../assets/bootstrap/css/styles.css">
        <link rel="stylesheet" href="../../assets/bootstrap/css/Login-Form-Basic-icons.css">


        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>

        <script src="../../assets/bootstrap/js/bootstrap.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



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

            @media (max-width: 480px) {
                .table {
                    font-size: 12px;
                    width: 100%;
                    overflow-x: auto;
                }
            }

            .dropdown-menu {
                background-color: #333;
                /* Cambiar el color de fondo del menú desplegable */
            }

            .dropdown-menu a {
                color: #fff !important;
                /* Cambiar el color de letra del menú desplegable */
            }

            .dropdown-menu a:hover {
                background-color: #555;
                /* Cambiar el color de fondo del enlace cuando se hace hover */
            }
        </style>



    </head>

    <body>
        <!-- <nav class="navbar navbar-light navbar-expand-lg fixed-top bg-secondary text-uppercase" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="../index.php"><img class="navbar-bar" src="../../assets/img/logoMedioBlanco.png" style="width: 40%;"></a><button data-toggle="collapse" data-target="#navbarResponsive" class="navbar-toggler text-white bg-primary navbar-toggler-right text-uppercase rounded" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item mx-0 mx-lg-1">
                            <div class="nav-item dropdown mt-2">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Actividades
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#">Calendario Grupal</a>
                                    <a class="dropdown-item" href="../Cuentas/paginaCuentas.php">Cuentas</a>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item mx-0 mx-lg-1">
                            <div class="nav-item dropdown mt-2">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Perfil
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="../Modificar/modificar.php">Modificar</a>
                                    <a class="dropdown-item" href="../../Conexion/desconexion.php">Salir</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav> -->

        <nav class="navbar navbar-light navbar-expand-md fixed-top bg-secondary text-uppercase" id="mainNav">
            <div class="container">
                <div class="d-flex align-items-center justify-content-between">
                    <a class="navbar-brand js-scroll-trigger logo-link order-1" href="../index.php">
                        <img class="navbar-bar" src="../../assets/img/logoMedioBlanco.png" style="width: 40%;">
                    </a>
                    <button data-toggle="collapse" data-target="#navbarResponsive" class="navbar-toggler text-white bg-primary navbar-toggler-right text-uppercase rounded ml-auto order-3" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>
                <div class="collapse navbar-collapse order-2" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto flex-nowrap">
                        <li class="nav-item mx-0 mx-lg-1 dropdown">
                            <a class="nav-link dropdown-toggle text-light text-center" href="#" id="dropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Actividades
                            </a>
                            <div class="dropdown-menu dropdown-menu-right bg-dark" aria-labelledby="dropdown">
                                <a class="dropdown-item text-light text-center" href="">Calendario Grupal</a>
                                <a class="dropdown-item text-light text-center" href="../Cuentas/paginaCuentas.php">Cuentas</a>
                            </div>
                        </li>
                        <li class="nav-item mx-0 mx-lg-1 dropdown">
                            <a class="nav-link dropdown-toggle text-light text-center" href="#" id="dropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Perfil
                            </a>
                            <div class="dropdown-menu dropdown-menu-right bg-dark" aria-labelledby="dropdown2">
                                <a class="dropdown-item text-light text-center" href="../Modificar/modificar.php">Modificar</a>
                                <a class="dropdown-item text-light text-center" href="../../Conexion/desconexion.php">Salir</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>


        <header class="text-center text-white bg-primary masthead mt-4" style="min-height: 90vh; display: flex;
    justify-content: center;
    align-items: center;">
            <div class="container">
                <div class="mb-5 h5">
                    <?php
                    //Menu desplegable con bootstrap
                    require '../../Conexion/conexion.php';
                    $sql = "SELECT * FROM tipoTarea";
                    $result = mysqli_query($conn, $sql);
                    echo "<select class='form-select' name='deplegableTarea' id='deplegableTarea'>";
                    echo "<option selected disabled>¿Que deseas ver?</option>";
                    echo "<option value='0' id='0' name='0'>Mostrar todas las tareas</option>";

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='" . $row['IdTipoTarea'] . "' style='color:" . $row['Color'] . ";' id='" . $row['IdTipoTarea'] . "' name='" . $row['IdTipoTarea'] . "'>" . $row['NombreTarea'] . "</option>";
                    }
                    echo "</select>";
                    ?>
                </div>
                <div>
                    <?php
                    @include('Calendario.php');
                    ?>
                </div>
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
                        <span id="tituloError" class="text-danger"></span>
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
                                    // $sql = "SELECT * FROM usuarios where IdPiso=" . $_SESSION['IdPiso'] . " and IdUsuario!= " . $_SESSION['IdUsuario'];
                                    $sql = "SELECT * FROM usuarios where IdPiso=" . $_SESSION['IdPiso'];

                                    $result = mysqli_query($conn, $sql);

                                    echo "<div class='form-group'>";

                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<div class='form-check'>";
                                        if (!isset($row['Nombre'])) {
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
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="3" maxlength="100"></textarea>
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


        <!-- Ventana modal para ver tareas -->
        <div class="modal fade justify-content-center align-items-center" id="eventDescription-modal" tabindex="-1" role="dialog" aria-labelledby="eventDescription-modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="eventDescription-modal-label">Descripción tarea</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <span id="tituloErrorDescripcion" class="text-danger"></span>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col">
                                    <p><strong>Descripción:</strong> <span id="tituloEvento"></span></p>
                                    <p><strong>Fecha:</strong> <span id="fechaEvento"></span></p>
                                    <!-- <p><strong>Usuario por completar:</strong> <span id="usuariosPorCompletar"></span></p> -->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <h6>Usuarios:</h6>
                                    <ul id="listaUsuarios"></ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="botonCerrarModalEventClick" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>



        <footer class="text-center footer" style="max-height: 20vh; display: flex; position: sticky ;justify-content: center; align-items: center;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="text-uppercase">About me</h4>
                        <div class="social-icons">
                            <a class="btn btn-outline-light btn-social rounded-circle" role="button" href="https://github.com/acontrecar"><i class="fa fa-github fa-fw"></i></a>
                            <a class="btn btn-outline-light btn-social rounded-circle" role="button" href="https://www.linkedin.com/in/antoniocontrerasc%C3%A1rdenas/"><i class="fa fa-linkedin-square fa-fw"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>


        <script>
        </script>


    </body>


    </html>
<?php } else {
    header('Location: ../../index.html');
}
