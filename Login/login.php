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
    <title>ContrePisos-Login</title>
    <link rel="icon" type="image/x-icon" href="../favicon.ico">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic&amp;display=swap">
    <link rel="stylesheet" href="../assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/bootstrap/css/styles.css">
    <link rel="stylesheet" href="../assets/bootstrap/css/Login-Form-Basic-icons.css">

</head>

<body>
    <!-- <nav class="navbar navbar-light navbar-expand-lg fixed-top bg-secondary text-uppercase" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger mw-25" href="../index.html"><img class="navbar-bar" src="../assets/img/logoMedioBlanco.png" style="width: 40%;"></a><button data-toggle="collapse" data-target="#navbarResponsive" class="navbar-toggler text-white bg-primary navbar-toggler-right text-uppercase rounded" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item mx-0 mx-lg-1"></li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="login.php">login</a></li>
                </ul>
            </div>
        </div>
    </nav> -->

    <nav class="navbar navbar-light navbar-expand-md fixed-top bg-secondary text-uppercase" id="mainNav">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between">
                <a class="navbar-brand js-scroll-trigger logo-link order-1" href="">
                    <img class="navbar-bar" src="../assets/img/logoMedioBlanco.png" style="width: 40%;">
                </a>
                <button data-toggle="collapse" data-target="#navbarResponsive" class="navbar-toggler text-white bg-primary navbar-toggler-right text-uppercase rounded ml-auto order-3" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
            </div>
            <div class="collapse navbar-collapse order-2" id="navbarResponsive">
                <ul class="navbar-nav ml-auto flex-nowrap">
                    <li class="nav-item mx-0 mx-lg-1">
                        <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger text-center" href="">Login</a>
                    </li>
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

    <header class="text-center text-white bg-primary masthead" style="min-height: 90vh; display: flex;
    justify-content: center;
    align-items: center;">
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