<?php

require "../../Conexion/conexion.php";
session_start();
if (!isset($_SESSION['IdUsuario']) && $_SESSION['Rol'] != 'cliente') {
    header("location: ../../index.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $IdCuenta = $_GET["id"];
    $sql = "DELETE FROM cuentas WHERE IdCuenta = '$IdCuenta'";

    if (mysqli_query($conn, $sql)) {
        header("location: paginaCuentas.php");
        exit();
    } else {
        //exit();
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
} else {
    header("location: ../../index.html");
    exit();
}
