<?php
session_start();

// Verifica si hay un mensaje de error almacenado en la sesión
if ($_SESSION['Rol'] == 'administrador') {

?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Administrador-Inicio</title>
        <link rel="icon" type="image/x-icon" href="../favicon.ico">
        <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700&amp;display=swap">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic&amp;display=swap">
        <link rel="stylesheet" href="../assets/fonts/font-awesome.min.css">
        <link rel="stylesheet" href="../assets/bootstrap/css/styles.css">
        <link rel="stylesheet" href="../assets/bootstrap/css/Login-Form-Basic-icons.css">

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
                            <a class="nav-link dropdown-toggle text-light text-center" href="#" id="dropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Admin
                            </a>
                            <div class="dropdown-menu dropdown-menu-right bg-dark" aria-labelledby="dropdown2">
                                <a class="dropdown-item text-light text-center" href="AdminPisos/crudPisos.php">Listado</a>
                                <a class="dropdown-item text-light text-center" href="NuevoPiso/paginaPrincipalNuevoPiso.php">Nuevo Piso</a>
                            </div>
                        </li>

                        <li class="nav-item mx-0 mx-lg-1 dropdown">
                            <a class="nav-link dropdown-toggle text-light text-center" href="#" id="dropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Perfil
                            </a>
                            <div class="dropdown-menu dropdown-menu-right bg-dark" aria-labelledby="dropdown2">
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
                <h1>Bienvenido</h1>
                <h4 class="mt-4">¿Que deseas hacer?</h4>


                <div class="row justify-content-center mt-5">
                    <div class="col-6">
                        <h2>
                            <a href="AdminPisos/crudPisos.php" class="text-decoration-none" style="color: white;">
                                <i class="fa fa-plu pr-2" aria-hidden="true"></i>
                                Administrar pisos<br>
                                <img src="../assets/img/administradoPisos.svg" alt="Admin vsg" style="width: 50%;">
                            </a>
                        </h2>
                    </div>

                    <div class="col-6">
                        <h2>
                            <a href="NuevoPiso/paginaPrincipalNuevoPiso.php" class="text-decoration-none" style="color: white;">
                                <i class="fa fa-plu" aria-hidden="true"></i>
                                Nuevo piso<br>
                                <img src="../assets/img/nuevoPisoAdmin.svg" alt="Nuevo Piso vsg" style="width: 50%;">
                            </a>
                        </h2>
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

        <script src="../assets/js/jquery.min.js"></script>
        <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="../assets/js/jquery.easing.min.js"></script>
        <script src="../assets/js/freelancer.js"></script>
    </body>

    </html>
<?php } else {
    header('Location: ../index.html');
}
