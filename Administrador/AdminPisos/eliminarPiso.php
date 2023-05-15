<?php

require "../../Conexion/conexion.php";
session_start();

$piso_id = $_GET['piso_id'];

if (!isset($_SESSION['IdUsuario']) && $_SESSION['Rol'] != 'administrador' && !isset($piso_id)) {
    header("location: ../../index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $sql = "DELETE FROM piso WHERE IdPiso = '$piso_id'";

    if (mysqli_query($conn, $sql)) {
        header("location: crudPisos.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        exit();
    }
} else {
    //header("location: ../../index.html");
    exit();
}
