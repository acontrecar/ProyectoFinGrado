<?php
require "../../Conexion/conexion.php";
session_start();
if (!isset($_SESSION['IdUsuario']) && $_SESSION['Rol'] != 'cliente') {
    header("location: ../../index.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $alimentos = isset($_POST['alimentos']) ? $_POST['alimentos'] : 0;
    $ocio = isset($_POST['ocio']) ? $_POST['ocio'] : 0;
    $limpieza = isset($_POST['limpieza']) ? $_POST['limpieza'] : 0;


    $usuarioAcreedor = $_SESSION['IdUsuario'];
    $cantidadDeudaCompartida = 0;
    $fechaActual = date("Y-m-d");


    $_SESSION['erroresAlimentos'] = array();
    $_SESSION['erroresGeneral'] = "";
    $_SESSION['erroresLimpieza'] = array();
    $_SESSION['erroresOcio'] = array();

    $_SESSION['correcto'] = "";

    $descripcion = "";


    if ($alimentos == "" && $limpieza == "" && $ocio == "") {
        //array_push($_SESSION['erroresAlimentos'], 'No se permiten campos vacíos');
        $_SESSION['erroresGeneral'] = "No se permiten campos vacíos";
        header("Location: paginaCuentas.php");
        exit();
    } else {

        if ($alimentos != "" && $alimentos != 0) {

            $integrantesAlimentos =
                isset($_POST['integrantesAlimentos']) ? $_POST['integrantesAlimentos'] : null;


            if (empty($integrantesAlimentos)) {
                array_push($_SESSION['erroresAlimentos'], "Debes seleccionar al menos un integrante");
                header("Location: paginaCuentas.php");
                exit();
            }

            $descripcion =
                isset($_POST["textAlimentos"]) ? $_POST["textAlimentos"] : null;

            if (strlen($descripcion) > 100 || $descripcion == null) {
                array_push($_SESSION['erroresAlimentos'], "La descripción no puede superar los 100 caracteres y debe de estar rellena");
                header("Location: paginaCuentas.php");
                exit();
            }

            $cantidadDeudaCompartida = number_format($alimentos / count($integrantesAlimentos), 2, '.', '');

            foreach ($integrantesAlimentos as $usuarioDeudor) {
                $sql = "INSERT INTO cuentas VALUES ('0','1','$usuarioDeudor','$usuarioAcreedor', '$cantidadDeudaCompartida', '$fechaActual', '$descripcion')";
                $result = mysqli_query($conn, $sql);
            }
        }



        if ($limpieza != "" && $limpieza != 0) {

            $integrantesLimpieza =
                isset($_POST['integrantesLimpieza']) ? $_POST['integrantesLimpieza'] : null;


            if (empty($integrantesLimpieza)) {
                array_push($_SESSION['erroresLimpieza'], "Debes seleccionar al menos un integrante");
                header("Location: paginaCuentas.php");
                exit();
            }

            $descripcion =
                isset($_POST["textLimpieza"]) ? $_POST["textLimpieza"] : null;

            if (strlen($descripcion) > 100 || $descripcion == null) {
                array_push($_SESSION['erroresLimpieza'], "La descripción no puede superar los 100 caracteres y debe de estar rellena");
                header("Location: paginaCuentas.php");
                exit();
            }

            $cantidadDeudaCompartida = number_format($limpieza / count($integrantesLimpieza), 2, '.', '');

            foreach ($integrantesLimpieza as $usuarioDeudor) {
                $sql = "INSERT INTO cuentas VALUES ('0','2','$usuarioDeudor','$usuarioAcreedor', '$cantidadDeudaCompartida', '$fechaActual', '$descripcion')";
                $result = mysqli_query($conn, $sql);
            }
        }


        if ($ocio != "" && $ocio != 0) {

            $integrantesOcio =
                isset($_POST['integrantesOcio']) ? $_POST['integrantesOcio'] : null;


            if (empty($integrantesOcio)) {
                array_push($_SESSION['erroresOcio'], "Debes seleccionar al menos un integrante");
                header("Location: paginaCuentas.php");
                exit();
            }

            $descripcion =
                isset($_POST["textOcio"]) ? $_POST["textOcio"] : null;

            if (strlen($descripcion) > 100 || $descripcion == null) {
                array_push($_SESSION['erroresOcio'], "La descripción no puede superar los 100 caracteres y debe de estar rellena");
                header("Location: paginaCuentas.php");
                exit();
            }

            $cantidadDeudaCompartida = number_format($ocio / count($integrantesOcio), 2, '.', '');

            foreach ($integrantesOcio as $usuarioDeudor) {
                $sql = "INSERT INTO cuentas VALUES ('0','3','$usuarioDeudor','$usuarioAcreedor', '$cantidadDeudaCompartida', '$fechaActual', '$descripcion')";
                $result = mysqli_query($conn, $sql);
            }
        }


        //Devolver como correo el resultado de la consulta
        $_SESSION['correcto'] = "Cuenta insertada correctamente";
        header("Location: paginaCuentas.php");
    }
} else {
    header("location: ../../index.html");
    exit();
}
