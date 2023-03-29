<?php
session_start();
require '../../Conexion/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION['Rol'] == 'administrador') {

    $imagen = $_FILES["imagen"]["tmp_name"];
    $latitud = $_POST["latitud"];
    $longitud = $_POST["longitud"];
    $nombreCalle = $_POST["nombreCalle"];
    $nombrePiso = $_POST["nombrePiso"];

    $_SESSION['errores'] = "";
    $_SESSION['correcto'] = "";


    if (isset($latitud, $longitud, $nombrePiso)) {

        $check = getimagesize($imagen);
        if ($check !== false) {
            if (is_numeric($latitud) && is_numeric($longitud) && !empty($nombrePiso)) {
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


                //Doy de alta el piso
                $Imagen = basename($_FILES["imagen"]["name"]);
                $sql = "INSERT INTO piso values ('0','$latitud','$longitud','$Imagen','$nombreCalle','$nombrePiso')";
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
                $header = "From: antonio@alquileres.webantonioc.es" . "\r\n";
                $header .=
                    "Reply-To: antonio@alquileres.webantonioc.es" . "\r\n";
                $header .=
                    "X-Mailer: PHP/" . phpversion();
                $emails = $_POST['emails'];
                foreach ($emails as $email) {
                    $password = generarContrasena();
                    $claveCifrada = md5($password);
                    $sql3 = "INSERT INTO usuarios VALUES ('0','$id_piso','$email', $claveCifrada','0','0','cliente',' ')";
                    if (mysqli_query($conn, $sql3)) {
                        mail($email, 'Tu contraseña', 'Aquí tu contraseña inicial: ' . $password, $header);
                    } else {
                        $_SESSION['errores'] = "Error al insertar el usuario" . mysqli_error($conn);
                    }
                }





                header("location: paginaPrincipalNuevoPiso.php");
            } else {
                $_SESSION['errores'] += "Los campos deben de estar en el formato correcto";
                header("location: paginaPrincipalNuevoPiso.php");
            }
        } else {
            // El archivo no es una imagen
            $_SESSION['errores'] .= "El archivo no es una imagen";
            header("location: paginaPrincipalNuevoPiso.php");
        }
    } else {
        $_SESSION['errores'] .= "Rellene los campos necesarios";
        header("location: paginaPrincipalNuevoPiso.php");
    }
} else {
    echo "<script>
    window.location.href='../../index.html'
    </script>";
}
