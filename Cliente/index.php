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

    </head>

    <body>
        <nav class="navbar navbar-light navbar-expand-lg fixed-top bg-secondary text-uppercase" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="../index.html"><i style="color:white" class="fa fa-home fa-2x" aria-hidden="true"></i>ContrePisos</a><button data-toggle="collapse" data-target="#navbarResponsive" class="navbar-toggler text-white bg-primary navbar-toggler-right text-uppercase rounded" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item mx-0 mx-lg-1"></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="Calendario/muestraCalendario.php">Calendario</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="Registro/">Deudas</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="Modificar/modificar.php">Modificar</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="../Conexion/desconexion.php">Salir</a></li>
                    </ul>
                </div>
            </div>
        </nav>



        <header class="text-center text-white bg-primary masthead mt-4">
            <div class="container">
                <h1 style="font-size: 300%;">Bienvenido a <?php echo $nombrePiso ?></h1>
                <hr class="star-light">
                <h1 style="font-size: 280%;">Que deseas hacer?</h1>


                <div class="row justify-content-center mt-5">
                    <div class="col-8">
                        <div class="p-3 mb-3">
                            <h2>
                                <a href="Calendario/muestraCalendario.php" class="text-decoration-none" style="color: white;">
                                    <i class="fa fa-folder-o pr-2" aria-hidden="true"></i>
                                    Ir a calendario grupal
                                </a>
                            </h2>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center mt-2">
                    <div class="col-8">
                        <div class="row justify-content-center">
                            <div class="col-8">
                                <div class="p-3 mb-3">
                                    <h2>
                                        <a href="Calculos/" class="text-decoration-none" style="color: white;">
                                            <i class="fa fa-folder-o pr-2" aria-hidden="true"></i>
                                            Cuentas
                                        </a>
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row justify-content-center mt-2">
                    <div class="col-8">
                        <div class="p-3 mb-3">
                            <h2>
                                <a href="Calendario/CalendarioPersonal/muestraCalendario.php" class="text-decoration-none" style="color: white;">
                                    <i class="fa fa-folder-o pr-2" aria-hidden="true"></i>
                                    Mis Tareas
                                </a>
                            </h2>
                        </div>
                    </div>
                </div>



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

        <script src="../assets/js/jquery.min.js"></script>
        <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="../assets/js/jquery.easing.min.js"></script>
        <script src="../assets/js/freelancer.js"></script>
    </body>

    </html>
<?php } else {
    header('Location: ../index.html');
}
