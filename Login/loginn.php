<?php
session_start();
require '../Conexion/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["email"];
    $password = $_POST["password"];

    $_SESSION['errores'] = "";


    if (isset($email, $password)) {

        $claveCifrada = md5($password);

        $sql = "Select * from usuarios where Email = '$email'";
        $result1 = mysqli_query($conn, $sql);

        //Existe usuario con ese email
        if (mysqli_num_rows($result1) > 0) {
            //Existe ese email
            $sql2 = "SELECT * from usuarios WHERE Email ='$email' AND Clave ='$claveCifrada'";
            $result2 = mysqli_query($conn, $sql2);

            $sql3 = "SELECT (Intentos) FROM usuarios WHERE Email ='$email'";
            $result3 = mysqli_query($conn, $sql3);

            $row2 = mysqli_fetch_assoc($result2);
            $value = ($row2["Intentos"]);

            //Existe ese usuario con esa contraseña y vemos si los intentos son distintos que 5
            if ((mysqli_num_rows($result2) > 0) && ($value != 5)) {
                mysqli_data_seek($result2, 0);
                while ($row = mysqli_fetch_assoc($result2)) {
                    echo 'entra2';
                    if ($row["Email"] == $email && $row["Clave"] == $claveCifrada) {
                        $_SESSION['IdUsuario'] = $row["IdUsuario"];
                        $_SESSION['IdPiso'] = $row["IdPiso"];
                        $_SESSION["Email"] = $row["Email"];
                        $_SESSION["Clave"] = $row["Clave"];
                        $_SESSION['Nombre'] = $row["Nombre"];
                        $_SESSION['Rol'] = $row["Rol"];

                        //Reiniciamos los intentos
                        $sql4 = "UPDATE usuarios set Intentos='0' where Email='$email'";
                        $result4 = mysqli_query($conn, $sql4);


                        header("location: ../Administrador/index.php");
                    } else {
                        $_SESSION['errores'] = "El usuario está bloqueado";
                        header("location: login.php");
                    }
                }
            } else {
                if ($value == 5) {
                    $_SESSION['errores'] = "El usuario está bloqueado";
                    header("location: login.php");
                } else {
                    //Contraseña incorrecta, aumentamos el numero de intentos
                    $sql = "SELECT (Intentos) FROM usuarios WHERE Email ='$email'";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $value = ($row["NumeroIntentos"]) + 1;
                    if ($value == 5) {
                        $sql = "UPDATE usuarios set Bloqueado='1' where Email='$email'";
                        $result = mysqli_query($conn, $sql);
                        $_SESSION['errores'] = "Intentos de login maximos alcanzados";
                        header("location: login.php");
                    }

                    $sql = "UPDATE usuarios set Intentos='$value' where Email='$email'";
                    $result = mysqli_query($conn, $sql);

                    $_SESSION['errores'] = "Datos incorrectos";
                    header("location: login.php");
                }
            }
        } else {
            $_SESSION['errores'] = "No existe ese email en la base de datos";
            header("location: login.php");
        }
    }
} else {
    echo "<script>
    window.location.href='../index.php'
    </script>";
}
