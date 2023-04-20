<?php
session_start();

// Verifica si hay un mensaje de error almacenado en la sesión
if ($_SESSION['Rol'] == 'cliente') {

    if (isset($_SESSION['erroresAlimentos'])) {
        $erroresAlimentos = $_SESSION['erroresAlimentos'];
        unset($_SESSION['erroresAlimentos']);
    }


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
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>

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
                                    Actividades
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="../Calendario/muestraCalendario.php">Calendario Grupal</a>
                                    <a class="dropdown-item" href="">Calendario Personal</a>
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
                                    <a class="dropdown-item" href="../Modificar/modificar.php">Modificar</a>
                                    <a class="dropdown-item" href="../../Conexion/desconexion.php">Salir</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>


        <header class="text-center text-white bg-primary masthead mt-5">

            <form action="insertaCuentas.php" method="POST">
                <div class="container" style="color: black;">
                    <div class="row">
                        <div class="col-md-4 car-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Alimentos</h5>
                                    <form>
                                        <div class="form-group">
                                            <input type="number" min="0" step="0.01" class="form-control" id="alimentos" name="alimentos" placeholder="Cantidad gastada">
                                        </div>
                                        <div class="form-group">
                                            <?php
                                            require '../../Conexion/conexion.php';
                                            $sql = "SELECT * FROM usuarios WHERE IdPiso=" . $_SESSION['IdPiso'] . " AND IdUsuario!=" . $_SESSION['IdUsuario'];
                                            $result = mysqli_query($conn, $sql);
                                            while ($reg = mysqli_fetch_array($result)) {
                                            ?>
                                                <div class="form-check">
                                                    <input type="checkbox" style="color: black;" class="form-check-input" name="integrantesAlimentos[]" value="<?php echo $reg['IdUsuario']; ?>" id="integrante-<?php echo $reg['IdUsuario']; ?>">
                                                    <label class="form-check-label" style="color: black;" for="integrante-<?php echo $reg['IdUsuario']; ?>"><?php echo $reg['Email']; ?></label>
                                                </div>
                                            <?php } ?>
                                        </div>

                                        <div class="form-group">
                                            <textarea class="form-control my-textarea" max="100" id="textAlimentos" name="textAlimentos"></textarea>
                                        </div>

                                        <?php
                                        if (isset($erroresAlimentos)) {
                                        ?>
                                            <div class="col-sm-12 mt-3">
                                                <div id="passwordError" style="color:red; font-style: italic;">
                                                    <?php

                                                    foreach ($erroresAlimentos as $error) {
                                                        echo $error . "<br>";
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 car-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Productos de limpieza</h5>
                                    <form>
                                        <div class="form-group">
                                            <input type="number" min="0" step="0.01" class="form-control" id="limpieza" name="limpieza" placeholder="Cantidad gastada">
                                        </div>
                                        <div class="form-group">
                                            <?php
                                            mysqli_data_seek($result, 0);
                                            while ($reg2 = mysqli_fetch_array($result)) {
                                            ?>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" name="integrantesLimpieza[]" value="<?php echo $reg2['IdUsuario']; ?>" id="integrante-<?php echo $reg2['IdUsuario']; ?>">
                                                    <label class="form-check-label" style="color: black;" for="integrante-<?php echo $reg2['IdUsuario']; ?>"><?php echo $reg2['Email']; ?></label>
                                                </div>
                                            <?php } ?>
                                        </div>

                                        <div class="form-group">
                                            <textarea class="form-control my-textarea" max="100" id="textLimpieza" name="textLimpieza"></textarea>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 car-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Ocio</h5>
                                    <form>
                                        <div class="form-group">
                                            <input type="number" min="0" step="0.01" class="form-control" id="ocio" name="ocio" placeholder="Cantidad gastada">
                                        </div>
                                        <div class="form-group">
                                            <?php
                                            mysqli_data_seek($result, 0);
                                            while ($reg3 = mysqli_fetch_array($result)) {
                                            ?>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" name="integrantesOcio[]" value="<?php echo $reg3['IdUsuario']; ?>" id="integrante-<?php echo $reg3['IdUsuario']; ?>">
                                                    <label class="form-check-label" style="color: black;" for="integrante-<?php echo $reg3['IdUsuario']; ?>"><?php echo $reg3['Email']; ?></label>
                                                </div>
                                            <?php } ?>
                                        </div>

                                        <div class="form-group">
                                            <textarea class="form-control my-textarea" max="100" id="textOcio" name="textOcio"></textarea>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center mt-5">
                        <button class="btn btn-success d-block" type="submit">Enviar</button>
                    </div>

            </form>
        </header>





        <footer class="text-center footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 mb-5 mb-lg-0">

                    </div>
                    <div class="col-md-4">
                        <h4 class="text-uppercase">About me</h4>
                        <ul class="list-inline">
                            <li class="list-inline-item"><a class="btn btn-outline-light text-center btn-social rounded-circle" role="button" href="https://github.com/acontrecar"><i class="fa fa-github fa-fw"></i></a>
                            </li>
                            <li class="list-inline-item"><a class="btn btn-outline-light text-center btn-social rounded-circle" role="button" href="https://www.linkedin.com/in/antoniocontrerasc%C3%A1rdenas/"><i class="fa fa-linkedin-square fa-fw"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </footer>

        <script>
        </script>

        <script src="validaDatos.js"></script>
        <script src="../../assets/js/jquery.min.js"></script>
        <script src="../../assets/bootstrap/js/bootstrap.min.js"></script>

    </body>


    </html>
<?php } else {
    header('Location: ../../index.html');
}
