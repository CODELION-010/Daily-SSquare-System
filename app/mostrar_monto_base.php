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
        

// Obtener el último valor registrado en la tabla valor_base
$sql = "SELECT monto_base FROM valor_base WHERE user_id = $user_id ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $monto_base_actual = $result->fetch_assoc()['monto_base'];
    $monto_base_actual = number_format($monto_base_actual, 0, ',', '.');
    echo"$monto_base_actual";
} else {
    $monto_base_actual = 0; // Valor predeterminado si no hay registros en la tabla
}
?>