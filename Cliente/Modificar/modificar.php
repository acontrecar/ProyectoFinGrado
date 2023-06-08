<?php
session_start();

// Verifica si hay un mensaje de error almacenado en la sesión
if ($_SESSION['Rol'] == 'cliente') {
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
        <title>ContrePisos-Modificar</title>
        <link rel="icon" type="image/x-icon" href="../../favicon.ico">
        <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700&amp;display=swap">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic&amp;display=swap">
        <link rel="stylesheet" href="../../assets/fonts/font-awesome.min.css">
        <link rel="stylesheet" href="../../assets/bootstrap/css/styles.css">
        <link rel="stylesheet" href="../../assets/bootstrap/css/Login-Form-Basic-icons.css">
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>


        <style>
            #snackbar {
                position: fixed;
                left: 50%;
                transform: translateX(-50%);
                bottom: 20px;
                background-color: #2c3e50;
                color: #fff;
                padding: 12px;
                border-radius: 4px;
                z-index: 9999;
                animation: slide-up 0.5s ease-out;
            }

            #snackbar.hide {
                display: none;
            }


            @keyframes slide-up {
                from {
                    transform: translateX(-50%) translateY(100%);
                }

                to {
                    transform: translateX(-50%) translateY(0);
                }
            }
        </style>
    </head>

    <body>
        <nav class="navbar navbar-light navbar-expand-lg fixed-top bg-secondary text-uppercase" id="mainNav">
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
                                    <a class="dropdown-item" href="../Calendario/muestraCalendario.php">Calendario Grupal</a>
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
                                    <a class="dropdown-item" href="">Modificar</a>
                                    <a class="dropdown-item" href="../../Conexion/desconexion.php">Salir</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>


        <header class="text-center text-white bg-primary masthead mt-4">
            <?php
            include '../../Conexion/conexion.php';
            $IdUsuario = $_SESSION['IdUsuario'];
            $sql = "SELECT * FROM usuarios WHERE IdUsuario = '$IdUsuario'";
            $result = mysqli_query($conn, $sql);


            // if (isset($_SESSION['correcto'])) {
            //     $correcto = $_SESSION['correcto'];
            //     unset($_SESSION['correcto']);
            // }

            //Posible errores
            if (isset($_SESSION['erroresPassword'])) {
                $erroresPassword = $_SESSION['erroresPassword'];
                unset($_SESSION['erroresPassword']);
            }
            if (isset($_SESSION['erroresNombre'])) {
                $erroresNombre = $_SESSION['erroresNombre'];
                unset($_SESSION['erroresNombre']);
            }
            if (isset($_SESSION['erroresEmail'])) {
                $erroresEmail = $_SESSION['erroresEmail'];
                unset($_SESSION['erroresEmail']);
            }

            if ($reg = mysqli_fetch_array($result)) {
            ?>
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-8 mx-auto">
                            <h1 class="brand-heading" style="font-size: 40px;padding-left: 3px;margin-left: 0px;margin-bottom: -23px;">MODIFICAR</h1>
                            <section class="py-4 py-xl-5">
                                <div class="container">
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-md-12 col-lg-12 col-xl-12">
                                            <div class="card mb-5">
                                                <div class="card-body d-flex flex-column align-items-center">
                                                    <form action="confirmacion.php" class="text-center" method="post">
                                                        <div class="form-group row mt-3">
                                                            <div class="col-sm-12">
                                                                <label class="text-secondary" for="nombre">Nombre:</label>
                                                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" value="<?php echo $reg['Nombre'] ?>">
                                                                <input type="hidden" class="form-control" id="IdUsuario" name="IdUsuario" value="<?php echo $reg['IdUsuario'] ?>">
                                                            </div>

                                                            <?php
                                                            if (isset($erroresNombre)) {
                                                            ?>
                                                                <div class="col-sm-12 mt-3">
                                                                    <div id="nameError" style="color:red; font-style: italic;">
                                                                        <?php
                                                                        echo $erroresNombre;
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            <?php } ?>

                                                        </div>
                                                        <div class="form-group row mt-3">
                                                            <div class="col-sm-12">
                                                                <label class="text-secondary" for="email">Email:</label>
                                                                <input type="text" class="form-control" disabled pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" id="email" name="email" placeholder="Email" value="<?php echo $reg['Email'] ?>">
                                                            </div>

                                                            <?php
                                                            if (isset($erroresEmail)) {
                                                            ?>
                                                                <div class="col-sm-12 mt-3">
                                                                    <div id="passwordError" style="color:red; font-style: italic;">
                                                                        <?php
                                                                        echo $erroresEmail;
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            <?php } ?>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-sm-12 mt-3">
                                                                <div id="passwordError" style="color:red; font-style: italic;">
                                                                    <?php
                                                                    if (isset($erroresPassword)) {
                                                                        echo $erroresPassword;
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">

                                                            <div class="col-sm-6 mt-4">
                                                                <input type="text" class="form-control" id="contraseña" name="contraseña" placeholder="Contraseña">
                                                            </div>
                                                            <div class="col-sm-6 mt-4">
                                                                <input type="password" class="form-control" id="contraseña2" name="contraseña2" placeholder="Confirmar Contraseña">
                                                            </div>
                                                        </div>

                                                        <div class="row d-flex justify-content-center">
                                                            <div class="col">
                                                                <input type="reset" class="btn btn-danger px-4 mt-4" value="Cancelar">
                                                            </div>
                                                            <div class="col">
                                                                <button type="submit" id="boton" class="btn btn-primary px-4 mt-4">Guardar</button>
                                                            </div>
                                                        </div>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <div id="snackbar" class="hide">
                <span id="snackbar-message"></span>
            </div>
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
            $(document).ready(function() {
                $("#contraseña").keyup(function() {
                    var contraseña = $("#contraseña").val();
                    var contraseña2 = $("#contraseña2").val();
                    if (contraseña != contraseña2) {
                        $("#passwordError").html("*Las contraseñas no coinciden");
                        $("#boton").attr("disabled", true);
                    } else {
                        $("#passwordError").html("");
                        $("#boton").attr("disabled", false);
                    }
                });
                $("#contraseña2").keyup(function() {
                    var contraseña = $("#contraseña").val();
                    var contraseña2 = $("#contraseña2").val();
                    if (contraseña != contraseña2) {
                        $("#boton").attr("disabled", true);
                        $("#passwordError").html("*Las contraseñas no coinciden");
                    } else {
                        $("#passwordError").html("");
                        $("#boton").attr("disabled", false);
                    }
                });
            });


            function showSnackbar(message) {
                var snackbar = document.getElementById("snackbar");
                var snackbarMessage = document.getElementById("snackbar-message");

                snackbarMessage.textContent = message;
                snackbar.classList.remove("hide");
                setTimeout(function() {
                    snackbar.classList.add("hide");
                }, 3000); // Snackbar se oculta después de 3 segundos
            }
        </script>

        <script src="validaDatos.js"></script>
        <script src="../../assets/js/jquery.min.js"></script>
        <script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="calendario.js"></script>


        <?php
        if (isset($_SESSION['correcto']) && !empty($_SESSION['correcto'])) {
            $correcto = $_SESSION['correcto'];
            unset($_SESSION['correcto']);

            // Llama a la función showSnackbar() para mostrar el mensaje
            echo "<script>showSnackbar('Modificación exitosa');</script>";
        }


        if (isset($_SESSION['erroresss']) && !empty($_SESSION['erroresss'])) {
            $erroneo = $_SESSION['erroresss'];
            unset($_SESSION['erroresss']);

            // Llama a la función showSnackbar() para mostrar el mensaje
            echo "<script>showSnackbar('No se ha modificado nada');</script>";
        }

        ?>
    </body>


    </html>
<?php } else {
    header('Location: ../../index.html');
}
