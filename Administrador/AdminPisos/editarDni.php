<?php
require "../../Conexion/conexion.php";
session_start();

$dni = $_SESSION['dniPropietario'];
$piso_id = $_GET['piso_id'];

if (!isset($_SESSION['IdUsuario']) && $_SESSION['Rol'] != 'administrador' && !isset($piso_id)) {
    header("location: ../../index.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $sql = "UPDATE piso SET DNI = '$dni' WHERE IdPiso = '$piso_id'";

    if (mysqli_query($conn, $sql)) {
        header("location: muestraInformacionPisos.php?piso_id=$piso_id");
        exit();
        return;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        exit();
        return;
    }
} else {
    header("location: ../../index.html");
    exit();
}
