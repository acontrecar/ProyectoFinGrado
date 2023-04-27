<?php
// establecer conexión con la base de datos

session_start();

if ($_SESSION['Rol'] == 'administrador') {


    require '../../Conexion/conexion.php';
    $sql = "SELECT Email FROM usuarios";
    $resultado = mysqli_query($conn, $sql);

    $emails = array();
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $emails[] = $fila["Email"];
    }
    header('Content-Type: application/json');

    echo json_encode($emails);
} else {
    header("Location: ../../index.html");
}
