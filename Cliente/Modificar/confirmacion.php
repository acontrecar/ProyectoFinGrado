<?php
require "../../Conexion/conexion.php";
session_start();
if (!isset($_SESSION['IdUsuario']) && $_SESSION['Rol'] != 'cliente') {
    header("location: ../../index.php");
    exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $_SESSION['errores'] = array();
    $_SESSION['correcto'] = array();

    $IdUsuario = $_SESSION['IdUsuario'];
    $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : "";
    $clave = isset($_POST["contraseña"]) ? $_POST["contraseña"] : "";
    $claveRepetida = isset($_POST["contraseña2"]) ? $_POST["contraseña2"] : "";

    $claveCifrada = "";

    $errores = false;

    if (strlen($nombre) == 0) {
        $_SESSION['erroresNombre'] = "El nombre no puede estar vacío";
        header("location: ./modificar.php");
        exit();
    }


    if (strlen($clave) == 0 && strlen($claveRepetida) == 0 && strcmp($nombre, $_SESSION['Nombre']) == 0) {
        $_SESSION['errores'][] = "No se ha modificado nada";
        header("location: modificar.php");
        exit();
    }

    if (strlen($clave) != 0 && strlen($claveRepetida) != 0) {
        for ($i = 0; $i < strlen($clave); $i++) {
            if ($clave[$i] == strtoupper($clave[$i])) {
                $mayuscula = true;
            }
            if (is_numeric($clave[$i])) {
                $numero = true;
            }
        }
        if ($mayuscula != true || $numero != true) {
            $_SESSION['erroresPassword'] = "La contraseña debe tener 1 mayúscula y 1 número.";
            $errores = true;
        } else {
            if (strcmp(($clave), ($claveRepetida)) != 0) {
                $errores = true;
                $_SESSION['erroresPassword'] = "Las contraseñas deben coincidir";
            } else {
                $claveCifrada = test_input($_POST["contraseña"]);
                $claveCifrada = md5($claveCifrada);
            }
        }
    }

    if (strlen($nombre) != 0) {
        if (!preg_match('/^[A-Za-zá-ú Á-Ú]{1,30}$/', $nombre)) {
            $_SESSION['erroresNombre'] = "Introduzca un nombre con formato valido";
            $errores = true;
        }
    }


    if ($errores) {
        header("location: modificar.php");
        exit();
    } else {
        if (strlen($clave) != 0 && strlen($claveRepetida) != 0) {
            $sql = "UPDATE usuarios SET Nombre = '$nombre', Clave = '$claveCifrada' WHERE IdUsuario = '$IdUsuario'";
        } else {
            $sql = "UPDATE usuarios SET Nombre = '$nombre' WHERE IdUsuario = '$IdUsuario'";
        }
        if ($conn->query($sql) === TRUE) {
            $_SESSION['Nombre'] = $nombre;
            $_SESSION['correcto'][] = "Se ha modificado correctamente";
            header("location: modificar.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
} else {
    header("location: ./modificar.php");
    exit();
}



function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
