<?php
session_start();

if ($_SESSION['Rol'] == 'administrador') {

    // Verifica si hay un mensaje de error almacenado en la sesión
    if (isset($_SESSION['errores'])) {
        $error = $_SESSION['errores'];
        unset($_SESSION['errores']);
    }

    if (isset($_SESSION['correcto'])) {
        $correcto = $_SESSION['correcto'];
        unset($_SESSION['correcto']);
    }
?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Admin-NuevoPiso</title>
        <link rel="icon" type="image/x-icon" href="../../favicon.ico">
        <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700&amp;display=swap">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic&amp;display=swap">
        <link rel="stylesheet" href="../../assets/fonts/font-awesome.min.css">
        <link rel="stylesheet" href="../../assets/bootstrap/css/styles.css">
        <link rel="stylesheet" href="../../assets/bootstrap/css/Login-Form-Basic-icons.css">


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src='https://api.mapbox.com/mapbox-gl-js/v2.4.0/mapbox-gl.js'></script>
        <link href='https://api.mapbox.com/mapbox-gl-js/v2.4.0/mapbox-gl.css' rel='stylesheet' />


        <style>
            #map {
                height: 400px;
                width: 100%;
            }
        </style>
    </head>

    <body>
        <nav class="navbar navbar-light navbar-expand-lg fixed-top bg-secondary text-uppercase" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger mw-25" href="../index.php"><img class="navbar-bar" src="../../assets/img/logoMedioBlanco.png" style="width: 40%;"></a><button data-toggle="collapse" data-target="#navbarResponsive" class="navbar-toggler text-white bg-primary navbar-toggler-right text-uppercase rounded" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item mx-0 mx-lg-1">
                            <div class="nav-item dropdown mt-2">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Perfil
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="../../Conexion/desconexion.php">Salir</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>



        <header class="text-center text-white bg-primary masthead mt-4">
            <div class="container">
                <form method="POST" action="insertaPiso.php" enctype="multipart/form-data">
                    <div class="form-group text-center">
                        <h4>Primero deberás de ubicar el piso con ese formulario:<br>
                            (Asegurate de que la ubicación sea correcta)
                        </h4>
                        <label for="direccion">Dirección:</label>
                        <input style="width: 60%;" type="text" id="direccion" name="direccion" required placeholder="Calle Sol, Guadalcacín, Jerez de la Frontera, Andalucía, España">
                        <button id="buscaUbicacion" class="btn btn-light">Buscar</button>

                        <div id="map" style="margin-top: 1%;"></div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col">
                            <label for="dniPropietario">DNI del propietario*</label>
                            <input type="text" class="form-control" required name="dniPropietario" id="dniPropietario" pattern="\d{8}[A-Za-z]" title="Ingrese un DNI válido" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col">
                            <label for="nombrePiso">Nombre del piso* (Para poder referenciarlo)</label>
                            <input type="text" class="form-control" required name="nombrePiso" id="nombrePiso" require>
                        </div>
                    </div>

                    <div id="campos-adicionales">
                        <!-- Aquí se añadirán los campos adicionales -->
                    </div>

                    <div class="form-group">
                        <button type="button" class="btn btn-primary" id="btn-anadir-campos">Añadir usuarios</button>
                    </div>

                    <button type="submit" class="btn btn-success">Enviar</button>

                    <?php
                    if (isset($error)) {
                    ?>
                        <div class="col-sm-12 mt-3">
                            <div id="passwordError" style="color:red; font-style: italic;">
                                <?php
                                echo $error;
                                ?>
                            </div>
                        </div>
                    <?php } ?>

                    <?php
                    if (isset($correcto)) {
                    ?>
                        <div class="col-sm-12 mt-3">
                            <div id="passwordError" style="color:green; font-style: italic;">
                                <?php
                                echo $correcto;
                                ?>
                            </div>
                        </div>
                    <?php } ?>
                </form>
            </div>
        </header>



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
            mapboxgl.accessToken = 'pk.eyJ1IjoiY29udHJlY2FyNyIsImEiOiJjbGFtOHg5aGEwZHp0M3lvYmNndDI3aWthIn0.3GGG77kdGhe9iJS6JP-DQw';

            var map = new mapboxgl.Map({
                container: 'map',
                style: 'mapbox://styles/mapbox/streets-v11',
                center: [-74.5, 40],
                zoom: 13
            });

            var marcador = null;

            $('#buscaUbicacion').click(function(event) {
                event.preventDefault();
                var direccion = $('#direccion').val();

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

                            // Remueve el marcador anterior, si existe
                            if (marcador !== null) {
                                marcador.remove();
                            }

                            // Agrega un marcador en la ubicación resultante
                            marcador = new mapboxgl.Marker()
                                .setLngLat(ubicacion)
                                .addTo(map);

                            // Mueve el mapa a la ubicación resultante
                            map.setCenter(ubicacion);
                        } else {
                            alert("Error al geocodificar " + direccion);
                            console.log('No se encontró ninguna ubicación para ' + direccion);
                        }
                    },
                    error: function(response) {
                        console.log('Error al geocodificar ' + direccion);
                        alert("Error al geocodificar " + direccion);
                    }
                });
            });



            let emailsBBDD = [];

            // Cargo los emails de la base de datos para comprobarlo
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var emails = JSON.parse(this.responseText);

                    emails.forEach(element => {
                        emailsBBDD.push(element);
                    });

                    // console.log(emailsBBDD);

                }
            };
            xhttp.open("GET", "buscaEmail.php", true);
            xhttp.send();


            var contadorCampos = 0;
            var maxCampos = 5; // Máximo de campos adicionales permitidos

            // Función para añadir los campos adicionales
            document.getElementById('btn-anadir-campos').addEventListener("click", anadirCampos);

            function anadirCampos(event) {

                if (contadorCampos < maxCampos) {
                    contadorCampos++;
                    if (contadorCampos >= 2) {
                        var nuevoCampo = `<div class="form-row">
                            <div class="col-md-3"></div>
                    <div class="form-group col-md-6">
                        <label for="email${contadorCampos}">Email ${contadorCampos}</label>
                        <input type="email" class="form-control" name="emails[]" id="email${contadorCampos}" onkeyup="comprobarEmail(this)" value="${document.getElementById(`email${contadorCampos-1}`).value}"
>
                    <span></span>
                    </div>
                    `;
                    } else {
                        var nuevoCampo = `<div class="form-row">
                            <div class="col-md-3"></div>
                    <div class="form-group col-md-6">
                        <label for="email${contadorCampos}">Email ${contadorCampos}</label>
                        <input type="email" class="form-control" name="emails[]" id="email${contadorCampos}" onkeyup="comprobarEmail(this)" >
                    <span></span>
                    </div>
                    `;
                    }

                    document.getElementById('campos-adicionales').innerHTML += nuevoCampo;
                    event.preventDefault();
                } else {
                    alert('Solo se permite ingresar 5 usuarios');
                    event.preventDefault();
                }
            }



            //Función para comprobar que los emails no se repiten en la bbdd
            function comprobarEmail(campo) {
                const correoElectronico = campo.value;

                //console.log(campo)

                const encontrado = emailsBBDD.includes(correoElectronico);

                const span = campo.parentElement.querySelector("span");

                // Actualizar el contenido del elemento span con el resultado de la verificación
                if (encontrado) {
                    span.textContent = "Este correo electrónico ya existe";
                    span.style.color = "red";
                } else {
                    span.textContent = "Correo electrónico válido";
                    span.style.color = "green";
                }
            }

            // Agregar evento oninput a los campos de correo electrónico
            const camposCorreoElectronico = document.querySelectorAll('input[type="email"]');
            camposCorreoElectronico.forEach((campo) => {
                campo.addEventListener("input", () => {
                    comprobarEmail(campo);
                });

                // Agregar elemento span para mostrar el resultado de la verificación
                const span = document.createElement("span");
                campo.parentElement.appendChild(span);
            });
        </script>

        <script src="../../assets/js/jquery.min.js"></script>
        <script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="../../assets/js/jquery.easing.min.js"></script>
        <script src="../../assets/js/freelancer.js"></script>
    </body>

    </html>
<?php } else {
    header('Location: ../../index.html');
}
