<?php

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Home - Brand</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/styles.css">
    <link rel="stylesheet" href="assets/bootstrap/css/Login-Form-Basic-icons.css">
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.4.0/mapbox-gl.js'></script>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>

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
            <a class="navbar-brand js-scroll-trigger" href="index.html"><i style="color:white" class="fa fa-home fa-2x" aria-hidden="true"></i>ContrePisos</a><button data-toggle="collapse" data-target="#navbarResponsive" class="navbar-toggler text-white bg-primary navbar-toggler-right text-uppercase rounded" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item mx-0 mx-lg-1">
                        <div class="nav-item dropdown mt-2">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Actividades
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="">Calendario Grupal</a>
                                <!--<a class="dropdown-item" href="">Calendario Personal</a>-->
                                <a class="dropdown-item" href="">Cuentas</a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item mx-0 mx-lg-1">
                        <div class="nav-item dropdown mt-2">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Perfil
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="">Modificar</a>
                                <a class="dropdown-item" href="">Salir</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>



    <header class="text-center text-white bg-primary masthead mt-4">
        <div class="container">
            <h1 style="font-size: 300%;">Bienvenido a
                <?php echo $nombrePiso ?>
            </h1>
            <h1 style="font-size: 280%;">Esperamos que todo vaya bien</h1>
            <hr class="star-light">

            <div class="row justify-content-center mt-5">

                <div class="col">


                    <?php


                    ?>
                    <h2>Actualmente en tu agenda tienes

                    </h2>
                    <button type="button" class="btn btn-primary" id="botonTareas" data-toggle="collapse" data-target="#tareas">Ver Tareas</button>
                </div>
            </div>
            <hr class="star-light">
            <div class="row justify-content-center mt-5">
                <div class="col">
                    <h2>Actualmente a los integrantes del piso les debes:
                        <?php //Aqui va un input de lo que debes a los demas 
                        ?>
                    </h2>
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
                        <p>
                            <?php echo $nombreCalle ?>
                        </p>
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
            center: [-74.5, 40],
            zoom: 13
        });

        var direccion = 'Calle Sol, Guadalcacín, Jerez de la Frontera, Andalucía, España';


        // Utiliza la API de geocodificación de Mapbox para obtener la ubicación de la calle
        $.ajax({
            url: 'https://api.mapbox.com/geocoding/v5/mapbox.places/' + direccion + '.json?access_token=' + mapboxgl.accessToken,
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                // La respuesta contiene un arreglo de resultados de geocodificación
                var features = response.features;
                if (features.length > 0) {
                    // Toma la primera ubicación resultante
                    var ubicacion = features[0].center;
                    // Mueve el mapa a la ubicación resultante
                    map.setCenter(ubicacion);
                    // Agrega un marcador en la ubicación resultante
                    new mapboxgl.Marker()
                        .setLngLat(ubicacion)
                        .addTo(map);
                } else {
                    // No se encontró ninguna ubicación resultante
                    console.log('No se encontró ninguna ubicación para ' + direccion);
                }
            },
            error: function(response) {
                console.log('Error al geocodificar ' + direccion);
            }
        });
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
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.easing.min.js"></script>
    <script src="assets/js/freelancer.js"></script>
</body>

</html>