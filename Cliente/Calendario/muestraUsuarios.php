<?php
header('Content-Type: application/json');
session_start();
if ($_SESSION['Rol'] != 'cliente') {
    header("location: ../../index.html");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    require '../../Conexion/conexion.php';

    $filtro = $_POST['id'];

    $sql = "Select u.Nombre from tareaUsuario tu, usuarios u where tu.Completado = 0 and tu.IdTarea = '$filtro' and u.IdUsuario=tu.IdUsuario";

    $resultado = mysqli_query($conn, $sql);

    if (mysqli_num_rows($resultado) > 0) {

        $resultadosArray = array();

        while ($fila = mysqli_fetch_assoc($resultado)) {
            $resultadosArray[] = $fila;
        }

        $response = array(
            'success' => true,
            'data' => $resultadosArray,
        );

        echo json_encode($response);
    } else {
        // no se encontraron resultados
        $response = array(
            'success' => false,
            'message' => 'No se encontraron resultados'
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
