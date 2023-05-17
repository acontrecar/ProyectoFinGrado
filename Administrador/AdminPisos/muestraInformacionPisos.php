<?php
session_start();

$piso_id = $_GET['piso_id'];



if ($_SESSION['Rol'] == 'administrador' && isset($piso_id)) {

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
            .tabla-responsive {
                overflow-x: auto;
            }

            .tabla-responsive table {
                width: 100%;
                border-collapse: collapse;
            }

            .tabla-responsive th,
            .tabla-responsive td {
                padding: 8px;
                text-align: left;
                border-bottom: 1px solid #ddd;
            }

            @media screen and (max-width: 600px) {

                .tabla-responsive th,
                .tabla-responsive td {
                    padding: 4px;
                }
            }
        </style>

    </head>

    <body>
        <nav class="navbar navbar-light navbar-expand-lg fixed-top bg-secondary text-uppercase" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger mw-25" href="../index.php"><img class="navbar-bar" src="../../assets/img/logoMedioBlanco.png" style="width: 40%;"></a><button data-toggle="collapse" data-target="#navbarResponsive" class="navbar-toggler text-white bg-primary navbar-toggler-right text-uppercase rounded" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
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


        <header class="text-center text-white bg-primary masthead mt-4" style="min-height: 80vh;">
            <div class="container">
                <button id="botonEliminarPiso" class="btn btn-danger">Eliminar piso</button>

                <h3 class="mt-3 mb-3">Listado de usuarios del piso:</h3>

                <div class="row">
                    <div class="col-md-12 mx-auto text-center">
                        <div class="table-responsive">
                            <table class="table table-info">
                                <thead>
                                    <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Email</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>

                                <tbody class="table-success">
                                    <?php
                                    include '../../Conexion/conexion.php';

                                    $sqlPiso = "SELECT * FROM piso WHERE IdPiso = '$piso_id'";
                                    $consultaPiso = mysqli_query($conn, $sqlPiso);
                                    $filaPiso = mysqli_fetch_array($consultaPiso);
                                    $dniPropietario = $filaPiso['DNI'];


                                    $_SESSION['dniPropietario'] = $dniPropietario;


                                    $sql = "SELECT * FROM usuarios WHERE IdPiso = '$piso_id'";
                                    $consulta = mysqli_query($conn, $sql);

                                    while ($fila = mysqli_fetch_array($consulta)) {
                                        echo $fila['Nombre'];
                                    ?>
                                        <tr>
                                            <th scope="row"><?php echo $fila['IdUsuario'] ?></th>
                                            <td><?php echo $fila['Nombre'] ?></td>
                                            <td><?php echo $fila['Email'] ?></td>
                                            <td><a href="eliminarUsuario.php?id=<?php echo $fila['IdUsuario'] ?>&piso_id=<?php echo $piso_id ?>" class="anclaEliminarUsuario" style="cursor: pointer;"><i class="fa fa-trash-o fa-2x" aria-hidden="true"></i></a></td>

                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                <?php

                $sql = "SELECT Email FROM usuarios";

                $consulta = mysqli_query($conn, $sql);

                $emails = array();

                while ($fila = mysqli_fetch_array($consulta)) {
                    array_push($emails, $fila['Email']);
                }
                ?>

                <div class="row mt-5">
                    <div class="col">
                        <input type="email" class="form-control" placeholder="Añada el nuevo email" style="width: 50%;">
                        <button id="botonAnadirUsuario" class="btn btn-success" disabled>Añadir usuario</button>
                    </div>
                </div>


                <div class="row mt-5">
                    <div class="col-md-6">
                        <h4 class="mt-3 mb-3">Editar el DNI del propietario (enter to save):</h4>
                    </div>
                    <div class="col-md-6">
                        <input type="text" id="dniInput" maxlength="9" minlength="9" class="form-control rounded" value="<?php echo $dniPropietario ?>">
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
            let anclasEliminarUsuario = document.querySelectorAll('.anclaEliminarUsuario');
            anclasEliminarUsuario.forEach(ancla => {
                ancla.addEventListener('click', () => {
                    event.preventDefault();
                    Swal.fire({
                        title: '¿Estás seguro de querer eliminar este usuario?',
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
                                '¡Usuario eliminado!',
                                'El usuario ha sido eliminado correctamente.',
                                'success'
                            )
                        }
                    });
                });
            });


            const botonEliminarPiso = document.getElementById('botonEliminarPiso');
            botonEliminarPiso.addEventListener('click', () => {
                Swal.fire({
                    title: '¿Estás seguro de querer eliminar este piso?',
                    text: "Esta acción no se puede deshacer.",
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


            const emails = <?php echo json_encode($emails) ?>;
            const botonAnadirUsuario = document.getElementById('botonAnadirUsuario');
            const inputEmail = document.querySelector('input[type="email"]');


            console.log(emails);
            inputEmail.addEventListener('keyup', () => {
                if (emails.includes(inputEmail.value)) {
                    botonAnadirUsuario.disabled = true;
                } else {
                    if (esEmail(inputEmail.value)) {
                        botonAnadirUsuario.disabled = false;
                    } else {
                        botonAnadirUsuario.disabled = true;
                    }
                }
            });

            botonAnadirUsuario.addEventListener('click', () => {
                Swal.fire({
                    title: '¿Estás seguro de querer añadir este usuario?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Sí, añadir'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = `anadirUsuario.php?email=${inputEmail.value}&piso_id=${<?php echo $piso_id ?>}`;
                        Swal.fire(
                            '¡Usuario añadido!',
                            'El usuario ha sido añadido correctamente.',
                            'success'
                        )
                    }
                })
            });


            const dniInput = document.getElementById('dniInput');
            dniInput.addEventListener('keyup', (event) => {

                if (event.keyCode === 13) {

                    if (validarDNI(dniInput.value)) {
                        Swal.fire({
                            title: '¿Estás seguro de querer cambiar el DNI del propietario?',
                            text: "Esta acción no se puede deshacer.",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            cancelButtonText: 'Cancelar',
                            confirmButtonText: 'Sí, cambiar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = `editarDni.php?dni=${dniInput.value}&piso_id=${<?php echo $piso_id ?>}`;
                                Swal.fire(
                                    '¡DNI cambiado!',
                                    'El DNI ha sido cambiado correctamente.',
                                    'success'
                                )
                            }
                        })
                    }

                }


            });


            function validarDNI(dni) {
                const regex = /^\d{8}[a-zA-Z]$/;
                return regex.test(dni);
            }

            function esEmail(email) {
                const regex = /\S+@\S+\.\S+/;
                return regex.test(email);
            }
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
