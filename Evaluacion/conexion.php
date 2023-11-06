<?php
$conexion = mysqli_connect("localhost", "root", "", "evaluaciondl");

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>
