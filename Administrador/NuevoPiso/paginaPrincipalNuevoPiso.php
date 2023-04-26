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
        <title>Home - Brand</title>
        <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700&amp;display=swap">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic&amp;display=swap">
        <link rel="stylesheet" href="../../assets/fonts/font-awesome.min.css">
        <link rel="stylesheet" href="../../assets/bootstrap/css/styles.css">
        <link rel="stylesheet" href="../../assets/bootstrap/css/Login-Form-Basic-icons.css">


        <!--MapBox-->
        <script src='https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.js'></script>
        <link href='https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.css' rel='stylesheet' />

    </head>

    <body>
        <nav class="navbar navbar-light navbar-expand-lg fixed-top bg-secondary text-uppercase" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="../index.php"><i style="color:white" class="fa fa-home fa-2x" aria-hidden="true"></i>ContrePisos</a><button data-toggle="collapse" data-target="#navbarResponsive" class="navbar-toggler text-white bg-primary navbar-toggler-right text-uppercase rounded" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item mx-0 mx-lg-1"></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="login.html">login</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="Registro/">singup</a></li>
                    </ul>
                </div>
            </div>
        </nav>



        <header class="text-center text-white bg-primary masthead mt-4">
            <div class="container">
                <form method="POST" action="insertaPiso.php" enctype="multipart/form-data">
                    <div class="form-group text-center">
                        <label for="imagen">Imagen del piso*</label>
                        <div class="position-relative">
                            <div class="rounded-circle overflow-hidden d-inline-block">
                                <img src="../../assets/img/pisoIcono.png" alt="Imagen" class="w-25" id="img-input">
                            </div>
                            <input type="file" accept="image/*" hidden class="form-control-file position-absolute h-100 w-100" name="imagen" id="imagen">
                            <?php if (isset($error)) : ?>
                                <p style="color: red;"><?php echo $error; ?></p>
                            <?php endif; ?>
                            <?php if (isset($correcto)) : ?>
                                <p style="color: green;"><?php echo $correcto; ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="latitud">Latitud del piso*</label>
                            <input type="number" step="any" required class="form-control" name="latitud" id="latitud">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="longitud">Logintud del piso*</label>
                            <input type="number" step="any" required class="form-control" name="longitud" id="longitud">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nombreCalle">Nombre de la calle*</label>
                            <input type="text" class="form-control" name="nombreCalle" require id="nombreCalle">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="nombrePiso">Nombre del piso</label>
                            <input type="text" class="form-control" required name="nombrePiso" id="nombrePiso">
                        </div>
                    </div>

                    <div id="campos-adicionales">
                        <!-- Aquí se añadirán los campos adicionales -->
                    </div>

                    <div class="form-group">
                        <button type="button" class="btn btn-primary" id="btn-anadir-campos">Añadir campos</button>
                    </div>

                    <button type="submit" class="btn btn-success">Enviar</button>
                </form>


                <script>
                    const imgInput = document.getElementById('img-input');
                    const fileInput = document.getElementById('imagen');

                    imgInput.addEventListener('click', () => {
                        fileInput.click();
                    });

                    var contadorCampos = 0;
                    var maxCampos = 5; // Máximo de campos adicionales permitidos

                    // Función para añadir los campos adicionales
                    document.getElementById('btn-anadir-campos').addEventListener("click", anadirCampos);

                    function anadirCampos(event) {

                        if (contadorCampos < maxCampos) {
                            contadorCampos++;
                            var nuevoCampo = `<div class="form-row">
                            <div class="col-md-3"></div>
                    <div class="form-group col-md-6">
                        <label for="email${contadorCampos}">Email ${contadorCampos}</label>
                        <input type="email" class="form-control" name="emails[]" id="email${contadorCampos}">
                    </div>`;
                            document.getElementById('campos-adicionales').innerHTML += nuevoCampo;
                            event.preventDefault();
                        } else {
                            alert('Solo se permite ingresar 5 usuarios');
                            event.preventDefault();
                        }
                    }
                </script>


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

        <script src="../../assets/js/jquery.min.js"></script>
        <script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="../../assets/js/jquery.easing.min.js"></script>
        <script src="../../assets/js/freelancer.js"></script>
    </body>

    </html>
<?php } else {
    header('Location: ../../index.html');
}
