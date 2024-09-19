<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "prog";

$conexion = new mysqli($hostname, $username, $password, $database);

if ($conexion->connect_error) {
    die("error en la conexion a la base de datos" . $conexion->connect_error);
}
//echo "conexion exitosa";
