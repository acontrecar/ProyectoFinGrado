<?php

require "../Conexion/conexion.php";
session_start();
if (!isset($_SESSION['IdUsuario']) && $_SESSION['Rol'] != 'cliente') {
    header("location: ../index.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $IdTarea = $_GET["id"];
    $sql = "SELECT Aceptaciones FROM tareas WHERE IdTarea = $IdTarea";
    $resultado = mysqli_query($conn, $sql);

    $fila = mysqli_fetch_assoc($resultado);
    $aceptaciones = $fila['Aceptaciones'];

    $aceptaciones = $aceptaciones - 1;

    $idPersona = $_SESSION['IdUsuario'];


    if ($aceptaciones === 0) {
        $sql2 = "DELETE FROM tareas WHERE IdTarea = $IdTarea";
        $resultado = mysqli_query($conn, $sql2);
        header("location: index.php");
        exit();
    } else {
        $sql3 = "UPDATE tareas SET Aceptaciones = $aceptaciones WHERE IdTarea = $IdTarea";
        mysqli_query($conn, $sql3);

        $sql4 = "UPDATE tareaUsuario SET Completado = 1 WHERE IdTarea = $IdTarea and IdUsuario = $idPersona";
        mysqli_query($conn, $sql4);
        header("location: index.php");
        exit();
    }
} else {
    header("location: ../index.html");
    exit();
}
