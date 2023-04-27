<?php
session_start();
require '../../Conexion/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION['Rol'] == 'administrador') {

    $direccion = $_POST["direccion"];
    $nombrePiso = $_POST["nombrePiso"];

    $_SESSION['errores'] = "";
    $_SESSION['correcto'] = "";


    if (isset($direccion, $nombrePiso)) {

        if (!empty($nombrePiso) && !empty($direccion)) {
            //Todo ha pasado bien
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


            //Compruebo si se ha mandado algun email y que no este vacío
            if (isset($_POST['emails'])) {
                //Compruebo si algun email esta vacio
                $emails = $_POST['emails'];
                foreach ($emails as $email) {
                    if (empty($email)) {
                        $_SESSION['errores'] .= "No puede haber ningun email vacio";
                        header("location: paginaPrincipalNuevoPiso.php");
                        exit();
                    }
                }
            } else {
                $_SESSION['errores'] .= "Debe de haber al menos un usuario";
                header("location: paginaPrincipalNuevoPiso.php");
                exit();
            }


            //Compruebo si algun email nuevo coincide con alguno ya existente
            $emails = $_POST['emails'];

            if (checkDuplicateEmails($emails)) {
                $_SESSION['errores'] .= "No puede haber emails duplicados";
                header("location: paginaPrincipalNuevoPiso.php");
                exit();
            }

            foreach ($emails as $email) {
                $sql = "SELECT * FROM usuarios WHERE Email='$email'";
                $resultado = mysqli_query($conn, $sql);
                if (mysqli_num_rows($resultado) > 0) {
                    $_SESSION['errores'] .= "El email " . $email . " ya existe en la base de datos";
                    header("location: paginaPrincipalNuevoPiso.php");
                    exit();
                }
            }

            //Doy de alta el piso
            $sql = "INSERT INTO piso (IdPiso,NombrePiso,Direccion) values ('0','$nombrePiso','$direccion')";
            mysqli_query($conn, $sql);
            $_SESSION['correcto'] = "Piso dado de alta correctamente";

            //Doy de alta los usuarios correspondientes si es que existe alguno:
            $sql2 = "SELECT IdPiso from piso ORDER BY IdPiso DESC LIMIT 1";
            $resultado2 = mysqli_query($conn, $sql2);

            // Verificar si hay resultados
            if (mysqli_num_rows($resultado2) > 0) {
                // Obtener el dato
                $row = mysqli_fetch_array($resultado2);
                $id_piso = $row["IdPiso"];
            }


            //Mirar bien esto
            // $header = "From: antonio@alquileres.webantonioc.es" . "\r\n";
            // $header .=
            //     "Reply-To: antonio@alquileres.webantonioc.es" . "\r\n";
            // $header .=
            //     "X-Mailer: PHP/" . phpversion();

            $headers = "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
            $headers .= "From: Antonio Contreras Cárdenas <antonio@alquileres.webantonioc.es>\r\n";
            $headers .= "Reply-To: antonio@alquileres.webantonioc.es\r\n";
            $headers .= "Return-path: antonio@alquileres.webantonioc.es\r\n";
            $headers .= "Cc: antonio@alquileres.webantonioc.es\r\n";
            $headers .= "Bcc: carantabel@gmail.com,acontrecar@gmail.com\r\n";

            $asunto = "Tu contraseña para la aplicación de alquileres";
            $emails = $_POST['emails'];



            foreach ($emails as $email) {
                $partes = explode('@', $email);
                $nombreProvisionalUsuario = $partes[0];
                $password = generarContrasena();
                $claveCifrada = md5($password);
                $cuerpoEmail = '<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
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
                $sql3 = "INSERT INTO usuarios VALUES ('0','$id_piso','$email', '$claveCifrada','0','0','cliente','$nombreProvisionalUsuario')";
                if (mysqli_query($conn, $sql3)) {
                    mail($email, $asunto, $cuerpoEmail, $headers);
                } else {
                    $_SESSION['errores'] .= "Error al insertar el usuario:" . $email;
                }
            }





            header("location: paginaPrincipalNuevoPiso.php");
            exit();
        } else {
            $_SESSION['errores'] += "Los campos deben de estar en el formato correcto";
            header("location: paginaPrincipalNuevoPiso.php");
            exit();
        }
    } else {
        $_SESSION['errores'] .= "Rellene los campos necesarios";
        header("location: paginaPrincipalNuevoPiso.php");
        exit();
    }
} else {
    echo "<script>
    window.location.href='../../index.html'
    </script>";
    exit();
}

function checkDuplicateEmails($emails)
{
    $counts = array_count_values($emails);
    foreach ($counts as $email => $count) {
        if ($count > 1) {
            return true; // hay al menos un email duplicado
        }
    }
    return false; // no hay emails duplicados
}
