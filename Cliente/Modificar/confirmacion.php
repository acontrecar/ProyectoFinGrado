<?php
require "../../Conexion/conexion.php";
session_start();
if (!isset($_SESSION['IdUsuario']) && $_SESSION['Rol'] != 'cliente') {
    header("location: ../../index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $IdUsuario = isset($_POST["IdUsuario"]) ? $_POST["IdUsuario"] : "";
    $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : "";
    $StringContraseña = isset($_POST["contraseña"]) ? $_POST["contraseña"] : "";

    $errores = false;

    $ContraseñaErr = "";
    $nombreErr = "";
    $RepiteContraseñaErr = "";
    $mayuscula = false;
    $numero = false;
    $contraseñaCifrada = "";

    if (!isset($_POST["contraseña"]) && !isset($_POST["contraseña2"])) {
        echo 'entra';
        for ($i = 0; $i < strlen($StringContraseña); $i++) {
            if ($StringContraseña[$i] == strtoupper($StringContraseña[$i])) {
                $mayuscula = true;
            }
            if (is_numeric($StringContraseña[$i])) {
                $numero = true;
            }
        }
        if ($mayuscula != true || $numero != true) {
            $_SESSION['erroresPassword'] = "La contraseña debe tener 1 mayúscula y 1 número.";
            $errores = true;
        } else {
            if (strcmp(($_POST["contraseña"]), ($_POST["contraseña2"])) != 0) {
                $errores = true;
                $_SESSION['erroresPassword'] = "Las contraseñas deben coincidir";
            } else {
                $contraseñaCifrada = test_input($_POST["contraseña"]);
                $contraseñaCifrada = md5($contraseñaCifrada);
            }
        }
    }

    if (isset($nombre) && !preg_match('/^[A-Za-zá-ú Á-Ú]{1,30}$/', $nombre)) {
        $_SESSION['erroresNombre'] = "Introduzca un nombre con formato valido";
        $errores = true;
    }

    if ($errores) {
        // echo "<script>
        //     alert('Existen errores en el formulario y no se ha podido modificar el usuario');
        //     window.location.href='./modificar.php'
        // </script>";
        // exit();
    } else {
        if (isset($_POST["contraseña"]) && isset($_POST["contraseña2"])) {
            $sql = "UPDATE usuarios SET Clave='$contraseñaCifrada' WHERE IdUsuario='$IdUsuario'";
            mysqli_query($conn, $sql);
        }

        if (isset($nombre)) {
            $sql = "UPDATE usuarios SET Nombre='$nombre' WHERE IdUsuario='$IdUsuario'";
            mysqli_query($conn, $sql);
        }

        if (isset($_POST["contraseña"]) || isset($nombre)) {
            echo "<script>
                alert('Se ha modificado el usuario correctamente');
                window.location.href='./modificar.php'
            </script>";
        } else {
            echo "<script>
                alert('No se ha modificado nada');
                window.location.href='./modificar.php'
            </script>";
        }
        exit();
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
