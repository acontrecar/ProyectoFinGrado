<?php

require "../Conexion/conexion.php";
session_start();
if (!isset($_SESSION['IdUsuario']) && $_SESSION['Rol'] != 'cliente') {
    header("location: ../index.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $IdTarea = $_GET["id"];
    $sql = "DELETE FROM tareas WHERE IdTarea = $IdTarea";

    if (mysqli_query($conn, $sql)) {
        header("location: index.php");
        exit();
    } else {
        exit();
    }
} else {
    header("location: ../index.html");
    exit();
}
