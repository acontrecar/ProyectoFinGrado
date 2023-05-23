<?php
session_start();

// Verifica si hay un mensaje de error almacenado en la sesión
if ($_SESSION['Rol'] == 'cliente') {

    if (isset($_SESSION['correcto'])) {
        $correcto = $_SESSION['correcto'];
        unset($_SESSION['correcto']);
    }

    if (isset($_SESSION['errores'])) {
        $errores = $_SESSION['errores'];
        unset($_SESSION['errores']);
    }
?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>ContrePisos-Cuentas</title>
        <link rel="icon" type="image/x-icon" href="../../favicon.ico">
        <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700&amp;display=swap">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic&amp;display=swap">
        <link rel="stylesheet" href="../../assets/fonts/font-awesome.min.css">
        <link rel="stylesheet" href="../../assets/bootstrap/css/styles.css">
        <link rel="stylesheet" href="../../assets/bootstrap/css/Login-Form-Basic-icons.css">
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <style>
            @media (max-width: 768px) {
                .car-margin {
                    margin-top: 10px;
                }
            }

            .my-textarea {
                font-size: 18px;
                border-color: #333;
                border-radius: 8px;
                padding: 12px;
            }

            .my-textarea:focus {
                outline: none;
                box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
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
                                <a class="dropdown-item text-light text-center" href="../Calendario/muestraCalendario.php">Calendario Grupal</a>
                                <a class="dropdown-item text-light text-center" href="">Cuentas</a>
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


        <header class="text-center text-white bg-primary masthead mt-5" style="min-height: 90vh; display: flex;
    justify-content: center;
    align-items: center;">
            <div class="container" style="color: black;">
                <form action="insertaCuentas.php" method="POST">
                    <div class="row">

                        <?php

                        require '../../Conexion/conexion.php';
                        $sql = "SELECT * FROM usuarios WHERE IdPiso=" . $_SESSION['IdPiso'] /*. " AND IdUsuario!=" . $_SESSION['IdUsuario']*/;
                        $result = mysqli_query($conn, $sql);

                        $sql2 = "SELECT * FROM tipoCuenta";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($reg1 = mysqli_fetch_assoc($result2)) {
                        ?>


                            <div class="col-md-4 car-margin mt-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $reg1['NombreCuenta'] ?></h5>
                                        <div class="form-group">
                                            <input type="number" min="0" step="0.01" class="form-control" id="cantidadGastoEnId<?php echo $reg1['IdTipoCuenta'] ?>" name="cantidadGastoEnId<?php echo $reg1['IdTipoCuenta'] ?>" placeholder="Cantidad gastada">
                                        </div>
                                        <div class="form-group">

                                            <?php
                                            while ($reg = mysqli_fetch_assoc($result)) {
                                            ?>
                                                <div class="form-check">
                                                    <input type="checkbox" style="color: black;" class="form-check-input" name="integrantesEnGastoConId<?php echo $reg1['IdTipoCuenta'] ?>[]" value="<?php echo $reg['IdUsuario']; ?>" id="integrante-<?php echo $reg['IdUsuario']; ?>">
                                                    <label class="form-check-label" style="color: black;" for="integrante-<?php echo $reg['IdUsuario']; ?>">
                                                        <?php
                                                        if ($reg['Nombre'] != null)
                                                            echo $reg['Nombre'];
                                                        else
                                                            echo $reg['Email'];
                                                        ?>
                                                    </label>
                                                </div>
                                            <?php }
                                            mysqli_data_seek($result, 0);
                                            ?>
                                        </div>

                                        <div class="form-group">
                                            <textarea class="form-control my-textarea" max="100" id="textCuenta<?php echo $reg1['IdTipoCuenta'] ?>" name="textCuenta<?php echo $reg1['IdTipoCuenta'] ?>"></textarea>
                                        </div>


                                    </div>
                                </div>
                            </div>

                        <?php
                        }
                        ?>


                    </div>

                    <?php
                    if (isset($correcto)) {
                    ?>
                        <div class="row justify-content-center mt-5">
                            <div id="passwordError" style="color:blue;">
                                <p>
                                    <?php
                                    foreach ($correcto as $correct) {
                                        echo $correct . "<br>";
                                    }
                                    ?>
                                </p>
                            </div>
                        </div>
                    <?php } ?>


                    <?php
                    if (isset($errores)) {
                    ?>
                        <div class="row justify-content-center mt-5">
                            <div id="passwordError" style="color:red; font-style: italic;">
                                <p>
                                    <?php
                                    foreach ($errores as $error) {
                                        echo $error . "<br>";
                                    }
                                    ?>
                                </p>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="row mt-4 justify-content-center">
                        <button class="btn btn-success d-block" type="submit">Enviar</button>
                    </div>

                </form>


                <div class="mt-5" style="color: black">
                    <div class="row justify-content-center">
                        <button class="btn btn-success d-block" id="botonTabla">¿Quieres ver tus cuentas?</button>
                    </div>
                </div>

                <div id="tablaTareas" style="display: none;" class="row justify-content-center mt-3">
                    <?php
                    $id = $_SESSION['IdUsuario'];
                    $sql = "SELECT c.IdCuenta, tc.NombreCuenta,c.Cantidad, ud.Nombre as NombreDeudor, ua.Nombre as NombreAcreedor, c.FechaDeuda, c.Descripción 
                            FROM cuentas c 
                            INNER JOIN tipoCuenta tc ON c.IdTipoCuenta = tc.IdTipoCuenta 
                            INNER JOIN usuarios ud ON c.IdUsuarioDeudor = ud.IdUsuario 
                            INNER JOIN usuarios ua ON c.IdUsuarioAcreedor = ua.IdUsuario 
                            WHERE c.IdUsuarioAcreedor = '$id'
                            and c.IdUsuarioDeudor!='$id'
                            ORDER BY c.FechaDeuda DESC";

                    $result2 = mysqli_query($conn, $sql);

                    if ($reg = mysqli_fetch_array($result2)) {

                        mysqli_data_seek($result2, 0);
                    ?>

                        <div class="table-responsive">
                            <table class="table table-striped table-info mt-5">
                                <thead>
                                    <tr>
                                        <th scope="col">Te lo debe</th>
                                        <th scope="col">Gasto en</th>
                                        <th scope="col">Fecha</th>
                                        <th scope="col">Descripción</th>
                                        <th scope="col">Cantidad</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($reg = mysqli_fetch_array($result2)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $reg['NombreDeudor'] ?></td>
                                            <td><?php echo $reg['NombreCuenta'] ?></td>
                                            <td><?php echo $reg['FechaDeuda'] ?></td>
                                            <td><?php echo $reg['Descripción'] ?></td>
                                            <td><?php echo $reg['Cantidad'] ?>€</td>
                                            <td><a href="eliminarCuenta.php?id=<?php echo $reg['IdCuenta'] ?>" class="anclaEliminarCuentas"><i class="fa fa-check" aria-hidden="true"></i></a></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } else {
                    ?>
                        <p>No te deben nada </p>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </header>





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
            let anclaEliminarCuentas = document.querySelectorAll('.anclaEliminarCuentas');
            anclaEliminarCuentas.forEach(ancla => {
                ancla.addEventListener('click', () => {
                    event.preventDefault();
                    Swal.fire({
                        title: '¿Ya te han pagado esta deuda?',
                        text: "Estas seguro",
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
                                '¡Cuenta eliminada!',
                                'La cuenta ha sido eliminado correctamente.',
                                'success'
                            )
                        }

                        event.preventDefault();
                    });
                });
            });





            var pulsa = false;
            document.getElementById('botonTabla').addEventListener('click', function() {
                if (pulsa == false) {
                    document.getElementById('tablaTareas').style.display = 'block';
                    document.getElementById('botonTabla').innerHTML = 'Ocultar Cuentas'
                    pulsa = true;
                } else {
                    document.getElementById('tablaTareas').style.display = 'none';
                    document.getElementById('botonTabla').innerHTML = '¿Quieres ver tus cuentas?'
                    pulsa = false;
                }
            });
        </script>


        <script src="../../assets/js/jquery.min.js"></script>
        <script src="../../assets/bootstrap/js/bootstrap.min.js"></script>

    </body>


    </html>
<?php } else {
    header('Location: ../../index.html');
}
