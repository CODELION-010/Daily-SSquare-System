<?php
session_start();
include "../db/conexion_db.php";

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['email'])) {
    // Si no ha iniciado sesión, redirige al usuario a la página de inicio de sesión.
    header('Location: ../index.php');
    exit();
}

// Consultar el número de registros en la tabla "movimientos"
$query = "SELECT COUNT(*) as num_movimientos FROM movimientos WHERE user_id = ?";
$stmt = $conn->prepare($query);

// Comprobar si la consulta preparada fue exitosa
if ($stmt) {
    // Enlazar el user_id del usuario actual a la consulta
    $stmt->bind_param('i', $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();

    // Obtener el número de registros
    $row = $result->fetch_assoc();
    $num_movimientos = $row['num_movimientos'];

    // Devolver el número de movimientos como texto
    echo $num_movimientos;

    $stmt->close();
} else {
    echo "Error en la consulta: " . $conn->error;
}
$conn->close();
?>
