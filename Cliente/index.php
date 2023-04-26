<?php
session_start();

// Verifica si hay un mensaje de error almacenado en la sesión
if ($_SESSION['Rol'] == 'cliente') {

    require '../Conexion/conexion.php';

    $idPiso = $_SESSION['IdPiso'];
    //Preparo algunos datos
    $sql1 = "SELECT * from piso WHERE IdPiso ='$idPiso'";
    $result1 = mysqli_query($conn, $sql1);

    if (mysqli_num_rows($result1) > 0) {
        while ($row = mysqli_fetch_assoc($result1)) {
            $nombrePiso = $row["NombrePiso"];
            $lat
                = $row["Latitud"];
            $long =
                $row["Longitud"];
            $nombreCalle
                = $row["NombreCalle"];
        }
    }
?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Home - Brand</title>
        <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700&amp;display=swap">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic&amp;display=swap">
        <link rel="stylesheet" href="../assets/fonts/font-awesome.min.css">
        <link rel="stylesheet" href="../assets/bootstrap/css/styles.css">
        <link rel="stylesheet" href="../assets/bootstrap/css/Login-Form-Basic-icons.css">
        <script src='https://api.mapbox.com/mapbox-gl-js/v2.4.0/mapbox-gl.js'></script>


        <script src='https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.js'></script>
        <link href='https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.css' rel='stylesheet' />

        <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.1/mapbox-gl-directions.js"></script>
        <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.1/mapbox-gl-directions.css" type="text/css">
        <!--a fa-calculator-->

        <style>
            @media (max-width: 480px) {
                .table {
                    font-size: 12px;
                    width: 100%;
                    overflow-x: auto;
                }
            }
        </style>
    </head>

    <body>
        <nav class="navbar navbar-light navbar-expand-lg fixed-top bg-secondary text-uppercase" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="../index.html"><i style="color:white" class="fa fa-home fa-2x" aria-hidden="true"></i>ContrePisos</a><button data-toggle="collapse" data-target="#navbarResponsive" class="navbar-toggler text-white bg-primary navbar-toggler-right text-uppercase rounded" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item mx-0 mx-lg-1">
                            <div class="nav-item dropdown mt-2">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Actividades
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="Calendario/muestraCalendario.php">Calendario Grupal</a>
                                    <!--<a class="dropdown-item" href="">Calendario Personal</a>-->
                                    <a class="dropdown-item" href="Cuentas/paginaCuentas.php">Cuentas</a>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item mx-0 mx-lg-1">
                            <div class="nav-item dropdown mt-2">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Perfil
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="Modificar/modificar.php">Modificar</a>
                                    <a class="dropdown-item" href="../Conexion/desconexion.php">Salir</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>



        <header class="text-center text-white bg-primary masthead mt-4">
            <div class="container">
                <h1 style="font-size: 300%;">Bienvenido a <?php echo $nombrePiso ?></h1>
                <h1 style="font-size: 280%;">Esperamos que todo vaya bien</h1>
                <hr class="star-light">

                <div class="row justify-content-center mt-5">

                    <div class="col">


                        <?php

                        //Cargo las tareas del usuario de la semana en el caso de que las haya

                        // Fecha actual
                        $fechaActual = date('Y-m-d');

                        // Fecha del domingo de esta semana
                        $fechaDomingo = date('Y-m-d', strtotime('sunday this week'));

                        $sql2 = "SELECT DISTINCT t.IdTarea, t.IdTipoTarea, t.FechaInicio, t.FechaFin, t.Descripción 
                                FROM tareas t, tareaUsuario p 
                                WHERE p.IdUsuario=" . $_SESSION['IdUsuario'] . " AND p.IdTarea=t.IdTarea 
                                AND (
                                    t.FechaInicio BETWEEN DATE(NOW()) AND DATE_SUB(DATE(NOW()), INTERVAL WEEKDAY(NOW()) DAY) 
                                    OR t.FechaFin BETWEEN DATE(NOW()) AND DATE_SUB(DATE(NOW()), INTERVAL WEEKDAY(NOW()) - 6 DAY)
                                )
                                ";
                        $result2 = mysqli_query($conn, $sql2);

                        $num_filas = mysqli_num_rows($result2);

                        if ($reg = mysqli_fetch_array($result2)) {

                        ?>
                            <h2>Actualmente en tu agenda tienes <?php echo $num_filas ?> tarea</h2>
                            <button type="button" class="btn btn-primary" id="botonTareas" data-toggle="collapse" data-target="#tareas">Ver Tareas</button>

                            <div id="tablaTareas" style="display: none;">
                                <table class="table table-striped table-info mt-5">
                                    <thead>
                                        <tr>
                                            <th scope="col">Tipo</th>
                                            <th scope="col">Fecha Inicio</th>
                                            <th scope="col">Fecha Fin</th>
                                            <th scope="col">Descripción</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        do {
                                            $sql3 = "SELECT * FROM tipoTarea WHERE IdTipoTarea = " . $reg['IdTipoTarea'];
                                            $result3 = mysqli_query($conn, $sql3);
                                            $reg3 = mysqli_fetch_array($result3);
                                        ?>
                                            <tr>
                                                <td><?php echo $reg3['NombreTarea'] ?></td>
                                                <td><?php echo $reg['FechaInicio'] ?></td>
                                                <td><?php echo $reg['FechaFin'] ?></td>
                                                <td><?php echo $reg['Descripción'] ?></td>
                                                <td><a href="eliminarTarea.php?id=<?php echo $reg['IdTarea'] ?>"><i class="fa fa-check" aria-hidden="true"></i></a></td>
                                            </tr>
                                        <?php
                                        } while ($reg = mysqli_fetch_array($result2));
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php } else {
                        ?>
                            <h2>Wao, parece que esta semana no tienes nada</h2>
                        <?php
                        }
                        ?>

                    </div>
                </div>
                <hr class="star-light">
                <div class="row justify-content-center mt-5">
                    <div class="col">
                        <h2>Actualmente a los integrantes del piso les debes:<?php //Aqui va un input de lo que debes a los demas 
                                                                                ?></h2>
                    </div>
                </div>
                <hr class="star-light">

                <!--
                <div class="row justify-content-center mt-2">
                    <div class="col-8">
                        <div class="row justify-content-center">
                            <div class="col-8">
                                <div class="p-3 mb-3">
                                    <h2>
                                        <a href="Cuentas/paginaCuentas.php" class="text-decoration-none" style="color: white;">
                                            <i class="fa fa-folder-o pr-2" aria-hidden="true"></i>
                                            Cuentas
                                        </a>
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    -->

                <div class="row justify-content-center mt-2">
                    <div class="col-8">
                        <div class="mb-3 p-3">
                            <div id='map' style='width: 100%; height: 400px;'></div>
                            <p><?php echo $nombreCalle ?></p>
                        </div>
                    </div>
                </div>

            </div>
        </header>

        <script>
            mapboxgl.accessToken = 'pk.eyJ1IjoiY29udHJlY2FyNyIsImEiOiJjbGFtOHg5aGEwZHp0M3lvYmNndDI3aWthIn0.3GGG77kdGhe9iJS6JP-DQw';

            var map = new mapboxgl.Map({
                container: 'map',
                style: 'mapbox://styles/mapbox/streets-v11',
                center: [<?php echo $long ?>, <?php echo $lat ?>],
                zoom: 13
            });

            var marker = new mapboxgl.Marker()
                .setLngLat([<?php echo $long ?>, <?php echo $lat ?>])
                .addTo(map);

            map.on('click', function(e) {
                var long = e.lngLat.lng;
                var lat = e.lngLat.lat;
                console.log('Longitud: ' + long + ' | Latitud: ' + lat);
                // Aquí puedes hacer lo que quieras con las variables long y lat
            });

            map.addControl(
                new mapboxgl.GeolocateControl({
                    positionOptions: {
                        enableHighAccuracy: true,
                    },
                    // When active the map will receive updates to the device's location as it changes.
                    trackUserLocation: true,
                    // Draw an arrow next to the location dot to indicate which direction the device is heading.
                    showUserHeading: true,
                })
            );

            map.addControl(
                new MapboxDirections({
                    accessToken: mapboxgl.accessToken
                }),
                'top-left'
            );
        </script>



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
        <script>
            var pulsa = false;
            document.getElementById('botonTareas').addEventListener('click', function() {
                if (pulsa == false) {
                    document.getElementById('tablaTareas').style.display = 'block';
                    document.getElementById('botonTareas').innerHTML = 'Ocultar Tareas'
                    pulsa = true;
                } else {
                    document.getElementById('tablaTareas').style.display = 'none';
                    document.getElementById('botonTareas').innerHTML = 'Ver Tareas'
                    pulsa = false;
                }
            });
        </script>
        <script src="../assets/js/jquery.min.js"></script>
        <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="../assets/js/jquery.easing.min.js"></script>
        <script src="../assets/js/freelancer.js"></script>
    </body>

    </html>
<?php } else {
    header('Location: ../index.html');
}
