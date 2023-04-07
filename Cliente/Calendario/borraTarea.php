<?php
header('Content-Type: application/json');
require '../../Conexion/conexion.php';
session_start();
if ($_SESSION['Rol'] != 'cliente') {
    header("location: ../../index.html");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idTarea = $_POST['id'];
    if (isset($idTarea)) {
        $sql = "DELETE from tareas where IdTarea=" . $idTarea;
        if (mysqli_query($conn, $sql)) {
            $response = array(
                'success' => true,
                'message' => 'La tarea se ha eliminado correctamente',
                'id' => $idTarea
            );
            echo json_encode($response);
        } else {
            $response = array(
                'success' => false,
                'message' => 'La tarea no se ha podido borrar'
            );
            echo json_encode($response);
        }
    }
}
