<?php
require "../../Conexion/conexion.php";
session_start();
if (!isset($_SESSION['IdUsuario']) && $_SESSION['Rol'] != 'cliente') {
    header("location: ../../index.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $alimentos = isset($_POST['alimentos']) ? $_POST['alimentos'] : 0;
    $limpieza = isset($_POST['limpieza']) ? $_POST['limpieza'] : 0;
    $ocio = isset($_POST['ocio']) ? $_POST['ocio'] : 0;


    $usuarioAcreedor = $_SESSION['IdUsuario'];
    $cantidadDeudaCompartida = 0;
    $fechaActual = date("Y-m-d");


    $_SESSION['erroresAlimentos'] = array();

    $descripcion = "";


    if ($alimentos == "" && $limpieza == "" && $ocio == "") {
        array_push($_SESSION['erroresAlimentos'], "No se permiten campos vacios");
        header("Location: paginaCuentas.php");
        exit();
    } else {

        if ($alimentos != "") {

            $integrantesAlimentos =
                isset($_POST['integrantesAlimentos']) ? $_POST['integrantesAlimentos'] : null;


            if (empty($integrantesAlimentos)) {
                array_push($_SESSION['erroresAlimentos'], "Debes seleccionar al menos un integrante");
                header("Location: paginaCuentas.php");
                exit();
            }

            $descripcion =
                isset($_POST["textAlimentos"]) ? $_POST["textAlimentos"] : null;

            $cantidadDeudaCompartida = number_format($alimentos / count($integrantesAlimentos), 2, '.', '');

            foreach ($integrantesAlimentos as $usuarioDeudor) {
                $sql = "INSERT INTO cuentas VALUES ('0','1','$usuarioDeudor','$usuarioAcreedor', '$cantidadDeudaCompartida', '$fechaActual', '$descripcion')";
                $result = mysqli_query($conn, $sql);

                echo $sql;
            }
        }



        if ($alimentos != "") {

            $integrantesAlimentos =
                isset($_POST['integrantesAlimentos']) ? $_POST['integrantesAlimentos'] : null;


            if (empty($integrantesAlimentos)) {
                array_push($_SESSION['erroresAlimentos'], "Debes seleccionar al menos un integrante");
                header("Location: paginaCuentas.php");
                exit();
            }

            $descripcion =
                isset($_POST["textAlimentos"]) ? $_POST["textAlimentos"] : null;

            $cantidadDeudaCompartida = number_format($alimentos / count($integrantesAlimentos), 2, '.', '');

            foreach ($integrantesAlimentos as $usuarioDeudor) {
                $sql = "INSERT INTO cuentas VALUES ('0','1','$usuarioDeudor','$usuarioAcreedor', '$cantidadDeudaCompartida', '$fechaActual', '$descripcion')";
                $result = mysqli_query($conn, $sql);

                echo $sql;
            }
        }



        if ($alimentos != "") {

            $integrantesAlimentos =
                isset($_POST['integrantesAlimentos']) ? $_POST['integrantesAlimentos'] : null;


            if (empty($integrantesAlimentos)) {
                array_push($_SESSION['erroresAlimentos'], "Debes seleccionar al menos un integrante");
                header("Location: paginaCuentas.php");
                exit();
            }

            $descripcion =
                isset($_POST["textAlimentos"]) ? $_POST["textAlimentos"] : null;

            $cantidadDeudaCompartida = number_format($alimentos / count($integrantesAlimentos), 2, '.', '');

            foreach ($integrantesAlimentos as $usuarioDeudor) {
                $sql = "INSERT INTO cuentas VALUES ('0','1','$usuarioDeudor','$usuarioAcreedor', '$cantidadDeudaCompartida', '$fechaActual', '$descripcion')";
                $result = mysqli_query($conn, $sql);

                echo $sql;
            }
        }
    }
} else {
    header("location: ../../index.html");
    exit();
}
