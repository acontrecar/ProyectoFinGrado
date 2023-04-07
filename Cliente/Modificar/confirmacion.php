<?php
require "../../Conexion/conexion.php";
session_start();
if (!isset($_SESSION['IdUsuario']) && $_SESSION['Rol'] != 'cliente') {
    header("location: ../../index.php");
    exit();
}

$existen_errores = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $_SESSION['erroresPassword'] = "";
    $_SESSION['erroresNombre'] = "";
    $_SESSION['erroresEmail'] = "";


    $IdUsuario = $_POST["IdUsuario"];
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $StringContraseña = $_POST["contraseña"];

    $errores = false;

    $ContraseñaErr = "";
    $nombreErr = "";
    $RepiteContraseñaErr = "";
    $EmailErr = "";
    $mayuscula = false;
    $numero = false;
    $contraseñaCifrada = "";

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

    if (!preg_match('/^[A-Za-zá-ú Á-Ú]{1,30}$/', $nombre)) {
        $_SESSION['erroresNombre'] = "Introduzca un nombre con formato valido";
        $errores = true;
    }

    if (!preg_match('/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/', $email)) {
        $_SESSION['erroresEmail'] = "Introduzca un email con formato valido";
        $errores = true;
    }

    if ($errores) {
        echo "<script>
    alert('Existen errores en el formulario y no se ha podido modificar el usuario');
    window.location.href='./modificar.php'
    </script>";
    } else {
        $sql = "UPDATE usuarios";

        $CLAUSES = array();

        if (strlen($nombre) != 0) {
            $CLAUSES[] = 'Nombre = "' . $nombre . '"';
        }
        if (strlen($email) != 0) {
            $CLAUSES[] = 'Email = "' . $email . '"';
        }
        if (strlen($contraseñaCifrada) != 0) {
            $CLAUSES[] = 'Clave = "' . $contraseñaCifrada . '"';
        }
        if (count($CLAUSES) > 0) {
            $sql .= ' SET ' . implode(' , ', $CLAUSES) . ' WHERE IdUsuario="' . $IdUsuario . '" ';
        }


        mysqli_query($conn, $sql);
        echo "<script>
    alert('Se ha modificado el usuario correctamente');
    window.location.href='./modificar.php'
    </script>";
    }
}


function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
