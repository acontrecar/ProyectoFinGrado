<?php
$servername = "sql925.main-hosting.eu";
$database = "u417389617_pisos";
$username = "u417389617_antonioc";
$password = "B9!m;f*b";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
