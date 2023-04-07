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

</head>

<body>
    <nav class="navbar navbar-light navbar-expand-lg fixed-top bg-secondary text-uppercase" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="../index.html"><i style="color:white" class="fa fa-home fa-2x" aria-hidden="true"></i>ContrePisos</a><button data-toggle="collapse" data-target="#navbarResponsive" class="navbar-toggler text-white bg-primary navbar-toggler-right text-uppercase rounded" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item mx-0 mx-lg-1"></li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="login.php">login</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <?php
    session_start();

    // Verifica si hay un mensaje de error almacenado en la sesión
    if (isset($_SESSION['errores'])) {
        $error = $_SESSION['errores'];
        unset($_SESSION['errores']);
    }
    ?>

    <header class="text-center text-white bg-primary masthead">
        <div class="container">
            <section class="py-4 py-xl-5">
                <div class="container">
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-6 col-xl-4">
                            <div class="card mb-5">
                                <div class="card-body d-flex flex-column align-items-center">
                                    <div class="bs-icon-xl bs-icon-circle bs-icon-primary bs-icon">
                                        <a class="btn btn-outline-primary text-center btn-social rounded-circle" role="button"><i class="fa fa-user fa-fw"></i></a>
                                    </div>
                                    <h4 class="text-dark mb-3">Bienvenido</h4>

                                    <?php if (isset($error)) : ?>
                                        <p style="color: red;"><?php echo $error; ?></p>
                                    <?php endif; ?>
                                    <form class="text-center" method="post" action="loginn.php">
                                        <div class="mb-3">
                                            <input class="form-control" type="email" name="email" id="email" placeholder="Email">
                                        </div>
                                        <div class="mb-3">
                                            <input class="form-control" type="password" name="password" id="password" placeholder="Password">
                                        </div>

                                        <div class="mb-3">
                                            <button class="btn btn-primary d-block w-100" type="submit">Login</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
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

    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/js/jquery.easing.min.js"></script>
    <script src="../assets/js/freelancer.js"></script>
</body>

</html>