<?php
session_start();
include "../db/conexion_db.php";
// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['email']) && !isset($_SESSION['user_id']) && !isset($_SESSION['telefono'])) {
    // Si no ha iniciado sesión, redirige al usuario a la página de inicio de sesión.
    header('Location: ../index.php');
    exit();
}           
$user_id = $_SESSION['user_id'];
$correo = $_SESSION['email'];
$nombre = $_SESSION['nombre'];
$telefono = $_SESSION['telefono'];
$num_movimientos = $_SESSION['num_movimientos'];


echo "$user_id . $correo . $nombre . $telefono . num_movimientos";

?>

