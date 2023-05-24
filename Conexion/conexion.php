<?php
$servername = "sql513.main-hosting.eu";
$database = "u417389617_pisos";
$username = "u417389617_antonioc";
$password = "#p|zC4Irw2H";

$conn = mysqli_connect($servername, $username, $password, $database);



if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
