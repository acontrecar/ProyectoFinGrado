<?php
session_start();
require '../../Conexion/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION['Rol'] == 'administrador') {

    $imagen = $_POST["imagen"];
    $latitud = $_POST["latitud"];
    $longitud = $_POST["longitud"];
    $nombreCalle = $_POST["nombreCalle"];
    $nombrePiso = $_POST["nombrePiso"];

    $_SESSION['errores'] = "";


    if (isset($latitud, $longitud, $latitud, $nombreCalle, $nombrePiso)) {

        $check = getimagesize($_FILES["imagen"]["tmp_name"]);
        if ($check !== false) {
            if (is_numeric($latitud) && is_numeric($longitud) && !empty($nombreCalle) && !empty($nombrePiso)) {
            } else {
                // Al menos uno de los campos numéricos no es un número
                echo "Al menos uno de los campos numéricos no es un número.";
            }
        } else {
            // El archivo no es una imagen
            echo "El archivo no es una imagen.";
        }
    }
} else {
    echo "<script>
    window.location.href='../index.php'
    </script>";
}
