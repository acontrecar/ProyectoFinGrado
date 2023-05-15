<?php
session_start();

$piso_id = $_GET['piso_id'];

if ($_SESSION['Rol'] == 'administrador' && isset($piso_id)) {

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

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <style>
            .container-personal {
                background-color: #f0f8ea;
                padding: 20px;
                border-radius: 10px;
            }

            h3 {
                color: #1c1c1c;
            }

            table {
                background-color: white;
                border-radius: 10px;
            }

            thead th {
                background-color: #1c1c1c;
                color: white;
            }

            tbody tr:hover {
                background-color: #e6e6e6;
            }

            .btn-success {
                background-color: #388e3c;
                border-color: #388e3c;
            }

            .btn-success:hover {
                background-color: #2e7d32;
                border-color: #2e7d32;
            }

            .btn-danger {
                background-color: #d32f2f;
                border-color: #d32f2f;
            }

            .btn-danger:hover {
                background-color: #c62828;
                border-color: #c62828;
            }

            @media (max-width: 767px) {
                .text-md-end {
                    text-align: center !important;
                }
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
                <button id="botonEliminarPiso" class="btn btn-danger">Eliminar piso</button>

                <h3>Listado de usuarios:</h3>

                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Email</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Juan Pérez</td>
                                    <td>juan.perez@example.com</td>
                                    <td>
                                        <button class="btn btn-danger">Eliminar</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>María García</td>
                                    <td>maria.garcia@example.com</td>
                                    <td>
                                        <button class="btn btn-danger">Eliminar</button>
                                    </td>
                                </tr>
                                <!-- ... -->
                            </tbody>
                        </table>
                    </div>
                </div>

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
            const botonEliminarPiso = document.getElementById('botonEliminarPiso');
            botonEliminarPiso.addEventListener('click', () => {
                Swal.fire({
                    title: '¿Estás seguro de querer eliminar este piso?',
                    text: "Esta acción no se puede deshacer y serás redirigido a la página principal.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = `eliminarPiso.php?piso_id=${<?php echo $piso_id ?>}`;
                        Swal.fire(
                            '¡Piso eliminado!',
                            'El piso ha sido eliminado correctamente.',
                            'success'
                        )
                    }
                })
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
