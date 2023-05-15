<?php
session_start();

if ($_SESSION['Rol'] == 'administrador') {

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


        <style>
            .list-group-propio {
                /* background-color: #d4edda; */
                border-radius: 5px;
                margin-top: 20px;
            }

            .list-group-item-propio {
                padding-top: 12px;
                padding-bottom: 12px;
                background-color: #fff;
                border: none;
                border-radius: 5px;
                margin-bottom: 10px;
                list-style-type: none;
            }

            .list-group-item-propio h5 {
                margin-bottom: 5px;
            }

            .list-group-item-propio small {
                color: #6c757d;
            }

            .list-group-item-propio:hover {
                cursor: pointer;
                background-color: #f8f9fa;
            }
        </style>
    </head>

    <body>
        <nav class="navbar navbar-light navbar-expand-lg fixed-top bg-secondary text-uppercase" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="../index.php"><i style="color:white" class="fa fa-home fa-2x" aria-hidden="true"></i>ContrePisos</a><button data-toggle="collapse" data-target="#navbarResponsive" class="navbar-toggler text-white bg-primary navbar-toggler-right text-uppercase rounded" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
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
                <h1>Listado de pisos</h1>
                <ul class="list-group-propio">
                    <?php
                    require_once '../../Conexion/conexion.php';
                    $sql = "Select * from piso";
                    $result = mysqli_query($conn, $sql);
                    $pisos = mysqli_fetch_all($result, MYSQLI_ASSOC);


                    foreach ($pisos as $piso) {
                    ?>
                        <li class="list-group-item-propio" id="<?php echo $piso['IdPiso']; ?>">
                            <a href="muestraInformacionPisos.php?piso_id=<?php echo $piso['IdPiso']; ?>">
                                <h5><?php echo $piso['NombrePiso']; ?></h5>
                                <p><?php echo $piso['Direccion']; ?></p>
                                <small class="text-muted">DNI Propietario: <?php echo $piso['DNI']; ?></small>
                            </a>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
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
