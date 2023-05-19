<?php
require "../../Conexion/conexion.php";
session_start();
if (!isset($_SESSION['IdUsuario']) || $_SESSION['Rol'] != 'cliente') {
    header("location: ../../index.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['errores'] = array();
    $_SESSION['correcto'] = array();

    $sql = "SELECT * FROM tipoCuenta";
    $result = mysqli_query($conn, $sql);

    $fechaActual = date("Y-m-d");
    $usuarioAcreedor = $_SESSION['IdUsuario'];

    while ($reg = mysqli_fetch_assoc($result)) {
        $flagCantidad = true;
        $flagUsuarios = true;
        $flagDescripcion = true;

        $tipoCuenta = $reg['IdTipoCuenta'];
        $nombreCuenta = $reg['NombreCuenta'];

        $Cantidad = isset($_POST['cantidadGastoEnId' . $tipoCuenta]) ? $_POST['cantidadGastoEnId' . $tipoCuenta] : 0;

        if (empty($Cantidad)) {
            $flagCantidad = false;
        }

        if ($flagCantidad) {
            $arrayUsuarios = isset($_POST['integrantesEnGastoConId' . $tipoCuenta]) ? $_POST['integrantesEnGastoConId' . $tipoCuenta] : 0;

            if (empty($arrayUsuarios)) {
                echo "No hay usuarios en la cuenta " . $nombreCuenta . "<br>";
                $flagUsuarios = false;
            }

            if ($flagUsuarios) {
                echo 'Hay usuarios en la cuenta ' . $nombreCuenta . '<br>';
                $descripcion = isset($_POST['textCuenta' . $tipoCuenta]) ? $_POST['textCuenta' . $tipoCuenta] : 0;

                if (strlen($descripcion) > 100 || $descripcion == null) {
                    $flagDescripcion = false;
                }

                if ($flagDescripcion) {
                    echo 'La descripción es correcta <br>';
                    $cantidadDeudaCompartida = number_format($Cantidad / count($arrayUsuarios), 2, '.', '');

                    foreach ($arrayUsuarios as $usuario) {
                        $sqlInsercion = "INSERT INTO cuentas (IdTipoCuenta, IdUsuarioDeudor, IdUsuarioAcreedor, Cantidad, FechaDeuda, Descripción) 
                                VALUES ('$tipoCuenta','$usuario','$usuarioAcreedor','$cantidadDeudaCompartida','$fechaActual','$descripcion')";

                        echo $sqlInsercion;

                        $resultadoInsercion = mysqli_query($conn, $sqlInsercion);

                        if ($resultadoInsercion) {
                            array_push($_SESSION['correcto'], "La cuenta de " . $nombreCuenta . " se ha insertado correctamente");
                        } else {
                            array_push($_SESSION['errores'], "No se ha podido insertar la cuenta de " . $nombreCuenta);
                        }
                    }
                }
            }
        }
    }


    header("Location: paginaCuentas.php");
    exit();
} else {
    header("location: ../../index.html");
    exit();
}
