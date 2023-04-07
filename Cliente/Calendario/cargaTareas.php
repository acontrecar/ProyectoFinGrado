<?php
header('Content-Type: application/json');
session_start();
if ($_SESSION['Rol'] != 'cliente') {
    header("location: ../../index.html");
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    require '../../Conexion/conexion.php';

    $filtro = $_GET['filtro'];

    // construye la consulta SQL basada en el valor del select
    if (
        $filtro === '0'
    ) {
        //SELECT DISTINCT t.IdTarea,t.FechaInicio,t.FechaFin,t.Descripción, r.Color FROM tareas t,tipoTarea r where t.IdPiso = 12 and r.IdTipoTarea=t.IdTipoTarea
        //$sql = 'SELECT * FROM tareas where IdPiso = ' . $_SESSION['IdPiso'];
        $sql = "SELECT DISTINCT t.IdTarea,t.FechaInicio,t.FechaFin,t.Descripción, r.Color FROM tareas t,tipoTarea r where t.IdPiso = " . $_SESSION["IdPiso"] . " and r.IdTipoTarea=t.IdTipoTarea";
    } else {
        $sql = "SELECT DISTINCT t.IdTarea,t.FechaInicio,t.FechaFin,t.Descripción, r.Color FROM tareas t,tipoTarea r where t.IdPiso = " . $_SESSION["IdPiso"] . " and r.IdTipoTarea=t.IdTipoTarea and r.IdTipoTarea = '$filtro'";
        //$sql = "SELECT * FROM tareas WHERE IdTipoTarea = '$filtro' and IdPiso = " . $_SESSION['IdPiso'];
    }

    $resultado = mysqli_query($conn, $sql);

    if (mysqli_num_rows($resultado) > 0) {
        // construye un array con los resultados de la consulta
        $resultadosArray = array();
        $arrayTareas = array();

        while ($fila = mysqli_fetch_assoc($resultado)) {
            $resultadosArray[] = $fila;
        }

        /*foreach ($resultadosArray as $resultado) {
            $arrayTareas[] = [
                'title' => $resultado->Descripcion,
                'start' => $resultado->FechaInicio,
                'end' => $resultado->FechaFin
            ];
        }*/

        // devuelve los resultados como un objeto JSON
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
