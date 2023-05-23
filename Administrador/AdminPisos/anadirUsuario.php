<?php

require "../../Conexion/conexion.php";
session_start();

$email = $_GET['email'];
$piso_id = $_GET['piso_id'];

$_SESSION['errores'] = "";
$_SESSION['correcto'] = "";

if (!isset($_SESSION['IdUsuario']) && $_SESSION['Rol'] != 'administrador' && !isset($email)) {
    header("location: ../../index.php");
    exit();
    return;
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {




    //Definimos todas las funciones para poder hacer uso de ellas
    function checkDuplicateEmails($emails, $email)
    {
        foreach ($emails as $emailBD) {
            if ($emailBD['Email'] == $email) {
                return false;
            }
        }
        return true;
    }

    function generarContrasena()
    {
        // Definimos los caracteres posibles para la contraseña
        $caracteres = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$%^&*()_+";

        // Generamos un array con los caracteres posibles
        $arrayCaracteres = str_split($caracteres);

        // Generamos la contraseña aleatoria
        $contrasena = "";
        for (
            $i = 0;
            $i < 7;
            $i++
        ) {
            $caracterAleatorio = $arrayCaracteres[array_rand($arrayCaracteres)];
            $contrasena .= $caracterAleatorio;
        }

        return $contrasena;
    }



    function mandaEmail($email, $piso_id, $conn)
    {

        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
        $headers .= "From: Antonio Contreras Cárdenas <antonio@alquileres.webantonioc.es>\r\n";
        $headers .= "Reply-To: antonio@alquileres.webantonioc.es\r\n";
        $headers .= "Return-path: antonio@alquileres.webantonioc.es\r\n";
        $headers .= "Cc: antonio@alquileres.webantonioc.es\r\n";
        $headers .= "Bcc: carantabel@gmail.com,acontrecar@gmail.com\r\n";

        $asunto = "Tu contraseña para la aplicación de alquileres";


        // $email = $_GET['email'];

        $partes = explode('@', $email);
        $nombreProvisionalUsuario = $partes[0];
        $password = generarContrasena();
        $claveCifrada = md5($password);
        $cuerpoEmail = '<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Language" content="es">
    <title>Correo de contraseña</title>
    <style type="text/css">
        /* Estilos generales */
        body {
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
            font-size: 14px;
            line-height: 1.5;
            color: #333333;
        }

        .container {
            width: 90%;
            max-width: 600px;
            margin: 0 auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.15);
        }

        h1,
        h2,
        p {
            margin: 0;
            padding: 0;
        }

        h1 {
            font-size: 24px;
            font-weight: bold;
            color: #00b894;
            margin-bottom: 20px;
        }

        h2 {
            font-size: 20px;
            font-weight: bold;
            color: #333333;
            margin-top: 40px;
            margin-bottom: 10px;
        }

        p {
            margin-bottom: 20px;
        }

        a {
            color: #00b894;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        /* Estilos específicos */
        .logo {
            margin-bottom: 30px;
        }

        .password {
            font-size: 18px;
            font-weight: bold;
            color: #00b894;
            margin-top: 20px;
            margin-bottom: 30px;
        }
    </style>
</head>

<body>
    <div class="container">
        <img class="logo" src="https://pisos.webantonioc.es/assets/img/logoEmail.png" alt="Logo de la página">
        <h1>¡Bienvenido!</h1>
        <p>Te enviamos este correo para proporcionarte tu contraseña de acceso a nuestra página web. A continuación,
            encontrarás la contraseña que te corresponde:</p>
        <h2>Contraseña:</h2>
        <p class="password">' . $password . '</p>
        <p>Para iniciar sesión, sigue el siguiente enlace:</p>
        <p><a href="https://pisos.webantonioc.es/Login/login.php">Pincha para iniciar sesión</a></p>
        <p>Esperamos que disfrutes de tu experiencia en nuestra página web. ¡Gracias por confiar en nosotros!</p>
    </div>
</body>

</html>';

        // $piso_id = $_GET['piso_id'];

        $sql3 = "INSERT INTO usuarios VALUES ('0','$piso_id','$email', '$claveCifrada','0','0','cliente','$nombreProvisionalUsuario')";
        if (mysqli_query($conn, $sql3)) {
            mail($email, $asunto, $cuerpoEmail, $headers);
            $_SESSION['correcto'] .= "Usuario insertado correctamente";
            header("location: muestraInformacionPisos.php?piso_id=$piso_id");
            exit();
        } else {
            $_SESSION['errores'] .= "Error al insertar el usuario:" . $email;
            header("location: muestraInformacionPisos.php?piso_id=$piso_id");
            exit();
        }
    }
    // FIN FUNCIONES


    $sql1 = "Select Email from usuarios";
    $result1 = mysqli_query($conn, $sql1);
    $emails = mysqli_fetch_all($result1, MYSQLI_ASSOC);



    if (checkDuplicateEmails($emails, $email)) {
        mandaEmail($email, $piso_id, $conn);
    } else {
        $_SESSION['errores'] .= "El email ya existe";
        header("location: muestraInformacionPisos.php?piso_id=$piso_id");
        exit();
    }











    if (mysqli_query($conn, $sql)) {
        header("location: muestraInformacionPisos.php?piso_id=$piso_id");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        exit();
    }

    return;
} else {
    header("location: ../../index.html");
    exit();
    return;
}
