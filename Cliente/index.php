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
            $direccion = $row["Direccion"];
        }
    }
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-1JLJ6R3L38"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());

            gtag('config', 'G-1JLJ6R3L38');
        </script>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Inicio-Cliente</title>
        <link rel="icon" type="image/x-icon" href="../favicon.ico">
        <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700&amp;display=swap">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic&amp;display=swap">
        <link rel="stylesheet" href="../assets/fonts/font-awesome.min.css">
        <link rel="stylesheet" href="../assets/bootstrap/css/styles.css">
        <link rel="stylesheet" href="../assets/bootstrap/css/Login-Form-Basic-icons.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src='https://api.mapbox.com/mapbox-gl-js/v2.4.0/mapbox-gl.js'></script>
        <link href='https://api.mapbox.com/mapbox-gl-js/v2.4.0/mapbox-gl.css' rel='stylesheet' />

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


        <style>
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

            @media (max-width: 767px) {
                .map-container {
                    width: 100%;
                    /* Define un ancho del 100% para el contenedor en dispositivos móviles */
                }
            }
        </style>
    </head>

    <body>


        <nav class="navbar navbar-light navbar-expand-md fixed-top bg-secondary text-uppercase" id="mainNav">
            <div class="container">
                <div class="d-flex align-items-center justify-content-between">
                    <a class="navbar-brand js-scroll-trigger logo-link order-1" href="../index.html">
                        <img class="navbar-bar" src="../assets/img/logoMedioBlanco.png" style="width: 40%;">
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
                                <a class="dropdown-item text-light text-center" href="Calendario/muestraCalendario.php">Calendario Grupal</a>
                                <a class="dropdown-item text-light text-center" href="Cuentas/paginaCuentas.php">Cuentas</a>
                            </div>
                        </li>
                        <li class="nav-item mx-0 mx-lg-1 dropdown">
                            <a class="nav-link dropdown-toggle text-light text-center" href="#" id="dropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Perfil
                            </a>
                            <div class="dropdown-menu dropdown-menu-right bg-dark" aria-labelledby="dropdown2">
                                <a class="dropdown-item text-light text-center" href="Modificar/modificar.php">Modificar</a>
                                <a class="dropdown-item text-light text-center" href="../Conexion/desconexion.php">Salir</a>
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
                                WHERE p.IdUsuario = " . $_SESSION['IdUsuario'] . " AND p.IdTarea = t.IdTarea 
                                AND (
                                    t.FechaInicio BETWEEN DATE(NOW()) AND DATE_SUB(DATE(NOW()), INTERVAL WEEKDAY(NOW()) DAY) 
                                    OR t.FechaFin BETWEEN DATE(NOW()) AND DATE_SUB(DATE(NOW()), INTERVAL WEEKDAY(NOW()) - 6 DAY)
                                )
                                AND p.Completado = 0";


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
                                                <td><a class="anclaEliminarTarea" href="eliminarTarea.php?id=<?php echo $reg['IdTarea'] ?>"><i class="fa fa-check" aria-hidden="true"></i></a></td>
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
                        <h2>
                            <?php //Aqui va un input de lo que debes a los demas

                            $id = $_SESSION['IdUsuario'];
                            //Sql de dinero debido
                            $sql4 = "SELECT ua.Nombre as NombreAcreedor, SUM(c.Cantidad) as DeudaTotal
                            FROM cuentas c 
                            INNER JOIN usuarios ud ON c.IdUsuarioDeudor = ud.IdUsuario 
                            INNER JOIN usuarios ua ON c.IdUsuarioAcreedor = ua.IdUsuario 
                            WHERE c.IdUsuarioAcreedor != '$id' and c.IdUsuarioDeudor = '$id'
                            GROUP BY ua.Nombre
                            ORDER BY ua.Nombre ASC
                            ";

                            $result4 = mysqli_query($conn, $sql4);
                            if ($reg4 = mysqli_fetch_array($result4)) {
                                mysqli_data_seek($result4, 0);
                                echo "Actualmente a los integrantes del piso les debes:";
                                while ($reg4 = mysqli_fetch_array($result4)) {
                                    echo "<br>" . $reg4['NombreAcreedor'] . ": " . $reg4['DeudaTotal'] . "€";
                                }
                            } else {
                                echo "No debes nada!";
                            }
                            ?>
                        </h2>
                    </div>
                </div>
                <hr class="star-light">


                <?php
                $sql5 = "SELECT tc.NombreCuenta, SUM(c.Cantidad) as SumaCuenta 
                    FROM cuentas c 
                    INNER JOIN tipoCuenta tc ON c.IdTipoCuenta = tc.IdTipoCuenta
                    WHERE c.IdUsuarioDeudor = '$id'
                    GROUP BY c.IdTipoCuenta";

                $result5 = mysqli_query($conn, $sql5);
                $nombreCuenta = array();
                $sumaCuenta = array();

                while ($reg5 = mysqli_fetch_array($result5)) {
                    $nombreCuenta[] = $reg5['NombreCuenta'];
                    $sumaCuenta[] = $reg5['SumaCuenta'];
                }

                $nombreCuentaJSON = json_encode($nombreCuenta);
                $sumaCuentaJSON = json_encode($sumaCuenta);



                $sql6 = "SELECT ua.Nombre as NombreAcreedor, SUM(c.Cantidad) as DeudaTotal
                        FROM cuentas c 
                        INNER JOIN usuarios ud ON c.IdUsuarioDeudor = ud.IdUsuario 
                        INNER JOIN usuarios ua ON c.IdUsuarioAcreedor = ua.IdUsuario 
                        WHERE c.IdUsuarioAcreedor != '$id' and c.IdUsuarioDeudor = '$id'
                        GROUP BY ua.Nombre
                        ORDER BY ua.Nombre ASC";

                $result6 = mysqli_query($conn, $sql6);
                $nombreAcreedor = array();
                $deudaTotal = array();

                while ($reg6 = mysqli_fetch_array($result6)) {
                    $nombreAcreedor[] = $reg6['NombreAcreedor'];
                    $deudaTotal[] = $reg6['DeudaTotal'];
                };

                $nombreAcreedorJSON = json_encode($nombreAcreedor);
                $deudaTotalJSON = json_encode($deudaTotal);


                ?>




                <div class="row justify-content-center mt-5">
                    <div class="col">
                        <p>Gastos de tipo:</p>
                        <canvas id="grafico1"></canvas>
                    </div>


                    <div class="col">
                        <p>Deudas a amigos</p>
                        <canvas id="grafico2"></canvas>
                    </div>
                </div>

                <hr class="star-light">


                <div class="row justify-content-center mt-2">
                    <div class="col">
                        <div class="mb-3 p-3 map-container">
                            <div id='map' style='width: 100%; height: 400px;'></div>
                            <p><?php echo $direccion ?></p>
                        </div>
                    </div>
                </div>


            </div>
        </header>


        <footer class="text-center footer" style="max-height: 20vh; display: flex; justify-content: center; align-items: center;">
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



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let anclaEliminarTarea = document.querySelectorAll('.anclaEliminarTarea');
            anclaEliminarTarea.forEach(ancla => {
                ancla.addEventListener('click', () => {
                    event.preventDefault();
                    Swal.fire({
                        title: '¿De verdad has terminado la tarea?',
                        text: "Esta acción no se puede deshacer.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sí, eliminar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = ancla.href;
                            Swal.fire(
                                '¡Tarea eliminada!',
                                'A la espera de los demás.',
                                'success'
                            )
                        }
                    });
                });
            });
        });


        var options = {
            maintainAspectRatio: true,
            responsive: true
        };

        var dataLabels = <?php echo $nombreCuentaJSON; ?>;
        var dataValues = <?php echo $sumaCuentaJSON; ?>;

        // Verificar si los datos están vacíos
        if (dataLabels.length === 0 || dataValues.length === 0) {
            dataLabels = ['No hay datos'];
            dataValues = [1];
        }

        var ctx1 = document.getElementById('grafico1').getContext('2d');
        var myChart1 = new Chart(ctx1, {
            type: 'pie',
            data: {
                labels: dataLabels,
                datasets: [{
                    label: 'Gastos (€): ',
                    data: dataValues,
                    backgroundColor: [
                        '#FF6384',
                        '#36A2EB',
                        '#FFCE56',
                        '#4BC0C0',
                        '#9966FF',
                    ]
                }]
            },
            options
        });



        var dataLabels2 = <?php echo $nombreAcreedorJSON; ?>;
        var dataValues2 = <?php echo $deudaTotalJSON; ?>;

        if (dataLabels2.length === 0 || dataValues2.length === 0) {
            dataLabels2 = ['No hay datos'];
            dataValues2 = [1];
        }

        //Grafico 2 donde muestre el dinero que debes a cada persona cogiendolos de la base de datos
        var ctx2 = document.getElementById('grafico2').getContext('2d');
        var myChart2 = new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: dataLabels2,
                datasets: [{
                    label: 'Gastos (€)',
                    data: dataValues2,
                    backgroundColor: [
                        '#FF6384',
                        '#36A2EB',
                        '#FFCE56',
                        '#4BC0C0',
                        '#9966FF',
                    ]
                }]
            },
            options: {
                responsive: true
            }
        });





        $(document).ready(function() {
            // Crea un nuevo mapa de Mapbox en el elemento con el ID "map"
            mapboxgl.accessToken = 'pk.eyJ1IjoiY29udHJlY2FyNyIsImEiOiJjbGFtOHg5aGEwZHp0M3lvYmNndDI3aWthIn0.3GGG77kdGhe9iJS6JP-DQw';
            var map = new mapboxgl.Map({
                container: 'map',
                style: 'mapbox://styles/mapbox/streets-v11',
                center: [-74.5, 40],
                zoom: 13
            });

            // Obtiene la dirección del usuario desde PHP
            var direccion = '<?php echo $direccion; ?>';

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
                        alert("Error al geocodificar " + direccion);
                        // No se encontró ninguna ubicación resultante
                        console.log('No se encontró ninguna ubicación para ' + direccion);
                    }
                },
                error: function(response) {
                    console.log('Error al geocodificar ' + direccion);
                    alert("Error al geocodificar " + direccion);
                }
            });

        });
    </script>

    </html>
<?php } else {
    header('Location: ../index.html');
}
