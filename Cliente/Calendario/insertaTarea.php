<?php
header('Content-Type: application/json');
session_start();
if ($_SESSION['Rol'] != 'cliente') {
    header("location: ../../index.html");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idTarea = $_POST['title'];

    // Formatear la fecha para que sea compatible con MySQL
    $start = date('Y-m-d H:i:s', strtotime($_POST['start']));
    $end = date('Y-m-d H:i:s', strtotime($_POST['end']));
    $descripcion = $_POST['descripcion'];
    $usuariosSeleccionados = $_POST['usuariosSeleccionados'];


    if (isset($idTarea, $start, $end, $descripcion, $usuariosSeleccionados)) {
        require '../../Conexion/conexion.php';

        $idPiso = $_SESSION['IdPiso'];

        $sql = "INSERT INTO tareas values ('0','$idTarea','$idPiso','$start','$end','$descripcion')";
        mysqli_query($conn, $sql);

        $sql2 = "SELECT IdTarea from tareas ORDER BY IdTarea DESC LIMIT 1";
        $resultado2 = mysqli_query($conn, $sql2);

        // Verificar si hay resultados
        if (mysqli_num_rows($resultado2) > 0) {
            // Obtener el dato
            $row = mysqli_fetch_array($resultado2);
            $id_tarea = $row["IdTarea"];

            foreach ($usuariosSeleccionados as $usuario) {
                $sql3 = "INSERT INTO tareaUsuario values ('0','$usuario','$id_tarea')";
                mysqli_query($conn, $sql3);
            }

            $response = array(
                'success' => true,
                'message' => 'Tarea dada de alta correctamente'
            );
            echo json_encode($response);
        } else {
            $response = array(
                'success' => false,
                'message' => 'No se ha podido dar de alta la tarea'
            );
            echo json_encode($response);
        }
    } else {
        $response = array(
            'success' => false,
            'message' => 'Por favor, rellena todos los campos'
        );
        echo json_encode($response);
    }
} else {
    $response = array(
        'success' => false,
        'message' => 'No estas accediendo correctamente a este archivo'
    );
    echo json_encode($response);
}
