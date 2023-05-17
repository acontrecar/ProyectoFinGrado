<?php
require "../../Conexion/conexion.php";
session_start();

$id = $_GET['id'];
$piso_id = $_GET['piso_id'];

if (!isset($_SESSION['IdUsuario']) && $_SESSION['Rol'] != 'administrador' && !isset($piso_id)) {
    header("location: ../../index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $sql = "DELETE FROM usuarios WHERE IdUsuario = '$id'";

    if (mysqli_query($conn, $sql)) {
        header("location: muestraInformacionPisos.php?piso_id=$piso_id");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        exit();
    }
} else {
    header("location: ../../index.html");
    exit();
}
