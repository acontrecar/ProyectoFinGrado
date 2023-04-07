<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    header('Location: ../index.php');
}
require "./conexion.php";
session_start();
mysqli_close($conn);
session_unset();
session_destroy();
header(("location: ../index.html"));
